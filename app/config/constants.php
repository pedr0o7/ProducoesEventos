<?php
// app/Config/constants.php

// Garante que o arquivo só seja incluído uma vez
if (!defined('CONSTANTS_LOADED')) {
    define('CONSTANTS_LOADED', true);

    // 1. Diretórios Base
    define('BASE_PATH', dirname(__DIR__, 2) . '/');          // Raiz do projeto
    define('APP_PATH', BASE_PATH . 'app/');
    define('VIEWS_PATH', BASE_PATH . 'views/');
    define('PUBLIC_PATH', BASE_PATH . 'public/');
    define('STORAGE_PATH', BASE_PATH . 'storage/');

    // 2. Configurações de Ambiente
    define('APP_ENV', getenv('APP_ENV') ?: 'production');
    define('BASE_URL', getenv('BASE_URL') ?: 'http://localhost:8000');

    // 3. Segurança
    define('SESSION_NAME', 'eventos_session');
    define('SESSION_LIFETIME', 86400); // 24 horas
    define('CSRF_TOKEN_EXPIRATION', 3600); // 1 hora

    // 4. Papéis de Usuário
    define('ROLE_ADMIN', 'admin');
    define('ROLE_ORGANIZER', 'organizer');
    define('ROLE_CUSTOMER', 'customer');

    // 5. Mensagens de Erro
    define('ERROR_404_TITLE', 'Página Não Encontrada');
    define('ERROR_404_MESSAGE', 'A página que você está procurando não existe.');
    define('ERROR_500_TITLE', 'Erro Interno');
    define('ERROR_500_MESSAGE', 'Algo deu errado. Nossa equipe foi notificada.');

    // 6. Configurações do Banco de Dados (para uso em Database.php)
    define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
    define('DB_NAME', getenv('DB_NAME') ?: 'producoes_eventos');
    define('DB_USER', getenv('DB_USER') ?: 'root');
    define('DB_PASS', getenv('DB_PASS') ?: '');

    // 7. Paginação
    define('ITEMS_PER_PAGE', 15);
    define('MAX_PAGINATION_LINKS', 5);

    // 8. Uploads
    define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
    define('ALLOWED_FILE_TYPES', serialize([
        'image/jpeg',
        'image/png',
        'application/pdf'
    ]));
}