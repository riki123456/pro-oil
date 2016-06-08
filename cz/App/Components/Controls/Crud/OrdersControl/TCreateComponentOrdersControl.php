<?php

namespace App\Components\Controls\Crud\OrdersControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu pageControl.
 */
trait TCreateComponentOrdersControl {

    /**
     * @var IOrdersControlFactory
     */
    protected $ordersControlFactory;

    /**
     * Injector.
     */
    public function injectOrdersControlFactory(IOrdersControlFactory $ordersControlFactory) {
        $this->ordersControlFactory = $ordersControlFactory;
    }

    /**
     * Vytvoří komponentu OrdersControl
     * @return OrdersControl
     */
    protected function createComponentOrdersControl() {
        return $this->ordersControlFactory->create();
    }

}
