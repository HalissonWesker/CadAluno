<?php

require_once "model/ClienteDAO.php";
require_once "model/Cliente.php";
require_once "view/View.php";

use Valitron\Validator;

class ClienteController
{
    private $data;

    public function index()
    {
        $this->data = array();
        $clientdao = new ClienteDAO();

        try {
            $clientes = $clientdao->selectAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['clientes'] = $clientes;

        View::load('view/template/header.html');
        View::load('view/clientes/index.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function show($id)
    {
        $this->data = array();
        $clientdao = new ClienteDAO();

        try {
            $clientes = $clientdao->select($id);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['clientes'] = $clientes;

        View::load('view/template/header.html');
        View::load('view/clientes/show.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function create()
    {
        View::load('view/template/header.html');
        View::load('view/clientes/create.php');
        View::load('view/template/footer.html');
    }

    public function store($data){
        try {
            $clientdao = new ClienteDAO();
            $v = new Validator($data);
            $v->rule('required', ['nome', 'endereco']);
            if ($v->validate()) {
                $newCat = new Category();
                $newCat->setName($data['nome']);
                $newCat->setDescription($data['endereco']);
                $clientdao->insert($newCat);
                header('location: index.php?clientes=index');

            }else{
                $this->data = [];
                $this->data['errors'] = $this->handleValidationErrors($v->errors());
                View::load('view/template/header.html');
                View::load('view/clientes/create.php', $this->data);
                View::load('view/template/footer.html');
            }


        }catch (PDOException $exception){
            echo $exception->getMessage();
        }
    }

    public function edit($id)
    {
        $this->data = array();
        $clientdao = new ClienteDAO();

        try {
            $clientes = $clientdao->select($id);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['clientes'] = $clientes;

        View::load('view/template/header.html');
        View::load('view/clientes/edit.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function update($data)
    {
        try {
            $v = new Validator($data);
            $clientdao = new ClienteDAO();
            $v->rule('required', ['nome', 'endereco']);
            if ($v->validate()) {
                $clientesEdit = new Cliente();
                $clientesEdit->setId($data['id']);
                $clientesEdit->setNome($data['nome']);
                $clientesEdit->setEndereco($data['endereco']);
                $clientdao->update($clientesEdit);
                header('location: index.php?clientes=index');
            } else {
                $this->data = [];
                $clientes = $clientdao->select($data['id']);
                $this->data['clientes'] = $clientes;
                $this->data['errors'] = $this->handleValidationErrors($v->errors());
                View::load('view/template/header.html');
                View::load('view/clientes/edit.php', $this->data);
                View::load('view/template/footer.html');
            }
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $clientdao = new ClienteDAO();
        try {
            $clientdao->delete($id);
            header('location: index.php?clientes=index');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function handleValidationErrors($errors)
    {
        $data = [];
        foreach ($errors as $errors) {
            foreach ($errors as $validation) {
                array_push($data, $validation);
            }
        }
        return $data;
    }
}
