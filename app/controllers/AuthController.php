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
                case 'admin':   header("Location: ../views/auth/painel_admin.php"); break;
                case 'cliente': header("Location: ../views/auth/painel_cliente.php"); break;
                case 'usuario': header("Location: ../views/auth/painel_usuario.php"); break;
                default:        header("Location: ../views/auth/login.php?erro=1"); break;
            }
            exit;
        }

        header("Location: ../views/auth/login.php?erro=1");
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: ../views/auth/login.php");
        exit;
    }
}
?>