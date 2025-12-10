<?php

namespace App\Models\Compra;

class Compra
{
    private $id;
    private $create_at;
    private $update_at;
    private $pedidos_id;
    private $parcelamentos_id;

    // Construtor
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->create_at = $data['create_at'];
        $this->update_at = $data['update_at'];
        $this->pedidos_id = $data['pedidos_id'];
        $this->parcelamentos_id = $data['parcelamentos_id'];
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getCreateAt()
    {
        return $this->create_at;
    }

    public function getUpdateAt()
    {
        return $this->update_at;
    }

    public function getPedidosId()
    {
        return $this->pedidos_id;
    }

    public function getParcelamentosId()
    {
        return $this->parcelamentos_id;
    }

    // Setters
    public function setPedidosId($pedidos_id)
    {
        $this->pedidos_id = $pedidos_id;
    }

    public function setParcelamentosId($parcelamentos_id)
    {
        $this->parcelamentos_id = $parcelamentos_id;
    }

    public function setUpdateAt($update_at)
    {
        $this->update_at = $update_at;
    }
}
