<?php
include '../includes/config.php';
verificarAdmin();

$stmt = $conn->prepare("SELECT * FROM eventos ORDER BY data_evento DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include '../includes/header.php'; ?>
<div class="container mt-4">
    <h2>Eventos Cadastrados</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while($evento = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $evento['titulo'] ?></td>
                <td><?= date('d/m/Y H:i', strtotime($evento['data_evento'])) ?></td>
                <td>
                    <a href="eventos-editar.php?id=<?= $evento['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="eventos-excluir.php?id=<?= $evento['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir evento?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include '../includes/footer.php'; ?>