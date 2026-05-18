<?php

namespace App\Controllers\Api\Admin;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\UserRoleModel;

class UsersController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $db = \Config\Database::connect();

        $users = $db->table('users')
            ->select('users.*, roles.name as role_name')
            ->join('user_roles', 'user_roles.user_id = users.id', 'left')
            ->join('roles', 'roles.id = user_roles.role_id', 'left')
            ->orderBy('users.id', 'DESC')
            ->get()
            ->getResultArray();

        return $this->respond([
            'status' => true,
            'message' => 'Users fetched',
            'data' => $users
        ]);
    }

    public function create()
    {
        $roleModel = new RoleModel();

        return $this->respond([
            'status' => true,
            'message' => 'Roles fetched',
            'data' => [
                'roles' => $roleModel->findAll()
            ]
        ]);
    }

    public function store()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->fail('Invalid request data');
        }

        $userModel = new UserModel();
        $userRoleModel = new UserRoleModel();

        if (empty($data['name']) || empty($data['email']) || empty($data['password']) || empty($data['role_id'])) {
            return $this->fail('Name, email, password and role are required');
        }

        $userId = $userModel->insert([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'status'   => $data['status'] ?? 1,
        ]);

        $userRoleModel->insert([
            'user_id' => $userId,
            'role_id' => $data['role_id'],
        ]);

        return $this->respondCreated([
            'status' => true,
            'message' => 'User created successfully',
            'data' => [
                'user_id' => $userId
            ]
        ]);
    }

    public function show($id = null)
    {
        $db = \Config\Database::connect();

        $user = $db->table('users')
            ->select('users.*, roles.id as role_id, roles.name as role_name')
            ->join('user_roles', 'user_roles.user_id = users.id', 'left')
            ->join('roles', 'roles.id = user_roles.role_id', 'left')
            ->where('users.id', $id)
            ->get()
            ->getRowArray();

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        return $this->respond([
            'status' => true,
            'message' => 'User fetched',
            'data' => $user
        ]);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->fail('Invalid request data');
        }

        $userModel = new UserModel();
        $userRoleModel = new UserRoleModel();

        $user = $userModel->find($id);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        $updateData = [
            'name'   => $data['name'] ?? $user['name'],
            'email'  => $data['email'] ?? $user['email'],
            'phone'  => $data['phone'] ?? $user['phone'],
            'status' => $data['status'] ?? $user['status'],
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $userModel->update($id, $updateData);

        if (!empty($data['role_id'])) {
            $existingRole = $userRoleModel->where('user_id', $id)->first();

            if ($existingRole) {
                $userRoleModel->update($existingRole['id'], [
                    'role_id' => $data['role_id']
                ]);
            } else {
                $userRoleModel->insert([
                    'user_id' => $id,
                    'role_id' => $data['role_id']
                ]);
            }
        }

        return $this->respond([
            'status' => true,
            'message' => 'User updated successfully'
        ]);
    }

    public function delete($id = null)
    {
        $userModel = new UserModel();

        $user = $userModel->find($id);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        $userModel->delete($id);

        return $this->respondDeleted([
            'status' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}