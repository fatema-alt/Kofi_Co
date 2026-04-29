<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function todaySales()
    {
        return $this->db->table('orders')
            ->selectSum('grand_total')
            ->where('DATE(created_at)', date('Y-m-d'))
            ->where('payment_status', 'paid')
            ->get()
            ->getRow()
            ->grand_total ?? 0;
    }

    public function todayOrders()
    {
        return $this->db->table('orders')
            ->where('created_at >=', date('Y-m-d 00:00:00'))
            ->where('created_at <=', date('Y-m-d 23:59:59'))
            ->countAllResults();
    }

    public function recentOrders()
    {
        return $this->db->table('orders')
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();
    }

    public function paymentSummary()
    {
        return $this->db->table('payments')
            ->select('payment_methods.name, SUM(payments.amount) as total')
            ->join('payment_methods', 'payment_methods.id = payments.payment_method_id')
            ->where('DATE(payments.paid_at)', date('Y-m-d'))
            ->groupBy('payment_methods.id')
            ->get()
            ->getResultArray();
    }

    public function topSellingItems()
    {
        return $this->db->table('order_items')
            ->select('menu_items.name, SUM(order_items.quantity) as total_sold')
            ->join('menu_items', 'menu_items.id = order_items.menu_item_id')
            ->join('orders', 'orders.id = order_items.order_id')
            ->where('orders.payment_status', 'paid')
            ->groupBy('order_items.menu_item_id')
            ->orderBy('total_sold', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();
    }

    public function lowStockItems()
    {
        return $this->db->table('ingredients')
            ->where('current_stock <= low_stock_alert')
            ->orderBy('current_stock', 'ASC')
            ->limit(5)
            ->get()
            ->getResultArray();
    }
}