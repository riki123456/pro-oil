<?php

namespace App\Components\Controls\CartControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu
 */
trait TCreateComponentCartControl {
    /**
     * @var ICategoriesControlFactory
     */
    protected $cartControlFactory;

    /**
     * Injector.
     */
    public function injectCartControlFactory(ICartControlFactory $cartControlFactory) {
        $this->cartControlFactory = $cartControlFactory;
    }

    /**
     * Vytvoří komponentu
     * @return CategoriesControl
     */
    protected function createComponentCartControl() {
        return $this->cartControlFactory->create();
    }
}
