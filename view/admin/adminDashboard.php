<?php View::layout('layouts.main') ?>

<?php View::section('title', 'Painel Admin') ?>

<?php View::section('content') ?>
<div class="container mt-4">
    <h1 class="mb-4">Dashboard Administrativo</h1>
    
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-primary shadow">
                <div class="card-body">
                    <h5 class="card-title text-primary">Eventos</h5>
                    <p class="display-6"><?= $totalEvents ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-success shadow">
                <div class="card-body">
                    <h5 class="card-title text-success">Usuários</h5>
                    <p class="display-6"><?= $totalUsers ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Últimos Eventos
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentEvents as $event): ?>
                    <tr>
                        <td><?= View::escape($event->title) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($event->start_datetime)) ?></td>
                        <td>
                            <span class="badge bg-<?= $event->status === 'published' ? 'success' : 'warning' ?>">
                                <?= $event->status ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php View::endSection() ?>