<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table    ='cliente';
    protected $primaryKey = 'idcliente';


    protected $returnType = 'array';
    protected $allowedFields = ['nombre', 'apellido', 'email', 'telefono', 'calle', 'cp', 'numeroext', 'numeroint'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nombre' => 'required|alpha_space|min_length[3]|max_length[45]',
        'apellido' => 'required|alpha_space|min_length[3]|max_length[45]',
        'email' => 'required|valid_email|min_length[10]|max_length[45]',
        'telefono' => 'required|alpha_numeric_space|min_length[10]|max_length[10]',
        'calle' => 'required|alpha_space|min_length[3]|max_length[45]',
        'cp' => 'required|alpha_numeric_space|min_length[5]|max_length[5]',
        'numeroext' => 'required|alpha_numeric_space|min_length[1]|max_length[10]',
        'numeroint' => 'required|alpha_numeric_space|min_length[1]|max_length[10]',
    ];

    protected $skipValidation = false;
}