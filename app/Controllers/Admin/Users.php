<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\UserRoleModel;

class Users extends BaseController
{
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

        return view('admin/users/index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $roleModel = new RoleModel();

        return view('admin/users/create', [
            'roles' => $roleModel->findAll()
        ]);
    }

    public function store()
    {
        $userModel = new UserModel();
        $userRoleModel = new UserRoleModel();

        $userId = $userModel->insert([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'phone'    => $this->request->getPost('phone'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status'   => $this->request->getPost('status'),
        ]);

        $userRoleModel->insert([
            'user_id' => $userId,
            'role_id' => $this->request->getPost('role_id'),
        ]);

        
        return redirect()->to('/admin/users')->with('success', 'User created successfully 🎉');
    }
    public function edit($id)
{
    $userModel = new \App\Models\UserModel();
    $roleModel = new \App\Models\RoleModel();
    $userRoleModel = new \App\Models\UserRoleModel();

    $user = $userModel->find($id);

    if (!$user) {
        return redirect()->to('/admin/users')->with('success', 'User not found');
    }

    $userRole = $userRoleModel->where('user_id', $id)->first();

    return view('admin/users/edit', [
        'user'     => $user,
        'roles'    => $roleModel->findAll(),
        'userRole' => $userRole
    ]);
}

public function update($id)
{
    $userModel = new \App\Models\UserModel();
    $userRoleModel = new \App\Models\UserRoleModel();

    $data = [
        'name'   => $this->request->getPost('name'),
        'email'  => $this->request->getPost('email'),
        'phone'  => $this->request->getPost('phone'),
        'status' => $this->request->getPost('status'),
    ];

    if (!empty($this->request->getPost('password'))) {
        $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
    }

    $userModel->update($id, $data);

    $existingRole = $userRoleModel->where('user_id', $id)->first();

    if ($existingRole) {
        $userRoleModel->update($existingRole['id'], [
            'role_id' => $this->request->getPost('role_id')
        ]);
    } else {
        $userRoleModel->insert([
            'user_id' => $id,
            'role_id' => $this->request->getPost('role_id')
        ]);
    }

    return redirect()->to('/admin/users')->with('success', 'User updated successfully ✅');
}

public function delete($id)
{
    $userModel = new \App\Models\UserModel();

    $userModel->delete($id);

    return redirect()->to('/admin/users')->with('success', 'User deleted successfully 🗑️');
}
}