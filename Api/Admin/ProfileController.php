<?php

namespace App\Controllers\Api\Admin;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class ProfileController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $db = \Config\Database::connect();

        // Temporary session-based user id
        $userId = session()->get('user_id');

        if (!$userId) {
            return $this->failUnauthorized('User not logged in');
        }

        $user = $db->table('users')
            ->select('users.*, roles.name as role_name')
            ->join('user_roles', 'user_roles.user_id = users.id', 'left')
            ->join('roles', 'roles.id = user_roles.role_id', 'left')
            ->where('users.id', $userId)
            ->get()
            ->getRowArray();

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        return $this->respond([
            'status'  => true,
            'message' => 'Profile fetched successfully',
            'data'    => $user
        ], 200);
    }

    public function update($id = null)
{
    $data = $this->request->getJSON(true);

    if (!$data) {
        $data = $this->request->getPost();
    }

    $userId = session()->get('user_id');

    if (!$userId) {
        return $this->failUnauthorized('User not logged in');
    }

    $rules = [
        'name'  => 'required|min_length[3]',
        'phone' => 'permit_empty|min_length[6]',
    ];

    if (!$this->validate($rules)) {
        return $this->failValidationErrors($this->validator->getErrors());
    }

    $userModel = new \App\Models\UserModel();

    $userModel->update($userId, [
        'name'  => $data['name'],
        'phone' => $data['phone'] ?? null,
    ]);

    session()->set('user_name', $data['name']);

    return $this->respond([
        'status'  => true,
        'message' => 'Profile updated successfully',
        'data'    => [
            'id'    => $userId,
            'name'  => $data['name'],
            'phone' => $data['phone'] ?? null,
        ]
    ], 200);
}
}