<?php
require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /login");
    exit;
}

$email  = trim($_POST['email']  ?? '');
$senha  = trim($_POST['senha']  ?? '');
$perfil = trim($_POST['perfil'] ?? '');

if (!$email || !$senha || !$perfil) {
    header("Location: /login?erro=1");
    exit;
}

$controller = new AuthController($conn);
$controller->login($email, $senha, $perfil);
?>