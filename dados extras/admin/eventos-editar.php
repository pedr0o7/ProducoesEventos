<?php
include '../includes/config.php';
verificarAdmin();

$id = (int)$_GET['id'];
$stmt = $conn->prepare("SELECT * FROM eventos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$evento = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = sanitizar($_POST['titulo']);
    // ... (capturar outros campos)
    
    $stmt = $conn->prepare("UPDATE eventos SET titulo=?, data_evento=?, ... WHERE id=?");
    $stmt->bind_param("sssdi", $titulo, $data, $local, $descricao, $preco, $quantidade, $id);
    $stmt->execute();
    header('Location: eventos-listar.php');
}
?>

<!-- Formulário de Edição Similar ao Criar -->