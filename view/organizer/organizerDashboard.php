<?php include '../partials/header.php'; ?>

<div class="container-fluid px-4">
    <h2 class="mt-4 mb-4">Dashboard Administrativo</h2>
    
    <!-- Cards de Estatísticas -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Usuários Cadastrados</h5>
                    <h2><?= $data['totalUsers'] ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Eventos Totais</h5>
                    <h2><?= $data['totalEvents'] ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Usuários -->
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Todos os Usuários</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Perfil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user): ?>
                    <tr>
                        <td><?= $user->getUserId() ?></td>
                        <td><?= htmlspecialchars($user->getName()) ?></td>
                        <td><?= htmlspecialchars($user->getEmail()) ?></td>
                        <td><?= ucfirst($user->getRole()) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>