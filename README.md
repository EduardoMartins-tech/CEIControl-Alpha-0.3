# 🚀 CEIControl

<p align="center">
  <img src="public/assets/ceicontrol.png" height="120"/>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <img src="public/assets/logo_jemtech.png" height="120"/>
</p>

<p align="center">
  <b>Sistema de Gestão para Centros de Educação Infantil Públicos</b>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/status-em%20desenvolvimento-yellow" />
  <img src="https://img.shields.io/badge/version-0.4-blue" />
  <img src="https://img.shields.io/badge/license-MIT-green" />
  <img src="https://img.shields.io/badge/PHP-Backend-blueviolet" />
  <img src="https://img.shields.io/badge/MySQL-Database-orange" />
  <img src="https://img.shields.io/badge/MVC-Architecture-brightgreen" />
</p>

---

## 📌 Sobre o Projeto

O **CEIControl** é uma plataforma web desenvolvida para **modernizar e simplificar a gestão de Centros de Educação Infantil (CEIs) públicos**.

A proposta é centralizar em um único sistema:

- 👥 Gestão de usuários e perfis de acesso
- 📦 Controle de estoque e serviços
- 🏢 Gestão de fornecedores
- 📅 Agenda digital escolar
- 💬 Comunicação interna entre usuários

> 💡 Projeto desenvolvido pela **JEMTech**, focada em soluções digitais para o setor público de educação.

---

## 📎 Links do Projeto

| Recurso | Link |
|---------|------|
| 🌐 Deploy Backend | [ceicontrol.up.railway.app](https://ceicontrol.up.railway.app) |
| 🖥️ Deploy Frontend | [CEIControl Front](https://eduardomartins-tech.github.io/CEIControl-Front/) |
| 📦 Repositório Backend | [GitHub - CEIControl Alpha 0.3](https://github.com/EduardoMartins-tech/CEIControl-Alpha-0.3) |
| 🎨 Repositório Frontend | [GitHub - CEIControl Front](https://github.com/EduardoMartins-tech/CEIControl-Front) |
| 🖌️ Protótipo Figma | [Visualizar no Figma](https://www.figma.com/design/Ik8DcPkOuDatNVvMvnUDYq/CCsite?node-id=0-1&p=f) |

---

## 👨‍💻 Desenvolvedores

<table align="center">
  <tr>
    <td align="center">
      <a href="https://github.com/EduardoMartins-tech">
        <img src="https://github.com/EduardoMartins-tech.png" width="100px;" /><br>
        <sub><b>Eduardo Ferreira Martins</b></sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/JVCod1ng">
        <img src="https://github.com/JVCod1ng.png" width="100px;" /><br>
        <sub><b>João Vitor</b></sub>
      </a>
    </td>
  </tr>
</table>

---

## 🎯 Objetivos

### 🔹 Objetivo Geral
Criar uma plataforma gratuita, eficiente e acessível para a gestão de CEIs, promovendo **organização, comunicação e transparência**.

### 🔹 Objetivos Específicos

- 📊 Centralizar dados administrativos
- 💬 Melhorar comunicação com responsáveis
- 🔐 Garantir segurança com controle de acesso por perfil
- ⚙️ Utilizar arquitetura MVC para escalabilidade
- 🌍 Promover inclusão digital no setor público

---

## 🌟 Funcionalidades

- ✅ CRUD completo — Usuários, Produtos, Serviços, Fornecedores, Eventos
- 💬 Chat interno entre usuários do sistema
- 📅 Agenda digital com controle de público-alvo
- 🔐 Autenticação por perfil com hash BCrypt
- 🌙 Modo escuro (Dark Mode)
- 📱 Layout responsivo para mobile
- ✔️ Validações com JavaScript no front-end

---

## 🏗️ Arquitetura MVC

```
CEIControl/
├── config/
│   └── database.php
├── app/
│   ├── models/
│   │   ├── UsuarioModel.php
│   │   ├── ProdutoModel.php
│   │   ├── FornecedoresModel.php
│   │   ├── EventoModel.php
│   │   └── MensagemModel.php
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── UsuarioController.php
│   │   ├── ProdutoController.php
│   │   ├── FornecedorController.php
│   │   └── EventoController.php
│   └── views/
│       ├── auth/
│       ├── usuarios/
│       ├── produtos/
│       ├── fornecedores/
│       ├── eventos/
│       ├── comunicacao.php
│       └── enviar_mensagens.php
├── public/
│   ├── index.php
│   ├── sobre.html
│   ├── style.css
│   ├── mobile.css
│   ├── script.js
│   └── assets/
├── sidebar.php
├── router.php
└── tabelas.sql
```

---

## 🧰 Tecnologias

<p align="center">

| Tecnologia | Uso |
|-----------|-----|
| PHP 8.x | Back-end e arquitetura MVC |
| MySQL | Banco de dados relacional |
| HTML5 | Estrutura das views |
| CSS3 | Estilo e responsividade |
| JavaScript | Interatividade e validações |
| Railway | Hospedagem e deploy |
| Apache | Servidor web com mod_rewrite |
| BCrypt | Hash seguro de senhas |

</p>

---

## 🔐 Perfis de Acesso

| Perfil | Descrição | E-mail | Senha |
|--------|-----------|--------|-------|
| **Admin** | Gestor Escolar — acesso total | admin@cei.com | 123456 |
| **Usuario** | Educador — agenda e materiais | usuario@cei.com | U123456 |
| **Cliente** | Responsável — agenda e chat | cliente@cei.com | 123456 |

> ⚠️ Credenciais apenas para ambiente de demonstração. Altere antes de uso em produção.

---

## 🚀 Histórico de Versões

### ✅ Alpha 0.4 — Arquitetura MVC Completa
- Reestruturação completa para padrão MVC
- Router centralizado com rotas absolutas
- Correção de todos os redirects e links das views e controllers
- CSS do chat integrado ao `style.css`
- Páginas públicas (`index.php` e `sobre.html`) movidas para `public/`
- Correção de caminhos de assets, CSS e session_start duplicado

### ✅ Alpha 0.3 — CRUDs e Padronização
- CRUD completo de Agenda, Produtos, Serviços, Fornecedores
- Separação lógica entre Produtos e Serviços
- Padronização de UI/UX com card centralizado
- Validações JavaScript nos formulários
- Deploy em produção no Railway

### ✅ Alpha 0.2 — Base do Sistema
- Autenticação com perfis (admin, usuario, cliente)
- CRUD de usuários
- Chat interno entre usuários
- Dark Mode

---

## 📊 Dados de Teste

O banco já vem populado com dados para demonstração:

| Módulo | Exemplos |
|--------|----------|
| Usuários | Admin, Educador, Responsável |
| Agenda | "Reunião de Pais", "Festa Junina" |
| Estoque | "Resma Papel A4", "Kit de Artes" |
| Serviços | "Pintura de Sala", "Reparo de Ar Condicionado" |
| Fornecedores | "Distribuidora Escolar S.A.", "Manutenção Express" |

---

## 🛠️ Como usar o `tabelas.sql`

1. Abra o **phpMyAdmin**
2. Crie um banco chamado `ceicontrol`
3. Importe o arquivo `tabelas.sql`
4. O script cria automaticamente as tabelas: `usuarios`, `fornecedores`, `produtos`, `servicos`, `agenda`, `mensagens`

---

## 💻 Como rodar localmente

### Pré-requisitos
- XAMPP ou WAMP (PHP 8.x + Apache + MySQL)

### Passo a passo

```bash
# Clone na pasta do servidor
cd C:/xampp/htdocs/
git clone https://github.com/EduardoMartins-tech/CEIControl-Alpha-0.3.git
```

Configure o `config/database.php`:
```php
$host = "localhost";
$user = "root";
$pass = "SUA_SENHA";
$db   = "ceicontrol";
```

Acesse no navegador:
```
http://localhost/CEIControl-Alpha-0.3/
```

### Variáveis de ambiente no Railway

| Variável | Descrição |
|----------|-----------|
| `DB_HOST` | Host do banco MySQL |
| `DB_NAME` | Nome do banco |
| `DB_USER` | Usuário do banco |
| `DB_PASSWORD` | Senha do banco |

---

## 🗺️ Roadmap Futuro

- [ ] Cadastro de alunos e turmas
- [ ] Vinculação responsável → aluno → turma
- [ ] Eventos filtrados por turma para responsáveis
- [ ] Sistema de solicitação de materiais e serviços
- [ ] Notificações internas com badge
- [ ] Dashboard com dados reais (gráficos e contadores)
- [ ] Controle de autoria nos eventos por educador

---

<p align="center">Desenvolvido pela <b>JEMTech</b> para a FATEC Ferraz de Vasconcelos</p>
<p align="center">Projeto Integrador — Programação Web — 2025/2026</p>
