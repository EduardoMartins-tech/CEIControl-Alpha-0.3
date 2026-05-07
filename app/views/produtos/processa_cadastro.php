<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/ProdutoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome       = trim($_POST['nome']       ?? '');
    $descricao  = trim($_POST['descricao']  ?? '');
    $preco      = floatval($_POST['preco']  ?? 0);
    $quantidade = intval($_POST['quantidade'] ?? 0);

    $controller = new ProdutoController($conn);
    $controller->cadastrar($nome, $descricao, $preco, $quantidade);
} else {
    header("Location: form_cadastro.php");
    exit;
}
?>