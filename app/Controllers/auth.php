<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    private $db;

    public function __construct()
    {
        // Connect to the default database group
        $this->db = \Config\Database::connect();
    } 

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('auth/login');
    }

    public function attemptLogin()
    {
        
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();
        $db = \Config\Database::connect();

$role = $db->table('user_roles')
    ->select('roles.name as role_name')
    ->join('roles', 'roles.id = user_roles.role_id')
    ->where('user_roles.user_id', $user['id'])
    ->get()
    ->getRowArray();
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid email or password');
        }

        if ($user['status'] !== 'active') {
            return redirect()->back()->with('error', 'Your account is inactive');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Invalid password');
        }
   
        session()->set([
            'user_id'    => $user['id'],
            'user_name'  => $user['name'],
            'user_email' => $user['email'],
            'user_role' => $role['role_name'] ?? 'Cashier',
            'isLoggedIn' => true,
           
        ]);

        return redirect()->to('/admin/dashboard');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}