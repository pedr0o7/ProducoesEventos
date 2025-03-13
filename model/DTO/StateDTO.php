<?php 

    class StateDTO{
        public $pdo = null;
        public $id;
        public $state;
        public $country_id;

        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }

        
        public function setState($state,$country_id){
            $this->state = $state;
            $this->country_id =$country_id;
        }
        public function getState(){
            return [
                'state' => $this->state,
                'country_id' => $this->country_id
            ];
        }

    }

?>