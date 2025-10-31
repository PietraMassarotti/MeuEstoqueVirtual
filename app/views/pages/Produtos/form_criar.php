<?php
use App\Models\Categoria\CategoriaDAO;
use App\Models\Marca\MarcaDAO;

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
$categoriaDao = new CategoriaDAO();
$categoria = $categoriaDao->showCategoria($admin);
$marcaDao = new MarcaDAO();
$marca = $marcaDao->showMarca($admin);

$title = 'Produto - Adicionar';
$page = 'produto/criar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Adicionar Produto</h1>
            
            <form action="<?= $basePath . '/produto/criar' ?>" method="POST">
                <label>Nome:</label>
                <input type="text" name="nome" required>
                
                <label>Preço:</label>
                <input type="text" name="preco" required>

                <label>Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" required>

                <label>Genero:</label>
                <select name="genero" id="genero" class="form-select">
                    <option value="Unissex">Unissex</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                </select>

                <label>Descrição:</label>
                <input type="text" name="descricao">

                <label>Marca:</label>
                <select name="marcas_id" id="marcas_id" class="form-select">
                    <?php foreach ($marca as $row): ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>">
                            <?php echo htmlspecialchars($row['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Categoria:</label>
                <select name="categorias_id" id="categorias_id" class="form-select">
                    <?php foreach ($categoria as $row): ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>">
                            <?php echo htmlspecialchars($row['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit">Adicionar</button>
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