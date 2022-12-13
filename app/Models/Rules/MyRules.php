<?php namespace App\Models\Rules;

use App\Models\ClienteModel;
use App\Models\ProductoModel;
use App\Models\PedidoModel;

class MyRules {

    public function is_valid_cliente(int $id): bool {
        $model = new ClienteModel();
        $cliente = $model->find($id);

        return $cliente == null ? false : true;
    }

    public function is_valid_producto(int $id): bool {
        $model = new ProductoModel();
        $producto = $model->find($id);

        return $producto == null ? false : true;
    }

    public function is_valid_pedido(int $id): bool {
        $model = new PedidoModel();
        $pedido = $model->find($id);

        //return false;
        return $pedido == null ? false : true;
    }

}