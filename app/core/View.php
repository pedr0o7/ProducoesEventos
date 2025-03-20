<?php
namespace app\core;

use app\config\constants;

class View {
    private static $layout = 'main';
    private static $sections = [];
    private static $currentSection;

    public static function render(string $view, array $data = []) {
        extract($data);
        ob_start();
        
        // Carrega o arquivo da view
        $viewPath = self::getViewPath($view);
        if (!file_exists($viewPath)) {
            throw new \Exception("View {$view} não encontrada");
        }
        require $viewPath;
        $content = ob_get_clean();

        // Aplica o layout
        $layoutPath = self::getLayoutPath();
        if ($layoutPath) {
            require $layoutPath;
        } else {
            echo $content;
        }
    }

    public static function layout(string $layout) {
        self::$layout = $layout;
    }

    public static function section(string $name) {
        self::$currentSection = $name;
        ob_start();
    }

    public static function endSection() {
        $content = ob_get_clean();
        self::$sections[self::$currentSection] = $content;
        self::$currentSection = null;
    }

    public static function yield(string $sectionName) {
        echo self::$sections[$sectionName] ?? '';
    }

    public static function escape($value) {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    private static function getViewPath(string $view): string {
        return constants::VIEWS_PATH . str_replace('.', '/', $view) . '.php';
    }

    private static function getLayoutPath(): ?string {
        $layoutFile = constants::VIEWS_PATH . 'layouts/' . self::$layout . '.php';
        return file_exists($layoutFile) ? $layoutFile : null;
    }

    public static function component(string $component, array $data = []) {
        $componentPath = constants::VIEWS_PATH . 'components/' . $component . '.php';
        if (file_exists($componentPath)) {
            extract($data);
            require $componentPath;
        }
    }
}