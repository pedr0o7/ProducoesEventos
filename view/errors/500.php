<?php View::layout('layouts.main') ?>

<?php View::section('title', 'Erro Interno') ?>

<?php View::section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card border-danger shadow">
                <div class="card-header bg-danger text-white">
                    <h1 class="display-4">500</h1>
                </div>
                <div class="card-body">
                    <h2 class="card-title mb-4">Erro Interno do Servidor</h2>
                    <p class="card-text lead">
                        Oops! Algo deu errado. Nossa equipe já foi notificada e estamos trabalhando para resolver.
                    </p>
                    <div class="mt-4">
                        <a href="/" class="btn btn-primary btn-lg me-3">
                            <i class="bi bi-house-door"></i> Página Inicial
                        </a>
                        <a href="/contact" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-envelope"></i> Contato
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php View::endSection() ?>