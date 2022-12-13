<?php namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table    ='producto';
    protected $primaryKey = 'idproducto';

    protected $returnType = 'array';
    protected $allowedFields = ['nombre', 'precio', 'stock'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nombre' => 'required|alpha_space|min_length[3]|max_length[45]',
        'precio' => 'required|decimal|min_length[3]',
        'stock' => 'required|integer|min_length[1]|max_length[10]',
    ];


    protected $skipValidation = false;
}