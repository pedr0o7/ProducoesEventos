<?php
require_once '../model/DTO/CountryDTO.php';
require_once '../model/DAO/CountryDAO.php';
require_once '../model/DTO/StateDTO.php';
require_once '../model/DAO/StateDAO.php';
require_once '../model/DTO/CityDTO.php';
require_once '../model/DAO/CityDAO.php';
require_once '../model/DTO/StreetDTO.php';
require_once '../model/DAO/StreetDAO.php';
require_once '../model/DTO/AddressDTO.php';
require_once '../model/DAO/AddressDAO.php';
require_once '../model/DTO/UsersDTO.php';
require_once '../model/DAO/UsersDAO.php';


// Pais
$country = $_POST['country'];
$countryDTO = new CountryDTO();
$countryDTO->setCountry($country);
$countryDAO = new CountryDAO();
$existingcountry = $countryDAO->findByCountry($countryDTO);

if (empty($existingcountry)) {
    $country_id = $countryDAO->cadastrarCountry($countryDTO);
} else {
    $country_id = $existingcountry[0]['country_id'];
}



// Estado
$state = $_POST['state'];

$stateDTO = new stateDTO();
$stateDTO->setState($state, $country_id);

$stateDAO = new stateDAO();
$existingstate = $stateDAO->findBystate($stateDTO);

if (empty($existingstate)) {
    $state_id = $stateDAO->cadastrarState($stateDTO);
} else {
    $state_id = $existingstate[0]['state_id'];
}


// Cidade
$city = $_POST['city'];
$cityDTO = new cityDTO();
$cityDTO->setcity($city, $state_id);
$cityDAO = new cityDAO();
$existingcity = $cityDAO->findBycity($cityDTO);

if (empty($existingcity)) {
    $city_id = $cityDAO->cadastrarcity($cityDTO);
} else {
    $city_id = $existingcity[0]['city_id'];

}


// Logradouro
$street = $_POST['street'];
$streetDTO = new streetDTO();
$streetDTO->setstreet($street, $city_id);
$streetDAO = new streetDAO();
$existingstreet = $streetDAO->findBystreet($streetDTO);
if (empty($existingstreet)) {
    $street_id = $streetDAO->cadastrarStreet($streetDTO);
} else {
    $street_id = $existingstreet[0]['street_id'];
}

// Endereço
$address = $_POST['location_name'];
$zip_code = $_POST['zip_code'];
$addressDTO = new addressDTO();
$addressDTO->setaddress(
    $address,
    $zip_code,
    $city_id
);
$addressDAO = new addressDAO();
$existingaddress = $addressDAO->findByaddress($addressDTO);
if (empty($existingaddress)) {
    $address_id = $addressDAO->cadastraraddress($addressDTO);
} else {
    $address_id = $existingaddress[0]['address_id'];
}


// Usuário
$name = $_POST['name'];
$email = $_POST['email'];
// $password_hash = $_POST['password'];
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];
$usersDTO = new UsersDTO();
$usersDTO->setUsers(
    $name,
    $email,
    $password_hash,
    $role,
    $address_id
);
$usersDAO = new usersDAO();
$existingusers = $usersDAO->findByusers($usersDTO);

if (empty($existingusers)) {

    $users_id = $usersDAO->cadastrarusers($usersDTO);
    //TODO
    //caso de usuario não existente criar pagina para login (redirecionar para ela)
    header('Location: ../view/login.php?status=success&email=' . urlencode($email));
    exit();
} else {
    $users_id = $existingusers[0]['user_id'];
    //TODO
    //caso de usuario ja existente criar pagina para redefinir senha (redirecionar para ela)
    header('Location: ../view/login.php?status=user_exists&email=' . urlencode($email));
    exit();
}



?>