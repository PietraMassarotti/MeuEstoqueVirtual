<?php

use App\Models\Pedido\PedidoDAO;
use App\Models\Cliente\ClienteDAO;

$pedidoDao = new PedidoDAO();
$pedido = $pedidoDao->findById($id);

if (!$pedido) {
    echo "pedido não encontrada.";
    exit();
}

$clienteDao = new ClienteDAO();
$cliente = $clienteDao->showCliente();

$title = 'Categoria - Editar ';
$page = 'categoria/editar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Editar Pedido</h1>

            <form action="<?= $basePath . '/pedido/salvar' ?>" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($pedido['id']) ?>">

                <label>cliente:</label>
                <select name="clientes_id" id="clientes_id" class="form-select">
                    <?php foreach ($cliente as $row): ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>"
                            <?= (isset($pedido['clientes_id']) && $pedido['clientes_id'] == $row['id']) ? 'selected' : '' ?>>
                            <?php echo htmlspecialchars($row['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit">Salvar Alterações</button>
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