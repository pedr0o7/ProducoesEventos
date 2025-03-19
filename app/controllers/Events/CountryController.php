<?php 
    require_once '../model/DTO/CountryDTO.php';
    require_once '../model/DAO/CountryDAO.php';
    
    $country = $_POST['country'];
    // var_dump($country);
    $countryDTO = new CountryDTO();
    $countryDTO->setCountry($country);
    //teste dos dados
    // echo '<pre>';
    // var_dump($countryDTO);
    $countryDAO = new CountryDAO();
    $existingcountry = $countryDAO->findByCountry($countryDTO);
    // echo '<pre>';
    // var_dump($existingcountry);
    //existingcountryverificar se tem dados:
    if (empty($existingcountry)) { 
        $country_id = $countryDAO->cadastrarCountry($countryDTO);
    } else {
        // Acessa o primeiro registro do array e a chave "country_id"
        $country_id = $existingcountry[0]['country_id']; // <--- Corrigido para "country_id"
    }
    // echo '<pre>';
    // var_dump($country_id);
?>