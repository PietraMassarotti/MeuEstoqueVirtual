<?php

use App\Models\MetodoPagamento\MetodoPagamentoDAO;

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

$metodoPagamentoDao = new MetodoPagamentoDAO();
$metodoPagamento = $metodoPagamentoDao->findById($id);

if (!$metodoPagamento) {
    echo "Marca não encontrada.";
    exit();
}
$title = 'Categoria - Editar ';
$page = 'categoria/editar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Editar Método</h1>

            <form action="<?= $basePath . '/metodoPagamento/salvar' ?>" method="POST">

                <input type="hidden" name="id" value="<?= htmlspecialchars($metodoPagamento['id']) ?>">

                <label>Nome:</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($metodoPagamento['nome']) ?>" required>

                <div class="form-actions">
                    <button type="submit">Salvar Alterações</button>
                </div>
            </form>

            <form action="<?= $basePath . '/metodoPagamento' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit">Voltar</button>
                </div>
            </form>
        </div>
    </div>
</div>