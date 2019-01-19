<?php

namespace App\Model;

use Nette;

abstract class BaseModel {
    use Nette\SmartObject;

    protected $database;

    protected $tableName;

    public function __construct(Nette\Database\Context $database, $tableName) {
        $this->database = $database;
        $this->tableName = $tableName;
    }

    public function getAll() {
        return $this->database->table($this->tableName);
    }

    public function getById(int $id) {
        return $this->database->table($this->tableName)->get($id);
    }

}