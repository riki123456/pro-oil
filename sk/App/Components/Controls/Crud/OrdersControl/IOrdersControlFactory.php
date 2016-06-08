<?php

namespace App\Components\Controls\Crud\OrdersControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface IOrdersControlFactory {

    /** @return OrdersControl */
    function create();    
}
