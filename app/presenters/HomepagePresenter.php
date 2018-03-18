<?php

namespace App\Presenters;

use Nette;
use App\Model\ProjectManager;


class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private $projectManager;

    public function __construct(ProjectManager $projectManager) {
        $this->projectManager = $projectManager;
    }

    /**
     * Seznam vsech projektu
     */
    public function renderDefault() {
        $this->template->projects = $this->projectManager->getAllProjects();
    }
}
