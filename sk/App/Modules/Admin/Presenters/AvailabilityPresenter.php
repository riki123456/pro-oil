<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\AvailabilityControl\TCreateComponentAvailabilityControl;

class AvailabilityPresenter extends AdminPresenter {

    /**
     * Vytvoří komponentu AvailabilityControl
     */
    use TCreateComponentAvailabilityControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Availability',
        'tablename' => 'dostupnost',
        'titles' => array(
            'default' => 'Správa dostupnosti položek',
            'edit' => 'Editace dostupnosti',
            'detail' => 'Detail dostupnosti',
            'add' => 'Nová dostupnost',
            'delete' => 'Smazání dostupnosti'
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
