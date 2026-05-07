<?php
require_once __DIR__ . '/../models/ProdutoModel.php';

class ProdutoController {
    private $model;

    public function __construct($conn) {
        $this->model = new ProdutoModel($conn);
    }

    public function listar() {
        return $this->model->listarTodos();
    }

    public function buscar($id) {
        return $this->model->buscarPorId($id);
    }

    public function cadastrar($nome, $descricao, $preco, $quantidade) {
        $this->model->criar($nome, $descricao, $preco, $quantidade);
        header("Location: /produtos?msg=cadastrado");
        exit;
    }

    public function atualizar($id, $nome, $descricao, $preco, $quantidade) {
        $this->model->atualizar($id, $nome, $descricao, $preco, $quantidade);
        header("Location: /produtos?msg=editado");
        exit;
    }

    public function excluir($id) {
        $this->model->excluir($id);
        header("Location: /produtos?msg=excluido");
        exit;
    }
}
?>