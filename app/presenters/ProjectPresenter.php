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

    /**
     *
     * @param  int $projectId
     */
    public function renderEdit(int $projectId) {
        // empty
    }

    /**
     * Novy projekt - data do sablony
     */
    public function renderNew() {
        // empty
    }

    /**
     * Formular pro novy projekt
     *
     * @return Nette\Application\UI\Form
     */
    protected function createComponentProjectForm() {
        // priprava dat do selectu
        $projectTypes = $this->database->table('types')->fetchPairs('id', 'name');

        $form = new Form; // means Nette\Application\UI\Form

        $form->addText('name', 'Název projektu')->setRequired();
        $form->addText('deadline', 'Termín dokončení')->setHtmlType('date')->setRequired();
        $form->addSelect('type_id', 'Typ projektu', $projectTypes);
        $form->addCheckbox('is_web', 'Webový projekt');

        $form->addSubmit('send', 'Uložit projekt');
        $form->onSuccess[] = [$this, 'postProjectFormSucceeded'];

        return $form;
    }

    /**
     * Odeslani formulare - novy projekt
     *
     * @param  $form
     * @param  Object $values
     */
    public function postProjectFormSucceeded($form, $values) {
        $projectId = $this->getParameter('projectId');

        if ($projectId) {
            // budeme upravovat
            $post = $this->database->table('projects')->get($projectId);
            $post->update($values);

            $this->flashMessage('Projekt byl úspěšně upraven', 'success');
        }
        else {
            $this->database->table('projects')->insert([
                'name' => $values->name,
                'deadline' => $values->deadline,
                'type_id' => $values->type_id,
                'is_web' => $values->is_web,
            ]);

            $this->flashMessage('Projekt byl úspěšně vytvořen', 'success');
        }

        $this->redirect('this');
    }

    /**
     * Smazani projektu
     *
     * @param  int $projectId
     */
    public function actionDelete(int $projectId) {
        $bool = $this->database->table('projects')->where('id', $projectId)->delete();

        if ($bool) {
            $this->flashMessage('Projekt byl úspěšně smazán', 'success');
        }
        else {
            $this->flashMessage('Projekt nebyl nalezen!', 'warning');
        }

        $this->redirect('Homepage:default');
    }

    /**
     * Editace projektu
     *
     * @param  int $projectId
     */
    public function actionEdit(int $projectId) {
        $project = $this->database->table('projects')->get($projectId);
        $this->template->project = $project;

        if (!$project) {
            $this->error("Projekt {$projectId} nebyl nalezen");
        }

        // default hodnota v input type=date
        $proj = $project->toArray();
        $proj['deadline'] = (string)$proj['deadline']->format("Y-m-d");

        $this['projectForm']->setDefaults($proj);
    }

}
