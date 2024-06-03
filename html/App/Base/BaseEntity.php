<?php

namespace App\Base;

use App\Contracts\IStorage;
use App\Contracts\IValidator;
use App\DataBaseHelper;
use App\Validator;

class BaseEntity
{
    protected ?IStorage $connection;
    protected ?IValidator $validator;

    public function __construct(?IStorage $connection = null, ?IValidator $validator = null){
        $this->connection = DataBaseHelper::getInstance('db/db.json');
        $this->validator = new Validator();
        if(isset($connection)){
            $this->connection = $connection;
        }
        if(isset($validator)){
            $this->validator = $validator;
        }
    }
}