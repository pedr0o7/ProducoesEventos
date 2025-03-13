<?php include 'partials/header.php'; ?>

<div class="container-fluid px-4">
    <h2 class="mt-4 mb-4">Dashboard do Cliente</h2>
    
    <div class="row g-4">
        <!-- Card de Ingressos -->
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card bg-success text-white shadow-lg">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Meus Ingressos</h5>
                        <p class="card-text display-6 mb-0">3</p>
                    </div>
                    <i class="bi bi-ticket-perforated fs-1"></i>
                </div>
                <div class="card-footer bg-dark">
                    <a href="#" class="text-white small">Ver todos</a>
                </div>
            </div>
        </div>

        <!-- Lista de Eventos -->
        <div class="col-12 col-md-6 col-xl-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Próximos Eventos</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Show da Banda X</h6>
                                <small class="text-muted">Local: Arena XPTO</small>
                            </div>
                            <span class="badge bg-primary">25/12</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Feira de Tecnologia</h6>
                                <small class="text-muted">Local: Centro de Convenções</small>
                            </div>
                            <span class="badge bg-primary">30/12</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>