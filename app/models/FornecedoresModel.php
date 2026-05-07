<?php
require_once __DIR__ . '/../../config/database.php';

class FornecedorModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listarTodos() {
        return $this->conn->query("SELECT * FROM fornecedores ORDER BY nome ASC");
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM fornecedores WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function criar($nome, $cnpj, $email, $telefone) {
        $stmt = $this->conn->prepare("INSERT INTO fornecedores (nome, cnpj, email, telefone, data_cadastro) VALUES (?, ?, ?, ?, CURDATE())");
        $stmt->bind_param("ssss", $nome, $cnpj, $email, $telefone);
        return $stmt->execute();
    }

    public function atualizar($id, $nome, $cnpj, $email, $telefone) {
        $stmt = $this->conn->prepare("UPDATE fornecedores SET nome=?, cnpj=?, email=?, telefone=? WHERE id=?");
        $stmt->bind_param("ssssi", $nome, $cnpj, $email, $telefone, $id);
        return $stmt->execute();
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM fornecedores WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>