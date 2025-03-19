<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once '../model/DTO/UsersDTO.php';
require_once '../model/DAO/UsersDAO.php';

$usersDAO = new UsersDAO();
$usersDTO = new UsersDTO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $usersDTO->setEmail($email);

    $token = isset($_POST['token']) ? trim($_POST['token']) : '';
    $usersDTO->setToken($token);

    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    if (!empty($token)) {
        
        // Validação do token e nova senha
        if ($newPassword !== $confirmPassword) {
            header('Location: ../view/redefineSenha.php?status=password_mismatch&email=' . urlencode($email));
            exit;
        }

        $resetData = $usersDAO->getPasswordResetToken($usersDTO);
        
        if (!$resetData || !password_verify($token, $resetData['token'])) {
            header('Location: ../view/redefineSenha.php?status=invalid_token&email=' . urlencode($email));
            exit;
        }

        if (date('Y-m-d H:i:s') > $resetData['expires_at']) {
            header('Location: ../view/redefineSenha.php?status=invalid_token&email=' . urlencode($email));
            exit;
        }

        // Atualizar senha
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $usersDTO->setPassword_hash($hashedPassword);
        if ($usersDAO->updatePassword($usersDTO)) {
            $usersDAO->deletePasswordResetToken($usersDTO);
            header('Location: ../view/redefineSenha.php?status=success');
            exit;
        } else {
            header('Location: ../view/redefineSenha.php?status=error');
            exit;
        }
    } else {
        
        // Processar envio de email
        if (!$usersDAO->emailExists($usersDTO)) {
            header('Location: ../view/redefineSenha.php?status=email_not_found');
            exit;
        }

        $token = bin2hex(random_bytes(16));
        $usersDTO->setToken($token);
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $usersDTO->setPassword_hash($hashedPassword);
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $usersDTO->setExpires_at($expiresAt);


        if ($usersDAO->storePasswordResetToken($usersDTO)) {
            // Enviar email (substitua com seu método de envio)
            $to = $email;
            $subject = 'Código de Redefinição de Senha';
            $message = "Seu código de verificação é: $token\nVálido por 1 hora.";
            $headers = 'From: noreply@example.com';
            
            echo "Parte de email TODO";
            exit;
            
            if (mail($to, $subject, $message, $headers)) {
                header('Location: ../view/redefineSenha.php?status=token_sent&email=' . urlencode($email));
                exit;
            }
        }
        header('Location: ../view/redefineSenha.php?status=error');
    }
}