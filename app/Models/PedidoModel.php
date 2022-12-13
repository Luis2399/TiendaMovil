<?php namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table    ='pedido';
    protected $primaryKey = 'idpedido';

    protected $returnType = 'array';
    protected $allowedFields = ['total', 'fecha', 'idCliente'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'total' => 'required|decimal|min_length[3]',
        'fecha' => 'required|valid_date[Y-m-d]',
        'idCliente' => 'required|integer|is_valid_cliente',
    ];

    protected $validationMessages = [
        'idCliente' => [
            'is_valid_cliente' => 'El ciente no existe'
        ],
    ];

    protected $skipValidation = false;
}