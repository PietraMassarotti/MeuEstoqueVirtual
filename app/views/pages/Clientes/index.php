<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

use App\Models\Cliente\ClienteDAO;
use App\Utils\Validacao;

$admin = $_SESSION['admin']['id'];
$clienteDao = new ClienteDAO();
$resultado = $clienteDao->showCliente($admin);

$title = 'Cliente';
$page = 'cliente';
$basePath = '/MeuEstoqueVirtual/public';
?>

<!DOCTYPE html>

<head>
    <title>Meu Estoque Virtual - Clientes</title>
    <link rel="stylesheet" type="text/css" href="../Css/tabela.css" media="screen" />
</head>

<body>
    <a href="<?= $basePath . '/cliente/adicionar' ?>">Adicionar Clientes</a>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Nascimento</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultado as $row): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row['endereco'] ?></td>
                    <td><?= Validacao::exibirTelefone($row["telefone"]) ?></td>
                    <td><?= $row['nasc'] ?></td>
                    <td class="btn-actions">
                        <a href="<?= $basePath . '/cliente/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="<?= $basePath . '/cliente/deletar/' . $row['id'] ?>" class="btn btn-delete">Deletar</a>
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