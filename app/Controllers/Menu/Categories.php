<?php

namespace App\Controllers\Menu;

use App\Controllers\BaseController;
use App\Models\MenuCategoryModel;

class Categories extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new MenuCategoryModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();

        $categories = $db->table('menu_categories')
            ->select('menu_categories.*, COUNT(menu_items.id) as total_items')
            ->join('menu_items', 'menu_items.category_id = menu_categories.id', 'left')
            ->groupBy('menu_categories.id')
            ->orderBy('menu_categories.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('admin/menu/categories/index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin/menu/categories/create');
    }

    public function store()
    {
        $imageName = null;

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/categories', $imageName);
        }

        $this->categoryModel->insert([
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'image'       => $imageName,
            'status'      => $this->request->getPost('status') ?? 1,
        ]);

        return redirect()->to('/admin/menu/categories')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        return view('admin/menu/categories/edit', [
            'category' => $this->categoryModel->find($id),
        ]);
    }

    public function update($id)
    {
        $category = $this->categoryModel->find($id);

        $imageName = $category['image'] ?? null;

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            if (!empty($category['image']) && file_exists(FCPATH . 'uploads/categories/' . $category['image'])) {
                unlink(FCPATH . 'uploads/categories/' . $category['image']);
            }

            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/categories', $imageName);
        }

        $this->categoryModel->update($id, [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'image'       => $imageName,
            'status'      => $this->request->getPost('status') ?? 0,
        ]);

        return redirect()->to('/admin/menu/categories')->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        $category = $this->categoryModel->find($id);

        if (!empty($category['image']) && file_exists(FCPATH . 'uploads/categories/' . $category['image'])) {
            unlink(FCPATH . 'uploads/categories/' . $category['image']);
        }

        $this->categoryModel->delete($id);

        return redirect()->to('/admin/menu/categories')->with('success', 'Category deleted successfully');
    }
}