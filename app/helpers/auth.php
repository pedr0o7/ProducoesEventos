<?php
use app\core\Session;

/**
 * Verifica se usuário está autenticado
 */
function isLoggedIn(): bool {
    $session = new Session();
    return $session->get('user_id') !== null;
}

/**
 * Verifica se usuário tem role específica
 */
function hasRole(string $role): bool {
    $session = new Session();
    return $session->get('user_role') === $role;
}

/**
 * Retorna dados do usuário logado
 */
function currentUser(): ?array {
    $session = new Session();
    return $session->get('user_data');
}

/**
 * Verifica se é admin
 */
function isAdmin(): bool {
    return hasRole(ROLE_ADMIN);
}

/**
 * Redireciona usuário não autenticado
 */
function guard(string $redirectTo = '/login') {
    if (!isLoggedIn()) {
        header("Location: $redirectTo");
        exit();
    }
}