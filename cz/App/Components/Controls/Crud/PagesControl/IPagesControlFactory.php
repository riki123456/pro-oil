<?php

namespace App\Components\Controls\Crud\PagesControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface IPagesControlFactory {

    /** @return PagesControl */
    function create();    
}
