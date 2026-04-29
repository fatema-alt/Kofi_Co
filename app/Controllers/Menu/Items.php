<?php

namespace App\Controllers\Menu;

use App\Controllers\BaseController;
use App\Models\MenuItemModel;
use App\Models\MenuCategoryModel;



class Items extends BaseController
{
    protected $itemModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->itemModel = new MenuItemModel();
        $this->categoryModel = new MenuCategoryModel();
    }

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

        $category = null;

        if (!empty($categoryId)) {
            $category = $this->categoryModel->find($categoryId);
        }

        return view('admin/menu/items/index', [
            'items' => $items,
            'category' => $category,
        ]);
       
    }

    public function create()
    {
        return view('admin/menu/items/create', [
            'categories' => $this->categoryModel
                ->where('status', 1)
                ->orderBy('name', 'ASC')
                ->findAll(),
        ]);
    }

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

        return redirect()->to('/admin/menu/items')->with('success', 'Menu item created successfully');
    }

   public function edit($id)
{
    $db = \Config\Database::connect();

    $recipeItems = $db->table('recipe_items')
        ->select('recipe_items.*, ingredients.name as ingredient_name, units.short_name as unit_name')
        ->join('ingredients', 'ingredients.id = recipe_items.ingredient_id', 'left')
        ->join('units', 'units.id = recipe_items.unit_id', 'left')
        ->where('recipe_items.menu_item_id', $id)
        ->get()
        ->getResultArray();

    $ingredients = $db->table('ingredients')
        ->select('ingredients.*, units.short_name as unit_name')
        ->join('units', 'units.id = ingredients.unit_id', 'left')
        ->where('ingredients.status', 1)
        ->orderBy('ingredients.name', 'ASC')
        ->get()
        ->getResultArray();

    return view('admin/menu/items/edit', [
        'item' => $this->itemModel->find($id),
        'categories' => $this->categoryModel
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->findAll(),
        'recipeItems' => $recipeItems,
        'ingredients' => $ingredients,
    ]);
}

    public function update($id)
    {
        $item = $this->itemModel->find($id);
        $imageName = $item['image'] ?? null;

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

        return redirect()->to('/admin/menu/items')->with('success', 'Menu item updated successfully');
    }

    public function delete($id)
    {
        $item = $this->itemModel->find($id);

        if (!empty($item['image']) && file_exists(FCPATH . 'uploads/menu/' . $item['image'])) {
            unlink(FCPATH . 'uploads/menu/' . $item['image']);
        }

        $this->itemModel->delete($id);

        return redirect()->to('/admin/menu/items')->with('success', 'Menu item deleted successfully');
    }
    public function storeRecipe()
{
    $db = \Config\Database::connect();

    $menuItemId = $this->request->getPost('menu_item_id');
    $ingredientId = $this->request->getPost('ingredient_id');
    $quantity = $this->request->getPost('quantity');

    $ingredient = $db->table('ingredients')
        ->where('id', $ingredientId)
        ->get()
        ->getRowArray();

    if (!$ingredient) {
        return redirect()->back()->with('error', 'Ingredient not found');
    }

    $db->table('recipe_items')->insert([
        'menu_item_id'  => $menuItemId,
        'ingredient_id' => $ingredientId,
        'quantity'      => $quantity,
        'unit_id'       => $ingredient['unit_id'],
        'created_at'    => date('Y-m-d H:i:s'),
    ]);

    return redirect()->to('/admin/menu/items/edit/' . $menuItemId)
        ->with('success', 'Recipe ingredient added');
}

public function deleteRecipe($recipeId, $menuItemId)
{
    $db = \Config\Database::connect();

    $db->table('recipe_items')
        ->where('id', $recipeId)
        ->delete();

    return redirect()->to('/admin/menu/items/edit/' . $menuItemId)
        ->with('success', 'Recipe ingredient removed');
}
}