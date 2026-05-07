<?php
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: /login");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/ProdutoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = intval($_POST['id']          ?? 0);
    $nome       = trim($_POST['nome']          ?? '');
    $descricao  = trim($_POST['descricao']     ?? '');
    $preco      = floatval($_POST['preco']     ?? 0);
    $quantidade = intval($_POST['quantidade']  ?? 0);

    if ($id === 0 || !$nome) {
        header("Location: /produtos?erro=dados_invalidos");
        exit;
    }

    $controller = new ProdutoController($conn);
    $controller->atualizar($id, $nome, $descricao, $preco, $quantidade);
} else {
    header("Location: /produtos");
    exit;
}
?>