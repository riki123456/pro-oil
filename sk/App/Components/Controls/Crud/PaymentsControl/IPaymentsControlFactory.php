<?php

namespace App\Components\Controls\Crud\PaymentsControl;

/**
 * Rozhranní pro generovanou továrničku.
 */
interface IPaymentsControlFactory {

    /** @return PaymentsControl */
    function create();    
}
