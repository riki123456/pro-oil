<?php

namespace App\Components\Controls\Crud\UsersControl;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Rozhranní pro generovanou továrničku.
 */
interface IUsersControlFactory {

    /** @return UsersControl */
    function create();    
}
