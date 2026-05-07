<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/FornecedorController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome']     ?? '');
    $cnpj     = trim($_POST['cnpj']     ?? '');
    $email    = trim($_POST['email']    ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    if (!$nome || !$cnpj) {
        header("Location: form_cadastro.php?erro=campos_vazios");
        exit;
    }

    $controller = new FornecedorController($conn);
    $controller->cadastrar($nome, $cnpj, $email, $telefone);
} else {
    header("Location: form_cadastro.php");
    exit;
}
?>