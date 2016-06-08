<?php

namespace App\Components\Forms\LoginForm;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří instanci LoginForm.
 */
trait TCreateComponentLoginForm {

    /**
     * @var ILoginFormFactory
     */
    protected $loginFormFactory;

    /**
     * Injector.
     */
    public function injectLoginFormFactory(ILoginFormFactory $loginFormFactory) {
        $this->loginFormFactory = $loginFormFactory;
    }

    /**
     * Vytvoří komponentu loginForm.
     * @return LoginForm
     */
    protected function createComponentLoginForm() {
        return $this->loginFormFactory->create();
    }

}
