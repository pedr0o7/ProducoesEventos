<?php 

    require_once "Conexao.php";
    require_once "../model/DTO/AddressDTO.php";
    class AddressDAO{
        //ativar conexão com banco
        //cadastrar pais
        //listar pais
        //buscar pais por nome
        public $pdo = null;

        public function __construct(){
            $this->pdo = Conexao::getInstance();
        }

        public function cadastrarAddress(AddressDTO $addressDTO){
            try{
                $sql = "INSERT INTO address (address, zip_code, city_id) VALUES (?,?,?)";
                $stmt = $this->pdo->prepare($sql);
                $address = $addressDTO->getAddress();
                $stmt->bindValue(1, $address["address"]);
                $stmt->bindValue(2, $address["zip_code"]);
                $stmt->bindValue(3, $address["city_id"]);
                $returno= $stmt->execute();
                return $returno;
            }
            catch(PDOException $e){
                echo "Erro: ".$e->getMessage();
            }
        }
            
        public function findByAddress($addressDTO) {
           try{
            $sql = "SELECT * FROM address WHERE zip_code = ? and city_id =?";
            $stmt = $this->pdo->prepare($sql);
            $address = $addressDTO->getAddress();
            $stmt->bindValue(1, $address["zip_code"]);
            $stmt->bindValue(2, $address["city_id"]);
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