<?php
if (!isset($_SESSION['usuario_id'])) {
    header("Location: /login");
    exit;
}

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../app/models/MensagemModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destinatario_id = intval($_POST['destinatario_id'] ?? 0);
    $mensagem        = trim($_POST['mensagem'] ?? '');
    $remetente_id    = $_SESSION['usuario_id'];

    if ($destinatario_id > 0 && !empty($mensagem)) {
        $model = new MensagemModel($conn);
        $model->enviar($remetente_id, $destinatario_id, $mensagem);
    }

    header("Location: /comunicacao?id_contato=$destinatario_id");
    exit;
}

header("Location: /comunicacao");
exit;
?>