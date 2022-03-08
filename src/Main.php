<?php

declare(strict_types=1);

namespace App;

use App\Models\UserQuery;
use App\Validator\EmailValidator;
use App\Http\Request;
use App\Db\Connection;

class Main
{

    public static function run(): void
    {
        $request = new Request();
        $emailValidator = new EmailValidator();

        // We can use more specific REQUEST method eg $_POST/$_GET
        $masterEmail = $request->getVar('email') ?: $request->getVar('masterEmail');
        if (null === $masterEmail) {
           echo 'No master email given';
        } elseif (
            is_string($masterEmail)
            &&
            $emailValidator->validate($masterEmail) // Optional email validation, we just search for email
        ) {
            echo 'The master email is ' . $masterEmail . '<br/>';
            $connection = new Connection();
            $user = (new UserQuery($connection))->getUserByEmail($masterEmail);
            echo $user ? $user->username : 'User with given email not found';
        } else {
            print_r($emailValidator->getMessage());
        }
    }

}
