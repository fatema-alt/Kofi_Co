<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuCategoryModel extends Model
{
    protected $table = 'menu_categories';
    protected $primaryKey = 'id';

    protected $allowedFields = [
    'name',
    'description',
    'image',
    'status',
];

    protected $useTimestamps = true;
}