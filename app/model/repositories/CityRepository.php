<?php 

    require_once "Database.php";
    require_once "../model/DTO/CityDTO.php";
    class CityDAO{
        //ativar conexão com banco
        //cadastrar pais
        //listar pais
        //buscar pais por nome
        public $pdo = null;

        public function __construct(){
            $this->pdo = Database::getInstance();
        }

        public function cadastrarCity(CityDTO $cityDTO){
            try{
                $sql = "INSERT INTO city (city, state_id) VALUES (?,?)";
                $stmt = $this->pdo->prepare($sql);
                $city = $cityDTO->getCity();
                $stmt->bindValue(1, $city["city"]);
                $stmt->bindValue(2, $city["state_id"]);
                $returno= $stmt->execute();
                return $returno;
            }
            catch(PDOException $e){
                echo "Erro: ".$e->getMessage();
            }
        }
            
        public function findByCity($cityDTO) {
           try{
            $sql = "SELECT * FROM city WHERE city = ? and state_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $city = $cityDTO->getCity();
            $stmt->bindValue(1, $city["city"]);
            $stmt->bindValue(2, $city["state_id"]);
            $stmt->execute();
            $returno= $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $returno;

           }
           catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
             }
        }


    }


?>