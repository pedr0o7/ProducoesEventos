<?php
namespace app\core;

class Router {
    private static $routes = [];
    private static $groupStack = [];
    private static $errorHandlers = [];

    // Corrigido: Parâmetros na ordem correta
    public static function group(array $options, callable $callback) {
        $prefix = $options['prefix'] ?? '';
        $middleware = $options['middleware'] ?? null;

        array_push(self::$groupStack, [
            'prefix' => $prefix,
            'middleware' => $middleware
        ]);

        $callback();

        array_pop(self::$groupStack);
    }

    private static function addRoute($method, $uri, $handler) {
        $currentGroup = end(self::$groupStack);
        $prefix = $currentGroup['prefix'] ?? '';
        
        $fullUri = $prefix . $uri;
        $fullUri = preg_replace('/\/+/', '/', $fullUri);

        self::$routes[$method][$fullUri] = [
            'handler' => $handler,
            'middleware' => $currentGroup['middleware'] ?? null
        ];
    }

    public static function get($uri, $handler) {
        self::addRoute('GET', $uri, $handler);
    }

    public static function post($uri, $handler) {
        self::addRoute('POST', $uri, $handler);
    }

    // Adicionado método error()
    public static function error($code, callable $handler) {
        self::$errorHandlers[$code] = $handler;
    }

    public static function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        foreach (self::$routes[$requestMethod] ?? [] as $pattern => $route) {
            $regex = '#^' . preg_replace('/:(\w+)/', '(?P<$1>[^/]+)', $pattern) . '$#';
            
            if (preg_match($regex, $requestUri, $matches)) {
                if ($route['middleware']) {
                    self::applyMiddleware($route['middleware']);
                }

                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                if (is_callable($route['handler'])) {
                    call_user_func_array($route['handler'], $params);
                } else {
                    list($controller, $method) = explode('@', $route['handler']);
                    self::callController($controller, $method, $params);
                }
                return;
            }
        }

        self::handleError(404);
    }

    private static function applyMiddleware($middleware) {
        // Implemente sua lógica de middleware aqui
    }

    private static function callController($controller, $method, $params) {
        $controllerClass = "app\\controller\\$controller";
        if (class_exists($controllerClass)) {
            $controllerInstance = new $controllerClass();
            if (method_exists($controllerInstance, $method)) {
                call_user_func_array([$controllerInstance, $method], $params);
                return;
            }
        }
        self::handleError(500);
    }

    private static function handleError($code) {
        if (isset(self::$errorHandlers[$code])) {
            call_user_func(self::$errorHandlers[$code]);
        } else {
            http_response_code($code);
            echo "Erro $code";
        }
        exit;
    }
}