<?php
session_start();
// Proteção de acesso: apenas admin pode gerenciar usuários
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: form_login.php");
    exit;
}

// Conexão com o banco
include 'database.php'; 

// Variável para a sidebar saber qual link destacar
$pagina_atual = 'usuarios'; 

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
        
        <?php include 'sidebar.php'; ?>

        <main class="main-content">
            <header class="dash-header">
                <?php if (isset($_GET['msg']) && $_GET['msg'] == 'cadastrado'): ?>
                    <div class="alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Usuário cadastrado com sucesso!</span>
                        <button onclick="this.parentElement.style.display='none'">&times;</button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['msg']) && $_GET['msg'] == 'excluido'): ?>
                    <div class="alert-danger">
                        <i class="fa-solid fa-trash-can"></i>
                        <span>Usuário removido do sistema.</span>
                        <button onclick="this.parentElement.style.display='none'">&times;</button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['msg']) && $_GET['msg'] == 'editado'): ?>
                    <div class="alert-success" style="border-left-color: #4a90e2; color: #4a90e2;">
                        <i class="fa-solid fa-user-check"></i>
                        <span>Dados atualizados com sucesso!</span>
                        <button onclick="this.parentElement.style.display='none'">&times;</button>
                    </div>
                <?php endif; ?>

                <div class="header-welcome">
                    <h1>Gestão de Usuários</h1>
                    <p>Visualize e gerencie as contas e permissões do sistema.</p>
                </div>

                <a href="form_cadastro_usuario.php" class="btn-black-full" style="width: auto; padding: 10px 25px;">
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
                                <td><strong><?= htmlspecialchars($row['nome']); ?></strong></td>
                                <td><?= htmlspecialchars($row['email']); ?></td>
                                <td>
                                    <?php 
                                        // Lógica das Badges
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
                                       onclick="return confirm('Tem certeza que deseja excluir o usuário <?= htmlspecialchars($row['nome']); ?>?')">
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