<?php

declare(strict_types=1);

namespace App\Validator;

class EmailValidator {

    public function validate(string $email): bool
    {
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function getMessage(): string
    {
        return 'Invalid email address';
    }

}
