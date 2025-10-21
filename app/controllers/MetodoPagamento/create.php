<?php

require_once __DIR__ . '/../../models/MetodoPagamento/MetodoPagamentoDAO.php';
require_once __DIR__ . '/../../utils/Sanitizacao.php';

$marcaDao = new MetodoPagamentoDAO();

// Sanitiza as entradas
$nome = Sanitizacao::sanitizar($_POST['nome']);

$MetodoPagamentoDAO = new MetodoPagamentoDAO();
$metodoPagamento = $MetodoPagamentoDAO->createMetodoPagamento($nome);

header("Location: ../../public/MetodosPagamento/index.php");
