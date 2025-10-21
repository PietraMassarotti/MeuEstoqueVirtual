<?php
session_start();
require_once __DIR__ . '/../../models/MetodoPagamento/MetodoPagamentoDAO.php';
require_once __DIR__ . '/../../utils/Sanitizacao.php';


// Sanitiza as entradas
$id = Sanitizacao::sanitizar($_GET['id']);

$MetodoPagamentoDAO = new MetodoPagamentoDAO();
$metodoPagamento = $MetodoPagamentoDAO->deleteMetodoPagamento($id);

header("Location: ../../public/MetodosPagamento/index.php");