<?php

class Usuario {
    private $id;          
    private $nome;         
    private $email;       
    private $senha_hash;  
    private $created_at;  

    public function __construct($data) {
        $this->id = $data['id'];
        $this->nome = $data['nome'];
        $this->email = $data['email'];
        $this->senha_hash = $data['senha_hash'];
        $this->created_at = $data['created_at'];
    }

    public function getId() { 
        return $this->id; 
    }

    public function getNome() { 
        return $this->nome; 
    }

    public function getEmail() { 
        return $this->email; 
    }

    public function getSenhaHash() { 
        return $this->senha_hash; 
    }

    public function getCreatedAt() { 
        return $this->created_at; 
    }

    public function setNome($nome) { 
        $this->nome = $nome; 
    }

    public function setEmail($email) { 
        $this->email = $email; 
    }

    public function setSenhaHash($senha_hash) { 
        $this->senha_hash = $senha_hash; 
    }
}
?>

