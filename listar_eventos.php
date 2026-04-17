<?php
include('acesso_admin.php');

if (!isset($conn)) {
    include('database.php');
}

verificar_acesso(['admin', 'cliente', 'usuario']); 

$pagina_atual = 'agenda';
$sql = "SELECT * FROM agenda ORDER BY data_evento ASC";
$result = $conn->query($sql);

$pode_editar = ($_SESSION['perfil'] === 'admin');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Eventos - CEIControl</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard-body">

    <div class="dashboard-container">
        <?php include 'sidebar.php'; ?>

        <main class="main-content">
            <header class="dash-header">
                <div class="header-welcome">
                    <h1>Agenda Escolar</h1>
                    <p>Gerencie e visualize todos os eventos e atividades da CEI.</p>
                </div>

                <?php if ($pode_editar): ?>
                <a href="form_cadastro_evento.php" class="btn-black-full" style="text-decoration: none !important; color: white !important;">
                    <i class="fa-solid fa-plus"></i> Novo Evento
                </a>
                <?php endif; ?>
            </header>

            <section class="content-wrapper">
                <div class="table-container">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>DATA / HORA</th>
                                <th>TÍTULO E DESCRIÇÃO</th>
                                <th>PÚBLICO-ALVO</th>
                                <th>LOCAL</th>
                                <?php if ($pode_editar): ?>
                                    <th style="text-align: center;">AÇÕES</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if ($result && $result->num_rows > 0) {
                                while ($evento = $result->fetch_assoc()) {
                                    $identificador = isset($evento['id']) ? $evento['id'] : urlencode($evento['titulo']);
                                    
                                    $titulo = htmlspecialchars($evento['titulo']);
                                    $desc = isset($evento['descricão']) ? htmlspecialchars($evento['descricão']) : (isset($evento['descricao']) ? htmlspecialchars($evento['descricao']) : '');
                                    $data = date('d/m/Y', strtotime($evento['data_evento']));
                                    $hora = !empty($evento['hora_evento']) ? date('H:i', strtotime($evento['hora_evento'])) : '--:--';
                                    $pub = $evento['publico_alvo'];
                                    $loc = !empty($evento['local']) ? htmlspecialchars($evento['local']) : 'Escola';
                            ?>
                                    <tr>
                                        <td>
                                            <div style="display: flex; flex-direction: column;">
                                                <span style="font-weight: 700; color: var(--text-main);"><?php echo $data; ?></span>
                                                <span style="font-size: 0.75rem; color: var(--text-sub);"><i class="fa-regular fa-clock"></i> <?php echo $hora; ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 600; color: var(--text-main);"><?php echo $titulo; ?></div>
                                            <div style="font-size: 0.8rem; color: var(--text-sub); max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                <?php echo $desc; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-agenda"><?php echo $pub; ?></span>
                                        </td>
                                        <td style="font-size: 0.9rem; color: var(--text-sub);">
                                            <i class="fa-solid fa-location-dot" style="font-size: 0.75rem; color: #00a98f;"></i> <?php echo $loc; ?>
                                        </td>
                                        
                                        <?php if ($pode_editar): ?>
                                            <td class="actions-cell">
                                                <a href="editar_evento.php?id=<?php echo $identificador; ?>" class="edit-btn">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="excluir_evento.php?id=<?php echo $identificador; ?>" 
                                                   class="delete-btn" 
                                                   onclick="return confirm('Deseja realmente excluir este evento?')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                            <?php 
                                } 
                            } else { 
                            ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-sub);">Nenhum evento agendado.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

</body>
</html>