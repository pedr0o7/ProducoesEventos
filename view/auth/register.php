<?php
//session_start();
require_once __DIR__ . '/../../app/config/database.php';
include __DIR__ . '/../../view/partials/header.php';

$pdo = Database::getInstance();
$error = '';
$success = '';

// Redirecionar usuários logados
if (isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . '/user/dashboard');
    exit;
}

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validações
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'O nome é obrigatório';
    }

    if (empty($email)) {
        $errors[] = 'O email é obrigatório';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email inválido';
    }

    if (strlen($password) < 8) {
        $errors[] = 'A senha deve ter pelo menos 8 caracteres';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'As senhas não coincidem';
    }

    if (empty($errors)) {
        try {
            // Verificar se email já existe
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $errors[] = 'Este email já está cadastrado';
            } else {
                // Hash da senha
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Inserir usuário
                $stmt = $pdo->prepare("
                    INSERT INTO users (name, email, password, created_at) 
                    VALUES (?, ?, ?, NOW())
                ");
                
                if ($stmt->execute([$name, $email, $hashedPassword])) {
                    $success = 'Cadastro realizado com sucesso!';
                    // Limpar campos
                    $name = $email = '';
                }
            }
        } catch (PDOException $e) {
            $errors[] = 'Erro no cadastro: ' . $e->getMessage();
        }
    }
    
    if (!empty($errors)) {
        $error = implode('<br>', $errors);
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title text-center mb-0">Criar Nova Conta</h3>
                </div>
                
                <div class="card-body p-4">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <form method="POST" novalidate>
                        <div class="row g-3">
                            <!-- Nome -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" 
                                           class="form-control" 
                                           id="name" 
                                           name="name" 
                                           value="<?= htmlspecialchars($name ?? '') ?>"
                                           required>
                                    <label for="name">Nome Completo</label>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" 
                                           class="form-control" 
                                           id="email" 
                                           name="email" 
                                           value="<?= htmlspecialchars($email ?? '') ?>"
                                           required>
                                    <label for="email">Email</label>
                                </div>
                            </div>

                            <!-- Senha -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password" 
                                           name="password" 
                                           minlength="8"
                                           required>
                                    <label for="password">Senha</label>
                                </div>
                                <small class="text-muted">Mínimo 8 caracteres</small>
                            </div>

                            <!-- Confirmar Senha -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" 
                                           class="form-control" 
                                           id="confirm_password" 
                                           name="confirm_password" 
                                           required>
                                    <label for="confirm_password">Confirme a Senha</label>
                                </div>
                            </div>

                            <!-- Botão de Registro -->
                            <div class="col-12">
                                <button type="submit" 
                                        class="btn btn-primary w-100 py-3">
                                    <i class="bi bi-person-plus me-2"></i>
                                    Registrar-se
                                </button>
                            </div>

                            <!-- Link para Login -->
                            <div class="col-12 text-center">
                                <p class="mb-0">
                                    Já tem uma conta? 
                                    <a href="<?= BASE_URL ?>/auth/login" 
                                       class="text-decoration-none">
                                        Faça login aqui
                                    </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../view/partials/footer.php'; ?>