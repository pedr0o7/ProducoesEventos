<?php
namespace app\core;

class Validator {
    private $errors = [];

    public function validate(array $data, array $rules) {
        foreach ($rules as $field => $validations) {
            $value = $data[$field] ?? null;
            
            foreach (explode('|', $validations) as $validation) {
                $params = [];
                
                if (strpos($validation, ':') !== false) {
                    [$validation, $paramStr] = explode(':', $validation, 2);
                    $params = explode(',', $paramStr);
                }

                $methodName = "validate" . ucfirst($validation);
                
                if (!method_exists($this, $methodName)) {
                    throw new \Exception("Validation rule $validation não existe");
                }

                if (!$this->$methodName($value, ...$params)) {
                    $this->addError($field, $validation, $params);
                    break;
                }
            }
        }
        
        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    private function addError($field, $rule, $params) {
        $messages = [
            'required' => 'O campo {field} é obrigatório',
            'email' => 'Email inválido',
            'min' => 'Mínimo de {param} caracteres',
            'max' => 'Máximo de {param} caracteres',
            'match' => 'Os campos não coincidem'
        ];

        $message = str_replace(
            ['{field}', '{param}'],
            [ucfirst($field), $params[0] ?? ''],
            $messages[$rule] ?? 'Erro de validação'
        );

        $this->errors[$field][] = $message;
    }

    // Métodos de Validação
    private function validateRequired($value) {
        return !empty($value) || $value === '0';
    }

    private function validateEmail($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    private function validateMin($value, $min) {
        return strlen(trim($value)) >= (int)$min;
    }

    private function validateMax($value, $max) {
        return strlen(trim($value)) <= (int)$max;
    }

    private function validateMatch($value, $fieldToMatch) {
        return $value === ($_REQUEST[$fieldToMatch] ?? null);
    }
}