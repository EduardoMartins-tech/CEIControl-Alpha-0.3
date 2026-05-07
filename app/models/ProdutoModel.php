<?php
require_once __DIR__ . '/../../config/database.php';

class ProdutoModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listarTodos() {
        return $this->conn->query("SELECT * FROM produtos ORDER BY nome ASC");
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function criar($nome, $descricao, $preco, $quantidade) {
        $stmt = $this->conn->prepare("INSERT INTO produtos (nome, descricao, preco, quantidade, data_cadastro) VALUES (?, ?, ?, ?, CURDATE())");
        $stmt->bind_param("ssdi", $nome, $descricao, $preco, $quantidade);
        return $stmt->execute();
    }

    public function atualizar($id, $nome, $descricao, $preco, $quantidade) {
        $stmt = $this->conn->prepare("UPDATE produtos SET nome=?, descricao=?, preco=?, quantidade=? WHERE id=?");
        $stmt->bind_param("ssdii", $nome, $descricao, $preco, $quantidade, $id);
        return $stmt->execute();
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>