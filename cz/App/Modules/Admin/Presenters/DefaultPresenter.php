<?php

namespace App\Modules\Admin\Presenters;

use App\Components\Controls\Crud\ItemsControl\TCreateComponentItemsControl;
use App\Components\Controls\Crud\OrdersControl\TCreateComponentOrdersControl;
use App\Components\Controls\Crud\UsersControl\TCreateComponentUsersControl;

class DefaultPresenter extends AdminPresenter {

    /**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => false,
        'presenter' => 'Default',
        'tablename' => '',
        'titles' => array(
            'default' => 'Vítejte v administraci',
        )
    );

    /**
     * Vytvoří komponentu itemsControl
     */
    use TCreateComponentItemsControl;

/**
     * Vytvoří komponentu UsersControl
     */
    use TCreateComponentUsersControl;

/**
     * Vytvoří komponentu OrdersControl
     */
    use TCreateComponentOrdersControl;
}
