<?php

namespace App\Model;

use Nette;

class ProjectTypeManager extends BaseModel {
    use Nette\SmartObject;

    protected $tableName = 'types';

    public function __construct(Nette\Database\Context $database) {
        parent::__construct($database, $this->tableName);
    }

    public function getProjectTypes() {
        return $this->getAll()->fetchPairs('id', 'name');
    }
}