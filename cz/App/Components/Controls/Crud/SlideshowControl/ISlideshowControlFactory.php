<?php

namespace App\Components\Controls\Crud\SlideshowControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface ISlideshowControlFactory {

    /** @return SlideshowControl */
    function create();    
}
