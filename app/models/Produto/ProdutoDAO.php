<?php
namespace App\Models\Produto;
use App\Models\Produto\Produto;
use App\Config\Database;
use PDO;

class ProdutoDAO {
    private $conn;

    public function __construct() {
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

    
    public function showProduto($id) {
        $query = "SELECT p.*, m.nome AS marca_nome, c.nome AS categoria_nome
                  FROM produtos p
                  LEFT JOIN marcas m ON p.marcas_id = m.id
                  LEFT JOIN categorias c ON p.categorias_id = c.id";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Cria no banco
public function createProduto($nome, $preco, $quantidade, $genero, $descricao, $marcas_id, $categorias_id) {
    $query = "INSERT INTO produtos (nome, preco, quantidade, genero, descricao, marcas_id, categorias_id) 
              VALUES (:nome, :preco, :quantidade, :genero, :descricao, :marcas_id, :categorias_id)";
    
    $stmt = $this->conn->prepare($query);
    
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':genero', $genero);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':marcas_id', $marcas_id, PDO::PARAM_INT);
    $stmt->bindParam(':categorias_id', $categorias_id, PDO::PARAM_INT); // Corrigido aqui

    // Executa e retorna true se sucesso, false se falha
    return $stmt->execute();
}

 // Editar no banco
public function updateProduto($id, $nome, $preco, $quantidade, $genero, $descricao, $marcas_id, $categorias_id) {
    $query = "UPDATE produtos 
              SET nome = :nome, preco = :preco, quantidade = :quantidade, genero = :genero, 
                  descricao = :descricao, marcas_id = :marcas_id, categorias_id = :categorias_id 
              WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':genero', $genero);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':marcas_id', $marcas_id, PDO::PARAM_INT);
    $stmt->bindParam(':categorias_id', $categorias_id, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute(); // Retorna true/false
}

    // Deletar no banco
      public function deleteProduto($id) {
        $query = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }  
}