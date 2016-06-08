<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\ItemsControl\TCreateComponentItemsControl;

class ItemsPresenter extends AdminPresenter {

    /**
     * Vytvoří komponentu pagesControl
     */
    use TCreateComponentItemsControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Items',
        'tablename' => 'polozka',
        'titles' => array(
            'default' => 'Správa položek',
            'edit' => 'Editace položky',
            'detail' => 'Detail položky',
            'add' => 'Nový položka',
            'delete' => 'Smazání položky'
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
