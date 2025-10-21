<?php

require_once __DIR__ . '/../../models/MetodoPagamento/MetodoPagamentoDAO.php';
require_once __DIR__ . '/../../utils/Sanitizacao.php';


// Sanitiza as entradas
$id = Sanitizacao::sanitizar($_POST['id']);
$nome = Sanitizacao::sanitizar($_POST['nome']);

$MetodoPagamentoDAO = new MetodoPagamentoDAO();
$metodoPagamento = $MetodoPagamentoDAO->updateMetodoPagamento($id, $nome);

header("Location: ../../public/MetodosPagamento/index.php");

