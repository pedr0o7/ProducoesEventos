<?php 

    require_once "Database.php";
    require_once "../model/DTO/StreetDTO.php";
    class StreetDAO{
        //ativar conexão com banco
        //cadastrar pais
        //listar pais
        //buscar pais por nome
        public $pdo = null;

        public function __construct(){
            $this->pdo = Database::getInstance();
        }

        public function cadastrarStreet(StreetDTO $streetDTO){
            try{
                $sql = "INSERT INTO street (logradouro,city_id) VALUES (?,?)";
                $stmt = $this->pdo->prepare($sql);
                $street = $streetDTO->getStreet();
                $stmt->bindValue(1, $street["logradouro"]);
                $stmt->bindValue(2, $street["city_id"]);
                $returno= $stmt->execute();
                return $returno;
            }
            catch(PDOException $e){
                echo "Erro: ".$e->getMessage();
            }
        }
            
        public function findByStreet($streetDTO) {
           try{
            $sql = "SELECT * FROM street WHERE logradouro = ? and city_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $street = $streetDTO->getStreet();
            $stmt->bindValue(1, $street["logradouro"]);
            $stmt->bindValue(2, $street["city_id"]);
            $stmt->execute();
            $returno= $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $returno;
            // $stmt->fetch(PDO::FETCH_ASSOC);
           }
           catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
             }
        }


    }


?>