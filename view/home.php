<?php
require_once __DIR__ . '/../app/config/database.php';
include __DIR__ . '/partials/header.php';

// Obter instância do PDO
$pdo = Database::getInstance(); // FORMA CORRETA DE CHAMAR

try {
    $stmt = $pdo->query("SELECT * FROM events WHERE start_datetime >= CURDATE() ORDER BY start_datetime LIMIT 6");
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Debug temporário
    // echo '<pre>';
    // var_dump($events);
    // echo '</pre>';

} catch (PDOException $e) {
    $events = [];
    $error = "Erro ao carregar eventos: " . $e->getMessage();
}
?>

<div class="container mt-4">
    <?php if (isset($_SESSION['user'])): ?>
        <a href="/user/userDashboard" class="btn btn-primary me-2">Dashboard</a>
        <?php if ($_SESSION['user']['is_admin']): ?>
            <a href="/admin/adminDashboard" class="btn btn-warning me-2">Admin</a>
        <?php endif; ?>
    <?php endif; ?>
    <main>
        <section class="hero-section bg-dark text-white p-5 rounded mb-4">
            <div class="hero-content text-center">
                <h2>Bem-vindo à Plataforma de Eventos</h2>
                <!-- <p class="lead">Organize ou participe dos melhores eventos da sua região</p> -->
            </div>
        </section>

        <section class="events-grid">
            <h3 class="mb-4">Próximos Eventos</h3>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?=$error?></div>
            <?php endif; ?>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                        <div class="col">
                            <div class="card h-100">
                                <!-- ⚠️ AJUSTE caminho da imagem -->
                                <img src="/assets/images/events/<?=htmlspecialchars($event['image'])?>"
                                     class="card-img-top"
                                     alt="<?=htmlspecialchars($event['title'])?>"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?=htmlspecialchars($event['title'])?></h5>
                                    <p class="card-text">
                                        <i class="bi bi-calendar-event"></i>
                                        <?=date('d/m/Y H:i', strtotime($event['event_date']))?>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-geo-alt"></i>
                                        <?=htmlspecialchars($event['location'])?>
                                    </p>
                                    <a href="/events/<?=$event['id']?>" class="btn btn-primary">Ver Detalhes</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info">Nenhum evento próximo encontrado</div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>