<?php

namespace App\Models\Pedido;

class Pedido
{

    private $id;
    private $create_at;
    private $update_at;
    private $clientes_id;

    // Construtor
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->create_at = $data['create_at'];
        $this->update_at = $data['update_at'];
        $this->clientes_id = $data['clientes_id'];
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return $this->create_at;
    }

    public function getUpdatedAt()
    {
        return $this->update_at;
    }

    public function getclientesId()
    {
        return $this->clientes_id;
    }

    // Setters
    public function setUpdatedAt($updated_at)
    {
        $this->update_at = $updated_at;
    }

    public function setclientesId($clientes_id)
    {
        $this->clientes_id = $clientes_id;
    }
}
