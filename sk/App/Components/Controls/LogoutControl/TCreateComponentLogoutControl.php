<?php

namespace App\Components\Controls\LogoutControl;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu logoutControl.
 */
trait TCreateComponentLogoutControl {

    /**
     * @var ILogoutControlFactory
     */
    protected $logoutControlFactory;

    /**
     * Injector.
     */
    public function injectLogoutControlFactory(ILogoutControlFactory $logoutControlFactory) {
        $this->logoutControlFactory = $logoutControlFactory;
    }

    /**
     * Vytvoří komponentu logoutControl
     * @return LogoutControl
     */
    protected function createComponentLogoutControl() {
        return $this->logoutControlFactory->create();
    }

}
