<?php 

    require_once "Database.php";
    require_once "../model/DTO/CountryDTO.php";
    class CountryDAO{
        //ativar conexão com banco
        //cadastrar pais
        //listar pais
        //buscar pais por nome
        public $pdo = null;

        public function __construct(){
            $this->pdo = Database::getInstance();
        }

        public function cadastrarCountry(CountryDTO $countryDTO){
            try{
                $sql = "INSERT INTO country (country) VALUES (?)";
                $stmt = $this->pdo->prepare(query: $sql);
                $country = $countryDTO->getCountry();
                $stmt->bindValue(1, $country);
                $returno= $stmt->execute();
                return $returno;
            }
            catch(PDOException $e){
                echo "Erro: ".$e->getMessage();
            }
        }
            
        public function findByCountry($countryDTO) {
           try{

            $sql = "SELECT * FROM country WHERE country = ?";
            $stmt = $this->pdo->prepare($sql);
            
            $country = $countryDTO->getCountry();
            
            $stmt->bindValue(1, $country);
            $stmt->execute();
            //$returno= $stmt->execute();
            $returno= $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $returno;
            
           }
           catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
             }
        }


    }


?>