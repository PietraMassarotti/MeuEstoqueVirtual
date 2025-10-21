<?php
    session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

require_once __DIR__ . '../../../models/Registro/RegistroDAO.php';

$admin = $_SESSION['admin']['id'];
$registroDao = new RegistroDAO();
$resultado = $registroDao->showRegistro($admin);

include '../Menu/index.php';

?>

<!DOCTYPE html>

<head>
    <title>Meu Estoque Virtual - Registros</title>
    <link rel="stylesheet" type="text/css" href="../Css/tabela.css" media="screen" />
</head>

<body>
    <a href="form_criar.php">Adicionar Registro</a>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Quantidade</th>
                <th>Ação</th>
                <th>Descrição</th>
                <th>Produto</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    <?php
    foreach ($resultado as $row): ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row['quantidade'] ?></td>
            <td><?= $row["acao"] ?></td>
            <td><?= $row['descricao'] ?></td>
            <td><?= htmlspecialchars($row['produto_nome']) ?></td>
            <td class="btn-actions">
                <a href="form_editar.php?id=<?= $row['id'] ?>" class="btn btn-edit">Editar</a>
                <a href="../../controllers/Marca/delete.php?id=<?= $row['id'] ?>" class="btn btn-delete">Deletar</a>
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
