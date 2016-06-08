<?php

namespace App\Components\Controls\Crud\CategoriesControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu
 */
trait TCreateComponentCategoriesControl {
    /**
     * @var ICategoriesControlFactory
     */
    protected $categoriesControlFactory;

    /**
     * Injector.
     */
    public function injectCategoriesControlFactory(ICategoriesControlFactory $categoriesControlFactory) {
        $this->categoriesControlFactory = $categoriesControlFactory;
    }

    /**
     * Vytvoří komponentu
     * @return CategoriesControl
     */
    protected function createComponentCategoriesControl() {
        return $this->categoriesControlFactory->create();
    }
}
