<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\TransportsControl\TCreateComponentTransportsControl;

class TransportsPresenter extends AdminPresenter {
    /**
     * Vytvoří komponentu pagesControl
     */
    use TCreateComponentTransportsControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Transports',
        'tablename' => 'transports',
        'titles' => array(
            'default' => 'Správa typů dopravy',
            'edit' => 'Editace dopravy',
            'detail' => 'Detail dopravy',
            'add' => 'Nová doprava',
            'delete' => 'Smazání dopravy'
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
