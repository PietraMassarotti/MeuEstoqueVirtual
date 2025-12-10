<?php

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

$title = 'Categoria - Adicionar';
$page = 'categoria/adicionar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Adicionar Categoria</h1>
            <form action="<?= $basePath . '/categoria/criar' ?>" method="POST">
                <label>Nome:</label>
                <input type="text" name="nome" required>
                <div class="form-actions">
                    <button type="submit">Adicionar</button>
                </div>
            </form>
            <form action="<?= $basePath . '/categoria' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit">Voltar</button>
                </div>
            </form>
        </div>
    </div>
</div>