<?php

namespace App\Components\Controls\Crud\TransportsControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu pageControl.
 */
trait TCreateComponentTransportsControl {
    /**
     * @var ITransportsControlFactory
     */
    protected $transportsControlFactory;

    /**
     * Injector.
     */
    public function injectTransportsControlFactory(ITransportsControlFactory $transportsControlFactory) {
        $this->transportsControlFactory = $transportsControlFactory;
    }

    /**
     * Vytvoří komponentu TransportsControl
     * @return TransportsControl
     */
    protected function createComponentTransportsControl() {
        return $this->transportsControlFactory->create();
    }
}
