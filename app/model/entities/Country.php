<?php 

    class CountryDTO{
        public $id;
        public $country;

        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }

        
        public function setCountry($country){
            $this->country = $country;
        }
        public function getCountry(){
            return $this->country;
        }

    }

?>