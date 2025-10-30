<?php

use App\Models\Marca\MarcaDAO;

$marcaDao = new MarcaDAO();
$marca = $marcaDao->findById($id);

if (!$marca) {
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
            <h1>Editar Marca</h1>

            <form action="<?= $basePath . '/marca/salvar' ?>" method="POST">
                <!-- Campo oculto para enviar o ID -->
                <input type="hidden" name="id" value="<?= htmlspecialchars($marca['id']) ?>">

                <label>Nome:</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($marca['nome']) ?>" required>

                <div class="form-actions">
                    <button type="submit">Salvar Alterações</button>
                </div>
            </form>

            <form action="<?= $basePath . '/marca' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit">Voltar</button>
                </div>
            </form>
        </div>
    </div>
</div>