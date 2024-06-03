<?php

namespace App;

use App\Base\BaseEntity;
use App\Contracts\IStorage;
use App\Contracts\IValidator;

class User extends BaseEntity
{
    protected ?int $id;
    protected ?string $name;
    protected ?string $surName;
    protected ?\DateTime $dateOfBirth;
    protected ?int $sex;
    protected ?string $cityOfBirth;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?string $surName = null,
        ?\DateTime $dateOfBirth = null,
        ?int $sex = null,
        ?string $cityOfBirth = null,
        ?IStorage $connection = null,
        ?IValidator $validator = null
    )
    {
        parent::__construct();
        $fields = get_defined_vars();
        if (!isset($id)){
            $this->setFileds($fields);
            return;
        }
        if (is_null($this->connection->get($id))){
            throw new \Exception('there is no such record in the database');
        }
        $dbUser = $this->connection->get($id);
        $dbUser['id'] = $id;
        $dbUser['dateOfBirth'] = new \DateTime($dbUser['dateOfBirth']);
        $this->setFileds($dbUser);
        $this->setFileds($fields);
    }

    public function setId(?int $id): self{
        $this->id = $id;
        return $this;
    }
    public function getId(): int{
        return $this->id;
    }
    public function setName(string $name): self{
        if ($this->validator->isValidName($name))
            $this->name = $name;
        else
            throw new \Exception('not valid name');
        return $this;
    }
    public function getName(): string{
        return $this->name;
    }
    public function setSurName(string $surName){
        if ($this->validator->isValidSurName($surName))
            $this->surName = $surName;
        else
            throw new \Exception('not valid surname');
        return $this;
    }
    public function getSurName(): string{
        return $this->surName;
    }
    public function setDateOfBirth(\DateTime $dateOfBirth): self{
        if ($this->validator->isValidDateOfBirth($dateOfBirth))
            $this->dateOfBirth = $dateOfBirth;
        else
            throw new \Exception('not valid date of birth');
        return $this;
    }
    public function getDateOfBirth(): \DateTime{
        return $this->dateOfBirth;
    }
    public function setSex(int $sex): self{
        if ($this->validator->isValidSex($sex))
            $this->sex = $sex;
        else
            throw new \Exception('not valid sex');
        return $this;
    }
    public function getSex(){
        return $this->sex;
    }
    public function setCityOfBirth(string $cityOfBirth): self{
        if ($this->validator->isValidCityOfBirth($cityOfBirth))
            $this->cityOfBirth = $cityOfBirth;
        else
            throw new \Exception('not valid city of birth');
        return $this;
    }
    public function saveUser(): self{
        if (isset($this->id)){
            $this->connection->update($this->id, $this->getFileds());
            return $this;
        }
        $this->id = $this->connection->create($this->getFileds());
        return $this;
    }
    public function removeUser(): self{
        $this->connection->remove($this->id);
        return $this;
    }
    public static function dateOfBirthToAge(\DateTime $dateOfBirth): string{
        return $dateOfBirth->diff(new \DateTime())->y;
    }
    public static function sexToText(int $sex): string{
        return $sex === 1 ? 'Male' : 'Female';
    }
    public function format(bool $convertAge = false, bool $convertSex =false): \stdClass{
        $fields = $this->getFileds();
        if ($convertAge){
            unset($fields['dateOfBirth']);
            $fields['age'] = $this->dateOfBirthToAge($this->dateOfBirth);
        }
        if($convertSex){
            $fields['sex'] = $this->sexToText($this->sex);
        }
        return (object)$fields;
    }
    protected function isSetField($field){
        return isset($field);
    }
    private function getFileds(){
        $fields = [];
        $fields['name'] = $this->name;
        $fields['surName'] = $this->surName;
        $fields['dateOfBirth'] = $this->dateOfBirth->format('Y-m-d');
        $fields['sex'] = $this->sex;
        $fields['cityOfBirth'] = $this->cityOfBirth;
        return $fields;
    }
    protected function setFileds(array $array): self{
        extract($array);
        if (isset($id))
            $this->setId($id);
        if (isset($name))
            $this->setName($name);
        if (isset($surName))
            $this->setSurName($surName);
        if (isset($dateOfBirth))
            $this->setDateOfBirth($dateOfBirth);
        if (isset($sex))
            $this->setSex($sex);
        if (isset($cityOfBirth))
            $this->setCityOfBirth($cityOfBirth);

        return $this;
    }

}