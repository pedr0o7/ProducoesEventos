<?php
function sanitizar($dado) {
    return htmlspecialchars(strip_tags(trim($dado)));
}

function verificarAdmin() {
    if (!isset($_SESSION['admin_logado'])) {
        header('Location: /admin/login.php');
        exit();
    }
}
?>