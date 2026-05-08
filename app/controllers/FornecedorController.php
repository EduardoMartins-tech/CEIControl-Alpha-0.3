<?php
require_once __DIR__ . '/../models/FornecedoresModel.php';

class FornecedorController {
    private $model;

    public function __construct($conn) {
        $this->model = new FornecedorModel($conn);
    }

    public function listar() {
        return $this->model->listarTodos();
    }

    public function buscar($id) {
        return $this->model->buscarPorId($id);
    }

    public function cadastrar($nome, $cnpj, $email, $telefone) {
        $this->model->criar($nome, $cnpj, $email, $telefone);
        header("Location: /fornecedores?msg=cadastrado");
        exit;
    }

    public function atualizar($id, $nome, $cnpj, $email, $telefone) {
        $this->model->atualizar($id, $nome, $cnpj, $email, $telefone);
        header("Location: /fornecedores?msg=editado");
        exit;
    }

    public function excluir($id) {
        $this->model->excluir($id);
        header("Location: /fornecedores?msg=excluido");
        exit;
    }
}
?>