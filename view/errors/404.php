<?php View::layout('layouts.main') ?>

<?php View::section('title', 'Página Não Encontrada') ?>

<?php View::section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-1 text-primary">404</h1>
            <h2 class="mb-4">Página Não Encontrada</h2>
            <p class="lead">A página que você está procurando não existe ou foi movida.</p>
            <a href="/" class="btn btn-primary mt-3">
                <i class="bi bi-house-door"></i> Voltar para Home
            </a>
        </div>
    </div>
</div>
<?php View::endSection() ?>