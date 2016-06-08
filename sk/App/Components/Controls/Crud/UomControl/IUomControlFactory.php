<?php

namespace App\Components\Controls\Crud\UomControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface IUomControlFactory {

    /** @return UomControl */
    function create();    
}
