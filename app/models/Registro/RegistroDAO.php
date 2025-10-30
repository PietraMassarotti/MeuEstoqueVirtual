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

    //Verifica se o ID existe
    public function findById($id)
    {
        $sql = "SELECT * FROM registros WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        $stmt->execute();
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $registro ?: null;
    }

    public function showRegistro($id) {
        $query = "SELECT r.*, p.nome AS produto_nome
        FROM registros r
        LEFT JOIN produtos p ON r.produtos_id = p.id"; // Remove o filtro por admin_id
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retorna todos os produtos como um array associativo
    }

    // Cria no banco
    public function createRegistro($quantidade, $acao, $descricao, $produtos_id) {
        $query = "INSERT INTO registros (quantidade, acao, descricao, produtos_id) 
              VALUES (:quantidade, :acao, :descricao, :produtos_id)";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':acao', $acao);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':produtos_id', $produtos_id, PDO::PARAM_INT);

        // Executa e retorna true se sucesso, false se falha
        return $stmt->execute();
    }

 // Editar no banco
    public function updateRegistro($id, $quantidade, $acao, $descricao, $produtos_id) {
        $query = "UPDATE registros 
              SET quantidade = :quantidade, acao = :acao, 
                  descricao = :descricao, produtos_id = :produtos_id
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