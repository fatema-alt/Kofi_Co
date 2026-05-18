<?php

namespace App\Controllers\Api\Admin;

use CodeIgniter\RESTful\ResourceController;

class IngredientsController extends ResourceController
{
    protected $format = 'json';

    public function index()
    {
        $db = \Config\Database::connect();

        $ingredients = $db->table('ingredients')
            ->select('ingredients.*, units.name as unit_name')
            ->join('units', 'units.id = ingredients.unit_id', 'left')
            ->orderBy('ingredients.id', 'DESC')
            ->get()
            ->getResultArray();

        return $this->respond([
            'status'  => true,
            'message' => 'Ingredients fetched successfully',
            'data'    => $ingredients
        ], 200);
    }

    public function create()
    {
        $db = \Config\Database::connect();

        $units = $db->table('units')->get()->getResultArray();

        return $this->respond([
            'status'  => true,
            'message' => 'Units fetched successfully',
            'data'    => [
                'units' => $units
            ]
        ], 200);
    }

    public function store()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            $data = $this->request->getPost();
        }

        $rules = [
            'name'            => 'required',
            'unit_id'         => 'required|numeric',
            'current_stock'   => 'required|numeric',
            'low_stock_alert' => 'required|numeric',
            'cost_per_unit'   => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $db = \Config\Database::connect();

        $db->table('ingredients')->insert([
            'name'            => $data['name'],
            'unit_id'         => $data['unit_id'],
            'current_stock'   => $data['current_stock'],
            'low_stock_alert' => $data['low_stock_alert'],
            'cost_per_unit'   => $data['cost_per_unit'],
            'expiry_date'     => $data['expiry_date'] ?? null,
            'status'          => 1,
            'created_at'      => date('Y-m-d H:i:s'),
        ]);

        return $this->respondCreated([
            'status'  => true,
            'message' => 'Ingredient added successfully',
            'data'    => [
                'id' => $db->insertID()
            ]
        ]);
    }

    public function show($id = null)
    {
        $db = \Config\Database::connect();

        $ingredient = $db->table('ingredients')
            ->select('ingredients.*, units.name as unit_name')
            ->join('units', 'units.id = ingredients.unit_id', 'left')
            ->where('ingredients.id', $id)
            ->get()
            ->getRowArray();

        if (!$ingredient) {
            return $this->failNotFound('Ingredient not found');
        }

        return $this->respond([
            'status'  => true,
            'message' => 'Ingredient fetched successfully',
            'data'    => $ingredient
        ], 200);
    }

    public function edit($id = null)
    {
        $db = \Config\Database::connect();

        $ingredient = $db->table('ingredients')->where('id', $id)->get()->getRowArray();

        if (!$ingredient) {
            return $this->failNotFound('Ingredient not found');
        }

        $units = $db->table('units')->get()->getResultArray();

        return $this->respond([
            'status'  => true,
            'message' => 'Ingredient edit data fetched successfully',
            'data'    => [
                'ingredient' => $ingredient,
                'units'      => $units
            ]
        ], 200);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            $data = $this->request->getPost();
        }

        $rules = [
            'name'            => 'required',
            'unit_id'         => 'required|numeric',
            'current_stock'   => 'required|numeric',
            'low_stock_alert' => 'required|numeric',
            'cost_per_unit'   => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $db = \Config\Database::connect();

        $ingredient = $db->table('ingredients')->where('id', $id)->get()->getRowArray();

        if (!$ingredient) {
            return $this->failNotFound('Ingredient not found');
        }

        $db->table('ingredients')->where('id', $id)->update([
            'name'            => $data['name'],
            'unit_id'         => $data['unit_id'],
            'current_stock'   => $data['current_stock'],
            'low_stock_alert' => $data['low_stock_alert'],
            'cost_per_unit'   => $data['cost_per_unit'],
            'expiry_date'     => $data['expiry_date'] ?? null,
        ]);

        return $this->respond([
            'status'  => true,
            'message' => 'Ingredient updated successfully',
            'data'    => [
                'id' => $id
            ]
        ], 200);
    }

    public function delete($id = null)
    {
        $db = \Config\Database::connect();

        $ingredient = $db->table('ingredients')->where('id', $id)->get()->getRowArray();

        if (!$ingredient) {
            return $this->failNotFound('Ingredient not found');
        }

        $db->table('ingredients')->where('id', $id)->delete();

        return $this->respondDeleted([
            'status'  => true,
            'message' => 'Ingredient deleted successfully',
            'data'    => [
                'id' => $id
            ]
        ]);
    }
}