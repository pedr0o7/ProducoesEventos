<?php
session_start();
require_once '../model/DAO/UsersDAO.php';

$status = isset($_GET['status']) ? $_GET['status'] : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="text-center mb-4">
                <h1>Redefinir Senha</h1>
                <p class="text-muted">
                    <?= $status === 'token_sent' ? 'Insira o código recebido e a nova senha' : 'Informe seu e-mail para redefinir a senha' ?>
                </p>
            </div>

            <?php if($status): ?>
                <div class="alert alert-<?= in_array($status, ['success', 'token_sent']) ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                    <?php
                    $messages = [
                        'success' => 'Senha alterada com sucesso!',
                        'token_sent' => 'Um código de verificação foi enviado para seu e-mail!',
                        'invalid_token' => 'Código inválido ou expirado',
                        'email_not_found' => 'E-mail não encontrado',
                        'password_mismatch' => 'As senhas não coincidem',
                        'error' => 'Erro ao processar solicitação'
                    ];
                    echo $messages[$status] ?? 'Ocorreu um erro desconhecido';
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="../control/redefineSenhaControl.php" method="post" novalidate>
                <div class="row g-3">
                    <div class="col-12">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= $email ?>" required <?= $email ? 'readonly' : '' ?>>
                    </div>

                    <?php if($status === 'token_sent' && $email): ?>
                        <div class="col-12">
                            <label for="token" class="form-label">Código de Verificação</label>
                            <input type="text" class="form-control" id="token" name="token" 
                                   required pattern="[0-9a-fA-F]{32}">
                            <div class="form-text">Insira o código de 32 caracteres recebido por e-mail</div>
                        </div>
                    <?php endif; ?>

                    <?php if($status === 'token_sent'): ?>
                        <div class="col-12">
                            <label for="new_password" class="form-label">Nova Senha</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" 
                                    name="new_password" required minlength="8">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="form-text">Mínimo 8 caracteres</div>
                        </div>

                        <div class="col-12">
                            <label for="confirm_password" class="form-label">Confirme a Senha</label>
                            <input type="password" class="form-control" id="confirm_password" 
                                name="confirm_password" required>
                        </div>
                    <?php endif; ?>

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <?= $status === 'token_sent' ? 'Redefinir Senha' : 'Enviar Código' ?>
                        </button>
                        <div class="mt-3">
                            <a href="login.php" class="text-decoration-none">Voltar para Login</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/scripts.js"></script>

</body>
</html>