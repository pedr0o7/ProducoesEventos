<?php 

    class StreetDTO{
        public $id;
        public $logradouro;
        public $city_id;

        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }

        
        public function setStreet($logradouro,$city_id){
            $this->logradouro = $logradouro;
            $this->city_id = $city_id;
        }
        public function getStreet(){
            return [
                'logradouro' => $this->logradouro,
                'city_id' => $this->city_id
            ];
        }

    }

?>