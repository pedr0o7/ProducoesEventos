<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
use Ramsey\Uuid\Uuid;

// Configuração do Banco de Dados
$conn = new mysqli('localhost', 'usuario', 'senha', 'Producoes_Eventos');

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Funções Essenciais
function generate_uuid() {
    return Uuid::uuid4()->toString();
}

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function check_auth($allowed_roles = []) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login-usuario.php');
        exit();
    }
    
    if (!empty($allowed_roles) && !in_array($_SESSION['user_role'], $allowed_roles)) {
        header('HTTP/1.1 403 Forbidden');
        exit('Acesso negado');
    }
}

// Helper para upload de imagens
function upload_image($file) {
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (!in_array($ext, $allowed)) {
        throw new Exception("Formato de arquivo inválido");
    }
    
    $filename = uniqid() . '.' . $ext;
    $path = $_SERVER['DOCUMENT_ROOT'] . '/public/img/' . $filename;
    
    if (!move_uploaded_file($file['tmp_name'], $path)) {
        throw new Exception("Falha no upload da imagem");
    }
    
    return '/public/img/' . $filename;
}
?>