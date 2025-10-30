<?php
namespace App\Models\Marca;
use App\Models\Marca\Marca;
use App\Config\Database;
use PDO;

class MarcaDAO
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
        $sql = "SELECT * FROM marcas WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $marca = $stmt->fetch(PDO::FETCH_ASSOC);

        return $marca ?: null;
    }

    //Mostra os campos
    public function showMarca($id)
    {
        $query = "SELECT * FROM marcas";  // Remove o filtro por admin_id
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retorna todos os produtos como um array associativo
    }

    // Cria no banco
    public function createMarca($nome)
    {
        $query = "INSERT INTO marcas (nome) VALUES (:nome)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        return $stmt->execute();
    }

    //Editar no banco
    public function updateMarca($id, $nome)
    {
        $query = "UPDATE marcas SET nome = :nome WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    // Deletar no banco
    public function deleteMarca($id)
    {
        $query = "DELETE FROM marcas WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
