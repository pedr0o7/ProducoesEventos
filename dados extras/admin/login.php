<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitizar($_POST['email']);
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM administradores WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($senha, $admin['senha'])) {
            $_SESSION['admin_logado'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            session_regenerate_id(true); // Prevenção de fixation
            header('Location: eventos-listar.php');
            exit();
        }
    }
    echo "<script>alert('Credenciais inválidas!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include '../includes/header.php'; ?>
</head>
<body>
<div class="container mt-5">
    <form method="POST">
        <h2>Login Administrativo</h2>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>
</body>
</html>