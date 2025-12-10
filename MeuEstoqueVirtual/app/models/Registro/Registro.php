<?php

namespace App\Models\Registro;

class Registro
{

    private $id;
    private $quantidade;
    private $acao;
    private $descricao;
    private $create_at;
    private $update_at;
    private $produtos_id;

    // Construtor
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->quantidade = $data['quantidade'];
        $this->acao = $data['acao'];
        $this->descricao = $data['descricao'];
        $this->create_at = $data['create_at'];
        $this->update_at = $data['update_at'];
        $this->produtos_id = $data['produtos_id'];
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function getAcao()
    {
        return $this->acao;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getCreatedAt()
    {
        return $this->create_at;
    }

    public function getUpdatedAt()
    {
        return $this->update_at;
    }

    public function getProdutosId()
    {
        return $this->produtos_id;
    }

    // Setters
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function setAcao($acao)
    {
        $this->acao = $acao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->update_at = $updated_at;
    }

    public function setProdutosId($produtos_id)
    {
        $this->produtos_id = $produtos_id;
    }
}
