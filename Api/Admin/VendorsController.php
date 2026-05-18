<?php

namespace App\Controllers\Api\Admin;

use CodeIgniter\RESTful\ResourceController;

class VendorsController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $db = \Config\Database::connect();

        $vendors = $db->table('vendors')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        return $this->respond([
            'status' => true,
            'message' => 'Vendors fetched',
            'data' => $vendors
        ]);
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->fail('Invalid request data');
        }

        if (empty($data['name'])) {
            return $this->fail('Vendor name is required');
        }

        $db->table('vendors')->insert([
            'name'           => $data['name'],
            'contact_person' => $data['contact_person'] ?? null,
            'phone'          => $data['phone'] ?? null,
            'email'          => $data['email'] ?? null,
            'address'        => $data['address'] ?? null,
            'status'         => $data['status'] ?? 1,
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        return $this->respondCreated([
            'status' => true,
            'message' => 'Vendor added successfully',
            'data' => [
                'vendor_id' => $db->insertID()
            ]
        ]);
    }

    public function show($id = null)
    {
        $db = \Config\Database::connect();

        $vendor = $db->table('vendors')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$vendor) {
            return $this->failNotFound('Vendor not found');
        }

        return $this->respond([
            'status' => true,
            'message' => 'Vendor fetched',
            'data' => $vendor
        ]);
    }

    public function update($id = null)
    {
        $db = \Config\Database::connect();
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->fail('Invalid request data');
        }

        $vendor = $db->table('vendors')->where('id', $id)->get()->getRowArray();

        if (!$vendor) {
            return $this->failNotFound('Vendor not found');
        }

        $db->table('vendors')
            ->where('id', $id)
            ->update([
                'name'           => $data['name'] ?? $vendor['name'],
                'contact_person' => $data['contact_person'] ?? $vendor['contact_person'],
                'phone'          => $data['phone'] ?? $vendor['phone'],
                'email'          => $data['email'] ?? $vendor['email'],
                'address'        => $data['address'] ?? $vendor['address'],
                'status'         => $data['status'] ?? $vendor['status'],
                'updated_at'     => date('Y-m-d H:i:s'),
            ]);

        return $this->respond([
            'status' => true,
            'message' => 'Vendor updated successfully'
        ]);
    }

    public function delete($id = null)
    {
        $db = \Config\Database::connect();

        $vendor = $db->table('vendors')->where('id', $id)->get()->getRowArray();

        if (!$vendor) {
            return $this->failNotFound('Vendor not found');
        }

        $db->table('vendors')->where('id', $id)->delete();

        return $this->respondDeleted([
            'status' => true,
            'message' => 'Vendor deleted successfully'
        ]);
    }
}