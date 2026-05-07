<?php
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: /login");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/FornecedorController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id       = intval($_POST['id']       ?? 0);
    $nome     = trim($_POST['nome']       ?? '');
    $cnpj     = trim($_POST['cnpj']       ?? '');
    $email    = trim($_POST['email']      ?? '');
    $telefone = trim($_POST['telefone']   ?? '');

    if ($id === 0 || !$nome || !$cnpj) {
        header("Location: /fornecedores?erro=dados_invalidos");
        exit;
    }

    $controller = new FornecedorController($conn);
    $controller->atualizar($id, $nome, $cnpj, $email, $telefone);
} else {
    header("Location: /fornecedores");
    exit;
}
?>