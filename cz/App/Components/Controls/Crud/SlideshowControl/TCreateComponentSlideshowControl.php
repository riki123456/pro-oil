<?php

namespace App\Components\Controls\Crud\SlideshowControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu
 */
trait TCreateComponentSlideshowControl {
    /**
     * @var ISlideshowControlFactory
     */
    protected $slideshowControlFactory;

    /**
     * Injector.
     */
    public function injectSlideshowControlFactory(ISlideshowControlFactory $slideshowControlFactory) {
        $this->slideshowControlFactory = $slideshowControlFactory;
    }

    /**
     * Vytvoří komponentu
     * @return SlideshowControl
     */
    protected function createComponentSlideshowControl() {
        return $this->slideshowControlFactory->create();
    }
}
