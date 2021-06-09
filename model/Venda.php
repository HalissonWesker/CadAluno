<?php

class Venda
{
    private $id;
    private $cliente_id;
    private $valor;

    public function __construct($id = null, $cliente_id = null, $valor = null)
    {
        $this->id = $id;
        $this->cliente_id = $cliente_id;
        $this->valor = $valor;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getClienteId()
    {
        return $this->cliente_id;
    }

    public function setClienteId($cliente_id)
    {
        $this->cliente_id = $cliente_id;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }
}