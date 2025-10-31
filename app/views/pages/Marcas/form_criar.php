<?php
$title = 'Categoria - Adicionar';
$page = 'categoria/adicionar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Adicionar Marca</h1>
            
            <form action="<?= $basePath . '/marca/criar' ?>" method="POST">
                <label>Nome:</label>
                <input type="text" name="nome" required>
                
                <div class="form-actions">
                    <button type="submit">Adicionar</button>
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