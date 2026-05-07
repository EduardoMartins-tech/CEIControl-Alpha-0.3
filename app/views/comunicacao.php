<?php
session_start();
require_once __DIR__ . '/../../config/database.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /app/views/auth/form_login.php");
    exit;
}

$pagina_atual   = 'comunicacao';
$meu_id         = $_SESSION['usuario_id'];
$id_contato     = isset($_GET['id_contato']) ? intval($_GET['id_contato']) : 0;
$contato_nome   = "Selecione um contato";
$contato_perfil = "";

if ($id_contato > 0) {
    $stmt = $conn->prepare("SELECT nome, perfil FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id_contato);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($user_data = $res->fetch_assoc()) {
        $contato_nome   = $user_data['nome'];
        $contato_perfil = $user_data['perfil'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - CEIControl</title>
    <link rel="stylesheet" href="/public/style.css">
    <link rel="stylesheet" href="/public/mobile.css">
    <link rel="stylesheet" href="/public/comunicacao_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="/public/assets/ceicontrol.png">
    <style>
        .avatar-icon {
            width: 42px; height: 42px; border-radius: 50%;
            background: #00a98f; display: flex; align-items: center;
            justify-content: center; color: white; font-size: 1.2rem; flex-shrink: 0;
        }
        .avatar-icon.large {
            width: 80px; height: 80px; font-size: 2rem; margin: 0 auto 10px;
        }
    </style>
</head>
<body class="dashboard-body">
<div class="dashboard-container">

    <?php include __DIR__ . '/../../sidebar.php'; ?>

    <main class="main-content chat-main">
        <div class="chat-container">

            <!-- LISTA DE CONTATOS -->
            <aside class="chat-sidebar">
                <div class="chat-search">
                    <h3>Conversas</h3>
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="filterContacts" placeholder="Pesquisar..." onkeyup="filtrarContatos()">
                    </div>
                </div>
                <ul class="contacts-list" id="contactsList">
                    <?php
                    $stmt = $conn->prepare("SELECT id, nome, perfil FROM usuarios WHERE id != ?");
                    $stmt->bind_param("i", $meu_id);
                    $stmt->execute();
                    $usuarios = $stmt->get_result();
                    while($u = $usuarios->fetch_assoc()):
                    ?>
                    <li class="contact-item <?= ($id_contato == $u['id']) ? 'active' : '' ?>"
                        onclick="location.href='/app/views/comunicacao.php?id_contato=<?= $u['id'] ?>'">
                        <div class="avatar-icon"><i class="fa-solid fa-user"></i></div>
                        <div class="contact-info">
                            <h4><?= htmlspecialchars($u['nome']) ?></h4>
                            <p><?= ucfirst($u['perfil']) ?></p>
                        </div>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </aside>

            <!-- JANELA DO CHAT -->
            <section class="chat-window">
                <?php if ($id_contato > 0): ?>
                <header class="chat-header">
                    <div class="user-details">
                        <div class="avatar-icon"><i class="fa-solid fa-user"></i></div>
                        <div>
                            <h4><?= htmlspecialchars($contato_nome) ?></h4>
                            <span>Online Agora</span>
                        </div>
                    </div>
                    <div class="header-actions">
                        <i class="fa-solid fa-phone" onclick="alert('Chamada de voz em desenvolvimento')"></i>
                        <i class="fa-solid fa-video" onclick="alert('Chamada de vídeo em desenvolvimento')"></i>
                    </div>
                </header>

                <div class="chat-messages" id="message-container">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM mensagens WHERE (remetente_id = ? AND destinatario_id = ?) OR (remetente_id = ? AND destinatario_id = ?) ORDER BY data_envio ASC");
                    $stmt->bind_param("iiii", $meu_id, $id_contato, $id_contato, $meu_id);
                    $stmt->execute();
                    $mensagens = $stmt->get_result();
                    while($m = $mensagens->fetch_assoc()):
                        $classe = ($m['remetente_id'] == $meu_id) ? 'sent' : 'received';
                    ?>
                    <div class="message <?= $classe ?>">
                        <p><?= htmlspecialchars($m['mensagem']) ?></p>
                        <small style="font-size:0.6rem;opacity:0.7;display:block;text-align:right;margin-top:5px;">
                            <?= date('H:i', strtotime($m['data_envio'])) ?>
                        </small>
                    </div>
                    <?php endwhile; ?>
                </div>

                <footer class="chat-input-area">
                    <form action="/app/views/enviar_mensagens.php" method="POST" class="input-wrapper">
                        <input type="hidden" name="destinatario_id" value="<?= $id_contato ?>">
                        <input type="text" name="mensagem" id="msgInput" placeholder="Digite sua mensagem..." required autocomplete="off">
                        <div class="input-icons">
                            <i class="fa-regular fa-face-smile" onclick="alert('Dica: Use Win + . para emojis')"></i>
                            <label for="file-upload" style="cursor:pointer"><i class="fa-solid fa-paperclip"></i></label>
                            <input id="file-upload" type="file" style="display:none;" onchange="alert('Upload de arquivos será implementado em breve')"/>
                            <button type="submit" class="send-btn">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </footer>

                <?php else: ?>
                <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;color:#888;">
                    <i class="fa-solid fa-comments" style="font-size:4rem;margin-bottom:20px;opacity:0.2;"></i>
                    <h3>Selecione uma conversa para começar</h3>
                </div>
                <?php endif; ?>
            </section>

            <!-- PERFIL LATERAL -->
            <aside class="chat-profile-info">
                <?php if ($id_contato > 0): ?>
                <div class="avatar-icon large"><i class="fa-solid fa-user"></i></div>
                <h3><?= htmlspecialchars($contato_nome) ?></h3>
                <p style="color:#00a98f;font-weight:bold;margin-bottom:20px;"><?= ucfirst($contato_perfil) ?></p>
                <button class="btn-profile" onclick="alert('Perfil de: <?= $contato_nome ?>')">Ver Perfil Completo</button>
                <ul class="profile-options">
                    <li onclick="ativarPesquisa()"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar Mensagem</li>
                    <li><i class="fa-regular fa-image"></i> Imagens Enviadas</li>
                    <li><i class="fa-solid fa-ellipsis"></i> Outras Opções</li>
                </ul>
                <?php else: ?>
                <p style="text-align:center;color:#999;">Nenhum contato selecionado</p>
                <?php endif; ?>
            </aside>

        </div>
    </main>
</div>

<script>
    var objDiv = document.getElementById("message-container");
    if(objDiv) objDiv.scrollTop = objDiv.scrollHeight;

    function ativarPesquisa() {
        let termo = prompt("O que você deseja buscar nesta conversa?");
        if (termo) {
            let msgs = document.querySelectorAll('.message p');
            let encontrou = false;
            msgs.forEach(m => {
                if (m.innerText.toLowerCase().includes(termo.toLowerCase())) {
                    m.parentElement.style.backgroundColor = "#fff3cd";
                    m.scrollIntoView();
                    encontrou = true;
                } else {
                    m.parentElement.style.backgroundColor = "";
                }
            });
            if(!encontrou) alert("Nenhuma mensagem encontrada com esse termo.");
        }
    }

    function filtrarContatos() {
        let input = document.getElementById('filterContacts').value.toLowerCase();
        let items = document.querySelectorAll('.contact-item');
        items.forEach(item => {
            let nome = item.querySelector('h4').innerText.toLowerCase();
            item.style.display = nome.includes(input) ? "flex" : "none";
        });
    }
</script>
</body>
</html>