<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\OrdersControl\TCreateComponentOrdersControl;

class OrdersPresenter extends AdminPresenter {

    /**
     * Vytvoří komponentu ordersControl
     */
    use TCreateComponentOrdersControl;

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => true,
        'presenter' => 'Orders',
        'tablename' => 'orders',
        'titles' => array(
            'default' => 'Správa objednávek',
            'detail' => 'Detail objednávky'
        )
    );

    /**
     * uprava promenny pro breadcrumb a jeho odkaz na default akci presenteru
     *  - nejdriv se vola parent::beforeRender(), pak tato metoda
     */
    protected function beforeRender() {
        parent::beforeRender();

        #-- pokud mame v url definovany stav, pridame ho do breadcrumb
        $type = $this->getParameter('type');
        if (null != $type) {
            $stav = ($type == 1) ? 'nové' : (($type == 2) ? 'potvrzené' : 'zamítnuté');

            #-- upravime link a text
            $link = $this->link($this->getConfigValue('presenter') . ":", array('type'=>$type));
            $linkName = $this->getConfigValue('titles', 'default');
            $this->breadcrumb->replace('default', $link, $linkName . ' - ' . $stav);
        }
    }

}
