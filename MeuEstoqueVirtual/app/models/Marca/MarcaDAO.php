<?php

namespace App\Models\Marca;

use App\Models\Marca\Marca;
use App\Config\Database;
use PDO;

class MarcaDAO
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
        $sql = "SELECT * FROM marcas WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $marca = $stmt->fetch(PDO::FETCH_ASSOC);

        return $marca ?: null;
    }

    //Mostra os campos
    public function showMarca()
    {
        $query = "SELECT * FROM marcas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cria no banco
    public function createMarca($nome)
    {
        $query = "INSERT INTO marcas (nome) VALUES (:nome)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        return $stmt->execute();
    }

    //Editar no banco
    public function updateMarca($id, $nome)
    {
        $query = "UPDATE marcas SET nome = :nome WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Verifica se existem produtos vinculados à marca
    private function hasProductsLinked($marcaId)
    {
        $sql = "SELECT COUNT(*) as total FROM produtos WHERE marcas_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $marcaId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }

    // Deletar no banco
    public function deleteMarca($id)
    {
        // Verificar se há produtos vinculados
        if ($this->hasProductsLinked($id)) {
            throw new \Exception("Esta marca não pode ser excluída pois está relacionada a um ou mais produtos.");
        }

        $query = "DELETE FROM marcas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Verifica se já existe marca com o mesmo nome (ignora maiúsculas/minúsculas)
    public function existsByName($nome)
    {
        $sql = "SELECT COUNT(*) FROM marcas WHERE LOWER(nome) = LOWER(:nome)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Verifica se já existe marca com o mesmo nome, exceto o próprio ID
    public function existsByNameExceptId($nome, $id)
    {
        $sql = "SELECT COUNT(*) FROM marcas 
            WHERE LOWER(nome) = LOWER(:nome)
            AND id <> :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
}
