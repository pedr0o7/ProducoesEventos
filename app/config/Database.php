<?php 

    class Database{
        //atributo
        private static $pdo;
        private function __construct(){
            //metodo construtor
        }
        public static function getInstance(){
            if(!isset(self::$pdo)){
                try{
                    //criando a conexão com o banco de dados
                    $options = array(
                        PDO::ATTR_PERSISTENT => true,
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAME UTF8;',
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    );
                    self::$pdo = new PDO('mysql:host=localhost;dbname=producoes_eventos','root','');
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                }catch(PDOException $exe){
                    echo 'Erro ao conectar com o banco de dados: '. $exe->getMessage();
                    die();
                }
                
            }
            return self::$pdo;
        }
    }
?>