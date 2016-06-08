<?php

namespace App\Components\Controls\Crud\AvailabilityControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface IAvailabilityControlFactory {

    /** @return AvailabilityControl */
    function create();    
}
