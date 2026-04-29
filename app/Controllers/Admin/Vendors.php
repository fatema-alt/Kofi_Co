<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Vendors extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $vendors = $db->table('vendors')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/vendors/index', [
            'vendors' => $vendors
        ]);
    }

    public function create()
    {
        return view('admin/vendors/create');
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $db->table('vendors')->insert([
            'name'           => $this->request->getPost('name'),
            'contact_person' => $this->request->getPost('contact_person'),
            'phone'          => $this->request->getPost('phone'),
            'email'          => $this->request->getPost('email'),
            'address'        => $this->request->getPost('address'),
            'status'         => $this->request->getPost('status') ?? 1,
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/vendors')->with('success', 'Vendor added successfully');
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        $vendor = $db->table('vendors')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        return view('admin/vendors/edit', [
            'vendor' => $vendor
        ]);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $db->table('vendors')
            ->where('id', $id)
            ->update([
                'name'           => $this->request->getPost('name'),
                'contact_person' => $this->request->getPost('contact_person'),
                'phone'          => $this->request->getPost('phone'),
                'email'          => $this->request->getPost('email'),
                'address'        => $this->request->getPost('address'),
                'status'         => $this->request->getPost('status') ?? 0,
                'updated_at'     => date('Y-m-d H:i:s'),
            ]);

        return redirect()->to('/admin/vendors')->with('success', 'Vendor updated successfully');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('vendors')->where('id', $id)->delete();

        return redirect()->to('/admin/vendors')->with('success', 'Vendor deleted successfully');
    }
}