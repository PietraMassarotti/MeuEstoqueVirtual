<?php

use App\Models\Cliente\ClienteDAO;

$clienteDao = new ClienteDAO();
$cliente = $clienteDao->showCliente();

$title = 'pedido - Adicionar';
$page = 'pedido/criar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Adicionar Pedido</h1>

            <form action="<?= $basePath . '/pedido/criar' ?>" method="POST">

                <label>Cliente:</label>
                <select name="clientes_id" id="clientes_id" class="form-select">
                    <?php foreach ($cliente as $row): ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>">
                            <?php echo htmlspecialchars($row['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit">Adicionar</button>
                </div>
            </form>

            <form action="<?= $basePath . '/pedido' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit">Voltar</button>
                </div>
            </form>
        </div>
    </div>
</div>