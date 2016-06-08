<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\UsersControl\TCreateComponentUsersControl;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersPresenter
 *
 * @author miroslav.petras
 */
class UsersPresenter extends AdminPresenter {

    /**
     * Vytvoří komponentu usersControl
     */
    use TCreateComponentUsersControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Users',
        'tablename' => 'users',
        'titles' => array(
            'default' => 'Správa uživatelů',
            'edit' => 'Editace uživatele',
            'detail' => 'Detail uživatele',
            'add' => 'Nový uživatel',
            'delete' => 'Smazání uživatele',
            'passw' => 'Změna hesla'
        )
    );

    /**
     * editace hesla uzivatele
     * 
     * @param type $id id uzivatele, ktereho editujeme
     */
    public function renderPassw($id) {
        parent::renderEdit($id);
    }

    /**
     * Dokonceni zpracování user formuláře (vola se z komponenty).
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
