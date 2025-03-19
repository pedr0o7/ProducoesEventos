<?php 

    class CityDTO{
        public $pdo = null;
        private $id;
        private $city;
        private $state_id;

        public function setId($id){
            $this->id = $id;
            
        }
        public function getId(){
            return $this->id;
        }

        
        public function setCity($city,$state_id){
            $this->city = $city;
            $this->state_id =$state_id;
        }
        public function getCity(){
            return [
                'city' => $this->city,
                'state_id' => $this->state_id
            ];
        }

        public function findByCity($city){
                    $sql = "SELECT * FROM city WHERE city = ?";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute([$city]);                    
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }
    }

?>