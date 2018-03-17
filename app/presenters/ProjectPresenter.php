<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;


class ProjectPresenter extends Nette\Application\UI\Presenter
{
    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }

    public function renderEdit(int $projectId) {
        $this->template->project = $this->database->table('projects')->get($projectId);
    }

    public function renderNew() {
        // empty
    }

    protected function createComponentNewProjectForm() {
        // priprava dat do selectu - asi by se to spravne melo delat jinak?
        $select = [];
        $projectTypes = $this->database->table('types');
        foreach ($projectTypes as $pt) {
            $select[$pt['id']] = $pt['name'];
        }

        $form = new Form; // means Nette\Application\UI\Form

        $form->addText('name', 'Název projektu')->setRequired();
        $form->addText('deadline', 'Termín dokončení')->setRequired();
        $form->addSelect('type_id', 'Typ projektu', $select);
        $form->addCheckbox('is_web', 'Webový projekt');

        $form->addSubmit('send', 'Vytvořit projekt');

        return $form;
    }

}
