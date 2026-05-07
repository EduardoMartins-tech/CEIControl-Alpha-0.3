<?php
require_once __DIR__ . '/../../config/database.php';

class UsuarioModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listarTodos() {
        return $this->conn->query("SELECT id, nome, email, perfil FROM usuarios");
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function buscarPorEmailPerfil($email, $perfil) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = ? AND perfil = ?");
        $stmt->bind_param("ss", $email, $perfil);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function criar($nome, $email, $senha, $perfil) {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email, senha, perfil) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $senha, $perfil);
        return $stmt->execute();
    }

    public function atualizar($id, $nome, $email, $perfil) {
        $stmt = $this->conn->prepare("UPDATE usuarios SET nome=?, email=?, perfil=? WHERE id=?");
        $stmt->bind_param("sssi", $nome, $email, $perfil, $id);
        return $stmt->execute();
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function emailExiste($email, $idExcluir = null) {
        if ($idExcluir) {
            $stmt = $this->conn->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
            $stmt->bind_param("si", $email, $idExcluir);
        } else {
            $stmt = $this->conn->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
        }
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
}
?>