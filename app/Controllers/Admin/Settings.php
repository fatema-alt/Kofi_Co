<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Settings extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $settings = $db->table('settings')->where('id', 1)->get()->getRowArray();

        return view('admin/settings/index', [
            'settings' => $settings
        ]);
    }

    public function update()
    {
        $db = \Config\Database::connect();

        $settings = $db->table('settings')->where('id', 1)->get()->getRowArray();

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
            'restaurant_name' => $this->request->getPost('restaurant_name'),
            'phone'          => $this->request->getPost('phone'),
            'email'          => $this->request->getPost('email'),
            'address'        => $this->request->getPost('address'),
            'currency'       => $this->request->getPost('currency'),
            'tax_percent'    => $this->request->getPost('tax_percent'),
            'service_charge' => $this->request->getPost('service_charge'),
            'receipt_footer' => $this->request->getPost('receipt_footer'),
            'logo'           => $logoName,
            'updated_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/settings')->with('success', 'Settings updated successfully');
    }
}