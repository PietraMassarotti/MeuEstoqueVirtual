<?php
namespace App\Models\Cliente;
use App\Models\Cliente\Cliente;
use App\Config\Database;
use PDO;

class ClienteDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

     //Verifica se o ID existe
     public function findById($id)
     {
         $sql = "SELECT * FROM clientes WHERE id = :id";
         $stmt = $this->conn->prepare($sql);
         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
 
         $stmt->execute();
         $marca = $stmt->fetch(PDO::FETCH_ASSOC);
 
         return $marca ?: null;
     }

    public function showCliente($id) {
        $query = "SELECT * FROM clientes";  // Remove o filtro por admin_id
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retorna todos os produtos como um array associativo
    }

     // Cria no banco
     public function createCliente($nome, $email, $endereco, $telefone, $nasc)
     {
         $query = "INSERT INTO clientes (nome, email, endereco, telefone, nasc) VALUES (:nome, :email, :endereco, :telefone, :nasc)";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(':nome', $nome);
         $stmt->bindParam(':email', $email);
         $stmt->bindParam(':endereco', $endereco);
         $stmt->bindParam(':telefone', $telefone);
         $stmt->bindParam(':nasc', $nasc);
         return $stmt->execute();
     }
 
     //Editar no banco
     public function updateCliente($id, $nome, $email, $endereco, $telefone, $nasc)
     {
         $query = "UPDATE clientes SET nome = :nome, email = :email, endereco = :endereco, telefone = :telefone,  nasc = :nasc WHERE id = :id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(':nome', $nome);
         $stmt->bindParam(':email', $email);
         $stmt->bindParam(':endereco', $endereco);
         $stmt->bindParam(':telefone', $telefone);
         $stmt->bindParam(':nasc', $nasc);
         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
         return $stmt->execute();
     }
 
 
     // Deletar no banco
     public function deleteCliente($id)
     {
         $query = "DELETE FROM clientes WHERE id = :id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
         return $stmt->execute();
     }

}
