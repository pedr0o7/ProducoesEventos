<?php 

    require_once "Database.php";
    require_once "../model/DTO/StateDTO.php";
    class StateDAO{
        //ativar conexão com banco
        //cadastrar pais
        //listar pais
        //buscar pais por nome
        public $pdo = null;

        public function __construct(){
            $this->pdo = Database::getInstance();
        }

        public function cadastrarState(StateDTO $stateDTO){
            try{
                $sql = "INSERT INTO state (state, country_id) VALUES (?,?)";
                $stmt = $this->pdo->prepare($sql);
                $state = $stateDTO->getState();
                
                $stmt->bindValue(1, $state["state"]);
                $stmt->bindValue(2, $state["country_id"]);
                $returno= $stmt->execute();
                return $returno;
            }
            catch(PDOException $e){
                echo "Erro: ".$e->getMessage();
            }
        }
            
        public function findByState($stateDTO) {
           try{
            $sql = "SELECT * FROM state WHERE state = ? and country_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $state = $stateDTO->getState();
            $stmt->bindValue(1, $state["state"]);
            $stmt->bindValue(2, $state["country_id"]);
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