<?php
require_once 'Usuario.php';
require_once __DIR__ . '/../../config/Database.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

      // Busca um usuário pelo email
      public function buscarPorEmail($email) {
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     // Valida o login
     public function validarLogin($email, $senha) {
        $usuario = $this->buscarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
            return new Usuario($usuario); // Cria objeto Usuario
        }
        return null;
    }

    // Cria um novo usuário
    public function criarUser ($nome, $email, $senha) {
        if ($this->buscarPorEmail($email)) {
            return null;
        }
        $query = "INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha)";
        $stmt = $this->conn->prepare($query);
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        if ($stmt->execute()) {
            return $this->buscarPorEmail($email);
        }
        return null;
    }
}

