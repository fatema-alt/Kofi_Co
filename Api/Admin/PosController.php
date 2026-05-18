<?php

namespace App\Controllers\Api\Admin;

use CodeIgniter\RESTful\ResourceController;

class PosController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $db = \Config\Database::connect();

        $items = $db->table('menu_items')
            ->select('menu_items.*, menu_categories.name as category_name')
            ->join('menu_categories', 'menu_categories.id = menu_items.category_id', 'left')
            ->where('menu_items.status', 1)
            ->orderBy('menu_items.id', 'DESC')
            ->get()
            ->getResultArray();

        $paymentMethods = $db->table('payment_methods')
            ->where('status', 1)
            ->get()
            ->getResultArray();

        $settings = $db->table('settings')->where('id', 1)->get()->getRowArray();

        return $this->respond([
            'status' => true,
            'message' => 'POS data fetched',
            'data' => [
                'items' => $items,
                'paymentMethods' => $paymentMethods,
                'settings' => $settings
            ]
        ]);
    }

    public function checkout()
    {
        $db = \Config\Database::connect();

        // 🔥 JSON input handle
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->fail('Invalid request data');
        }

        $cart = $data['cart'] ?? [];
        $paymentMethodId = $data['payment_method_id'] ?? null;
        $discountPercent = (float) ($data['discount_percent'] ?? 0);

        if (empty($cart)) {
            return $this->fail('Cart is empty');
        }

        // 🔢 Calculate subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }

        $settings = $db->table('settings')->where('id', 1)->get()->getRowArray();

        $discount = ($subtotal * $discountPercent) / 100;
        $tax = ($subtotal * ($settings['tax_percent'] ?? 0)) / 100;
        $serviceCharge = ($subtotal * ($settings['service_charge'] ?? 0)) / 100;

        $grandTotal = $subtotal - $discount + $tax + $serviceCharge;

        $db->transBegin();

        $orderNo = 'ORD-' . date('YmdHis');

        // 🧾 Insert Order
        $db->table('orders')->insert([
            'order_no' => $orderNo,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax' => $tax,
            'service_charge' => $serviceCharge,
            'grand_total' => $grandTotal,
            'payment_status' => 'paid',
            'status' => 'paid',
            'created_by' => 1, // 🔥 temporarily static (later JWT/user session)
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $orderId = $db->insertID();

        // 🧠 Process Cart
        foreach ($cart as $item) {
            $menuItemId = $item['id'];
            $orderQty = (float) $item['qty'];

            // Save order item
            $db->table('order_items')->insert([
                'order_id' => $orderId,
                'menu_item_id' => $menuItemId,
                'quantity' => $orderQty,
                'price' => $item['price'],
                'total' => $item['price'] * $orderQty,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            // 🔥 Recipe logic
            $recipes = $db->table('recipe_items')
                ->where('menu_item_id', $menuItemId)
                ->get()
                ->getResultArray();

            foreach ($recipes as $recipe) {
                $ingredientId = $recipe['ingredient_id'];
                $usedQty = (float) $recipe['quantity'] * $orderQty;

                $ingredient = $db->table('ingredients')
                    ->where('id', $ingredientId)
                    ->get()
                    ->getRowArray();

                if (!$ingredient) continue;

                $currentStock = (float) $ingredient['current_stock'];

                // ❌ Stock check
                if ($currentStock < $usedQty) {
                    $db->transRollback();

                    return $this->fail($ingredient['name'] . ' stock is not enough');
                }

                $newStock = $currentStock - $usedQty;

                // Update stock
                $db->table('ingredients')
                    ->where('id', $ingredientId)
                    ->update([
                        'current_stock' => $newStock,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);

                // Stock movement
                $db->table('stock_movements')->insert([
                    'ingredient_id' => $ingredientId,
                    'type' => 'sale',
                    'direction' => 'out',
                    'quantity' => $usedQty,
                    'reference_id' => $orderId,
                    'note' => 'Auto deducted from order ' . $orderNo,
                    'created_by' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        // 💳 Payment
        $db->table('payments')->insert([
            'order_id' => $orderId,
            'payment_method_id' => $paymentMethodId,
            'amount' => $grandTotal,
            'paid_at' => date('Y-m-d H:i:s'),
        ]);

        if ($db->transStatus() === false) {
            $db->transRollback();
            return $this->fail('Order failed');
        }

        $db->transCommit();

        return $this->respondCreated([
            'status' => true,
            'message' => 'Order placed successfully',
            'data' => [
                'order_id' => $orderId,
                'order_no' => $orderNo,
                'total' => $grandTotal
            ]
        ]);
    }
}