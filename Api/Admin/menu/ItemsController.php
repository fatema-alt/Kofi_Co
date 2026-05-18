<?php

namespace App\Controllers\Api\Admin\Menu;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MenuItemModel;
use App\Models\MenuCategoryModel;

class ItemsController extends ResourceController
{
    protected $format = 'json';
    protected $itemModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->itemModel = new MenuItemModel();
        $this->categoryModel = new MenuCategoryModel();
    }

    // ✅ GET items (with optional category filter)
    public function index()
    {
        $db = \Config\Database::connect();
        $categoryId = $this->request->getGet('category');

        $builder = $db->table('menu_items')
            ->select('menu_items.*, menu_categories.name as category_name')
            ->join('menu_categories', 'menu_categories.id = menu_items.category_id', 'left')
            ->orderBy('menu_items.id', 'DESC');

        if (!empty($categoryId)) {
            $builder->where('menu_items.category_id', $categoryId);
        }

        $items = $builder->get()->getResultArray();

        return $this->respond([
            'status' => true,
            'message' => 'Items fetched',
            'data' => $items
        ]);
    }

    // ✅ GET categories for dropdown
    public function create()
    {
        $categories = $this->categoryModel
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->findAll();

        return $this->respond([
            'status' => true,
            'data' => $categories
        ]);
    }

    // ✅ CREATE item (form-data بسبب image)
    public function store()
    {
        $imageName = null;
        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/menu', $imageName);
        }

        $this->itemModel->insert([
            'category_id' => $this->request->getPost('category_id'),
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'image'       => $imageName,
            'status'      => $this->request->getPost('status') ?? 1,
        ]);

        return $this->respondCreated([
            'status' => true,
            'message' => 'Item created',
            'data' => [
                'item_id' => $this->itemModel->insertID()
            ]
        ]);
    }

    // ✅ SHOW single item + recipe
    public function show($id = null)
    {
        $db = \Config\Database::connect();

        $item = $this->itemModel->find($id);

        if (!$item) {
            return $this->failNotFound('Item not found');
        }

        $recipes = $db->table('recipe_items')
            ->select('recipe_items.*, ingredients.name as ingredient_name, units.short_name as unit_name')
            ->join('ingredients', 'ingredients.id = recipe_items.ingredient_id', 'left')
            ->join('units', 'units.id = recipe_items.unit_id', 'left')
            ->where('recipe_items.menu_item_id', $id)
            ->get()
            ->getResultArray();

        return $this->respond([
            'status' => true,
            'data' => [
                'item' => $item,
                'recipes' => $recipes
            ]
        ]);
    }

    // ✅ UPDATE item (form-data)
    public function update($id = null)
    {
        $item = $this->itemModel->find($id);

        if (!$item) {
            return $this->failNotFound('Item not found');
        }

        $imageName = $item['image'];

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {

            if (!empty($item['image']) && file_exists(FCPATH . 'uploads/menu/' . $item['image'])) {
                unlink(FCPATH . 'uploads/menu/' . $item['image']);
            }

            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/menu', $imageName);
        }

        $this->itemModel->update($id, [
            'category_id' => $this->request->getPost('category_id'),
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'image'       => $imageName,
            'status'      => $this->request->getPost('status') ?? 0,
        ]);

        return $this->respond([
            'status' => true,
            'message' => 'Item updated'
        ]);
    }

    // ✅ DELETE item
    public function delete($id = null)
    {
        $item = $this->itemModel->find($id);

        if (!$item) {
            return $this->failNotFound('Item not found');
        }

        if (!empty($item['image']) && file_exists(FCPATH . 'uploads/menu/' . $item['image'])) {
            unlink(FCPATH . 'uploads/menu/' . $item['image']);
        }

        $this->itemModel->delete($id);

        return $this->respondDeleted([
            'status' => true,
            'message' => 'Item deleted'
        ]);
    }

    // ✅ ADD recipe
    public function addRecipe()
    {
        $db = \Config\Database::connect();

        $menuItemId  = $this->request->getPost('menu_item_id');
        $ingredientId = $this->request->getPost('ingredient_id');
        $quantity     = $this->request->getPost('quantity');

        $ingredient = $db->table('ingredients')->where('id', $ingredientId)->get()->getRowArray();

        if (!$ingredient) {
            return $this->fail('Ingredient not found');
        }

        $db->table('recipe_items')->insert([
            'menu_item_id'  => $menuItemId,
            'ingredient_id' => $ingredientId,
            'quantity'      => $quantity,
            'unit_id'       => $ingredient['unit_id'],
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        return $this->respondCreated([
            'status' => true,
            'message' => 'Recipe added'
        ]);
    }

    // ✅ DELETE recipe
    public function deleteRecipe($recipeId = null)
    {
        $db = \Config\Database::connect();

        $db->table('recipe_items')->where('id', $recipeId)->delete();

        return $this->respondDeleted([
            'status' => true,
            'message' => 'Recipe removed'
        ]);
    }
}