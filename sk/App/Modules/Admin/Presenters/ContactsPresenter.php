<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\ContactsControl\TCreateComponentContactsControl;

class ContactsPresenter extends AdminPresenter {
    /**
     * Vytvoří komponentu pagesControl
     */
    use TCreateComponentContactsControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Contacts',
        'tablename' => 'kontakty',
        'titles' => array(
            'default' => 'Správa kontaktů',
            'edit' => 'Editace kontaktu',
            'detail' => 'Detail kontaktu',
            'add' => 'Nový kontakt',
            'delete' => 'Smazání kontaktu'
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
