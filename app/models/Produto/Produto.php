<?php
namespace App\Models\Produto;

class Produto {

    private $id;
    private $nome;
    private $preco;
    private $quantidade;
    private $genero;
    private $descricao;
    private $create_at;
    private $update_at;
    private $marcas_id; 
    private $categorias_id;

    // Construtor
    public function __construct($data) {
        $this->id = $data['id'];
        $this->nome = $data['nome'];
        $this->preco = $data['preco'];
        $this->quantidade = $data['quantidade'];
        $this->genero = $data['genero'];
        $this->genero = $data['descricao'];
        $this->create_at = $data['create_at'];
        $this->update_at = $data['update_at'];
        $this->marcas_id = $data['marcas_id'];
        $this->categorias_id = $data['categorias_id'];
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

     public function getGenero() {
        return $this->genero;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getCreatedAt() {
        return $this->create_at;
    }

    public function getUpdateAt() {
        return $this->update_at;
    }

    public function getMarcasId() {
        return $this->marcas_id;
    }

    public function getCategoriasId() {
        return $this->categorias_id;
    }

    // Setters
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

      public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setUpdateAt($update_at) {
        $this->update_at = $update_at;
    }

    public function setMarcasId($marcas_id) {
        $this->marcas_id = $marcas_id;
    }

    public function setCategoriasId($categorias_id) {
        $this->categorias_id = $categorias_id;
    }
}
?>