<?php
namespace App\Models\MetodoPagamento;
use App\Models\MetodoPagamento\MetodoPagamento;
use App\Config\Database;
use PDO;

class MetodoPagamentoDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

     //Verifica se o ID existe
    public function findById($id)
    {
        $sql = "SELECT * FROM metodos_pagamento WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $marca = $stmt->fetch(PDO::FETCH_ASSOC);

        return $marca ?: null;
    }

    //Mostra os campos
    public function showMetodoPagamento($id) {
        $query = "SELECT * FROM metodos_pagamento";  // Remove o filtro por admin_id
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retorna todos os produtos como um array associativo
    }

    // Cria no banco
    public function createMetodoPagamento($nome)
    {
        $query = "INSERT INTO metodos_pagamento (nome) VALUES (:nome)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        return $stmt->execute();
    }

    //Editar no banco
    public function updateMetodoPagamento($id, $nome)
    {
        $query = "UPDATE metodos_pagamento SET nome = :nome WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    // Deletar no banco
    public function deleteMetodoPagamento($id)
    {
        $query = "DELETE FROM metodos_pagamento WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
