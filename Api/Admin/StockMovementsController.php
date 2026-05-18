<?php

namespace App\Controllers\Api\Admin;

use CodeIgniter\RESTful\ResourceController;

class StockMovementsController extends ResourceController
{
    protected $format = 'json';

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

        return $this->respond([
            'status' => true,
            'message' => 'Stock movements fetched',
            'data' => $movements
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

        return $this->respond([
            'status' => true,
            'message' => 'Ingredients fetched',
            'data' => $ingredients
        ]);
    }

    public function store()
    {
        $db = \Config\Database::connect();

        // 🔥 JSON input (same as your POS checkout) :contentReference[oaicite:0]{index=0}
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->fail('Invalid request data');
        }

        $ingredientId = $data['ingredient_id'] ?? null;
        $type         = $data['type'] ?? null;
        $quantity     = (float) ($data['quantity'] ?? 0);
        $note         = $data['note'] ?? null;

        if (!$ingredientId || !$type || $quantity <= 0) {
            return $this->fail('Ingredient, type and valid quantity required');
        }

        $direction = in_array($type, ['purchase', 'adjustment_in', 'return'])
            ? 'in'
            : 'out';

        $ingredient = $db->table('ingredients')
            ->where('id', $ingredientId)
            ->get()
            ->getRowArray();

        if (!$ingredient) {
            return $this->failNotFound('Ingredient not found');
        }

        if ($direction === 'out' && $ingredient['current_stock'] < $quantity) {
            return $this->fail('Not enough stock available');
        }

        $db->transBegin();

        // Insert movement
        $db->table('stock_movements')->insert([
            'ingredient_id' => $ingredientId,
            'type'          => $type,
            'direction'     => $direction,
            'quantity'      => $quantity,
            'reference_id'  => null,
            'note'          => $note,
            'created_by'    => 1, // later JWT/session
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        $movementId = $db->insertID();

        // Update stock
        $newStock = $direction === 'in'
            ? $ingredient['current_stock'] + $quantity
            : $ingredient['current_stock'] - $quantity;

        $db->table('ingredients')
            ->where('id', $ingredientId)
            ->update([
                'current_stock' => $newStock,
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);

        if ($db->transStatus() === false) {
            $db->transRollback();
            return $this->fail('Stock update failed');
        }

        $db->transCommit();

        return $this->respondCreated([
            'status' => true,
            'message' => 'Stock updated successfully',
            'data' => [
                'movement_id' => $movementId,
                'ingredient_id' => $ingredientId,
                'type' => $type,
                'direction' => $direction,
                'quantity' => $quantity,
                'current_stock' => $newStock
            ]
        ]);
    }
}