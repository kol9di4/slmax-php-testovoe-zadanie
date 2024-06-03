<?php

include_once 'ini.php';

use App\DataBaseHelper;
use App\User;

try {
//    $user = new User(name: "Vasya",surName: 'Vasechkin',sex: 1, dateOfBirth: new DateTime('1990-01-01'),cityOfBirth: 'Minsk');
//    $user->saveUser();
//    echo User::dateOfBirthToAge($user->getDateOfBirth());
    $user = new User(id:3, name: 'Galya',surName: 'Nadya');
//    echo $user->format(convertSex: true)->sex;
//    $user->saveUser();
//    $user->removeUser();
    echo '<pre>';
    var_dump($user->format(convertSex: true)->sex);
    echo '</pre>';
}
catch (Exception $e) {
    echo '<pre>';
    var_dump($e->getMessage());
    echo '</pre>';
}
