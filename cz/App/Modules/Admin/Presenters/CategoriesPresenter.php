<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\CategoriesControl\TCreateComponentCategoriesControl;

class CategoriesPresenter extends AdminPresenter
{
    /**
     * Vytvoří komponentu pagesControl
     */
    use TCreateComponentCategoriesControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Categories',
        'tablename' => 'kategorie',
        'titles' => array(
            'default' => 'Správa kategorií položek',
            'edit' => 'Editace kategorie',
            'detail' => 'Detail kategorie',
            'add' => 'Nová kategorie',
            'delete' => 'Smazání kategorie'
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
