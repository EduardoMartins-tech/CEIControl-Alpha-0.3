<?php
session_start();

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$routes = [
    ''                          => 'app/views/auth/form_login.php',
    'login'                     => 'app/views/auth/form_login.php',
    'login/user'                => 'app/views/auth/login_user.php',
    'logout'                    => 'app/views/auth/logout.php',
    'painel/admin'              => 'app/views/auth/painel_admin.php',
    'painel/usuario'            => 'app/views/auth/painel_usuario.php',
    'painel/cliente'            => 'app/views/auth/painel_cliente.php',
    'acesso/admin'              => 'app/views/auth/acesso_admin.php',

    'usuarios'                  => 'app/views/usuarios/listar.php',
    'usuarios/cadastro'         => 'app/views/usuarios/form_cadastro.php',
    'usuarios/processa'         => 'app/views/usuarios/processa_cadastro.php',
    'usuarios/editar'           => 'app/views/usuarios/editar.php',
    'usuarios/atualizar'        => 'app/views/usuarios/atualizar.php',
    'usuarios/excluir'          => 'app/views/usuarios/excluir.php',

    'produtos'                  => 'app/views/produtos/listar.php',
    'produtos/cadastro'         => 'app/views/produtos/form_cadastro.php',
    'produtos/processa'         => 'app/views/produtos/processa_cadastro.php',
    'produtos/editar'           => 'app/views/produtos/editar.php',
    'produtos/atualizar'        => 'app/views/produtos/atualizar.php',
    'produtos/excluir'          => 'app/views/produtos/excluir.php',

    'fornecedores'              => 'app/views/fornecedores/listar.php',
    'fornecedores/cadastro'     => 'app/views/fornecedores/form_cadastro.php',
    'fornecedores/processa'     => 'app/views/fornecedores/processa_cadastro.php',
    'fornecedores/editar'       => 'app/views/fornecedores/editar.php',
    'fornecedores/atualizar'    => 'app/views/fornecedores/atualizar.php',
    'fornecedores/excluir'      => 'app/views/fornecedores/excluir.php',

    'eventos'                   => 'app/views/eventos/listar.php',
    'eventos/cadastro'          => 'app/views/eventos/form_cadastro.php',
    'eventos/processa'          => 'app/views/eventos/processa_cadastro.php',
    'eventos/editar'            => 'app/views/eventos/editar.php',
    'eventos/atualizar'         => 'app/views/eventos/atualizar.php',
    'eventos/excluir'           => 'app/views/eventos/excluir.php',

    'comunicacao'               => 'app/views/comunicacao.php',
    'mensagens/enviar'          => 'app/views/enviar_mensagens.php',
];

if (isset($routes[$path])) {
    require __DIR__ . '/' . $routes[$path];
    exit;
}

// Serve arquivos estáticos (CSS, JS, imagens)
$file = __DIR__ . '/' . $path;
if (is_file($file)) {
    return false;
}

http_response_code(404);
echo "404 - Página não encontrada";