<?php
namespace App\Models\Registro;
use App\Models\Registro\Registro;
use App\Config\Database;
use PDO;

class RegistroDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function showRegistro($id) {
        $query = "SELECT r.*, p.nome AS produto_nome
        FROM registros r
        LEFT JOIN produtos p ON r.produtos_id = p.id"; // Remove o filtro por admin_id
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retorna todos os produtos como um array associativo
    }


    public function createRegistro($quantidade, $acao, $descricao, $produtos_id) {
        $query = "INSERT INTO produtos (quantidade, acao, descricao, produtos_id) 
                  VALUES (:quantidade, :acao, :descricao, :produtos_id)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':acao', $acao);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':produtos_id', $produtos_id, PDO::PARAM_INT); // Corrigido aqui
    
        // Executa e retorna true se sucesso, false se falha
        return $stmt->execute();
    }
    

    public function updateRegistro($id, $quantidade, $acao, $descricao, $produtos_id) {
        $query = "UPDATE produtos 
                  SET quantidade = :quantidade, acao = :acao, descricao = :descricao, produtos_id = :produtos_id 
                  WHERE id = :id";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':acao', $acao);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':produtos_id', $produtos_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $stmt->execute(); // Retorna true/false
    }

    // Deletar no banco
    public function deleteRegistro($id) {
        $query = "DELETE FROM registros WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }  
    
}
