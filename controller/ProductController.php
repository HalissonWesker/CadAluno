<?php

require_once "model/ProductDAO.php";
require_once "model/Product.php";
require_once "view/View.php";

use Valitron\Validator;

class ProductController
{
    private $data;

    public function index()
    {
        $this->data = array();
        $prodDAO = new ProductDAO();

        try {
            $products = $prodDAO->selectAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['products'] = $products;

        View::load('view/template/header.html');
        View::load('view/product/index.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function show($id)
    {
        $this->data = array();
        $prodDAO = new ProductDAO();

        try {
            $products = $prodDAO->select($id);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['products'] = $products;

        View::load('view/template/header.html');
        View::load('view/product/show.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function create()
    {
        $this->data = [];

        try {
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        View::load('view/template/header.html');
        View::load('view/product/create.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function store($data)
    {
        try {
            $prodDAO = new ProductDAO();
            $v = new Validator($data);
            $v->rule('required', ['name', 'description', 'price']);
            if ($v->validate()) {
                $newProduct = new Product();
                $newProduct->setName($data['name']);
                $newProduct->setDescription($data['description']);
                $newProduct->setImage($data['image']);
                $newProduct->setPrice($data['price']);
                $prodDAO->insert($newProduct);
                header('location: index.php?product=index');
            } else {
                $this->data = [];
                $this->data['errors'] = $this->handleValidationErrors($v->errors());
                View::load('view/template/header.html');
                View::load('view/product/create.php', $this->data);
                View::load('view/template/footer.html');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        $this->data = array();
        $prodDAO = new ProductDAO();

        try {
            $products = $prodDAO->select($id);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->data['products'] = $products;


        View::load('view/template/header.html');
        View::load('view/product/edit.php', $this->data);
        View::load('view/template/footer.html');
    }

    public function update($data)
    {
        try {
            $prodDAO = new ProductDAO();
            $v = new Validator($data);
            $v->rule('required', ['id','name', 'description', 'price']);
            if ($v->validate()) {
                $product = new Product();
                $product->setId($data['id']);
                $product->setName($data['name']);
                $product->setDescription($data['description']);
                $product->setImage($data['image']);
                $product->setPrice($data['price']);

                $prodDAO->update($product);
                header('location: index.php?product=index');
            } else {
                $this->data = [];
                $products = $prodDAO->select($data['id']);

                $this->data['products'] = $products;
                $this->data['errors'] = $this->handleValidationErrors($v->errors());
                View::load('view/template/header.html');
                View::load('view/product/edit.php', $this->data);
                View::load('view/template/footer.html');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $prodDAO = new ProductDAO();
        try {
            $prodDAO->delete($id);
            header('location: index.php?product=index');
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
