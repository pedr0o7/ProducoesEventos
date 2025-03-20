<?php
namespace app\core;

class Router {
    private static $routes = [];
    private static $groupOptions = [];

    public static function get($uri, $action) {
        self::addRoute('GET', $uri, $action);
    }

    public static function post($uri, $action) {
        self::addRoute('POST', $uri, $action);
    }

    private static function addRoute($method, $uri, $action) {
        $prefix = self::$groupOptions['prefix'] ?? '';
        $middleware = self::$groupOptions['middleware'] ?? null;
        
        self::$routes[] = [
            'method' => $method,
            'uri' => $prefix . $uri,
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    public static function group($options, $callback) {
        $previousOptions = self::$groupOptions;
        self::$groupOptions = array_merge($previousOptions, $options);
        $callback();
        self::$groupOptions = $previousOptions;
    }

    public static function error($code, $handler) {
        // Implementação de tratamento de erros
    }

    public static function put($uri, $action) {
        self::addRoute('PUT', $uri, $action);
    }

    // Atualizar método dispatch para processar PUT
    public static function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Para suportar method spoofing
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }

        foreach (self::$routes as $route) {
            // ... (lógica de matching existente)
        }
    }
}