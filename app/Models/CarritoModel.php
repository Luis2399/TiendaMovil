<?php namespace App\Models;

use CodeIgniter\Model;

class CarritoModel extends Model
{
    protected $table    ='carrito';
    protected $primaryKey = 'idPedido';

    protected $returnType = 'array';
    protected $allowedFields = ['idPedido', 'cantidad', 'subtotal', 'idProducto'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'idPedido' => 'required|integer|is_valid_pedido',
        'cantidad' => 'required|integer|min_length[1]|max_length[2]',
        'subtotal' => 'required|decimal',
        'idProducto' => 'required|integer|is_valid_producto',
    ];

    protected $validationMessages = [
        'idPedido' => [
            'is_valid_pedido' => 'El pedido no existe'
        ],
        'idProducto' => [
            'is_valid_producto' => 'El producto no existe'
        ],
    ];

    protected $skipValidation = false;
}