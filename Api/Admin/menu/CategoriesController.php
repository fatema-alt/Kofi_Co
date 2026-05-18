<?php

namespace App\Controllers\Api\Admin\Menu;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MenuCategoryModel;

class CategoriesController extends ResourceController
{
    protected $format = 'json';
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

        return $this->respond([
            'status' => true,
            'message' => 'Categories fetched',
            'data' => $categories
        ]);
    }

    public function store()
    {
        $imageName = null;

        // 🔥 file input (NOT JSON)
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

        return $this->respondCreated([
            'status' => true,
            'message' => 'Category created successfully',
            'data' => [
                'category_id' => $this->categoryModel->insertID()
            ]
        ]);
    }

    public function show($id = null)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            return $this->failNotFound('Category not found');
        }

        return $this->respond([
            'status' => true,
            'data' => $category
        ]);
    }

    public function update($id = null)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            return $this->failNotFound('Category not found');
        }

        $imageName = $category['image'] ?? null;

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {

            // delete old image
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

        return $this->respond([
            'status' => true,
            'message' => 'Category updated successfully'
        ]);
    }

    public function delete($id = null)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            return $this->failNotFound('Category not found');
        }

        if (!empty($category['image']) && file_exists(FCPATH . 'uploads/categories/' . $category['image'])) {
            unlink(FCPATH . 'uploads/categories/' . $category['image']);
        }

        $this->categoryModel->delete($id);

        return $this->respondDeleted([
            'status' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}