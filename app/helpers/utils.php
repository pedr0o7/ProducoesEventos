<?php
use app\Config\constants;

/**
 * Formata data para padrão BR
 */
function formatDateBr(string $date): string {
    return date('d/m/Y H:i', strtotime($date));
}

/**
 * Gera URL absoluta
 */
function url(string $path = ''): string {
    return constants::BASE_URL . $path;
}

/**
 * Sanitiza input do usuário
 */
function sanitizeInput($data) {
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }
    return htmlspecialchars(trim($data));
}

/**
 * Mostra mensagens flash
 */
function flash(string $key): ?string {
    $session = new Session();
    return $session->getFlash($key);
}

/**
 * Formata preço
 */
function formatPrice(float $value): string {
    return 'R$ ' . number_format($value, 2, ',', '.');
}