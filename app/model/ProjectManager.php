<?php

namespace App\Model;

use Nette;

class ProjectManager {
    use Nette\SmartObject;

    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    public function getAllProjects() {
        return $this->database->table('projects')->order('id DESC');
    }

    public function getProjectTypes() {
        return $this->database->table('types')->fetchPairs('id', 'name');
    }

    public function getProject(int $projectId) {
        return $this->database->table('projects')->get($projectId);
    }

    public function createProject(array $values) {
        return $this->database->table('projects')->insert($values);
    }

    public function deleteProjectById(int $projectId) {
        return $this->database->table('projects')->where('id', $projectId)->delete();
    }
}