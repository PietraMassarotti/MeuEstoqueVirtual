<?php

namespace App\Config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost:3306';    
    private $db_name = 'sistema_estoque'; 
    private $username = 'root';          
    private $password = 'b4nc0D4d0sM1SQL';  //b4nc0D4d0sM1SQL //&tec77@info!
    private $conn;                       

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}", 
                $this->username,                                   
                $this->password                                  
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) { 
            die("Erro na conexão: " . $e->getMessage());
        }
        return $this->conn;
    }
}
