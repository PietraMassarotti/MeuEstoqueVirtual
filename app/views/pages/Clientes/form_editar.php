<?php
session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<p>" . $_SESSION['mensagem'] . "</p>";
    // Limpa a mensagem
    unset($_SESSION['mensagem']);
}

use App\Models\Cliente\ClienteDAO;

$clienteDao = new ClienteDAO();
$cliente = $clienteDao->findById($id);

if (!$cliente) {
    echo "Cliente não encontrada.";
    exit();
}
?>


<h1>Atualizar</h1>
<form action="<?= $basePath . '/cliente/salvar' ?>" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($cliente['id']) ?>">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
    <label>E-mail:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>
    <label>Endereço:</label>
    <input type="text" name="endereco" value="<?= htmlspecialchars($cliente['endereco']) ?>" required>
    <label>Telefone:</label>
    <input type="text" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" required>
    <label>Data de Nascimento:</label>
    <input type="date" name="nasc" value="<?= htmlspecialchars($cliente['nasc']) ?>" required>
    <button type="submit">Editar</button>
</form>
<form action="<?= $basePath . '/cliente' ?>" method="GET">
    <button type="submit">Voltar</button>
</form>