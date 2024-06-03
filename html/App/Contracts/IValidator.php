<?php

namespace App\Contracts;

interface IValidator
{
    public function isValidName(string $name) : bool;
    public function isValidSurName(string $surName) : bool;
    public function isValidDateOfBirth(\DateTime $dateOfBirth) : bool;
    public function isValidSex(int $sex) : bool;
    public function isValidCityOfBirth(string $cityOfBirth) : bool;
}