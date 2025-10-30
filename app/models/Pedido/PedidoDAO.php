<?php

namespace App\Models\Pedido;

use App\Models\Pedido\Pedido;
use App\Config\Database;
use PDO;

class PedidoDAO
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
        $sql = "SELECT * FROM pedidos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        return $pedido ?: null;
    }

    public function showPedido($id)
    {
        $query = "SELECT pedidos.*, clientes.nome AS cliente_nome
    FROM pedidos
    LEFT JOIN clientes ON pedidos.clientes_id = clientes.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cria no banco
    public function createPedido($clientes_id)
    {
        $query = "INSERT INTO pedidos (clientes_id) 
              VALUES (:clientes_id)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':clientes_id', $clientes_id, PDO::PARAM_INT);

        // Executa e retorna true se sucesso, false se falha
        return $stmt->execute();
    }

    // Editar no banco
    public function updatePedido($id, $clientes_id)
    {
        $query = "UPDATE pedidos 
              SET clientes_id = :clientes_id
              WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':clientes_id', $clientes_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute(); // Retorna true/false
    }

    // Deletar no banco
    public function deletePedido($id)
    {
        $query = "DELETE FROM pedidos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
