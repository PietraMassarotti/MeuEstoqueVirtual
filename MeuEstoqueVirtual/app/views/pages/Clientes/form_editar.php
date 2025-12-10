<?php
session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message success'>" . $_SESSION['mensagem'] . "</div>";
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

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Editar Cliente</h1>

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

                <div class="form-actions">
                    <button type="submit">Salvar Alterações</button>
                </div>
            </form>

            <form action="<?= $basePath . '/cliente' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit">Voltar</button>
                </div>
            </form>
        </div>
    </div>
</div>