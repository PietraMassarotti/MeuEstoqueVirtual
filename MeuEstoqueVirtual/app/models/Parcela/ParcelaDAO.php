<?php

namespace App\Models\Parcela;

use App\Models\Parcela\Parcela;
use App\Config\Database;
use PDO;

class ParcelaDAO
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
        $sql = "SELECT * FROM parcelas WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $parcela = $stmt->fetch(PDO::FETCH_ASSOC);
        return $parcela ?: null;
    }

    // Mostra todas as parcelas com informações da compra e cliente
    public function showParcelas()
    {
        $query = "SELECT 
                    p.id,
                    p.numero,
                    p.valor,
                    p.data,
                    p.status,
                    p.create_at,
                    p.update_at,
                    p.compras_id,
                    c.pedidos_id,
                    cli.nome as cliente_nome
                  FROM parcelas p
                  LEFT JOIN compras c ON p.compras_id = c.id
                  LEFT JOIN pedidos ped ON c.pedidos_id = ped.id
                  LEFT JOIN clientes cli ON ped.clientes_id = cli.id
                  ORDER BY p.data ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar parcelas atrasadas
    public function getParcelasAtrasadas()
    {
        $query = "SELECT 
                    p.id,
                    p.numero,
                    p.valor,
                    p.data,
                    p.status,
                    p.compras_id,
                    cli.nome as cliente_nome,
                    DATEDIFF(CURDATE(), p.data) as dias_atraso
                  FROM parcelas p
                  LEFT JOIN compras c ON p.compras_id = c.id
                  LEFT JOIN pedidos ped ON c.pedidos_id = ped.id
                  LEFT JOIN clientes cli ON ped.clientes_id = cli.id
                  WHERE p.data < CURDATE() 
                  AND p.status != 'Pago'
                  ORDER BY p.data ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Criar parcela
    public function createParcela($numero, $valor, $data, $status, $compras_id)
    {
        $query = "INSERT INTO parcelas (numero, valor, data, status, compras_id) 
                  VALUES (:numero, :valor, :data, :status, :compras_id)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':numero', $numero, PDO::PARAM_INT);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':compras_id', $compras_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Editar parcela
    public function updateParcela($id, $numero, $valor, $data, $status, $compras_id)
    {
        $query = "UPDATE parcelas 
                  SET numero = :numero, 
                      valor = :valor, 
                      data = :data, 
                      status = :status, 
                      compras_id = :compras_id 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':numero', $numero, PDO::PARAM_INT);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':compras_id', $compras_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Deletar parcela
    public function deleteParcela($id)
    {
        $query = "DELETE FROM parcelas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Buscar todas as compras para o select
    public function getAllCompras()
    {
        $query = "SELECT 
                    c.id, 
                    c.pedidos_id,
                    cli.nome as cliente_nome,
                    c.create_at
                  FROM compras c
                  LEFT JOIN pedidos p ON c.pedidos_id = p.id
                  LEFT JOIN clientes cli ON p.clientes_id = cli.id
                  ORDER BY c.create_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
