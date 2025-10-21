<?php
session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<p>" . $_SESSION['mensagem'] . "</p>";
    // Limpa a mensagem
    unset($_SESSION['mensagem']);
}

$title = 'Cliente - Adicionar';
$page = 'cliente/adicionar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<h1>Adicionar</h1>
<form action="<?= $basePath . '/cliente/criar' ?>" method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" required>
    <label>E-mail:</label>
    <input type="email" name="email" required>
    <label>Endereço:</label>
    <input type="text" name="endereco" required>
    <label>Telefone:</label>
    <input type="text" name="telefone" required>
    <label>Data de Nascimento:</label>
    <input type="date" name="nasc" required>
    <button type="submit">Adicionar</button>
</form>
<form action="<?= $basePath . '/cliente' ?>" method="GET">
    <button type="submit">Voltar</button>
</form>