<?php
session_start();
if (!isset($_SESSION['logged_in'])){
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
    <link href="../../css/styles.css" rel="stylesheet">
</head>
<body class="dashboard-body">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <h3>Sistema Eventos</h3>
            </div>

            <ul class="list-unstyled components">
                <?php if ($userRole === 'admin'): ?>
                    <li class="active">
                        <a href="#adminSubmenu" data-bs-toggle="collapse">Admin</a>
                        <ul class="collapse list-unstyled" id="adminSubmenu">
                            <li><a href="#">Usuários</a></li>
                            <li><a href="#">Configurações</a></li>
                            <li><a href="#">Relatórios</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($userRole === 'organizer'): ?>
                    <li>
                        <a href="#eventSubmenu" data-bs-toggle="collapse">Eventos</a>
                        <ul class="collapse list-unstyled" id="eventSubmenu">
                            <li><a href="#">Criar Evento</a></li>
                            <li><a href="#">Meus Eventos</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="#">Perfil</a>
                </li>
                <li>
                    <a href="logout.php">Sair</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button class="btn btn-dark" id="sidebarCollapse">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="ms-auto">
                        <span class="navbar-text">
                            Olá, <?= $welcomeName ?> (<?= $userRole ?>)
                        </span>
                    </div>
                </div>
            </nav>