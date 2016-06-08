<?php

namespace App\Components\Controls\Crud\UsersControl;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu userControl.
 */
trait TCreateComponentUsersControl {
    /**
     * @var IUsersControlFactory
     */
    protected $usersControlFactory;

    /**
     * Injector.
     */
    public function injectUsersControlFactory(IUsersControlFactory $usersControlFactory) {
        $this->usersControlFactory = $usersControlFactory;
    }

    /**
     * Vytvoří komponentu UsersControl
     * @return UsersControl
     */
    protected function createComponentUsersControl() {
        return $this->usersControlFactory->create();
    }
}
