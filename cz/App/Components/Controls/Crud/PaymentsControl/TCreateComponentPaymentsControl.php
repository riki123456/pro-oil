<?php

namespace App\Components\Controls\Crud\PaymentsControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu pageControl.
 */
trait TCreateComponentPaymentsControl {
    /**
     * @var IPaymentsControlFactory
     */
    protected $paymentsControlFactory;

    /**
     * Injector.
     */
    public function injectPaymentsControlFactory(IPaymentsControlFactory $paymentsControlFactory) {
        $this->paymentsControlFactory = $paymentsControlFactory;
    }

    /**
     * Vytvoří komponentu PaymentsControl
     * @return PaymentsControl
     */
    protected function createComponentPaymentsControl() {
        return $this->paymentsControlFactory->create();
    }
}
