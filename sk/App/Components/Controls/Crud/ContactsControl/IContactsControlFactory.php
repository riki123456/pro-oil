<?php

namespace App\Components\Controls\Crud\ContactsControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface IContactsControlFactory {

    /** @return ContactsControl */
    function create();    
}
