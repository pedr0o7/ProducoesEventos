<?php
include 'includes/config.php';
check_auth(['customer', 'organizer', 'admin']);

$stmt = $conn->prepare("
    SELECT o.order_id, o.created_at, e.title, e.start_datetime, ti.type, oi.quantity, oi.price_per_ticket 
    FROM orders o
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN tickets ti ON oi.ticket_id = ti.ticket_id
    JOIN events e ON ti.event_id = e.event_id
    WHERE o.user_id = ?
");
$stmt->bind_param('s', $_SESSION['user_id']);
$stmt->execute();
$orders = $stmt->get_result();
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-4">
    <h2>Meus Ingressos</h2>
    <?php while($order = $orders->fetch_assoc()): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5><?= $order['title'] ?></h5>
                <p>Data: <?= date('d/m/Y H:i', strtotime($order['start_datetime'])) ?></p>
                <p>Tipo: <?= $order['type'] ?> × <?= $order['quantity'] ?></p>
                <p>Total: R$ <?= number_format($order['quantity'] * $order['price_per_ticket'], 2) ?></p>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php include 'includes/footer.php'; ?>