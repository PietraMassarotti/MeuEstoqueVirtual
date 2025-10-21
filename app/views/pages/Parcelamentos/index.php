<?php
    session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

require_once __DIR__ . '../../../models/Produto/ProdutoDAO.php';

$admin = $_SESSION['admin']['id'];
$produtoDao = new ProdutoDAO();
$resultado = $produtoDao->showProduto($admin);

include '../Menu/index.php';

?>

<!DOCTYPE html>

<head>
    <title>Meu Estoque Virtual - Parcelamentos</title>
    <link rel="stylesheet" type="text/css" href="../Css/tabela.css" media="screen" />
</head>

<body>
    <a href="form_criar.php">Adicionar Produto</a>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Quantidade</th>
                <th>taxa</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>metodo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
    <?php
    foreach ($resultado as $row): ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row['nome'] ?></td>
            <td><?= $row['preco'] ?></td>
            <td><?= $row['create_at'] ?></td>
            <td><?= $row['update_at'] ?></td>
            <td><?= htmlspecialchars($row['categoria_nome']) ?></td>
            <td class="btn-actions">
                <a href="form_editar.php?id=<?= $row['id'] ?>" class="btn btn-edit">Editar</a>
                <a href="../../controllers/Produto/delete.php?id=<?= $row['id'] ?>" class="btn btn-delete">Deletar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
    </table>
    <div class="actions">
        <a href="../../controllers/Admin/logout.php" class="btn btn-exit">Sair</a>
    </div>
</body>

</html>