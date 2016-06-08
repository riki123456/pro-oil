<?php

namespace App\Components\Controls\Crud\PagesControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu pageControl.
 */
trait TCreateComponentPagesControl {
    /**
     * @var IPagesControlFactory
     */
    protected $pagesControlFactory;

    /**
     * Injector.
     */
    public function injectPagesControlFactory(IPagesControlFactory $pagesControlFactory) {
        $this->pagesControlFactory = $pagesControlFactory;
    }

    /**
     * Vytvoří komponentu PagesControl
     * @return PagesControl
     */
    protected function createComponentPagesControl() {
        return $this->pagesControlFactory->create();
    }
}
