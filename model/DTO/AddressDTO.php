<?php 

    class AddressDTO{
        public $id;
        public $address;
        public $city_id;
        public $zip_code;

        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }

        
        public function setAddress($address,$zip_code,$city_id){
            $this->address = $address;
            $this->zip_code = $zip_code;
            $this->city_id = $city_id;

        }
        public function getAddress(){
            return [
                'address' => $this->address,
                'zip_code' => $this->zip_code,
                'city_id' => $this->city_id
            ];
        }
    }

?>