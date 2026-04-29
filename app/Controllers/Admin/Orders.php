<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Orders extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $orders = $db->table('orders')
            ->select('orders.*, users.name as cashier_name')
            ->join('users', 'users.id = orders.created_by', 'left')
            ->orderBy('orders.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/orders/index', [
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        $db = \Config\Database::connect();

        $order = $db->table('orders')
            ->select('orders.*, users.name as cashier_name')
            ->join('users', 'users.id = orders.created_by', 'left')
            ->where('orders.id', $id)
            ->get()
            ->getRowArray();

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

        return view('admin/orders/show', [
            'order' => $order,
            'items' => $items,
            'payment' => $payment
        ]);
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('payments')->where('order_id', $id)->delete();
        $db->table('order_items')->where('order_id', $id)->delete();
        $db->table('orders')->where('id', $id)->delete();

        return redirect()->to('/admin/orders')->with('success', 'Order deleted successfully');
    }
    public function receipt($id)
{
    $db = \Config\Database::connect();

    $order = $db->table('orders')
        ->select('orders.*, users.name as cashier_name')
        ->join('users', 'users.id = orders.created_by', 'left')
        ->where('orders.id', $id)
        ->get()
        ->getRowArray();


    if (!$order) {
        return redirect()->to('/admin/orders')->with('success', 'Order not found');
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
    $settings = $db->table('settings')->where('id', 1)->get()->getRowArray();
   
    

    return view('admin/orders/receipt', [
    'order' => $order,
    'items' => $items,
    'payment' => $payment,
    'appSettings' => $settings,
]);
}
}