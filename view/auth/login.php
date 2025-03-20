<?php View::layout('layouts.main') ?>

<?php View::section('title', 'Login') ?>

<?php View::section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Acessar Conta</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                            <a href="/forgot-password" class="btn btn-link">Esqueceu a senha?</a>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    Não tem conta? <a href="/register" class="text-decoration-none">Registre-se aqui</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php View::endSection() ?>