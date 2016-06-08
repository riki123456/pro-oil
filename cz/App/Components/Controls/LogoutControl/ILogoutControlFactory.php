<?php

namespace App\Components\Controls\LogoutControl;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Rozhranní pro generovanou továrničku.
 * 
 * @author miroslav.petras
 */
interface ILogoutControlFactory {

    /** @return LogoutControl */
    function create();
}
