<?php
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: /login");
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
        header("Location: /usuarios?erro=dados_invalidos");
        exit;
    }

    $controller = new UsuarioController($conn);

    if (!empty($senha)) {
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
        $stmt->bind_param("si", $senhaHash, $id);
        $stmt->execute();
    }

    $controller->atualizar($id, $nome, $email, $perfil);
} else {
    header("Location: /usuarios");
    exit;
}
?>