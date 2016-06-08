<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\PagesControl\TCreateComponentPagesControl;

class PagesPresenter extends AdminPresenter {

    /**
     * Vytvoří komponentu pagesControl
     */
    use TCreateComponentPagesControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Pages',
        'tablename' => 'pages',
        'titles' => array(
            'default' => 'Správa webových stránek',
            'edit' => 'Editace stránky',
            'detail' => 'Detail stránky',
            'add' => 'Nová stránka',
            'delete' => 'Smazání stránky'
        )
    );

    /**
     * Dokonceni zpracování page formuláře (vola se z komponenty).
     * 
     * @param UI\Form $form argumenty predane metoda z komponenty
     */
    public function successForm(\Nette\Application\UI\Form $form) {
        if ($form->isSubmitted()) {
            $this->redirect('default');
        }

        /*
          if ($this->presenter->isAjax()) {
          $this->presenter->redrawControl('flash');
          $this->presenter->redrawControl('content');
          } else {
          $this->presenter->redirect('default');
          }
         * 
         */
    }

}
