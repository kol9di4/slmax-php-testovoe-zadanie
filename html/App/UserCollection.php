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
        $result = $this->connection->getFewRecords($comparison, $idUsers);
        if (!isset($result)) {
            throw new \Exception('no user');
        }
        foreach($result as $idUser){
            $this->userCollection[] = new User(id:$idUser);
        }
    }
    public function getUserCollection(): array{
        return $this->userCollection;
    }
    public function removeAll(): void{
        foreach($this->userCollection as $user){
            $user->removeUser();
        }
    }
}