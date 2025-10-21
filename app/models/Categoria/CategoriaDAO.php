<?php

namespace App\Models\Categoria;
use App\Models\Categoria\Categoria;
use App\Config\Database;
use PDO;

class CategoriaDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    //Verifica se o ID existe
    public function findById($id)
    {
        $sql = "SELECT * FROM categorias WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

        return $categoria ?: null;
    }

    //Mostra os campos
    public function showCategoria($id) {
        $query = "SELECT * FROM categorias";  // Remove o filtro por admin_id
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retorna todos os produtos como um array associativo
    }

    // Cria no banco
    public function createCategoria($nome)
    {
        $query = "INSERT INTO categorias (nome) VALUES (:nome)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        return $stmt->execute();
    }

    //Editar no banco
    public function updateCategoria($id, $nome)
    {
        $query = "UPDATE categorias SET nome = :nome WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    // Deletar no banco
    public function deleteCategoria($id)
    {
        $query = "DELETE FROM categorias WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
