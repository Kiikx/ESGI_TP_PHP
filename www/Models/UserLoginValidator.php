<?php

namespace App\Models;

class UserLoginValidator
{
    private Object $user;
    private string $email;
    private string $password;
    private array $errors = [];

    public function __construct(Object $user, string $email, string $password)
    {
        $this->user = $user;
        $this->email = $email;
        $this->password = $password;

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "L'email est invalide ou manquant.";
        } elseif (!$user->emailExists($email)) {
            $this->errors[] = "Aucun compte associé à cet email.";
        } elseif (!password_verify($password, $user->getPwdByEmail($email))) {
            $this->errors[] = "Le mot de passe est incorrect.";
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
