<?php

namespace App;

use App\Contracts\IValidator;

class Validator implements IValidator
{
    public function isValidName(string $name) : bool{
        return !preg_match('~[0-9]+~',$name);
    }
    public function isValidSurName(string $surName) : bool{
        return !preg_match('~[0-9]+~',$surName);
    }
    public function isValidDateOfBirth(\DateTime $dateOfBirth) : bool{
        //date validator logic
        return true;
    }
    public function isValidSex(int $sex) : bool{
        return ($sex === 0 || $sex === 1);
    }
    public function isValidCityOfBirth(string $cityOfBirth) : bool{
        //check existing city
        return true;
    }
}