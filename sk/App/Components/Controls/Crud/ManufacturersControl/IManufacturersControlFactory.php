<?php

namespace App\Components\Controls\Crud\ManufacturersControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface IManufacturersControlFactory {

    /** @return ManufacturersControl */
    function create();    
}
