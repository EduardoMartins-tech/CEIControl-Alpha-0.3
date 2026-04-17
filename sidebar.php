<aside class="sidebar">
    <div class="sidebar-logo">
        <span class="logo-text">CEIControl®</span>
    </div>
    
    <nav class="sidebar-nav">
        <p class="nav-category">Principal</p>
        
        <?php if ($_SESSION['perfil'] == 'admin'): ?>
            <a href="painel_admin.php" class="<?= ($pagina_atual == 'dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
            <p class="nav-category">Gestão</p>
            <a href="listar_usuarios.php" class="<?= ($pagina_atual == 'usuarios') ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i> Usuários
            </a>
            <a href="listar_estoque.php" class="<?= ($pagina_atual == 'produtos') ? 'active' : '' ?>">
                <i class="fa-solid fa-box-open"></i> Produtos
            </a>
            <a href="listar_fornecedores.php" class="<?= ($pagina_atual == 'fornecedores') ? 'active' : '' ?>">
                <i class="fa-solid fa-truck-moving"></i> Fornecedores
            </a>
            <a href="listar_eventos.php" class="<?= ($pagina_atual == 'agenda') ? 'active' : '' ?>">
                <i class="fa-solid fa-calendar-days"></i> Agenda
            </a>

        <?php elseif ($_SESSION['perfil'] == 'usuario'): ?>
            <a href="painel_usuario.php" class="<?= ($pagina_atual == 'dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-chalkboard-user"></i> Minha Sala
            </a>
            <p class="nav-category">Rotina</p>
            <a href="listar_eventos.php" class="<?= ($pagina_atual == 'agenda') ? 'active' : '' ?>">
                <i class="fa-solid fa-calendar-check"></i> Agenda Escolar
            </a>
            <a href="listar_estoque.php" class="<?= ($pagina_atual == 'produtos') ? 'active' : '' ?>">
                <i class="fa-solid fa-box-archive"></i> Materiais
            </a>

        <?php elseif ($_SESSION['perfil'] == 'cliente'): ?>
            <a href="painel_cliente.php" class="<?= ($pagina_atual == 'dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-house-user"></i> Visão Geral
            </a>
            <p class="nav-category">Acompanhamento</p>
            <a href="listar_eventos.php" class="<?= ($pagina_atual == 'agenda') ? 'active' : '' ?>">
                <i class="fa-solid fa-calendar-day"></i> Agenda da CEI
            </a>
        <?php endif; ?>

        <p class="nav-category">Sistema</p>
        <a href="chat.php" class="nav-link <?= ($pagina_atual == 'comunicacao') ? 'active' : '' ?>">
        <i class="fa-solid fa-comments"></i>
        <span>Comunicação</span>
        </a>
        <a href="logout.php" class="logout-link">
            <i class="fa-solid fa-right-from-bracket"></i> Sair
        </a>
    </nav>

    <div class="theme-switch-wrapper">
        <i class="fa-solid fa-sun theme-icon-sm"></i>
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" onclick="toggleDarkMode()" />
            <div class="slider round"></div>
        </label>
        <i class="fa-solid fa-moon theme-icon-sm"></i>
    </div>
</aside>

<script src="script.js"></script> 