<?php include 'partials/header.php'; ?>

            <div class="container-fluid px-4">
                <h2 class="mt-4">Dashboard do Organizador</h2>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Criar Novo Evento
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Nome do Evento">
                                    </div>
                                    <button class="btn btn-success">Criar Evento</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Estatísticas
                            </div>
                            <div class="card-body">
                                <canvas id="eventChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php include 'partials/footer.php'; ?>