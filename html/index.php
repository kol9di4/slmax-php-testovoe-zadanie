<?php

include_once 'ini.php';

use App\User;
use App\UserCollection;

try {
//    $user = new User(name: "Vasya",surName: 'Vasechkin',sex: 1, dateOfBirth: new DateTime('1990-01-01'),cityOfBirth: 'Minsk');
//    $user->saveUser();
//    echo User::dateOfBirthToAge($user->getDateOfBirth());
//    $user = new User(id:3, name: 'Galya',surName: 'Nadya');
//    echo $user->format(convertSex: true)->sex;
//    $user->saveUser();
//    $user->removeUser();
    $collection = new UserCollection([3,4]);
    echo '<pre>';
//    var_dump($user->format(convertSex: true)->sex);
    var_dump($collection);
    echo '</pre>';
}
catch (Exception $e) {
    echo '<pre>';
    var_dump($e->getMessage());
    echo '</pre>';
}
