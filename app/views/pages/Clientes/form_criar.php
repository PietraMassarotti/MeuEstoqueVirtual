<?php
session_start();

if (isset($_SESSION['mensagem'])) {
    echo "<div class='message success'>" . $_SESSION['mensagem'] . "</div>";
    // Limpa a mensagem
    unset($_SESSION['mensagem']);
}

$title = 'Cliente - Adicionar';
$page = 'cliente/adicionar';
$basePath = '/MeuEstoqueVirtual/public';
?>

<div class="all">
    <div class="body">
        <div class="form-container">
            <h1>Adicionar Cliente</h1>
            
            <form action="<?= $basePath . '/cliente/criar' ?>" method="POST">
                <label>Nome:</label>
                <input type="text" name="nome" required>
                
                <label>E-mail:</label>
                <input type="email" name="email" required>
                
                <label>Endereço:</label>
                <input type="text" name="endereco" required>
                
                <label>Telefone:</label>
                <input type="text" name="telefone" required>
                
                <label>Data de Nascimento:</label>
                <input type="date" name="nasc" required>
                
                <div class="form-actions">
                    <button type="submit">Adicionar</button>
                </div>
            </form>
            
            <form action="<?= $basePath . '/cliente' ?>" method="GET">
                <div class="form-actions">
                    <button type="submit">Voltar</button>
                </div>
            </form>
        </div>
    </div>
</div>