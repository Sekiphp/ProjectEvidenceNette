<?php

namespace App\Presenters;

use Nette;


class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    /**
     * Seznam vsech projektu
     */
    public function renderDefault() {
        $this->template->projects = $this->database
            ->table('projects')
            ->order('id DESC');
    }
}
