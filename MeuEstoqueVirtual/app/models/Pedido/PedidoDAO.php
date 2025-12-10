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

    public function showPedido()
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

        return $stmt->execute();
    }

    // Verifica se existem compras ou itens vinculados ao pedido
    private function hasLinkedRecords($pedidoId)
    {
        // Verificar compras
        try {
            $sqlCompras = "SELECT COUNT(*) as total FROM compras WHERE pedidos_id = :id";
            $stmtCompras = $this->conn->prepare($sqlCompras);
            $stmtCompras->bindParam(':id', $pedidoId, PDO::PARAM_INT);
            $stmtCompras->execute();
            $resultCompras = $stmtCompras->fetch(PDO::FETCH_ASSOC);

            if ($resultCompras['total'] > 0) {
                return true;
            }
        } catch (\PDOException $e) {
        }

        // Verificar itens do pedido
        try {
            $possibleTables = ['pedidos_has_produtos', 'itens_pedido', 'pedido_produtos'];

            foreach ($possibleTables as $table) {
                try {
                    $sql = "SELECT COUNT(*) as total FROM $table WHERE pedidos_id = :id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':id', $pedidoId, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($result['total'] > 0) {
                        return true;
                    }
                } catch (\PDOException $e) {
                    continue;
                }
            }
        } catch (\PDOException $e) {
        }

        return false;
    }

    // Deletar no banco
    public function deletePedido($id)
    {
        // Verificar se há registros vinculados
        if ($this->hasLinkedRecords($id)) {
            throw new \Exception("Este pedido não pode ser excluído pois está relacionado a compras ou possui itens vinculados.");
        }

        $query = "DELETE FROM pedidos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
