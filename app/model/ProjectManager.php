<?php

namespace App\Model;

use Nette;

class ProjectManager extends BaseModel {
    use Nette\SmartObject;

    protected $tableName = 'projects';

    public function __construct(Nette\Database\Context $database) {
        parent::__construct($database, $this->tableName);
    }

    public function createProject(array $values) {
        return $this->database->table($this->tableName)->insert($values);
    }

    public function deleteProjectById(int $projectId) {
        return $this->database->table($this->tableName)->where('id', $projectId)->delete();
    }
}