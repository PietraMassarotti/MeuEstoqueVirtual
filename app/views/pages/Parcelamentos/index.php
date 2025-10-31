<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

use App\Models\Parcelamento\ParcelamentoDAO;

$admin = $_SESSION['admin']['id'];
$parcelamentoDao = new ParcelamentoDAO();
$resultado = $parcelamentoDao->showParcelamento($admin);

$title = 'Parcelamento - Sistema de Usuários';
$page = 'parcelamento';
$basePath = '/MeuEstoqueVirtual/public';
?>
<body>
    <!-- CONTAINER PRINCIPAL -->
    <div class="main-container">

        <!-- TÍTULO -->
        <h1>Gerenciamento de Parcelamentos</h1>

        <!-- BOTÃO ADICIONAR -->
        <a href="<?= $basePath . '/parcelamento/adicionar' ?>">Adicionar</a>

        <!-- TABELA -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Quantidade</th>
                    <th>Taxa</th>
                    <th>Método de Pagamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["id"]) ?></td>
                        <td><?= htmlspecialchars($row["quantidade"]) ?></td>
                        <td><?= htmlspecialchars($row["taxa_juros"]) ?></td>
                        <td><?= htmlspecialchars($row["metodo_pagamento_nome"]) ?></td>
                        <td class="btn-actions">
                            <a href="<?= $basePath . '/parcelamento/editar/' . $row['id'] ?>" class="btn btn-edit">Editar</a>
                            <a href="<?= $basePath . '/parcelamento/deletar/' . $row['id'] ?>" class="btn btn-delete">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <!-- BOTÃO FIXO DE SAIR -->
    <div class="actions">
        <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
    </div>

    <!-- LOGO FIXA NO CANTO INFERIOR ESQUERDO -->
    <img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">

</body>
</html>
