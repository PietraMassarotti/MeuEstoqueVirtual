<?php

namespace App\Models\Compra;

use App\Config\Database;
use PDO;

class CompraDAO
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Verifica se o ID existe
    public function findById($id)
    {
        $sql = "SELECT * FROM compras WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Lista as compras com informações de pedidos e produtos
    public function showCompras()
    {
        $query = "SELECT 
                    c.id,
                    c.create_at,
                    c.update_at,
                    c.pedidos_id,
                    c.parcelamentos_id,
                    ped.clientes_id,
                    cli.nome AS cliente_nome,
                    GROUP_CONCAT(DISTINCT p.nome SEPARATOR ', ') AS produtos_nomes,
                    COUNT(DISTINCT p.id) AS total_produtos
                  FROM compras c
                  LEFT JOIN pedidos ped ON c.pedidos_id = ped.id
                  LEFT JOIN clientes cli ON ped.clientes_id = cli.id
                  LEFT JOIN pedidos_has_produtos php ON ped.id = php.pedidos_id
                  LEFT JOIN produtos p ON php.produtos_id = p.id
                  GROUP BY c.id
                  ORDER BY c.create_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Produtos com estoque baixo
    public function getProdutosEstoqueBaixo()
    {
        $query = "SELECT 
                    p.id,
                    p.nome,
                    p.quantidade,
                    c.nome AS categoria_nome,
                    m.nome AS marca_nome
                  FROM produtos p
                  LEFT JOIN categorias c ON p.categorias_id = c.id
                  LEFT JOIN marcas m ON p.marcas_id = m.id
                  WHERE p.quantidade < 7
                  ORDER BY p.quantidade ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Criar compra
    public function createCompra($pedidos_id, $parcelamentos_id)
    {
        $query = "INSERT INTO compras (pedidos_id, parcelamentos_id) 
                  VALUES (:pedidos_id, :parcelamentos_id)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pedidos_id', $pedidos_id, PDO::PARAM_INT);
        $stmt->bindParam(':parcelamentos_id', $parcelamentos_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Editar compra
    public function updateCompra($id, $pedidos_id, $parcelamentos_id)
    {
        $query = "UPDATE compras 
                  SET pedidos_id = :pedidos_id,
                      parcelamentos_id = :parcelamentos_id
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pedidos_id', $pedidos_id, PDO::PARAM_INT);
        $stmt->bindParam(':parcelamentos_id', $parcelamentos_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    private function hasLinkedRecords($id)
    {

        try {
            $sql = "SELECT pedidos_id FROM compras WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $compra = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($compra && !empty($compra['pedidos_id'])) {
                return true;
            }
        } catch (\PDOException $e) {
        }

        try {
            $sql = "SELECT parcelamentos_id FROM compras WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $compra = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($compra && !empty($compra['parcelamentos_id'])) {
                return true;
            }
        } catch (\PDOException $e) {
        }

        return false;
    }

    public function deleteCompra($id)
    {
        if ($this->hasLinkedRecords($id)) {
            throw new \Exception("Esta compra não pode ser excluída pois está vinculada a um pedido ou parcelamento.");
        }

        $query = "DELETE FROM compras WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function getAllPedidos()
    {
        $query = "SELECT p.id, c.nome AS cliente_nome, p.create_at 
                  FROM pedidos p
                  LEFT JOIN clientes c ON p.clientes_id = c.id
                  ORDER BY p.create_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllParcelamentos()
    {
        $query = "SELECT id, quantidade, taxa_juros, create_at 
                  FROM parcelamentos 
                  ORDER BY create_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
