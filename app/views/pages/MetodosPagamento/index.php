<?php
    session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

require_once __DIR__ . '../../../models/MetodoPagamento/MetodoPagamentoDAO.php';

$admin = $_SESSION['admin']['id'];
$metodoPagamentoDao = new MetodoPagamentoDAO();
$resultado = $metodoPagamentoDao->showMetodoPagamento($admin);

include '../Menu/index.php';

?>

<!DOCTYPE html>

<head>
    <title>Meu Estoque Virtual - Metodos de Pagamento</title>
    <link rel="stylesheet" type="text/css" href="../Css/tabela.css" media="screen" />
</head>

<body>
    <a href="form_criar.php">Adicionar Metodo de Pagamento</a>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Metodo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    <?php
    foreach ($resultado as $row): ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row['nome'] ?></td>
            <td class="btn-actions">
                <a href="form_editar.php?id=<?= $row['id'] ?>" class="btn btn-edit">Editar</a>
                <a href="../../controllers/MetodoPagamento/delete.php?id=<?= $row['id'] ?>" class="btn btn-delete">Deletar</a>
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
