<?php

require_once "Product.php";
require_once "DAO.php";

class ProductDAO extends DAO
{
    public function selectAll()
    {
        $sql = "SELECT * FROM products ORDER BY id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Product', ['name', 'description', 'image', 'price', 'id']);
            return $products;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function select($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id ORDER BY name";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Product', ['name', 'description', 'image', 'price', 'id']);

            return $products;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function insert($product)
    {
        $sql = "INSERT INTO products (name, description, image, price) VALUES (:name, :description, :image, :price)";
        $stmt = $this->connection->prepare($sql);

        $productName = $product->getName();
        $productDescription = $product->getDescription();
        $productImage = $product->getImage();
        $productPrice = $product->getPrice();

        $stmt->bindParam(':name', $productName);
        $stmt->bindParam(':description', $productDescription);
        $stmt->bindParam(':image', $productImage);
        $stmt->bindParam(':price', $productPrice);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
            return false;
        }
    }

    public function update($product)
    {

        $sql = "UPDATE products SET name = :name, description = :description, image = :image, price = :price WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        $productId = $product->getId();
        $productName = $product->getName();
        $productDescription = $product->getDescription();
        $productImage = $product->getImage();
        $productPrice = $product->getPrice();

        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $productName, PDO::PARAM_STR);
        $stmt->bindParam(':description', $productDescription, PDO::PARAM_STR);
        $stmt->bindParam(':image', $productImage, PDO::PARAM_STR);
        $stmt->bindParam(':price', $productPrice, PDO::PARAM_STR);

        try {
           $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw $e;
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }


}
