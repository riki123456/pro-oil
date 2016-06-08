<?php

namespace App\Modules\Admin\Presenters;

class CronPresenter extends AdminPresenter {
    
/**
     * @var array $presenterConfig konfigurace pro zakladni presenter akce, vyuzivano rodici
     * 
     * - pole 'titles' ma v indexech nazvy render method
     */
    protected $presenterConfig = array(
        'crud' => false,
        'presenter' => 'Cron',
        'tablename' => 'cron_log',
        'titles' => array(
            'default' => 'Ruční spouštění CRON skriptů'
        )
    );
}
