<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class StockMovements extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $movements = $db->table('stock_movements')
            ->select('stock_movements.*, ingredients.name as ingredient_name, units.short_name as unit_name')
            ->join('ingredients', 'ingredients.id = stock_movements.ingredient_id', 'left')
            ->join('units', 'units.id = ingredients.unit_id', 'left')
            ->orderBy('stock_movements.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/stock_movements/index', [
            'movements' => $movements
        ]);
    }

    public function create()
    {
        $db = \Config\Database::connect();

        $ingredients = $db->table('ingredients')
            ->select('ingredients.*, units.short_name as unit_name')
            ->join('units', 'units.id = ingredients.unit_id', 'left')
            ->where('ingredients.status', 1)
            ->orderBy('ingredients.name', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/stock_movements/create', [
            'ingredients' => $ingredients
        ]);
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $ingredientId = $this->request->getPost('ingredient_id');
        $type         = $this->request->getPost('type');
        $quantity     = (float) $this->request->getPost('quantity');
        $note         = $this->request->getPost('note');

        $direction = in_array($type, ['purchase', 'adjustment_in', 'return']) ? 'in' : 'out';

        $ingredient = $db->table('ingredients')
            ->where('id', $ingredientId)
            ->get()
            ->getRowArray();

        if (!$ingredient) {
            return redirect()->back()->with('error', 'Ingredient not found');
        }

        if ($direction === 'out' && $ingredient['current_stock'] < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock available');
        }

        $db->transStart();

        $db->table('stock_movements')->insert([
            'ingredient_id' => $ingredientId,
            'type'          => $type,
            'direction'     => $direction,
            'quantity'      => $quantity,
            'reference_id'   => null,
            'note'          => $note,
            'created_by'    => session()->get('user_id'),
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        if ($direction === 'in') {
            $newStock = $ingredient['current_stock'] + $quantity;
        } else {
            $newStock = $ingredient['current_stock'] - $quantity;
        }

        $db->table('ingredients')
            ->where('id', $ingredientId)
            ->update([
                'current_stock' => $newStock,
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);

        $db->transComplete();

        return redirect()->to('/admin/stock-movements')->with('success', 'Stock updated successfully');
    }
}