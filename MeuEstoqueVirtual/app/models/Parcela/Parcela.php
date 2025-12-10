<?php

namespace App\Models\Parcela;

class Parcela
{
    private $id;
    private $numero;
    private $valor;
    private $data;
    private $status;
    private $create_at;
    private $update_at;
    private $compras_id;

    // Construtor
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->numero = $data['numero'];
        $this->valor = $data['valor'];
        $this->data = $data['data'];
        $this->status = $data['status'];
        $this->create_at = $data['create_at'];
        $this->update_at = $data['update_at'];
        $this->compras_id = $data['compras_id'];
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreateAt()
    {
        return $this->create_at;
    }

    public function getUpdateAt()
    {
        return $this->update_at;
    }

    public function getComprasId()
    {
        return $this->compras_id;
    }

    // Setters
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setUpdateAt($update_at)
    {
        $this->update_at = $update_at;
    }

    public function setComprasId($compras_id)
    {
        $this->compras_id = $compras_id;
    }

    // Método para verificar se está atrasada
    public function isAtrasada()
    {
        $dataAtual = new \DateTime();
        $dataVencimento = new \DateTime($this->data);

        return ($dataVencimento < $dataAtual && $this->status !== 'Pago');
    }
}
