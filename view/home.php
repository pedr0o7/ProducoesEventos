<?php
session_start();
require_once __DIR__ . '/../config/database.php'; // Arquivo de conexão com o banco
include __DIR__ . '/partials/header.php';

// Buscar eventos do banco de dados
try {
    $stmt = $pdo->query("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date LIMIT 6");
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $events = [];
    $error = "Erro ao carregar eventos: " . $e->getMessage();
}
?>

<div class="container mt-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <h1 class="navbar-brand">Produções de Eventos</h1>
            <div class="d-flex">
                <?php if(isset($_SESSION['user'])): ?>
                    <a href="/user/dashboard" class="btn btn-primary me-2">Dashboard</a>
                    <?php if($_SESSION['user']['is_admin']): ?>
                        <a href="/admin/dashboard" class="btn btn-warning me-2">Admin</a>
                    <?php endif; ?>
                    <a href="/logout" class="btn btn-danger">Sair</a>
                <?php else: ?>
                    <a href="/login" class="btn btn-success me-2">Login</a>
                    <a href="/register" class="btn btn-outline-primary">Cadastre-se</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main>
        <section class="hero-section bg-dark text-white p-5 rounded mb-4">
            <div class="hero-content text-center">
                <h2>Bem-vindo à Plataforma de Eventos</h2>
                <p class="lead">Organize ou participe dos melhores eventos da sua região</p>
            </div>
        </section>

        <section class="events-grid">
            <h3 class="mb-4">Próximos Eventos</h3>
            
            <?php if(!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php if(!empty($events)): ?>
                    <?php foreach($events as $event): ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="/assets/images/events/<?= htmlspecialchars($event['image']) ?>" 
                                     class="card-img-top" 
                                     alt="<?= htmlspecialchars($event['title']) ?>"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
                                    <p class="card-text">
                                        <i class="bi bi-calendar-event"></i>
                                        <?= date('d/m/Y H:i', strtotime($event['event_date'])) ?>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-geo-alt"></i>
                                        <?= htmlspecialchars($event['location']) ?>
                                    </p>
                                    <a href="/events/<?= $event['id'] ?>" class="btn btn-primary">Ver Detalhes</a>
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