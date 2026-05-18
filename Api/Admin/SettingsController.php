<?php

namespace App\Controllers\Api\Admin;

use CodeIgniter\RESTful\ResourceController;

class SettingsController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $db = \Config\Database::connect();

        $settings = $db->table('settings')
            ->where('id', 1)
            ->get()
            ->getRowArray();

        if (!$settings) {
            return $this->failNotFound('Settings not found');
        }

        return $this->respond([
            'status'  => true,
            'message' => 'Settings fetched successfully',
            'data'    => $settings
        ], 200);
    }

    public function update($id = null)
    {
        $db = \Config\Database::connect();

        $settings = $db->table('settings')
            ->where('id', 1)
            ->get()
            ->getRowArray();

        if (!$settings) {
            return $this->failNotFound('Settings not found');
        }

        $data = $this->request->getJSON(true);

        if (!$data) {
            $data = $this->request->getPost();
        }

        $logoName = $settings['logo'] ?? null;

        $logo = $this->request->getFile('logo');

        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            if (!empty($settings['logo']) && file_exists(FCPATH . 'uploads/settings/' . $settings['logo'])) {
                unlink(FCPATH . 'uploads/settings/' . $settings['logo']);
            }

            $logoName = $logo->getRandomName();
            $logo->move(FCPATH . 'uploads/settings', $logoName);
        }

        $db->table('settings')->where('id', 1)->update([
            'restaurant_name' => $data['restaurant_name'] ?? $settings['restaurant_name'],
            'phone'          => $data['phone'] ?? $settings['phone'],
            'email'          => $data['email'] ?? $settings['email'],
            'address'        => $data['address'] ?? $settings['address'],
            'currency'       => $data['currency'] ?? $settings['currency'],
            'tax_percent'    => $data['tax_percent'] ?? $settings['tax_percent'],
            'service_charge' => $data['service_charge'] ?? $settings['service_charge'],
            'receipt_footer' => $data['receipt_footer'] ?? $settings['receipt_footer'],
            'logo'           => $logoName,
            'updated_at'     => date('Y-m-d H:i:s'),
        ]);

        return $this->respond([
            'status'  => true,
            'message' => 'Settings updated successfully',
            'data'    => [
                'restaurant_name' => $data['restaurant_name'] ?? $settings['restaurant_name'],
                'phone'          => $data['phone'] ?? $settings['phone'],
                'email'          => $data['email'] ?? $settings['email'],
                'address'        => $data['address'] ?? $settings['address'],
                'currency'       => $data['currency'] ?? $settings['currency'],
                'tax_percent'    => $data['tax_percent'] ?? $settings['tax_percent'],
                'service_charge' => $data['service_charge'] ?? $settings['service_charge'],
                'receipt_footer' => $data['receipt_footer'] ?? $settings['receipt_footer'],
                'logo'           => $logoName,
            ]
        ], 200);
    }
}