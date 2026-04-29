<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = session()->get('user_role');

        if (!$role) {
            return redirect()->to('/login');
        }

        if ($role === 'Admin') {
            return;
        }

        if (in_array('Manager', $arguments ?? []) && $role === 'Manager') {
            return;
        }

        if (in_array('Cashier', $arguments ?? []) && $role === 'Cashier') {
            return;
        }

        return redirect()->to('/admin/dashboard')->with('error', 'Access denied');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}