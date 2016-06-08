<?php

namespace App\Modules;

use Nette;
use Nette\Application;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Base
 *
 * @author miroslav.petras
 */
abstract class Base extends Nette\Object {

    abstract public function setupRouter(Application\IRouter $router);


    //abstract public function setupPermission(SitePermission $permission);
    //public function setupHooks(SiteHooks $hooks) { }
}
