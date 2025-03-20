<?php View::layout('layouts.main') ?>

<?php View::section('title', 'Criar Conta') ?>

<?php View::section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Criar Nova Conta</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/register">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <label for="name">Nome Completo</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <label for="password">Senha</label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password_confirmation" 
                                           name="password_confirmation" required>
                                    <label for="password_confirmation">Confirme a Senha</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Aceito os <a href="/terms" class="text-decoration-none">Termos de Uso</a>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-person-plus"></i> Criar Conta
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    Já tem conta? <a href="/login" class="text-decoration-none">Faça Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php View::endSection() ?>