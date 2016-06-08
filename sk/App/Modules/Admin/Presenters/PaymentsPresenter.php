<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\PaymentsControl\TCreateComponentPaymentsControl;

class PaymentsPresenter extends AdminPresenter {
    /**
     * Vytvoří komponentu pagesControl
     */
    use TCreateComponentPaymentsControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Payments',
        'tablename' => 'platba',
        'titles' => array(
            'default' => 'Správa typů plateb',
            'edit' => 'Editace platby',
            'detail' => 'Detail platby',
            'add' => 'Nová platba',
            'delete' => 'Smazání platby'
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
