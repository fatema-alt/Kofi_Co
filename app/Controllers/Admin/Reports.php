<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Reports extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $from = $this->request->getGet('from') ?? date('Y-m-01');
        $to   = $this->request->getGet('to') ?? date('Y-m-d');

        $fromDate = $from . ' 00:00:00';
        $toDate   = $to . ' 23:59:59';

        $sales = $db->table('orders')
            ->select('COUNT(id) as total_orders, SUM(grand_total) as total_sales')
            ->where('created_at >=', $fromDate)
            ->where('created_at <=', $toDate)
            ->where('payment_status', 'paid')
            ->get()
            ->getRowArray();

        $topItems = $db->table('order_items')
            ->select('menu_items.name, SUM(order_items.quantity) as total_qty, SUM(order_items.total) as total_amount')
            ->join('menu_items', 'menu_items.id = order_items.menu_item_id', 'left')
            ->join('orders', 'orders.id = order_items.order_id', 'left')
            ->where('orders.created_at >=', $fromDate)
            ->where('orders.created_at <=', $toDate)
            ->where('orders.payment_status', 'paid')
            ->groupBy('order_items.menu_item_id')
            ->orderBy('total_qty', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();

        $paymentSummary = $db->table('payments')
            ->select('payment_methods.name, SUM(payments.amount) as total')
            ->join('payment_methods', 'payment_methods.id = payments.payment_method_id', 'left')
            ->join('orders', 'orders.id = payments.order_id', 'left')
            ->where('orders.created_at >=', $fromDate)
            ->where('orders.created_at <=', $toDate)
            ->groupBy('payments.payment_method_id')
            ->get()
            ->getResultArray();

        $lowStock = $db->table('ingredients')
            ->select('ingredients.*, units.short_name as unit_name')
            ->join('units', 'units.id = ingredients.unit_id', 'left')
            ->where('ingredients.current_stock <= ingredients.low_stock_alert')
            ->orderBy('ingredients.current_stock', 'ASC')
            ->get()
            ->getResultArray();

        $categorySales = $db->table('order_items')
    ->select('menu_categories.name as category_name, SUM(order_items.quantity) as total_qty, SUM(order_items.total) as total_amount')
    ->join('menu_items', 'menu_items.id = order_items.menu_item_id', 'left')
    ->join('menu_categories', 'menu_categories.id = menu_items.category_id', 'left')
    ->join('orders', 'orders.id = order_items.order_id', 'left')
    ->where('orders.created_at >=', $fromDate)
    ->where('orders.created_at <=', $toDate)
    ->where('orders.payment_status', 'paid')
    ->groupBy('menu_categories.id')
    ->orderBy('total_amount', 'DESC')
    ->get()
    ->getResultArray();

$dailySales = $db->table('orders')
    ->select('DATE(created_at) as sale_date, COUNT(id) as total_orders, SUM(grand_total) as total_sales')
    ->where('created_at >=', $fromDate)
    ->where('created_at <=', $toDate)
    ->where('payment_status', 'paid')
    ->groupBy('DATE(created_at)')
    ->orderBy('sale_date', 'ASC')
    ->get()
    ->getResultArray();

        return view('admin/reports/index', [
    'from' => $from,
    'to' => $to,
    'sales' => $sales,
    'topItems' => $topItems,
    'paymentSummary' => $paymentSummary,
    'lowStock' => $lowStock,
    'categorySales' => $categorySales,
    'dailySales' => $dailySales,
]);
    }
}