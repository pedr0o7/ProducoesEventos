<?php
namespace app\models\entities;

class Registration {
    public string $name;
    public string $email;
    public string $password;
    public string $password_confirmation;
    public string $role = 'customer';
    public ?string $cpf = null;
    public ?string $cnpj = null;
    public ?string $company_name = null;

    public function validate(): array {
        $errors = [];
        
        if (empty($this->name)) {
            $errors['name'] = 'Nome é obrigatório';
        }
        
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email inválido';
        }
        
        if (strlen($this->password) < 8) {
            $errors['password'] = 'Senha deve ter no mínimo 8 caracteres';
        }
        
        if ($this->password !== $this->password_confirmation) {
            $errors['password_confirmation'] = 'Senhas não coincidem';
        }
        
        if ($this->role === 'organizer' && empty($this->cnpj)) {
            $errors['cnpj'] = 'CNPJ é obrigatório para organizadores';
        }

        return $errors;
    }
}