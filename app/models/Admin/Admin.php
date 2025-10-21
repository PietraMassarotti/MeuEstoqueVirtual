<?php

namespace App\Models\Admin;

class Admin {
    private $id;          
    private $nome;         
    private $email;       
    private $senha;  
    private $created_at;  
    private $update_at;  

    public function __construct($data) {
        $this->id = $data['id'];
        $this->nome = $data['nome'];
        $this->email = $data['email'];
        $this->senha_hash = $data['senha'];
        $this->created_at = $data['created_at'];
        $this->update_at = $data['update_at'];
    }

    //Get

    public function getId() { 
        return $this->id; 
    }

    public function getNome() { 
        return $this->nome; 
    }

    public function getEmail() { 
        return $this->email; 
    }

    public function getSenha() { 
        return $this->senha; 
    }

    public function getCreatedAt() { 
        return $this->created_at; 
    }

    public function getUpdateAt() { 
        return $this->update_at; 
    }

    //Set

    public function setNome($nome) { 
        $this->nome = $nome; 
    }

    public function setEmail($email) { 
        $this->email = $email; 
    }

    public function setSenha($senha) { 
        $this->senha = $senha; 
    }

    
}
?>

