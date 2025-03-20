<?php View::layout('layouts.main') ?>

<?php View::section('title', 'Meu Painel') ?>

<?php View::section('content') ?>
<div class="container mt-4">
    <h1 class="mb-4">Bem-vindo, <?= View::escape(currentUser()['name']) ?></h1>
    
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Meus Ingressos
                </div>
                <div class="card-body">
                    <?php if (!empty($tickets)): ?>
                    <div class="list-group">
                        <?php foreach ($tickets as $ticket): ?>
                        <div class="list-group-item">
                            <h5><?= View::escape($ticket->event_title) ?></h5>
                            <p class="mb-1">Tipo: <?= $ticket->type ?></p>
                            <small class="text-muted">Data: <?= date('d/m/Y H:i', strtotime($ticket->event_date)) ?></small>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info">Nenhum ingresso comprado ainda.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    Meus Dados
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nome:</dt>
                        <dd class="col-sm-8"><?= View::escape(currentUser()['name']) ?></dd>

                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8"><?= View::escape(currentUser()['email']) ?></dd>
                    </dl>
                    <a href="/user/profile" class="btn btn-primary">
                        Editar Perfil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php View::endSection() ?>