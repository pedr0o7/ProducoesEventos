<?php
session_start();
require_once '../model/DTO/UsersDTO.php';
require_once '../model/DAO/UsersDAO.php';

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../view/login.php?status=invalid_request');
    exit();
}

// Sanitização das entradas
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];

// Validação básica
if (empty($email) || empty($password)) {
    header('Location: ../view/login.php?status=empty_fields');
    exit();
}

// Busca o usuário no banco
$usersDAO = new UsersDAO();
$userDTO = new UsersDTO();
$userDTO->setEmail($email);
// $existingUser = $usersDAO->findByEmail($userDTO);
// echo '<pre>';
// var_dump();
try {
    $existingUser = $usersDAO->findByEmail($userDTO);
    
    if (!$existingUser) {
        header('Location: ../view/login.php?status=user_not_found&email=' . urlencode($email));
        exit();
    }

    // Verificação de senha (supondo que está usando password_hash no cadastro)
    // password_hash($password_hash, PASSWORD_DEFAULT);
   
    if (password_verify($password, $existingUser[0]['password_hash'])) {
        // Login bem-sucedido
        $_SESSION['user_id'] = $existingUser[0]['user_id'];
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = $existingUser[0]['role'];
        $_SESSION['logged_in'] = true;

        // Redirecionamento baseado no perfil
        switch ($_SESSION['user_role']) {
            case 'admin':
                header('Location: ../view/admin_dashboard.php');
                break;
            case 'organizer':
                header('Location: ../view/organizer_dashboard.php');
                break;
            default:
                header('Location: ../view/user_dashboard.php');
        }
        exit();
        
    } else {
        header('Location: ../view/login.php?status=wrong_password&email=' . urlencode($email));
        exit();
    }
    
} catch (Exception $e) {
    error_log('Login error: ' . $e->getMessage());
    header('Location: ../view/login.php?status=error');
    exit();
}