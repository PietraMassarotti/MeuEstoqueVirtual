<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

use App\Models\Registro\RegistroDAO;

$admin = $_SESSION['admin']['id'];
$registroDao = new RegistroDAO();
$resultado = $registroDao->showRegistro($admin);

$title = 'Registro - Sistema de Usuários';
$page = 'registro';
$basePath = '/MeuEstoqueVirtual/public';
?>

<body>
    <!-- Container principal -->
    <div class="main-container">

        <!-- Título -->
        <h1>Gerenciamento de Registros</h1>

        <!-- Botão adicionar -->
        <a href="<?= $basePath . '/registro/adicionar' ?>">Adicionar</a>

        <!-- Tabela -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Quantidade</th>
                    <th>Ação</th>
                    <th>Descrição</th>
                    <th>Produto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["id"]) ?></td>
                        <td><?= htmlspecialchars($row["quantidade"]) ?></td>
                        <td><?= htmlspecialchars($row["acao"]) ?></td>
                        <td><?= htmlspecialchars($row["descricao"]) ?></td>
                        <td><?= htmlspecialchars($row["produto_nome"]) ?></td>
                        <td class="btn-actions">
                            <a href="<?= $basePath . '/registro/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                            <a href="<?= $basePath . '/registro/deletar/' . $row['id'] ?>" class="btn btn-delete">Deletar</a>
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