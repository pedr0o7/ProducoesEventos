<?php
session_start();
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center mb-4">Acessar Sistema</h1>

            <?php if($status): ?>
                <div class="alert alert-<?= $status === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                    <?php $messages = [
                        'success' => 'Cadastro realizado com sucesso! Faça login',
                        'user_exists' => 'Usuário já cadastrado. Faça login ou <a href="redefine_senha.php" class="alert-link">redefinir senha</a>',
                        'empty_fields' => 'Preencha todos os campos obrigatórios',
                        'user_not_found' => 'Usuário não encontrado',
                        'wrong_password' => 'Senha incorreta',
                        'error' => 'Erro no sistema. Tente novamente'
                    ];
                    echo $messages[$status] ?? 'Ocorreu um erro desconhecido'; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="../control/loginControl.php" method="post">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= $email ?>" required autofocus>
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <a href="redefineSenha.php" class="alert-link">redefinir senha</a>
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                        <div class="mt-3">
                            <a href="cadastroUsuario.php" class="text-decoration-none">Criar nova conta</a>
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