<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $dashboard = new DashboardModel();

        $data = [
            'todaySales'     => $dashboard->todaySales(),
            'todayOrders'    => $dashboard->todayOrders(),
            'recentOrders'   => $dashboard->recentOrders(),
            'paymentSummary' => $dashboard->paymentSummary(),
            'topItems'       => $dashboard->topSellingItems(),
            'lowStockItems'  => $dashboard->lowStockItems(),
        ];

        return view('admin/dashboard', $data);
    }
}