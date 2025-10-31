<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

use App\Models\MetodoPagamento\MetodoPagamentoDAO;

$admin = $_SESSION['admin']['id'];
$metodoPagamentoDao = new MetodoPagamentoDAO();
$resultado = $metodoPagamentoDao->showMetodoPagamento($admin);

$title = 'Método de Pagamento';
$page = 'metodoPagamento';
$basePath = '/MeuEstoqueVirtual/public';
?>
<body>
    <div class="main-container">
        <h1>Gerenciamento de Métodos de Pagamento</h1>

        <!-- Botão adicionar -->
        <a href="<?= $basePath . '/metodoPagamento/adicionar' ?>">Adicionar</a>

        <!-- Tabela -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Método</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $row): ?>
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row['nome'] ?></td>
                        <td class="btn-actions">
                            <a href="<?= $basePath . '/metodoPagamento/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                            <a href="<?= $basePath . '/metodoPagamento/deletar/' . $row['id'] ?>" class="btn btn-delete">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Botão sair -->
        <div class="actions">
            <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
        </div>
    </div>

    <!-- Logo fixa no canto inferior esquerdo -->
    <img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">
</body>

</html>
