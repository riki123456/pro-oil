<?php

namespace App\Components\Controls\Crud\TransportsControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface ITransportsControlFactory {

    /** @return TransportsControl */
    function create();    
}
