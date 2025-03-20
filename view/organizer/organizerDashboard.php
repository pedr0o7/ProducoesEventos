<?php View::layout('layouts.main') ?>

<?php View::section('title', 'Painel do Organizador') ?>

<?php View::section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Meus Eventos</h1>
        <a href="/events/create" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Novo Evento
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($events as $event): ?>
        <div class="col">
            <div class="card h-100 shadow">
                <img src="<?= $event->cover_image_url ?>" class="card-img-top" alt="<?= $event->title ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $event->title ?></h5>
                    <p class="card-text">
                        <small class="text-muted">
                            <?= date('d/m/Y H:i', strtotime($event->start_datetime)) ?>
                        </small>
                    </p>
                    <div class="d-grid gap-2">
                        <a href="/events/<?= $event->event_id ?>" class="btn btn-outline-primary">
                            <i class="bi bi-eye"></i> Ver Detalhes
                        </a>
                        <a href="/events/<?= $event->event_id ?>/edit" class="btn btn-outline-secondary">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">
                        Ingressos vendidos: <?= $event->tickets_sold ?>
                    </small>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($events)): ?>
    <div class="alert alert-info mt-4">
        Nenhum evento criado ainda. 
        <a href="/events/create" class="alert-link">Crie seu primeiro evento</a>
    </div>
    <?php endif; ?>
</div>
<?php View::endSection() ?>