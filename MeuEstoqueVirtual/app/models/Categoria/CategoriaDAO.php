<?php

namespace App\Models\Categoria;

use App\Models\Categoria\Categoria;
use App\Config\Database;
use PDO;

class CategoriaDAO
{
    private $conn;

    public function __construct()
    {
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
    public function showCategoria()
    {
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

    // Verifica se existem produtos vinculados à categoria
    private function hasProductsLinked($categoriaId)
    {
        $sql = "SELECT COUNT(*) as total FROM produtos WHERE categorias_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $categoriaId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }

    // Deletar no banco
    public function deleteCategoria($id)
    {
        // Verificar se há produtos vinculados
        if ($this->hasProductsLinked($id)) {
            throw new \Exception("Não é possível excluir esta categoria pois existem produtos vinculados a ela. Remova ou altere a categoria dos produtos primeiro.");
        }

        $query = "DELETE FROM categorias WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Verifica se já existe uma categoria com o mesmo nome
    public function existsByName($nome)
    {
        $sql = "SELECT COUNT(*) FROM categorias WHERE LOWER(nome) = LOWER(:nome)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function existsByNameExceptId($nome, $id)
    {
        $sql = "SELECT COUNT(*) FROM categorias 
            WHERE LOWER(nome) = LOWER(:nome) AND id <> :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}
