<?php

namespace App\Models\Categoria;

class Marca
{
    private $id;
    private $nome;
    private $created_at;
    private $update_at;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->nome = $data['nome'];
        $this->created_at = $data['created_at'];
        $this->update_at = $data['update_at'];
    }

    //Get

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdateAt()
    {
        return $this->update_at;
    }

    //Set

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}
