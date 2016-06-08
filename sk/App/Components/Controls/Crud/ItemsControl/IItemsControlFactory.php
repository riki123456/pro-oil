<?php

namespace App\Components\Controls\Crud\ItemsControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface IItemsControlFactory {

    /** @return ItemsControl */
    function create();    
}
