<?php include 'partials/header.php'; ?>

<div class="container-fluid px-4">
    <h2 class="mt-4 mb-4">Dashboard do Organizador</h2>
    
    <div class="row g-4">
        <!-- Formulário de Evento -->
        <div class="col-12 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Criar Novo Evento</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nome do Evento</label>
                            <input type="text" class="form-control" placeholder="Ex: Show de Rock">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data do Evento</label>
                            <input type="datetime-local" class="form-control">
                        </div>
                        <button class="btn btn-primary">
                            <i class="bi bi-calendar-plus"></i> Criar Evento
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Gráfico -->
        <div class="col-12 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Estatísticas de Eventos</h5>
                </div>
                <div class="card-body">
                    <canvas id="eventChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuração do Gráfico
    const ctx = document.getElementById('eventChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Ativos', 'Cancelados', 'Finalizados'],
            datasets: [{
                data: [12, 2, 5],
                backgroundColor: ['#4bc0c0', '#ff6384', '#36a2eb']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>

<?php include 'partials/footer.php'; ?>