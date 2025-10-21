<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

use App\Models\Marca\MarcaDAO;

$admin = $_SESSION['admin']['id'];
$marcaDao = new MarcaDAO();
$resultado = $marcaDao->showMarca($admin);

$title = 'Marca';
$page = 'marca';
$basePath = '/MeuEstoqueVirtual/public';

?>

<!DOCTYPE html>

<head>
    <title>Meu Estoque Virtual - Marca</title>
    <link rel="stylesheet" type="text/css" href="../Css/tabela.css" media="screen" />
</head>

<body>
    <a href="form_criar.php">Adicionar Marca</a>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
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
                        <a href="../../controllers/Marca/delete.php?id=<?= $row['id'] ?>" class="btn btn-delete">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="actions">
        <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
    </div>
</body>

</html>