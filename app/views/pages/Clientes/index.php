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

<body>

    <!-- CONTAINER PRINCIPAL -->
    <div class="main-container">

        <h1>Gerenciamento de Clientes</h1>

        <!-- BOTÃO ADICIONAR CLIENTE -->

        <a href="<?= $basePath . '/cliente/adicionar' ?>">Adicionar</a>

        <!-- TABELA DE CLIENTES -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $row): ?>
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= htmlspecialchars($row['nome']) ?></td>
                        <td><?= htmlspecialchars($row["email"]) ?></td>
                        <td><?= htmlspecialchars($row['endereco']) ?></td>
                        <td><?= Validacao::exibirTelefone($row["telefone"]) ?></td>
                        <td><?= htmlspecialchars($row['nasc']) ?></td>
                        <td class="btn-actions">
                            <a href="<?= $basePath . '/cliente/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                            <a href="<?= $basePath . '/cliente/deletar/' . $row['id'] ?>" class="btn btn-delete">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <!-- BOTÃO SAIR FIXO -->
    <div class="actions">
        <a href="../../controllers/Admin/logout.php" class="btn btn-exit">Sair</a>
    </div>

    <!-- LOGO FIXA NO CANTO INFERIOR ESQUERDO -->
    <img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">

</body>
</html>
