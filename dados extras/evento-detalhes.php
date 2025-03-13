<?php
include 'includes/config.php';

$event_id = sanitize($_GET['event_id']);
$stmt = $conn->prepare("
    SELECT e.*, u.name AS organizer_name 
    FROM events e
    JOIN users u ON e.organizer_id = u.user_id
    WHERE e.event_id = ?
");
$stmt->bind_param('s', $event_id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();

// Buscar ingressos
$tickets_stmt = $conn->prepare("
    SELECT * FROM tickets 
    WHERE event_id = ? 
    AND (sale_start <= NOW() OR sale_start IS NULL)
    AND (sale_end >= NOW() OR sale_end IS NULL)
");
$tickets_stmt->bind_param('s', $event_id);
$tickets_stmt->execute();
$tickets = $tickets_stmt->get_result();
?>

<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <!-- Exibição detalhada do evento e formulário de compra -->
</div>
<?php include 'includes/footer.php'; ?>