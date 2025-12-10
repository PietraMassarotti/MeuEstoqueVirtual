<?php

use App\Models\Registro\RegistroDAO;
use App\Models\Produto\ProdutoDAO;

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message success'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

$registroDao = new RegistroDAO();
$registro = $registroDao->findById($id);

if (!$registro) {
    echo "Registro não encontrada.";
    exit();
}

$produtoDao = new ProdutoDAO();
$produto = $produtoDao->showProduto();

$title = 'Categoria - Editar ';
$page = 'categoria/editar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Editar Registro</h1>

            <form action="<?= $basePath . '/registro/salvar' ?>" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($registro['id']) ?>">

                <label>Quantidade:</label>
                <input type="number" name="quantidade" value="<?= htmlspecialchars($registro['quantidade']) ?>" required>

                <label>Ação:</label>
                <select name="acao" id="acao" class="form-select">
                    <option value="Entrada" <?= $registro['acao'] === 'Entrada' ? 'selected' : '' ?>>Entrada</option>
                    <option value="Saida" <?= $registro['acao'] === 'Saida' ? 'selected' : '' ?>>Saída</option>
                </select>

                <label>Descrição:</label>
                <input type="text" name="descricao" value="<?= htmlspecialchars($registro['descricao']) ?>">

                <label>Produto:</label>
                <select name="produtos_id" id="produtos_id" class="form-select">
                    <?php foreach ($produto as $row): ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>"
                            <?= (isset($registro['produtos_id']) && $registro['produtos_id'] == $row['id']) ? 'selected' : '' ?>>
                            <?php echo htmlspecialchars($row['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit">Salvar Alterações</button>
                </div>
            </form>

            <form action="<?= $basePath . '/registro' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit">Voltar</button>
                </div>
            </form>
        </div>
    </div>
</div>