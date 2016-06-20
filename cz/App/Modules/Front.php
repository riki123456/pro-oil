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
 * Description of Front
 *
 * @author miroslav.petras
 */
class Front extends Base {

    public function setupRouter(Application\IRouter $router) {
        $frontRouter = new Routers\RouteList('Front');
        $frontRouter[] = new Routers\Route('index.php', 'Default:default', Routers\Route::ONE_WAY);
        
        #-- csob return url
        $frontRouter[] = new Routers\Route('csob-return', array('presenter'=>'Default', 'action'=>'paymentReturn', 'id'=>'csob'));
        
        #-- pevne adresy
        $frontRouter[] = new Routers\Route('sluzby', array('presenter'=>'Default', 'action'=>'page','id'=>'sluzby'));
        $frontRouter[] = new Routers\Route('obchodni-podminky', array('presenter'=>'Default', 'action'=>'page','id'=>'obchodni-podminky'));
        $frontRouter[] = new Routers\Route('o-spolecnosti', array('presenter'=>'Default', 'action'=>'page','id'=>'o-spolecnosti'));
        $frontRouter[] = new Routers\Route('kontaktni-informace', array('presenter'=>'Default', 'action'=>'contact', 'id'=>'kontaktni-informace'));
        $frontRouter[] = new Routers\Route('akcni-nabidka', array('presenter'=>'Default', 'action'=>'itemsInAction'));
        $frontRouter[] = new Routers\Route('vyhledavani', array('presenter'=>'Default', 'action'=>'itemsSearch'));
        $frontRouter[] = new Routers\Route('nakupni-kosik', array('presenter'=>'Default', 'action'=>'shoppingCart'));
        
        #-- cron
        $frontRouter[] = new Routers\Route('cron/<action>/<manuallyCall>', array('presenter'=>'Cron', 'action'=>'default', 'manuallyCall'=>0));
        
        #-- dynamic url
        $frontRouter[] = new Routers\Route('<category .+>/<manufacturer .+>/<id .+>', array('presenter'=>'Default', 'action'=>'itemDetail'));
        //$frontRouter[] = new Routers\Route('detail/<id .+>', array('presenter'=>'Default', 'action'=>'itemDetail'));
        $frontRouter[] = new Routers\Route('<category .+>[/<manufacturer>]', array('presenter'=>'Default', 'action'=>'items'));
        
        
        //$frontRouter[] = new Routers\Route('prihlaseni', array('presenter'=>'Default', 'action'=>'page','id'=>'obchodni-podminky'));
        //$frontRouter[] = new Routers\Route('registrace', array('presenter'=>'Default', 'action'=>'page','id'=>'obchodni-podminky'));
        
        /*
        $frontRouter[] = new Routers\Route('index.php', 'Default:default', Routers\Route::ONE_WAY);
        
        
        $router[] = new Route('<id .+>', array(
                                'presenter' => 'Page',
                                'action' => 'default',
                                'id' => array(
                                    Route::FILTER_IN => function($id) use ($pages){
                                        if(is_numeric($id)){
                                            return $id;
                                        } else {

                                            $page = $pages->query('SELECT id FROM pages WHERE url = ?', $id)->fetch();

                                            if($page){
                                              return $page->id;
                                            } else {
                                                return NULL;
                                            }
                                        }
                                    },
                                    Route::FILTER_OUT => function($id) use ($pages){
                                        if(!is_numeric($id)){
                                            return $id;
                                        } else {
                                            return $pages->table('pages')->get($id)->url;
                                        }
                                    },
                                ),
                        ));
          */
        
        //$frontRouter[] = new Routers\Route('<id .+>', 'Default:items');
        
        
        
        
        $frontRouter[] = new Routers\Route('<presenter>/<action>[/<id>]', 'Default:default');

        $router[] = $frontRouter;
    }

    /*
      public function setupPermission(SitePermission $permission)
      {
      $permission->addResource('Page');
      $permission->addPrivilege('Page', array('edit', 'create'));
      }
     */
}
