<?php

namespace App\Models\Parcelamento;

use App\Models\Parcelamento\Parcelamento;
use App\Config\Database;
use PDO;

class ParcelamentoDAO
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
        $sql = "SELECT * FROM parcelamentos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        return $produto ?: null;
    }


    public function showParcelamento()
    {
        $query = "SELECT p.*, m.nome AS metodo_pagamento_nome
                  FROM parcelamentos p
                  LEFT JOIN metodos_pagamento m ON p.metodos_pagamento_id = m.id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Cria no banco
    public function createParcelamento($quantidade, $taxa_juros, $metodos_pagamento_id)
    {
        $query = "INSERT INTO parcelamentos (quantidade, `taxa_juros`, metodos_pagamento_id) 
              VALUES (:quantidade, :taxa_juros, :metodos_pagamento_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':taxa_juros', $taxa_juros);
        $stmt->bindParam(':metodos_pagamento_id', $metodos_pagamento_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Editar no banco
    public function updateParcelamento($id, $quantidade, $taxa_juros, $metodos_pagamento_id)
    {
        $query = "UPDATE parcelamentos 
              SET quantidade = :quantidade, `taxa_juros` = :taxa_juros, 
                  metodos_pagamento_id = :metodos_pagamento_id
              WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':taxa_juros', $taxa_juros);
        $stmt->bindParam(':metodos_pagamento_id', $metodos_pagamento_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Verifica se existem compras ou pedidos vinculados ao parcelamento
    private function hasLinkedRecords($parcelamentoId)
    {
        // Verificar compras
        try {
            $sqlCompras = "SELECT COUNT(*) as total FROM compras WHERE parcelamentos_id = :id";
            $stmtCompras = $this->conn->prepare($sqlCompras);
            $stmtCompras->bindParam(':id', $parcelamentoId, PDO::PARAM_INT);
            $stmtCompras->execute();
            $resultCompras = $stmtCompras->fetch(PDO::FETCH_ASSOC);

            if ($resultCompras['total'] > 0) {
                return true;
            }
        } catch (\PDOException $e) {
        }

        // Verificar pedidos (caso exista relação direta)
        try {
            $sqlPedidos = "SELECT COUNT(*) as total FROM pedidos WHERE parcelamentos_id = :id";
            $stmtPedidos = $this->conn->prepare($sqlPedidos);
            $stmtPedidos->bindParam(':id', $parcelamentoId, PDO::PARAM_INT);
            $stmtPedidos->execute();
            $resultPedidos = $stmtPedidos->fetch(PDO::FETCH_ASSOC);

            if ($resultPedidos['total'] > 0) {
                return true;
            }
        } catch (\PDOException $e) {
        }

        return false;
    }

    // Deletar no banco
    public function deleteParcelamento($id)
    {
        // Verificar se há registros vinculados
        if ($this->hasLinkedRecords($id)) {
            throw new \Exception("Este parcelamento não pode ser excluído pois está relacionado a compras ou pedidos.");
        }

        $query = "DELETE FROM parcelamentos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
