<?php

namespace App\Components\Controls\Crud\AvailabilityControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu
 */
trait TCreateComponentAvailabilityControl {
    /**
     * @var IAvailabilityControlFactory
     */
    protected $availabilityControlFactory;

    /**
     * Injector.
     */
    public function injectAvailabilityControlFactory(IAvailabilityControlFactory $availabilityControlFactory) {
        $this->availabilityControlFactory = $availabilityControlFactory;
    }

    /**
     * Vytvoří komponentu
     * @return AvailabilityControl
     */
    protected function createComponentAvailabilityControl() {
        return $this->availabilityControlFactory->create();
    }
}
