<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Ingredients extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $ingredients = $db->table('ingredients')
            ->select('ingredients.*, units.name as unit_name')
            ->join('units', 'units.id = ingredients.unit_id', 'left')
            ->orderBy('ingredients.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/ingredients/index', [
            'ingredients' => $ingredients
        ]);
    }

    public function create()
    {
        $db = \Config\Database::connect();

        return view('admin/ingredients/create', [
            'units' => $db->table('units')->get()->getResultArray()
        ]);
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $db->table('ingredients')->insert([
            'name'            => $this->request->getPost('name'),
            'unit_id'         => $this->request->getPost('unit_id'),
            'current_stock'   => $this->request->getPost('current_stock'),
            'low_stock_alert' => $this->request->getPost('low_stock_alert'),
            'cost_per_unit'   => $this->request->getPost('cost_per_unit'),
            'expiry_date'     => $this->request->getPost('expiry_date'),
            'status'          => 1,
            'created_at'      => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/ingredients')->with('success', 'Ingredient added');
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        return view('admin/ingredients/edit', [
            'ingredient' => $db->table('ingredients')->where('id', $id)->get()->getRowArray(),
            'units'      => $db->table('units')->get()->getResultArray()
        ]);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $db->table('ingredients')->where('id', $id)->update([
            'name'            => $this->request->getPost('name'),
            'unit_id'         => $this->request->getPost('unit_id'),
            'current_stock'   => $this->request->getPost('current_stock'),
            'low_stock_alert' => $this->request->getPost('low_stock_alert'),
            'cost_per_unit'   => $this->request->getPost('cost_per_unit'),
            'expiry_date'     => $this->request->getPost('expiry_date'),
        ]);

        return redirect()->to('/admin/ingredients')->with('success', 'Updated');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('ingredients')->where('id', $id)->delete();

        return redirect()->to('/admin/ingredients')->with('success', 'Deleted');
    }
}