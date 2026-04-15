<?php
session_start();
// Proteção de acesso: apenas admin pode gerenciar usuários
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: form_login.php");
    exit;
}

// Conexão com o banco (ajuste os dados se necessário)
include 'database.php'; 

// Consulta para buscar os usuários
$query = "SELECT id, nome, email, perfil FROM usuarios";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Usuários - CEIControl</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard-body">

    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-logo">
                <span class="logo-text">CEIControl®</span>
            </div>
            
            <nav class="sidebar-nav">
                <p class="nav-category">Principal</p>
                <a href="painel_admin.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
                
                <p class="nav-category">Gestão</p>
                <a href="listar_usuarios.php" class="active"><i class="fa-solid fa-users"></i> Usuários</a>
                <a href="listar_produtos.php"><i class="fa-solid fa-box-open"></i> Produtos</a>
                <a href="listar_fornecedores.php"><i class="fa-solid fa-truck-moving"></i> Fornecedores</a>
                <a href="listar_eventos.php"><i class="fa-solid fa-calendar-days"></i> Agenda</a>
                
                <p class="nav-category">Sistema</p>
                <a href="mensagens.php"><i class="fa-solid fa-envelope"></i> Comunicação</a>
                <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
            </nav>
        </aside>

        <main class="main-content">
    <header class="dash-header">
        <div class="header-welcome">
            <h1>Gestão de Usuários</h1>
            <p>Visualize e gerencie as contas e permissões do sistema.</p>
        </div>

        <a href="form_cadastro_usuario.php" class="btn-black-full" style="width: auto; padding: 10px 25px; margin-top: 0;">
            <i class="fa-solid fa-plus"></i> Novo Usuário
        </a>
    </header>

    <section class="content-wrapper">
                <div class="table-container">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Perfil de Acesso</th>
                                <th style="text-align: center;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if ($result && $result->num_rows > 0):
                                while($row = $result->fetch_assoc()): 
                            ?>
                            <tr>
                                <td>#<?= $row['id']; ?></td>
                                <td><strong><?= $row['nome']; ?></strong></td>
                                <td><?= $row['email']; ?></td>
                                <td>
                                    <?php 
                                        // Lógica das Badges (Etiquetas Coloridas)
                                        if($row['perfil'] == 'admin') {
                                            echo '<span class="badge badge-admin">Gestor Escolar</span>';
                                        } elseif($row['perfil'] == 'cliente') {
                                            echo '<span class="badge badge-cliente">Responsável</span>';
                                        } else {
                                            echo '<span class="badge badge-usuario">Educador</span>';
                                        }
                                    ?>
                                </td>
                                <td class="actions-cell">
                                    <a href="form_edit_usuario.php?id=<?= $row['id']; ?>" class="edit-btn" title="Editar">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="excluir_usuario.php?id=<?= $row['id']; ?>" class="delete-btn" title="Excluir" 
                                       onclick="return confirm('Tem certeza que deseja excluir o usuário <?= $row['nome']; ?>?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                endwhile; 
                            else:
                            ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 30px; color: #999;">
                                    Nenhum usuário cadastrado no momento.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

</body>
</html>