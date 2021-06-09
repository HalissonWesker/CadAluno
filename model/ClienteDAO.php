<?php

require_once "Cliente.php";
require_once "DAO.php";

class ClienteDAO extends DAO
{
    public function selectAll()
    {
        $sql = "SELECT * FROM clientes ORDER BY id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $clientes = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Cliente', ['nome', 'endereco', 'id']);

            return $clientes;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function select($id)
    {
        $sql = "SELECT * FROM clientes WHERE id = :id ORDER BY nome";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $clientes = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Cliente', ['nome', 'endereco', 'id']);

            return $clientes;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function insert($cliente)
    {
        $sql = "INSERT INTO clientes (nome,endereco) values (:nome,:endereco)";
        $stmt = $this->connection->prepare($sql);

        $clienteNome = $cliente->getNome();
        $clienteEndereco = $cliente->getEndereco();

        $stmt->bindParam(':nome', $clienteNome, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $clienteEndereco, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $exception) {
            throw $exception;
            return false;
        }
    }

    public function update($cliente)
    {
        $sql = "UPDATE clientes SET nome = :nome, endereco = :endereco WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $clienteId = $cliente->getId();
        $clienteNome = $cliente->getNome();
        $clienteEndereco = $cliente->getEndereco();

        $stmt->bindParam(':id', $clienteId, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $clienteNome, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $clienteEndereco, PDO::PARAM_STR);

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
        $sql = "DELETE FROM clientes WHERE id = :id";
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
