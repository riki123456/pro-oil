<?php

namespace App\Components\Controls\Crud\ManufacturersControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu pageControl.
 */
trait TCreateComponentManufacturersControl {
    /**
     * @var IManufacturersControlFactory
     */
    protected $manufacturersControlFactory;

    /**
     * Injector.
     */
    public function injectManufacturersControlFactory(IManufacturersControlFactory $manufacturersControlFactory) {
        $this->manufacturersControlFactory = $manufacturersControlFactory;
    }

    /**
     * Vytvoří komponentu ManufacturersControl
     * @return ManufacturersControl
     */
    protected function createComponentManufacturersControl() {
        return $this->manufacturersControlFactory->create();
    }
}
