<?php 
class Database {
    private static $pdo;

    private function __construct() { }

    public static function getInstance() {
        if(!isset(self::$pdo)) {
            try {
                $options = array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', // CORREÇÃO AQUI (removi ; e corrigi NAME para NAMES)
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );
                
                self::$pdo = new PDO(
                    'mysql:host=localhost;dbname=producoes_eventos;charset=utf8', // Adicionei charset
                    'root',
                    '',
                    $options
                );

            } catch(PDOException $e) {
                echo 'Erro ao conectar: ' . $e->getMessage();
                die();
            }
        }
        return self::$pdo;
    }
}
?>