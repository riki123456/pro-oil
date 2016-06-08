<?php

namespace App\Components\Controls\Crud\ContactsControl;

/**
 * Trait, který injectuje továrničku do presenteru a vytvoří komponentu
 */
trait TCreateComponentContactsControl {
    /**
     * @var IContactsControlFactory
     */
    protected $contactsControlFactory;

    /**
     * Injector.
     */
    public function injectContactsControlFactory(IContactsControlFactory $contactsControlFactory) {
        $this->contactsControlFactory = $contactsControlFactory;
    }

    /**
     * Vytvoří komponentu
     * @return ContactsControl
     */
    protected function createComponentContactsControl() {
        return $this->contactsControlFactory->create();
    }
}
