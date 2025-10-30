<?php
use App\Models\Produto\ProdutoDAO;

session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message success'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

if (!isset($_SESSION['admin'])) {
    header("Location: ../Login/index.php");
    exit();
}

$admin = $_SESSION['admin']['id'];
$produtoDao = new ProdutoDAO();
$produto = $produtoDao->showProduto($admin);

$title = 'Registro - Adicionar';
$page = 'registro/criar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Adicionar Registro</h1>
            
            <form action="<?= $basePath . '/registro/criar' ?>" method="POST">
                <label>Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" required>

                <label>Ação:</label>
                <select name="acao" id="acao" class="form-select">
                    <option value="Entrada">Entrada</option>
                    <option value="Saida">Saída</option>
                </select>

                <label>Descrição:</label>
                <input type="text" name="descricao">

                <label>Produto:</label>
                <select name="produtos_id" id="produtos_id" class="form-select">
                    <?php foreach ($produto as $row): ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>">
                            <?php echo htmlspecialchars($row['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit">Adicionar</button>
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