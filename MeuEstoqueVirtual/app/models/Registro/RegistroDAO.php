<?php

namespace App\Models\Registro;

use App\Models\Registro\Registro;
use App\Config\Database;
use PDO;

class RegistroDAO
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
        $sql = "SELECT * FROM registros WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);

        return $registro ?: null;
    }

    public function showRegistro()
    {
        $query = "SELECT r.*, p.nome AS produto_nome
        FROM registros r
        LEFT JOIN produtos p ON r.produtos_id = p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cria no banco
    public function createRegistro($quantidade, $acao, $descricao, $produtos_id)
    {
        try {
            // Ajustar estoque primeiro
            $this->ajustarEstoque($produtos_id, $quantidade, $acao);

            // Criar registro
            $query = "INSERT INTO registros (quantidade, acao, descricao, produtos_id) 
                  VALUES (:quantidade, :acao, :descricao, :produtos_id)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':acao', $acao);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':produtos_id', $produtos_id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // Editar no banco
    public function updateRegistro($id, $quantidade, $acao, $descricao, $produtos_id)
    {
        $query = "UPDATE registros 
              SET quantidade = :quantidade, acao = :acao, 
                  descricao = :descricao, produtos_id = :produtos_id
              WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':acao', $acao);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':produtos_id', $produtos_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Deletar no banco
    public function deleteRegistro($id)
    {
        $query = "DELETE FROM registros WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function ajustarEstoque($produtos_id, $quantidade, $acao)
    {
        try {
            $this->conn->beginTransaction();

            // Buscar quantidade atual do produto
            $sql = "SELECT quantidade FROM produtos WHERE id = :id FOR UPDATE";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $produtos_id, PDO::PARAM_INT);
            $stmt->execute();

            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$produto) {
                throw new \Exception("Produto não encontrado.");
            }

            $estoqueAtual = (int)$produto['quantidade'];
            $quantidade = (int)$quantidade;

            // Ajustar de acordo com ação
            if ($acao === "Entrada") {
                $novoEstoque = $estoqueAtual + $quantidade;
            } elseif ($acao === "Saida") {
                if ($quantidade > $estoqueAtual) {
                    throw new \Exception("A saída informada excede o estoque disponível.");
                }
                $novoEstoque = $estoqueAtual - $quantidade;
            } else {
                throw new \Exception("Ação inválida. Use 'Entrada' ou 'Saida'.");
            }

            // Atualizar estoque
            $updateSql = "UPDATE produtos SET quantidade = :quantidade WHERE id = :id";
            $updateStmt = $this->conn->prepare($updateSql);
            $updateStmt->bindParam(':quantidade', $novoEstoque, PDO::PARAM_INT);
            $updateStmt->bindParam(':id', $produtos_id, PDO::PARAM_INT);

            $updateStmt->execute();

            $this->conn->commit();
            return true;
        } catch (\Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function deletarComAjusteEstoque($id)
    {
        try {
            $this->conn->beginTransaction();

            $sql = "SELECT quantidade, acao, produtos_id FROM registros WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $reg = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$reg) {
                throw new \Exception("Registro não encontrado.");
            }

            $quantidade = (int)$reg['quantidade'];
            $acao = $reg['acao'];
            $produtos_id = $reg['produtos_id'];

            $sqlEstoque = "SELECT quantidade FROM produtos WHERE id = :id FOR UPDATE";
            $stmt2 = $this->conn->prepare($sqlEstoque);
            $stmt2->bindParam(':id', $produtos_id, PDO::PARAM_INT);
            $stmt2->execute();
            $produto = $stmt2->fetch(PDO::FETCH_ASSOC);

            if (!$produto) {
                throw new \Exception("Produto não encontrado.");
            }

            $estoqueAtual = (int)$produto['quantidade'];

            if ($acao === "Entrada") {
                $novoEstoque = $estoqueAtual - $quantidade;

                if ($novoEstoque < 0) {
                    throw new \Exception("Não é possível excluir este registro: o estoque ficaria negativo.");
                }
            } else { 

                $novoEstoque = $estoqueAtual + $quantidade;
            }

            $update = "UPDATE produtos SET quantidade = :qtd WHERE id = :id";
            $stmt3 = $this->conn->prepare($update);
            $stmt3->bindParam(':qtd', $novoEstoque, PDO::PARAM_INT);
            $stmt3->bindParam(':id', $produtos_id, PDO::PARAM_INT);
            $stmt3->execute();

            $delete = "DELETE FROM registros WHERE id = :id";
            $stmt4 = $this->conn->prepare($delete);
            $stmt4->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt4->execute();

            $this->conn->commit();
            return true;
        } catch (\Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }
}
