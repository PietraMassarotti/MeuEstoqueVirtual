<?php
session_start();

use App\Models\Categoria\CategoriaDAO;
use App\Models\Marca\MarcaDAO;
use App\Models\Produto\ProdutoDAO;

$produtoDao = new ProdutoDAO();
$produto = $produtoDao->findById($id);

if (!$produto) {
    echo "Produto não encontrada.";
    exit();
}

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

$categoriaDao = new CategoriaDAO();
$categoria = $categoriaDao->showCategoria();
$marcaDao = new MarcaDAO();
$marca = $marcaDao->showMarca();

$title = 'Categoria - Editar ';
$page = 'categoria/editar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Editar Produto</h1>

            <form action="<?= $basePath . '/produto/salvar' ?>" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">

                <label>Nome:</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>

                <label>Preco:</label>
                <input type="text" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required>

                <label>Quantidade:</label>
                <input type="number" name="quantidade" value="<?= htmlspecialchars($produto['quantidade']) ?>" required>

                <label>Genero:</label>
                <select name="genero" id="genero" class="form-select">
                    <option value="Unissex" <?= $produto['genero'] === 'Unissex' ? 'selected' : '' ?>>Unissex</option>
                    <option value="Masculino" <?= $produto['genero'] === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                    <option value="Feminino" <?= $produto['genero'] === 'Feminino' ? 'selected' : '' ?>>Feminino</option>
                </select>

                <label>Descrição:</label>
                <input type="text" name="descricao" value="<?= htmlspecialchars($produto['descricao']) ?>">

                <label>Data de Validade (Opcional):</label>
                <input type="date" name="data_validade" value="<?= htmlspecialchars($produto['data_validade'] ?? '') ?>">

                <label>Marca:</label>
                <select name="marcas_id" id="marcas_id" class="form-select">
                    <?php foreach ($marca as $row): ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>"
                            <?= (isset($produto['marcas_id']) && $produto['marcas_id'] == $row['id']) ? 'selected' : '' ?>>
                            <?php echo htmlspecialchars($row['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Categoria:</label>
                <select name="categorias_id" id="categorias_id" class="form-select">
                    <?php foreach ($categoria as $row): ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>"
                            <?= (isset($produto['categorias_id']) && $produto['categorias_id'] == $row['id']) ? 'selected' : '' ?>>
                            <?php echo htmlspecialchars($row['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit">Salvar Alterações</button>
                </div>
            </form>

            <form action="<?= $basePath . '/produto' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit">Voltar</button>
                </div>
            </form>
        </div>
    </div>
</div>