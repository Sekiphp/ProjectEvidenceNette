<?php

namespace App\Model;

use Nette;

class ProjectTypeManager {
    use Nette\SmartObject;

    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }


    public function getProjectTypes() {
        return $this->database->table('types')->fetchPairs('id', 'name');
    }
}