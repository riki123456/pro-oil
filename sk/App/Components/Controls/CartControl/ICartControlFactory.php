<?php

namespace App\Components\Controls\CartControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface ICartControlFactory {

    /** @return CartControl */
    function create();    
}
