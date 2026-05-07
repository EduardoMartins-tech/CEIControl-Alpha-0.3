<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct($conn) {
        $this->model = new UsuarioModel($conn);
    }

    public function listar() {
        return $this->model->listarTodos();
    }

    public function buscar($id) {
        return $this->model->buscarPorId($id);
    }

    public function cadastrar($nome, $email, $senha, $perfil) {
        if ($this->model->emailExiste($email)) {
            header("Location: ../views/usuarios/form_cadastro.php?erro=email_duplicado");
            exit;
        }
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $this->model->criar($nome, $email, $senhaHash, $perfil);
        header("Location: ../views/usuarios/listar.php?msg=cadastrado");
        exit;
    }

    public function atualizar($id, $nome, $email, $perfil) {
        if ($this->model->emailExiste($email, $id)) {
            header("Location: ../views/usuarios/editar.php?id=$id&erro=email_duplicado");
            exit;
        }
        $this->model->atualizar($id, $nome, $email, $perfil);
        header("Location: ../views/usuarios/listar.php?msg=editado");
        exit;
    }

    public function excluir($id) {
        $this->model->excluir($id);
        header("Location: ../views/usuarios/listar.php?msg=excluido");
        exit;
    }
}
?>