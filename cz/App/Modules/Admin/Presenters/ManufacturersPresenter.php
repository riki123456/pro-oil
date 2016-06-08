<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\ManufacturersControl\TCreateComponentManufacturersControl;

class ManufacturersPresenter extends AdminPresenter {
    /**
     * Vytvoří komponentu pagesControl
     */
    use TCreateComponentManufacturersControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Manufacturers',
        'tablename' => 'vyrobce',
        'titles' => array(
            'default' => 'Správa výrobců',
            'edit' => 'Editace výrobce',
            'detail' => 'Detail výrobce',
            'add' => 'Nový výrobce',
            'delete' => 'Smazání výrobce'
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
