<?php
require_once 'Marca.php';
require_once __DIR__ . '/../../../config/Database.php';

class MarcaDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    //Verifica se o ID existe no banco
    public function buscarId($id) {
        $query = "SELECT * FROM marcas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Adicionar no banco
    public function criarMarca($nome) {
        $query = "INSERT INTO marcas (nome) VALUES (:nome)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        return null;
    }

    //Editar no banco
    public function editarMarca($id, $nome) {
        $query = "UPDATE marcas SET nome = :nome WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $this->buscarId($id);
        }
        return null;
    }

    // Deletar no banco
      public function deletarMarca($id) {
        $query = "DELETE FROM marcas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }  
}
