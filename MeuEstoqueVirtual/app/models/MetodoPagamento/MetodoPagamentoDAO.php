<?php

namespace App\Models\MetodoPagamento;

use App\Models\MetodoPagamento\MetodoPagamento;
use App\Config\Database;
use PDO;

class MetodoPagamentoDAO
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
        $sql = "SELECT * FROM metodos_pagamento WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $marca = $stmt->fetch(PDO::FETCH_ASSOC);

        return $marca ?: null;
    }

    //Mostra os campos
    public function showMetodoPagamento()
    {
        $query = "SELECT * FROM metodos_pagamento";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    // Verifica se existem parcelamentos ou pedidos vinculados ao método de pagamento
    private function hasLinkedRecords($metodoPagamentoId)
    {
        // Verificar parcelamentos
        $sqlParcelamento = "SELECT COUNT(*) as total FROM parcelamentos WHERE metodos_pagamento_id = :id";
        $stmtParcelamento = $this->conn->prepare($sqlParcelamento);
        $stmtParcelamento->bindParam(':id', $metodoPagamentoId, PDO::PARAM_INT);
        $stmtParcelamento->execute();
        $resultParcelamento = $stmtParcelamento->fetch(PDO::FETCH_ASSOC);

        if ($resultParcelamento['total'] > 0) {
            return true;
        }

        try {
            $sqlPedidos = "SELECT COUNT(*) as total FROM pedidos WHERE metodos_pagamento_id = :id";
            $stmtPedidos = $this->conn->prepare($sqlPedidos);
            $stmtPedidos->bindParam(':id', $metodoPagamentoId, PDO::PARAM_INT);
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
    public function deleteMetodoPagamento($id)
    {
        // Verificar se há registros vinculados
        if ($this->hasLinkedRecords($id)) {
            throw new \Exception("Este método de pagamento não pode ser excluído pois está relacionado a parcelamentos ou pedidos.");
        }

        $query = "DELETE FROM metodos_pagamento WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Verifica se já existe marca com o mesmo nome (ignora maiúsculas/minúsculas)
    public function existsByName($nome)
    {
        $sql = "SELECT COUNT(*) FROM metodos_pagamento WHERE LOWER(nome) = LOWER(:nome)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Verifica se já existe marca com o mesmo nome, exceto o próprio ID
    public function existsByNameExceptId($nome, $id)
    {
        $sql = "SELECT COUNT(*) FROM metodos_pagamento 
            WHERE LOWER(nome) = LOWER(:nome)
            AND id <> :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
}
