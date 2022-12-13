<?php

namespace App\Controllers\API;

use App\Models\PedidoModel;
use CodeIgniter\RESTful\ResourceController;

class Pedidos extends ResourceController
{
    public function __construct() {
        $this->model = $this->setModel(new PedidoModel());
    }
    public function index()
    {
        $pedidos = $this->model->findAll();
        return $this->respond($pedidos);
    }

    public function create() {
        //return $this->failServerError('Aqui entra');
        try{
            //return $this->respondCreated('Aqui entra!!');
            $pedido = $this->request->getJSON();
            if($this->model->insert($pedido)):
                $pedido->id = $this->model->insertID();
                return $this->respondCreated($pedido);
            else:
                return $this->failValidationErrors($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            //return $this->failServerError('Ha ocurrido un error en el servidor');
            return $this->failServerError($e->getMessage());
        }
    }

    public function edit($id = null)
    {
        try{
            if ($id == null) {
                return $this->failNotFound('Id no encontrado');
            }

            $pedido = $this->model->find($id);
            if ($pedido == null) {
                return $this->failNotFound('No se encontro el pedido');
            }

            return $this->respond($pedido);
        } catch (\Exception $e) {
            //return $this->failServerError('Ha ocurrido un error en el servidor');
            return $this->failServerError($e->getMessage());
        }
    }

    public function update($id = null)
    {
        try{
            if ($id == null) {
                return $this->failNotFound('Id no encontrado');
            }

            $pedidoVerificado = $this->model->find($id);
            if ($pedidoVerificado == null) {
                return $this->failNotFound('No se encontro el pedido');
            }

            $pedido = $this->request->getJSON();

            if($this->model->update($id, $pedido)):
                $pedido->id = $id;
                return $this->respondUpdated($pedido);
            else:
                return $this->failValidationErrors($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            //return $this->failServerError('Ha ocurrido un error en el servidor');
            return $this->failServerError($e->getMessage());
        }
    }

    public function delete($id = null)
    {
        try{
            if ($id == null) {
                return $this->failNotFound('Id no encontrado');
            }

            $pedidoVerificado = $this->model->find($id);
            if ($pedidoVerificado == null) {
                return $this->failNotFound('No se encontro el pedido');
            }

            if($this->model->delete($id)):
                return $this->respondDeleted($pedidoVerificado);
            else:
                return $this->failServerError('No se ha podido eliminar el registro');
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}