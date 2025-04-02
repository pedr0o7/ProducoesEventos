<?php
//session_start();
require_once __DIR__ . '/../../app/config/database.php';
include __DIR__ . '/../../view/partials/header.php';

$pdo = Database::getInstance();
$error = '';

// Se usuário já está logado, redireciona
if (isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . '/user/dashboard');
    exit;
}

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validação básica
    if (empty($email) || empty($password)) {
        $error = 'Preencha todos os campos';
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Autenticação bem-sucedida
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'is_admin' => $user['is_admin']
                ];
                
                header('Location: ' . BASE_URL . '/user/dashboard');
                exit;
            } else {
                $error = 'Credenciais inválidas';
            }
        } catch (PDOException $e) {
            $error = 'Erro no login: ' . $e->getMessage();
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Login</h2>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>

                        <div class="text-center">
                            <a href="<?= BASE_URL ?>/auth/forgot-password" class="text-decoration-none">
                                Esqueceu a senha?
                            </a>
                        </div>
                    </form>

                    <hr class="my-4">
                    <div class="text-center">
                        <span class="text-muted">Não tem conta?</span>
                        <a href="<?= BASE_URL ?>/auth/register" class="text-decoration-none">
                            Criar conta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../view/partials/footer.php'; ?>