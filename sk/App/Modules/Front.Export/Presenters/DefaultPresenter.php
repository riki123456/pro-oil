<?php

namespace App\Modules\Front\Export\Presenters;

class DefaultPresenter extends \App\Modules\Base\Presenters\BasePresenter
{
    public function setupRouter(\Nette\Application\IRouter $router)
    {
        $router[] = new PageRoute('<uri>', array(
            'presenter' => 'Page',
            'action' => 'default'
        ));
    }

    public function setupPermission(SitePermission $permission)
    {
        $permission->addResource('Page');
        $permission->addPrivilege('Page', array('edit', 'create'));
    }
}
