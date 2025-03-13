<?php include 'partials/header.php'; ?>

<?php
// Lógica para seções
$section = $_GET['section'] ?? 'dashboard';
?>
<div class="container-fluid px-4">
    <h2 class="mt-4 mb-4">Dashboard Administrativo</h2>
    
    <div class="row g-4">
        <!-- Cards de Estatísticas -->
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card bg-primary text-white shadow-lg">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Usuários</h5>
                        <p class="card-text display-6 mb-0">152</p>
                    </div>
                    <i class="bi bi-people-fill fs-1"></i>
                </div>
                <div class="card-footer bg-dark">
                    <a href="#" class="text-white small">Ver detalhes</a>
                </div>
            </div>
        </div>

        <!-- Conteúdo Principal -->
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Últimas Atividades</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Usuário</th>
                                    <th>Ação</th>
                                    <th>Data</th>
                                    <th>IP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>João Silva</td>
                                    <td><span class="badge bg-success">Login</span></td>
                                    <td>25/12 10:00</td>
                                    <td>192.168.1.1</td>
                                </tr>
                                <!-- Adicione mais linhas -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>