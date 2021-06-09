<?php

require_once "Venda.php";
require_once "DAO.php";

class VendaDAO extends DAO
{
    public function selectAll()
    {
        $sql = "SELECT * FROM vendas ORDER BY id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $vendas = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Venda', ['cliente_id', 'valor', 'id']);

            return $vendas;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function select($id)
    {
        $sql = "SELECT * FROM vendas WHERE id = :id ORDER BY cliente_id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $vendas = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Venda', ['cliente_id', 'valor', 'id']);

            return $vendas;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function insert($venda)
    {
        $sql = "INSERT INTO vendas (cliente_id,valor) values (:cliente_id,:valor)";
        $stmt = $this->connection->prepare($sql);

        $vendaClienteId = $venda->getClienteId();
        $vendaValor = $venda->getValor();

        $stmt->bindParam(':cliente_id', $vendaClienteId, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $vendaValor, PDO::PARAM_STR);

        try {
            $stmt->execute();

            return true;
        } catch (PDOException $exception) {
            throw $exception;
            return false;
        }
    }

    public function update($venda)
    {
        $sql = "UPDATE vendas SET cliente_id = :cliente_id, valor = :valor WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $vendaId = $venda->getId();
        $vendaClientId = $venda->getClienteId();
        $vendaValor = $venda->getValor();

        $stmt->bindParam(':id', $vendaId, PDO::PARAM_INT);
        $stmt->bindParam(':cliente_id', $vendaClientId, PDO::PARAM_INT);
        $stmt->bindParam(':valor', $vendaValor, PDO::PARAM_INT);

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
        $sql = "DELETE FROM vendas WHERE id = :id";
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
