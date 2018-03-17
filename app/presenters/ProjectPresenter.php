<?php

namespace App\Presenters;

use Nette;


class ProjectPresenter extends Nette\Application\UI\Presenter
{
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    public function renderEdit(int $projectId) {
        $this->template->project = $this->database->table('projects')->get($projectId);
    }

}
