<?php

require_once "model/VendaDAO.php";
require_once "model/Venda.php";
require_once "model/Cliente.php";
require_once "view/View.php";

use Valitron\Validator;

class VendaController
{
    private $data;

    public function index()
    {
        $this->data = array();
        $prodDAO = new VendaDAO();

        try {
            $vendas = $prodDAO->selectAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['vendas'] = $vendas;

        View::load('view/template/header.html');
        View::load('view/venda/index.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function show($id)
    {
        $this->data = array();
        $prodDAO = new VendaDAO();

        try {
            $vendas = $prodDAO->select($id);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['vendas'] = $vendas;

        View::load('view/template/header.html');
        View::load('view/venda/show.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function create()
    {
        $this->data = [];
        $clienteDao = new ClienteDAO;
        $prodDao = new ProductDAO;

        try {
            $clientes = $clienteDao->selectAll();
            $produtos = $prodDao->selectAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $this->data['clientes'] =  $clientes;
        $this->data['produtos'] =  $produtos;
        View::load('view/template/header.html');
        View::load('view/venda/create.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function store($data)
    {
        try {
            $prodDAO = new VendaDAO();
            $v = new Validator($data);

            $v->rule('required', ['cliente', 'valor']);
            if ($v->validate()) {
                $newVenda = new Venda();
                $newVenda->setClienteId($data['cliente']);
                $newVenda->setValor($data['valor']);
                $prodDAO->insert($newVenda);

                header('location: index.php?venda=index');
            } else {
                $this->data = [];
                $clienteDao = new ClienteDAO;
                $clientes = $clienteDao->selectAll();
                $this->data['clientes'] =  $clientes;
                $this->data['errors'] = $this->handleValidationErrors($v->errors());
                View::load('view/template/header.html');
                View::load('view/venda/create.php', $this->data);
                View::load('view/template/footer.html');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        $this->data = array();
        $prodDAO = new VendaDAO();
        $clienteDao = new ClienteDAO;

        try {
            $vendas = $prodDAO->select($id);
            $clientes = $clienteDao->selectAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['vendas'] = $vendas;
        $this->data['clientes'] =  $clientes;


        View::load('view/template/header.html');
        View::load('view/venda/edit.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function update($data)
    {
        try {
            $prodDAO = new VendaDAO();
            $v = new Validator($data);
            $v->rule('required', ['id','cliente', 'valor']);
            if ($v->validate()) {
                $venda = new Venda();
                $venda->setId($data['id']);
                $venda->setValor($data['valor']);
                $venda->setClienteId($data['cliente']);;

                $prodDAO->update($venda);
                header('location: index.php?venda=index');
            } else {
                $this->data = [];
                $vendas = $prodDAO->select($data['id']);
                $clienteDao = new ClienteDAO;

                $clientes = $clienteDao->selectAll();
                $this->data['vendas'] = $vendas;
                $this->data['clientes'] =  $clientes;
                $this->data['errors'] = $this->handleValidationErrors($v->errors());
                View::load('view/template/header.html');
                View::load('view/venda/edit.php', $this->data);
                View::load('view/template/footer.html');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $prodDAO = new VendaDAO();
        try {
            $prodDAO->delete($id);
            header('location: index.php?venda=index');
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
