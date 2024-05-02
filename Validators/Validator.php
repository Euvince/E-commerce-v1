<?php

namespace Validators;

use Valitron\Validator as ValitronValidator;

class Validator 
{
    private $v;

    public function __construct(array $data)
    {
        ValitronValidator::lang('fr');
        $this->v = new ValitronValidator($data);
        $this->v->rule('required', ['username', 'mail', 'password']);
        $this->v->rule('lengthBetween', 'username', 4, 12);
        $this->v->rule('email', 'mail');
        $this->v->rule('lengthMin', 'password', 6);
        $this->v->labels([
            'username'    => 'Le Nom d\'Utilisateur',
            'mail' => 'L\'Email',
            'password'    => 'Le Mot de Passe',
        ]);
    }

    public function validate (): bool
    {
        return $this->v->validate();
    }

    public function errors (): array
    {
        return $this->v->errors();
    }

    public function getInputClass (string $key, array $errors): ?string
    {
        $inputClass = "form-control";
        if (array_key_exists($key, $errors)){
           return $inputClass .= " is-invalid";
        }
        return $inputClass;
    }

    public function getErrorFeedback (string $key, array $errors): ?string 
    {
        if (array_key_exists($key, $errors)){
            if (is_array($errors[$key])){
                return '<div class="invalid-feedback">' .implode('<br>', $errors[$key]). '</div>';
            }
         }
         return '';
    }

}