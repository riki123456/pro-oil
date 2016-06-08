<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\UomControl\TCreateComponentUomControl;

class UomPresenter extends AdminPresenter {
    /**
     * Vytvoří komponentu uomControl
     */
    use TCreateComponentUomControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Uom',
        'tablename' => 'uom',
        'titles' => array(
            'default' => 'Správa měrných jednotek',
            'edit' => 'Editace měrné jednotky',
            'detail' => 'Detail měrné jednotky',
            'add' => 'Nová měrná jednotka',
            'delete' => 'Smazání měrné jednotky'
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
