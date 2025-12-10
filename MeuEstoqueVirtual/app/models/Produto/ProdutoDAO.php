<?php

namespace App\Models\Produto;

use App\Models\Produto\Produto;
use App\Config\Database;
use PDO;

class ProdutoDAO
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
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        return $produto ?: null;
    }


    public function showProduto()
    {
        $query = "SELECT p.*, m.nome AS marca_nome, c.nome AS categoria_nome
                  FROM produtos p
                  LEFT JOIN marcas m ON p.marcas_id = m.id
                  LEFT JOIN categorias c ON p.categorias_id = c.id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Cria no banco
    public function createProduto($nome, $preco, $quantidade, $genero, $descricao, $marcas_id, $categorias_id, $data_validade = null)
    {
        $query = "INSERT INTO produtos (nome, preco, quantidade, genero, descricao, data_validade, marcas_id, categorias_id) 
                  VALUES (:nome, :preco, :quantidade, :genero, :descricao, :data_validade, :marcas_id, :categorias_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':data_validade', $data_validade);
        $stmt->bindParam(':marcas_id', $marcas_id, PDO::PARAM_INT);
        $stmt->bindParam(':categorias_id', $categorias_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Editar no banco
    public function updateProduto($id, $nome, $preco, $quantidade, $genero, $descricao, $marcas_id, $categorias_id, $data_validade = null)
    {
        $query = "UPDATE produtos 
                  SET nome = :nome, preco = :preco, quantidade = :quantidade, genero = :genero, 
                      descricao = :descricao, data_validade = :data_validade, marcas_id = :marcas_id, categorias_id = :categorias_id 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':data_validade', $data_validade);
        $stmt->bindParam(':marcas_id', $marcas_id, PDO::PARAM_INT);
        $stmt->bindParam(':categorias_id', $categorias_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Verifica se o produto está vinculado a compras ou pedidos
    private function hasLinkedRecords($produtoId)
    {
        // Verificar registros (ESSENCIAL!)
        try {
            $sql = "SELECT COUNT(*) AS total FROM registros WHERE produtos_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $produtoId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['total'] > 0) {
                return true;
            }
        } catch (\PDOException $e) {
        }

        // Verificar compras
        try {
            $sql = "SELECT COUNT(*) AS total FROM compras WHERE produtos_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $produtoId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['total'] > 0) {
                return true;
            }
        } catch (\PDOException $e) {
        }

        // Verificar itens de pedidos
        $possibleTables = ['pedidos_has_produtos', 'itens_pedido', 'pedido_produtos'];

        foreach ($possibleTables as $table) {
            try {
                $sql = "SELECT COUNT(*) AS total FROM $table WHERE produtos_id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $produtoId, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result['total'] > 0) {
                    return true;
                }
            } catch (\PDOException $e) {
                continue;
            }
        }

        return false;
    }


    // Deletar no banco
    public function deleteProduto($id)
    {
        // Verificar se há registros vinculados
        if ($this->hasLinkedRecords($id)) {
            throw new \Exception("Este produto não pode ser excluído pois está relacionado a compras ou pedidos.");
        }

        $query = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
