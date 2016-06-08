<?php

namespace App\Components\Controls\Crud\CategoriesControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface ICategoriesControlFactory {

    /** @return CategoriesControl */
    function create();    
}
