<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

use App\Models\Pedido\PedidoDAO;

$admin = $_SESSION['admin']['id'];
$pedidoDao = new PedidoDAO();
$resultado = $pedidoDao->showPedido($admin);

$title = 'pedido - Sistema de Usuários';
$page = 'pedido';
$basePath = '/MeuEstoqueVirtual/public';
?>

<body>
    <!-- Container principal -->
    <div class="main-container">

        <!-- Título -->
        <h1>Gerenciamento de pedidos</h1>

        <!-- Botão adicionar -->
        <a href="<?= $basePath . '/pedido/adicionar' ?>">Adicionar</a>

        <!-- Tabela -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["id"]) ?></td>
                        <td><?= htmlspecialchars($row["cliente_nome"]) ?></td>
                        <td class="btn-actions">
                            <a href="<?= $basePath . '/pedido/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                            <a href="<?= $basePath . '/pedido/deletar/' . $row['id'] ?>" class="btn btn-delete">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Botão fixo de sair -->
    <div class="actions">
        <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
    </div>

    <!-- Logo fixa no canto inferior esquerdo -->
    <img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">
</body>

</html>