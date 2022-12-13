<?php

namespace App\Controllers\API;

use App\Models\CarritoModel;
use CodeIgniter\RESTful\ResourceController;

class Carritos extends ResourceController
{
    public function __construct() {
        $this->model = $this->setModel(new CarritoModel());
    }
    public function index()
    {
        $carritos = $this->model->findAll();
        return $this->respond($carritos);
    }

    public function create() {
        //return $this->failServerError('Aqui entra');
        try{
            $carrito = $this->request->getJSON();
            if($this->model->insert($carrito, false)):
                //$carrito->id = $this->model->insertID();
                return $this->respondCreated($carrito);
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

            //$carritoModel = new CarritoModel();
            //$carritoModel->findall();
            //$carritoModel->insert();

            $carrito = $this->model->find($id);
            if ($carrito == null) {
                return $this->failNotFound('No se encontro el carrito');
            }

            return $this->respond($carrito);
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

            $carritoVerificado = $this->model->find($id);
            if ($carritoVerificado == null) {
                return $this->failNotFound('No se encontro el carrito');
            }

            $carrito = $this->request->getJSON();

            if($this->model->update($id, $carrito)):
                $carrito->id = $id;
                return $this->respondUpdated($carrito);
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

            $carritoVerificado = $this->model->find($id);
            if ($carritoVerificado == null) {
                return $this->failNotFound('No se encontro el carrito');
            }

            if($this->model->delete($id)):
                return $this->respondDeleted($carritoVerificado);
            else:
                return $this->failServerError('No se ha podido eliminar el registro');
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}