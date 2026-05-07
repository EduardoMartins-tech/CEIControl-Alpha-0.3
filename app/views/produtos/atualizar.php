<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/UsuarioController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id     = intval($_POST['id']     ?? 0);
    $nome   = trim($_POST['nome']     ?? '');
    $email  = trim($_POST['email']    ?? '');
    $perfil = trim($_POST['perfil']   ?? '');
    $senha  = trim($_POST['senha']    ?? '');

    if ($id === 0 || !$nome || !$email || !$perfil) {
        header("Location: listar.php?erro=dados_invalidos");
        exit;
    }

    $controller = new UsuarioController($conn);

    // Atualiza senha se foi preenchida
    if (!empty($senha)) {
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $stmt->bind_param("si", $senhaHash, $id);
        $stmt->execute();
    }

    $controller->atualizar($id, $nome, $email, $perfil);
} else {
    header("Location: listar.php");
    exit;
}
?>