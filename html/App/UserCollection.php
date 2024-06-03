<?php

namespace App;

use App\Contracts\IStorage;
use App\Enums\Comparison;
use App\User;
use App\DataBaseHelper;

class UserCollection
{
    protected array $userCollection;
    protected IStorage $connection;
    public function __construct(array $idUsers, Comparison $comparison = Comparison::Equals, ?IStorage $connection = null)
    {
        $this->connection = DataBaseHelper::getInstance('db/db.json');
        if(isset($connection)){
            $this->connection = $connection;
        }
        if ($comparison === Comparison::Equals) {
            $this->userCollection = $this->connection->getFewRecords($idUsers);
        }
    }    

}