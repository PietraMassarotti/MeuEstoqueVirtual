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
    
}