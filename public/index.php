<?php include 'includes/header.php'; ?>

<main class="container">
    <h2 class="my-4">Eventos em Destaque</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- Imagem padrão -->
                <img src="public/img/images.jpg" class="card-img-top" alt="FESTA">
                <div class="card-body">
                    <!-- Título padrão -->
                    <h5 class="card-title">FESTA</h5>
                    <!-- Data e hora padrão -->
                    <p class="card-text"><?= date('d/m/Y H:i', strtotime('2025-02-19 23:00')) ?></p>
                    <!-- Link para detalhes (pode ser ajustado) -->
                    <a href="evento-detalhes.php?id=0" class="btn btn-primary">Comprar Ingresso</a>
                </div>
            </div>
        </div>
        <!-- TO DO -->
        <?php 
        include 'includes/config.php';

        $sql = "SELECT * FROM eventos ORDER BY data_evento DESC LIMIT 6";
        $result = $conn->query(query: $sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()):
        ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="<?= $row['imagem'] ?>" class="card-img-top" alt="<?= $row['titulo'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['titulo'] ?></h5>
                    <p class="card-text"><?= date('d/m/Y H:i', strtotime($row['data_evento'])) ?></p>
                    <a href="evento-detalhes.php?id=<?= $row['id'] ?>" class="btn btn-primary">Comprar Ingresso</a>
                </div>
            </div>
        </div>
        <?php
            endwhile;
        } else {
            // Exibe o evento padrão caso não haja registros no banco de dados
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">

                    <img src="public/img/images.jpg" class="card-img-top" alt="FESTA">
                    <div class="card-body">
 
                        <h5 class="card-title">FESTA</h5>
           
                        <p class="card-text"><?= date('d/m/Y H:i', strtotime('2025-02-19 23:00')) ?></p>
             
                        <a href="evento-detalhes.php?id=0" class="btn btn-primary">Comprar Ingresso</a>
                    </div>
                </div>
            </div>
         <?php
        }
        ?>  
    </div>
</main>

<?php include 'includes/footer.php'; ?>