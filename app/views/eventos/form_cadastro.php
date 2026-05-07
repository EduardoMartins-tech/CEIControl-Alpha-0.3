<?php
session_start();
if (!isset($_SESSION['perfil']) || !in_array($_SESSION['perfil'], ['admin', 'usuario'])) {
    header("Location: ../auth/form_login.php");
    exit;
}
$pagina_atual = 'agenda';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Evento - CEIControl</title>
    <link rel="stylesheet" href="../../../public/style.css">
    <link rel="stylesheet" href="../../../public/mobile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="../../../public/assets/ceicontrol.png">
</head>
<body class="dashboard-body">
<div class="dashboard-container">
    <?php include __DIR__ . '/../../../sidebar.php'; ?>

    <main class="main-content">
        <header class="dash-header">
            <div class="header-welcome">
                <h1>Novo Evento</h1>
                <p>Adicione uma atividade à agenda escolar.</p>
            </div>
            <a href="listar.php" class="btn-sm secondary" style="text-decoration:none;">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        <section class="content-wrapper-centered">
            <div class="form-card-centered">
                <form action="processa_cadastro.php" method="POST" class="custom-form">

                    <div class="form-group">
                        <label><i class="fa-solid fa-tag"></i> Título do Evento</label>
                        <input type="text" name="titulo" placeholder="Ex: Festa da Primavera" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-align-left"></i> Descrição</label>
                        <textarea name="descricao" rows="3" placeholder="Pauta ou detalhes..."></textarea>
                    </div>

                    <div style="display:flex;gap:15px;margin-bottom:20px;">
                        <div class="form-group" style="flex:1;margin-bottom:0;">
                            <label><i class="fa-solid fa-calendar"></i> Data</label>
                            <input type="date" name="data_evento" required>
                        </div>
                        <div class="form-group" style="flex:1;margin-bottom:0;">
                            <label><i class="fa-solid fa-clock"></i> Horário</label>
                            <input type="time" name="hora_evento">
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-location-dot"></i> Local</label>
                        <input type="text" name="local" placeholder="Ex: Pátio Central">
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-users"></i> Público-Alvo</label>
                        <select name="publico_alvo">
                            <option value="Geral">Geral (Todos)</option>
                            <option value="Pais">Apenas Pais</option>
                            <option value="Funcionários">Apenas Funcionários</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-finalizar">
                        <i class="fa-solid fa-check"></i> Salvar na Agenda
                    </button>
                </form>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>