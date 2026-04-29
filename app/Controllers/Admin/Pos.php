<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MenuCategoryModel;
use App\Models\MenuItemModel;

class Pos extends BaseController
{
    public function index()
    {
        $categoryModel = new MenuCategoryModel();
        $itemModel = new MenuItemModel();
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

        $settings = $db->table('settings')
    ->where('id', 1)
    ->get()
    ->getRowArray();

        return view('admin/pos/index', [
            'categories' => $categoryModel->where('status', 1)->findAll(),
            'items' => $items,
            'paymentMethods' => $paymentMethods,
            'appSettings' => $settings,
        ]);
    }

    public function checkout()
    {
        $db = \Config\Database::connect();

$cart = json_decode($this->request->getPost('cart'), true);
$paymentMethodId = $this->request->getPost('payment_method_id');
$discountPercent = (float) $this->request->getPost('discount_percent');

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

        $db->table('orders')->insert([
            'order_no' => $orderNo,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'tax' => $tax,
            'service_charge' => $serviceCharge,
            'grand_total' => $grandTotal,
            'payment_status' => 'paid',
            'status' => 'paid',
            'created_by' => session()->get('user_id'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $orderId = $db->insertID();

        foreach ($cart as $item) {
    $menuItemId = $item['id'];
    $orderQty   = (float) $item['qty'];

    // Save order item
    $db->table('order_items')->insert([
        'order_id'     => $orderId,
        'menu_item_id' => $menuItemId,
        'quantity'     => $orderQty,
        'price'        => $item['price'],
        'total'        => $item['price'] * $orderQty,
        'created_at'   => date('Y-m-d H:i:s'),
    ]);
    $settings = $db->table('settings')->where('id', 1)->get()->getRowArray();

$discount = 0;
$tax = ($subtotal * ($settings['tax_percent'] ?? 0)) / 100;
$serviceCharge = ($subtotal * ($settings['service_charge'] ?? 0)) / 100;

$grandTotal = $subtotal - $discount + $tax + $serviceCharge;
    // Get recipe ingredients for this menu item
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

        if (!$ingredient) {
            continue;
        }

        $currentStock = (float) $ingredient['current_stock'];

        // Not enough stock
        if ($currentStock < $usedQty) {
            $db->transRollback();

            return $this->response->setJSON([
                'success' => false,
                'message' => $ingredient['name'] . ' stock is not enough'
            ]);
        }

        $newStock = $currentStock - $usedQty;

        // Deduct ingredient stock
        $db->table('ingredients')
            ->where('id', $ingredientId)
            ->update([
                'current_stock' => $newStock,
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);

        // Create stock movement history
        $db->table('stock_movements')->insert([
            'ingredient_id' => $ingredientId,
            'type'          => 'sale',
            'direction'     => 'out',
            'quantity'      => $usedQty,
            'reference_id'  => $orderId,
            'note'          => 'Auto deducted from order ' . $orderNo,
            'created_by'    => session()->get('user_id'),
            'created_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}

        $db->table('payments')->insert([
            'order_id' => $orderId,
            'payment_method_id' => $paymentMethodId,
            'amount' => $grandTotal,
            'paid_at' => date('Y-m-d H:i:s'),
        ]);

        if ($db->transStatus() === false) {
    $db->transRollback();

    return $this->response->setJSON([
        'success' => false,
        'message' => 'Order failed'
    ]);
}

$db->transCommit();

       return $this->response->setJSON([
    'success' => true,
    'message' => 'Order placed successfully',
    'order_no' => $orderNo,
    'order_id' => $orderId
]);
    }
}