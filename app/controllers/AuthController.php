<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class AuthController {
    private $model;

    public function __construct($conn) {
        $this->model = new UsuarioModel($conn);
    }

    public function login($email, $senha, $perfil) {
        $usuario = $this->model->buscarPorEmailPerfil($email, $perfil);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome']       = $usuario['nome'];
            $_SESSION['perfil']     = $usuario['perfil'];

            switch ($usuario['perfil']) {
                case 'admin':   header("Location: /painel/admin"); break;
                case 'cliente': header("Location: /painel/cliente"); break;
                case 'usuario': header("Location: /painel/usuario"); break;
                default:        header("Location: /login?erro=1"); break;
            }
            exit;
        }

        header("Location: /login?erro=1");
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: /login");
        exit;
    }
}
?>