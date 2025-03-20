<?php
namespace app\models\entities;

class Organizer extends Users {
    // Campos específicos de organizadores (se necessário)
    public string $cnpj;
    public string $company_name;
    
    // public function __construct() {
    //     parent::__construct();
    //     $this->role = 'organizer';
    // }
}