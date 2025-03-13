<?php
class UsersDTO {
    public $id;
    public $name;
    public $email;
    public $password_hash;
    public $role;
    public $address_id;
    public $token;
    public $expires_at;

    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword_hash($password_hash){
        $this->password_hash = $password_hash;
    }
    public function getPassword_hash(){
        return $this->password_hash;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setToken($token){
        $this->token = $token;
    }
    public function getToken(){
        return $this->token;
    }
    public function setExpires_at($expires_at){
        $this->expires_at = $expires_at;
    }
    public function getExpires_at(){
        return $this->expires_at;
    }
    public function setUsers($name,$email,$password_hash, $role, $address_id,$token,$expires_at){
        $this->name = $name;
        $this->email = $email;
        // $this->password_hash = password_hash($password_hash, PASSWORD_DEFAULT);
        $this->password_hash = $password_hash;
        $this->role = $role;
        $this->address_id = $address_id;
        $this->token = $token;
        $this->expires_at = $expires_at;


        

    }
    public function getUsers(){
        return [
            'name' => $this->name,
            'email' => $this->email,
            //'password_hash' => $this->password_hash($password_hash, PASSWORD_DEFAULT);
            'password_hash' => $this->password_hash,
            'role' => $this->role,
            'address_id' => $this->address_id,
            'token' => $this->token,
            'expires_at' => $this->expires_at
        ];
    }

}
?>

