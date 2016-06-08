<?php

namespace App\Components\Controls\Crud\UomControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu UomControl.
 */
trait TCreateComponentUomControl {
    /**
     * @var IUomControlFactory
     */
    protected $uomControlFactory;

    /**
     * Injector.
     */
    public function injectUomControlFactory(IUomControlFactory $uomControlFactory) {
        $this->uomControlFactory = $uomControlFactory;
    }

    /**
     * Vytvoří komponentu UomControl
     * @return UomControl
     */
    protected function createComponentUomControl() {
        return $this->uomControlFactory->create();
    }
}
