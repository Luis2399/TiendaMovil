<?php

namespace App\Controllers\API;

use App\Models\ClienteModel;
use CodeIgniter\RESTful\ResourceController;

class Clientes extends ResourceController
{
    public function __construct() {
        $this->model = $this->setModel(new ClienteModel());
    }
    public function index()
    {
        $clientes = $this->model->findAll();
        return $this->respond($clientes);
    }

    public function create() {
        //return $this->failServerError('Aqui entra');
        try{

            $cliente = $this->request->getJSON();
            if($this->model->insert($cliente)):
                $cliente->id = $this->model->insertID();
                return $this->respondCreated($cliente);
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

            $cliente = $this->model->find($id);
            if ($cliente == null) {
                return $this->failNotFound('No se encontro el cliente');
            }

            return $this->respond($cliente);
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

            $clienteVerificado = $this->model->find($id);
            if ($clienteVerificado == null) {
                return $this->failNotFound('No se encontro el cliente');
            }

            $cliente = $this->request->getJSON();

            if($this->model->update($id, $cliente)):
                $cliente->id = $id;
                return $this->respondUpdated($cliente);
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

            $clienteVerificado = $this->model->find($id);
            if ($clienteVerificado == null) {
                return $this->failNotFound('No se encontro el cliente');
            }

            if($this->model->delete($id)):
                return $this->respondDeleted($clienteVerificado);
            else:
                return $this->failServerError('No se ha podido eliminar el registro');
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}