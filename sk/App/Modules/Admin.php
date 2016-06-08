<?php

namespace App\Modules;

use Nette\Application;
use Nette\Application\Routers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author miroslav.petras
 */
class Admin extends Base {
    public function setupRouter(Application\IRouter $router)
    {
        $adminRouter = new Routers\RouteList('Admin');
        $adminRouter[] = new Routers\Route('admin/<presenter>/<action>[/<id>]', 'Default:default');
        
        $router[] = $adminRouter;
    }

    /*
    public function setupPermission(SitePermission $permission)
    {
        $permission->addResource('Page');
        $permission->addPrivilege('Page', array('edit', 'create'));
    }
     */
}
