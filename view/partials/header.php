<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

$userRole = $_SESSION['user_role'];
$welcomeName = $_SESSION['user_name'] ?? 'Usuário';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst($userRole) ?> Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <style>
        /* Mantenha os estilos anteriores */
        body {
            background-color: #f8f9fa;
        }
        /* ... outros estilos ... */
    </style>
</head>
<body>
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark">
            <div class="sidebar-header">
                <h3>Sistema Eventos</h3>
            </div>

            <ul class="list-unstyled components">
                <?php if ($userRole === 'admin'): ?>
                    <li>
                        <a href="#adminSubmenu" data-bs-toggle="collapse" class="dropdown-toggle">Admin</a>
                        <ul class="collapse list-unstyled" id="adminSubmenu">
                            <li><a href="admin_dashboard.php?section=users">Usuários</a></li>
                            <li><a href="admin_dashboard.php?section=settings">Configurações</a></li>
                            <li><a href="admin_dashboard.php?section=reports">Relatórios</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($userRole === 'organizer'): ?>
                    <li>
                        <a href="#eventSubmenu" data-bs-toggle="collapse" class="dropdown-toggle">Eventos</a>
                        <ul class="collapse list-unstyled" id="eventSubmenu">
                            <li><a href="organizer_dashboard.php?section=create">Criar Evento</a></li>
                            <li><a href="organizer_dashboard.php?section=events">Meus Eventos</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="profile.php">Perfil</a>
                </li>
                <li>
                    <a href="logout.php">Sair</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-dark" id="sidebarCollapse">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="ms-auto">
                        <span class="navbar-text">
                            Olá, <strong><?= $welcomeName ?></strong> (<?= $userRole ?>)
                        </span>
                    </div>
                </div>
            </nav>

            <!-- Área para conteúdo dinâmico -->
            <div class="container-fluid p-4">
                <!-- O conteúdo específico de cada página será inserido aqui -->