<?php
include '../includes/config.php';
check_auth(['admin', 'organizer']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $event_id = generate_uuid();
        $cover_image = upload_image($_FILES['cover_image']);
        
        $stmt = $conn->prepare("INSERT INTO events (
            event_id, organizer_id, title, description, start_datetime, end_datetime,
            location_name, address, city, state, country, zip_code, cover_image_url
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param('sssssssssssss',
            $event_id,
            $_SESSION['user_id'],
            sanitize($_POST['title']),
            sanitize($_POST['description']),
            $_POST['start_datetime'],
            $_POST['end_datetime'],
            sanitize($_POST['location_name']),
            sanitize($_POST['address']),
            sanitize($_POST['city']),
            sanitize($_POST['state']),
            sanitize($_POST['country']),
            sanitize($_POST['zip_code']),
            $cover_image
        );
        
        if ($stmt->execute()) {
            header("Location: eventos-editar.php?event_id=$event_id");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<?php include '../includes/header.php'; ?>
<!-- Formulário de criação de evento com todos os campos -->