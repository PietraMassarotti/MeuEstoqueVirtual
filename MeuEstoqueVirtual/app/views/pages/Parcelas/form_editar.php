<?php

use App\Models\Parcela\ParcelaDAO;

if (!isset($id) || !$id) {
    header("Location: /MeuEstoqueVirtual/public/parcela");
    exit();
}

$parcelaDao = new ParcelaDAO();
$parcela = $parcelaDao->findById($id);

if (!$parcela) {
    header("Location: /MeuEstoqueVirtual/public/parcela");
    exit();
}

$compras = $parcelaDao->getAllCompras();

$title = 'Editar Parcela - Sistema de Usuários';
$page = 'parcelas';
$basePath = '/MeuEstoqueVirtual/public';

session_start();
if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}
?>

<div class="all">
    <div class="body">
        <div class="form-container">

            <h1>Editar Parcela #<?= $parcela['id'] ?></h1>

            <form action="<?= $basePath . '/parcela/salvar' ?>" method="POST">

                <input type="hidden" name="id" value="<?= $parcela['id'] ?>">

                <label>Número da Parcela:</label>
                <input type="number" name="numero" value="<?= $parcela['numero'] ?>" required min="1">

                <label>Valor (R$):</label>
                <input type="number" name="valor" value="<?= $parcela['valor'] ?>" required step="0.01" min="0.01">

                <label>Data de Vencimento:</label>
                <input type="date" name="data" value="<?= $parcela['data'] ?>" required>

                <label>Status:</label>
                <select name="status" required class="form-select">
                    <option value="">Selecione...</option>
                    <option value="Pendente" <?= $parcela['status'] == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                    <option value="Pago" <?= $parcela['status'] == 'Pago' ? 'selected' : '' ?>>Pago</option>
                    <option value="Atrasado" <?= $parcela['status'] == 'Atrasado' ? 'selected' : '' ?>>Atrasado</option>
                    <option value="Cancelado" <?= $parcela['status'] == 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                </select>

                <label>Compra:</label>
                <select name="compras_id" required class="form-select">
                    <option value="">Selecione uma compra...</option>
                    <?php foreach ($compras as $compra): ?>
                        <option value="<?= $compra['id'] ?>" <?= $parcela['compras_id'] == $compra['id'] ? 'selected' : '' ?>>
                            Compra #<?= $compra['id'] ?> -
                            <?= htmlspecialchars($compra['cliente_nome']) ?>
                            (<?= date('d/m/Y', strtotime($compra['create_at'])) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Criado em:</label>
                <input type="text" value="<?= date('d/m/Y H:i', strtotime($parcela['create_at'])) ?>" disabled>

                <label>Atualizado em:</label>
                <input type="text" value="<?= date('d/m/Y H:i', strtotime($parcela['update_at'])) ?>" disabled>

                <div class="form-actions">
                    <button type="submit" class="btn btn-save">Salvar Alterações</button>
                </div>
            </form>

            <form action="<?= $basePath . '/parcela' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit" class="btn btn-cancel">Cancelar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="actions">
    <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
</div>

<img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">