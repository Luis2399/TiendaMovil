<?php

namespace App\Controllers\API;

use App\Models\ProductoModel;
use CodeIgniter\RESTful\ResourceController;

class Productos extends ResourceController
{
    public function __construct() {
        $this->model = $this->setModel(new ProductoModel());
    }
    public function index()
    {
        $productos = $this->model->findAll();
        return $this->respond($productos);
    }

    public function create() {
        //return $this->failServerError('Aqui entra');
        try{
            //return $this->respondCreated('Aqui entra!!');
            $producto = $this->request->getJSON();
            if($this->model->insert($producto)):
                $producto->id = $this->model->insertID();
                return $this->respondCreated($producto);
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

            $producto = $this->model->find($id);
            if ($producto == null) {
                return $this->failNotFound('No se encontro el producto');
            }

            return $this->respond($producto);
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

            $productoVerificado = $this->model->find($id);
            if ($productoVerificado == null) {
                return $this->failNotFound('No se encontro el producto');
            }

            $producto = $this->request->getJSON();

            if($this->model->update($id, $producto)):
                $producto->id = $id;
                return $this->respondUpdated($producto);
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

            $productoVerificado = $this->model->find($id);
            if ($productoVerificado == null) {
                return $this->failNotFound('No se encontro el producto');
            }

            if($this->model->delete($id)):
                return $this->respondDeleted($productoVerificado);
            else:
                return $this->failServerError('No se ha podido eliminar el registro');
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}