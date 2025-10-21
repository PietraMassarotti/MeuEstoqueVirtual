<?php

namespace App\Models\Admin;
use App\Models\Admin\Admin;
use App\Config\Database;
use PDO;

class AdminDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

      public function buscarPorEmail($email) {
        $query = "SELECT * FROM administradores WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     public function validarLogin($email, $senha) {
        $admin = $this->buscarPorEmail($email);
        if ($admin && password_verify($senha, $admin['senha'])) {
            return new Admin($admin);
        }
        return null;
    }

}

