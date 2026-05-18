<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class AuthController extends ResourceController
{
    protected $format = 'json';

    public function login()
    {
        $db = \Config\Database::connect();
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->fail('Invalid request data');
        }

        $email    = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (!$email || !$password) {
            return $this->fail('Email and password are required');
        }

        $userModel = new UserModel();

        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return $this->failUnauthorized('Invalid email or password');
        }

        if ($user['status'] !== 'active' && $user['status'] != 1) {
            return $this->failForbidden('Your account is inactive');
        }

        if (!password_verify($password, $user['password'])) {
            return $this->failUnauthorized('Invalid email or password');
        }

        $role = $db->table('user_roles')
            ->select('roles.name as role_name')
            ->join('roles', 'roles.id = user_roles.role_id', 'left')
            ->where('user_roles.user_id', $user['id'])
            ->get()
            ->getRowArray();

        return $this->respond([
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => [
                    'id'    => $user['id'],
                    'name'  => $user['name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'] ?? null,
                    'role'  => $role['role_name'] ?? 'Cashier',
                    'status'=> $user['status'],
                ]
            ]
        ]);
    }

    public function logout()
    {
        return $this->respond([
            'status' => true,
            'message' => 'Logout successful'
        ]);
    }
}