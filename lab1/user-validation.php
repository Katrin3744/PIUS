<?php
require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\Validator\Validation;

require 'User.php';

$validator = Validation::createValidatorBuilder()->addMethodMapping('loadValidatorMetadata')->getValidator();

function showValidity(User $user): void {
    global $validator;

    $errors = $validator->validate($user);

    if (0 < count($errors)) {
        echo "User is invalid!<br>";
        foreach ($errors as $error) {
            echo $error->getMessage().'<br>';
        }

        echo '<hr>';
    }
    else {
        echo "User is valid!<br><hr>";
    }
}

$validUser = new User(1, "uservalid", "user@valid.ru", "passwordvalid");
showValidity($validUser);

$invalidIdUser = new User(-1, "userinvalidid", "user@invalidid.ru", "passwordinvalidid");
showValidity($invalidIdUser);

$invalidPasswordUser = new User(2, "userinvalidpass", "user@invalidpass.ru", "1");
showValidity($invalidPasswordUser);

$invalidEmailUser = new User(3, "userinvalidemail", "userinvalidemail", "invalidemail");
showValidity($invalidEmailUser);

$completelyInvalidUser = new User(-1, "in",  "inv", "inv");
showValidity($completelyInvalidUser);
