<?php

namespace App\Controllers\Api\Admin;

use CodeIgniter\RESTful\ResourceController;

class OrdersController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $db = \Config\Database::connect();

        $orders = $db->table('orders')
            ->select('orders.*, users.name as cashier_name')
            ->join('users', 'users.id = orders.created_by', 'left')
            ->orderBy('orders.id', 'DESC')
            ->get()
            ->getResultArray();

        return $this->respond([
            'status'  => true,
            'message' => 'Orders fetched successfully',
            'data'    => $orders
        ], 200);
    }

    public function show($id = null)
    {
        $db = \Config\Database::connect();

        $order = $db->table('orders')
            ->select('orders.*, users.name as cashier_name')
            ->join('users', 'users.id = orders.created_by', 'left')
            ->where('orders.id', $id)
            ->get()
            ->getRowArray();

        if (!$order) {
            return $this->failNotFound('Order not found');
        }

        $items = $db->table('order_items')
            ->select('order_items.*, menu_items.name as item_name')
            ->join('menu_items', 'menu_items.id = order_items.menu_item_id', 'left')
            ->where('order_items.order_id', $id)
            ->get()
            ->getResultArray();

        $payment = $db->table('payments')
            ->select('payments.*, payment_methods.name as payment_method')
            ->join('payment_methods', 'payment_methods.id = payments.payment_method_id', 'left')
            ->where('payments.order_id', $id)
            ->get()
            ->getRowArray();

        return $this->respond([
            'status'  => true,
            'message' => 'Order details fetched successfully',
            'data'    => [
                'order'   => $order,
                'items'   => $items,
                'payment' => $payment
            ]
        ], 200);
    }

    public function receipt($id = null)
    {
        $db = \Config\Database::connect();

        $order = $db->table('orders')
            ->select('orders.*, users.name as cashier_name')
            ->join('users', 'users.id = orders.created_by', 'left')
            ->where('orders.id', $id)
            ->get()
            ->getRowArray();

        if (!$order) {
            return $this->failNotFound('Order not found');
        }

        $items = $db->table('order_items')
            ->select('order_items.*, menu_items.name as item_name')
            ->join('menu_items', 'menu_items.id = order_items.menu_item_id', 'left')
            ->where('order_items.order_id', $id)
            ->get()
            ->getResultArray();

        $payment = $db->table('payments')
            ->select('payments.*, payment_methods.name as payment_method')
            ->join('payment_methods', 'payment_methods.id = payments.order_id', 'left')
            ->where('payments.order_id', $id)
            ->get()
            ->getRowArray();

        $settings = $db->table('settings')
            ->where('id', 1)
            ->get()
            ->getRowArray();

        return $this->respond([
            'status'  => true,
            'message' => 'Receipt data fetched successfully',
            'data'    => [
                'order'       => $order,
                'items'       => $items,
                'payment'     => $payment,
                'appSettings' => $settings
            ]
        ], 200);
    }

    public function delete($id = null)
    {
        $db = \Config\Database::connect();

        $order = $db->table('orders')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$order) {
            return $this->failNotFound('Order not found');
        }

        $db->transStart();

        $db->table('payments')->where('order_id', $id)->delete();
        $db->table('order_items')->where('order_id', $id)->delete();
        $db->table('orders')->where('id', $id)->delete();

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->failServerError('Failed to delete order');
        }

        return $this->respondDeleted([
            'status'  => true,
            'message' => 'Order deleted successfully',
            'data'    => [
                'id' => $id
            ]
        ]);
    }
}