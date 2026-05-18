<?php

namespace App\Controllers\Api\Admin;

use CodeIgniter\RESTful\ResourceController;
use App\Models\DashboardModel;

class DashboardController extends ResourceController
{
    protected $format = 'json';

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

        return $this->respond([
            'status'  => true,
            'message' => 'Dashboard data fetched successfully',
            'data'    => $data
        ], 200);
    }
}