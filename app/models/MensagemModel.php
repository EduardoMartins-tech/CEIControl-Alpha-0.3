<?php
require_once __DIR__ . '/../../config/database.php';

class MensagemModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function buscarConversa($meu_id, $contato_id) {
        $stmt = $this->conn->prepare("SELECT * FROM mensagens WHERE (remetente_id = ? AND destinatario_id = ?) OR (remetente_id = ? AND destinatario_id = ?) ORDER BY data_envio ASC");
        $stmt->bind_param("iiii", $meu_id, $contato_id, $contato_id, $meu_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function enviar($remetente_id, $destinatario_id, $mensagem) {
        $stmt = $this->conn->prepare("INSERT INTO mensagens (remetente_id, destinatario_id, mensagem) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $remetente_id, $destinatario_id, $mensagem);
        return $stmt->execute();
    }
}
?>