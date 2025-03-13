<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produções de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<?php if(isset($_SESSION['user_id'])): ?>
<nav class="admin-nav navbar-dark">
    <div class="container">
        <div class="d-flex align-items-center">
            <a href="/" class="navbar-brand">Home</a>
            <?php if($_SESSION['user_role'] === 'admin'): ?>
                <a href="/admin" class="nav-link">Painel Admin</a>
            <?php endif; ?>
            <?php if(in_array($_SESSION['user_role'], ['organizer', 'admin'])): ?>
                <a href="/organizer/events" class="nav-link">Meus Eventos</a>
            <?php endif; ?>
            <div class="ms-auto">
                <a href="/logout.php" class="btn btn-outline-light">Sair</a>
            </div>
        </div>
    </div>
</nav>
<?php endif; ?>
<main class="container py-4">