<?php
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = generate_uuid();
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'customer'; // Default

    $stmt = $conn->prepare("INSERT INTO users (user_id, name, email, password_hash, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $user_id, $name, $email, $password, $role);
    
    if ($stmt->execute()) {
        header('Location: login.php?success=1');
    } else {
        $error = "Erro ao cadastrar: " . $conn->error;
    }
}
?>

<?php include 'includes/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">Cadastro de Usuário</h2>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label>Nome Completo</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Senha</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</div>
<?php include 'includes/footer.php'; ?>