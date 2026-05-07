<?php
require_once __DIR__ . '/../models/EventoModel.php';

class EventoController {
    private $model;

    public function __construct($conn) {
        $this->model = new EventoModel($conn);
    }

    public function listar() {
        return $this->model->listarTodos();
    }

    public function buscar($id) {
        return $this->model->buscarPorId($id);
    }

    public function cadastrar($titulo, $descricao, $data_evento, $hora_evento, $local, $criado_por, $publico_alvo) {
        $this->model->criar($titulo, $descricao, $data_evento, $hora_evento, $local, $criado_por, $publico_alvo);
        header("Location: /eventos?msg=cadastrado");
        exit;
    }

    public function atualizar($id, $titulo, $descricao, $data_evento, $hora_evento, $local, $publico_alvo) {
        $this->model->atualizar($id, $titulo, $descricao, $data_evento, $hora_evento, $local, $publico_alvo);
        header("Location: /eventos?msg=editado");
        exit;
    }

    public function excluir($id) {
        $this->model->excluir($id);
        header("Location: /eventos?msg=excluido");
        exit;
    }
}
?>