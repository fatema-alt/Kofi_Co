<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $user = $db->table('users')
            ->select('users.*, roles.name as role_name')
            ->join('user_roles', 'user_roles.user_id = users.id', 'left')
            ->join('roles', 'roles.id = user_roles.role_id', 'left')
            ->where('users.id', session()->get('user_id'))
            ->get()
            ->getRowArray();

        return view('admin/profile/index', [
            'user' => $user
        ]);
    }

    public function update()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');

        $userModel->update($userId, [
            'name'  => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
        ]);

        session()->set('user_name', $this->request->getPost('name'));

        return redirect()->to('/admin/profile')->with('success', 'Profile updated successfully');
    }
}