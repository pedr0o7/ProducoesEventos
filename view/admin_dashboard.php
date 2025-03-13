<?php include 'partials/header.php'; ?>

            <div class="container-fluid px-4">
                <h2 class="mt-4">Dashboard Administrativo</h2>
                
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5>Usuários</h5>
                                <p class="display-4">152</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                Últimas Atividades
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Usuário</th>
                                            <th>Ação</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>João</td>
                                            <td>Login</td>
                                            <td>25/12 10:00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php include 'partials/footer.php'; ?>