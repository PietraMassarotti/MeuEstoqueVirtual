<?php

use App\Models\Parcela\ParcelaDAO;

session_start();

// Mensagem de erro (mesmo padrão do Código 2)
if (isset($_SESSION['mensagem'])) {
    echo "<div class='message error'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

$parcelaDao = new ParcelaDAO();
$compras = $parcelaDao->getAllCompras();

$title = 'Adicionar Parcela - Sistema de Usuários';
$page = 'parcelas';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">

            <h1>Adicionar Nova Parcela</h1>

            <form action="<?= $basePath . '/parcela/criar' ?>" method="POST">

                <label>Número da Parcela:</label>
                <input type="number" name="numero" required min="1">

                <label>Valor (R$):</label>
                <input type="text" name="valor" required placeholder="0.00">

                <label>Data de Vencimento:</label>
                <input type="date" name="data" required>

                <label>Status:</label>
                <select name="status" required class="form-select">
                    <option value="">Selecione...</option>
                    <option value="Pendente">Pendente</option>
                    <option value="Pago">Pago</option>
                    <option value="Atrasado">Atrasado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>

                <label>Compra:</label>
                <select name="compras_id" required class="form-select">
                    <?php foreach ($compras as $compra): ?>
                        <option value="<?= $compra['id'] ?>">
                            Compra #<?= $compra['id'] ?> -
                            <?= htmlspecialchars($compra['cliente_nome']) ?>
                            (<?= date('d/m/Y', strtotime($compra['create_at'])) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="form-actions">
                    <button type="submit">Adicionar</button>
                </div>
            </form>

            <form action="<?= $basePath . '/parcela' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit">Voltar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="actions">
    <a href="<?= $basePath . '/login/sair' ?>" class="btn btn-exit">Sair</a>
</div>

<img src="<?= $basePath . '/assets/logo-claudineia.jpeg' ?>" alt="Logo Claudinéia" class="logo-fixed">