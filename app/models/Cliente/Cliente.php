<?php

namespace App\Models\Cliente;

class Livro {

    private $id;
    private $nome;
    private $email;
    private $endereco;
    private $telefone;
    private $nasc;
    private $create_at;
    private $update_at;

    // Construtor
    public function __construct($data) {
        $this->id = $data['id'];
        $this->nome = $data['nome'];
        $this->preco = $data['email'];
        $this->quantidade = $data['endereco'];
        $this->genero = $data['telefone'];
        $this->genero = $data['nasc'];
        $this->create_at = $data['create_at'];
        $this->update_at = $data['update_at'];
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getEndereco() {
        return $this->endereco;
    }

     public function getTelefone() {
        return $this->telefone;
    }

    public function getNasc() {
        return $this->nasc;
    }

    public function getCreatedAt() {
        return $this->create_at;
    }

    public function getUpdatedAt() {
        return $this->update_at;
    }

    // Setters
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

      public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setNasc($nasc) {
        $this->nasc = $nasc;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

}
?>