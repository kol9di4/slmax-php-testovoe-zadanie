<?php

namespace App\Contracts;

interface IStorage
{
    public function create(array $fields) : int;
    public function get(int $id) : ?array;
    public function remove(int $id) : bool;
    public function update(int $id, array $fields) : bool;
    public function getRecords() : ?array;
    public function getFewRecords(array $idUsers) : ?array;
}