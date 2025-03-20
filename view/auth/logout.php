<?php View::layout('layouts.main') ?>

<?php View::section('title', 'Sair do Sistema') ?>

<?php View::section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="mb-4">Deseja realmente sair?</h2>
                    <form action="/logout" method="POST">
                        <button type="submit" class="btn btn-danger btn-lg me-3">
                            <i class="bi bi-box-arrow-right"></i> Sim, Sair
                        </button>
                        <a href="/" class="btn btn-secondary btn-lg">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php View::endSection() ?>