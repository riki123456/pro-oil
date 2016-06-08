<?php

namespace App\Components\Controls\Crud\ItemsControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu
 */
trait TCreateComponentItemsControl {
    /**
     * @var IItemsControlFactory
     */
    protected $itemsControlFactory;

    /**
     * Injector.
     */
    public function injectItemsControlFactory(IItemsControlFactory $itemsControlFactory) {
        $this->itemsControlFactory = $itemsControlFactory;
    }

    /**
     * Vytvoří komponentu
     * @return ItemsControl
     */
    protected function createComponentItemsControl() {
        return $this->itemsControlFactory->create();
    }
}
