<?php

namespace App\Components\Controls\LogoutControl;

use App\Components;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LogoutControl
 *
 * @author miroslav.petras
 */
class LogoutControl extends Components\BaseControl {

    /**
     * Provede odhlášení uživatele.
     */
    public function handleLogout() {
        $this->presenter->getUser()->logout(TRUE); # smazeme explicitne i identitu
        $this->presenter->flashMessage('Byl jste odhlášen.', FLASH_OK);
        $this->presenter->redirect('this');
    }

    /**
     * Defaultní pohled.
     */
    public function render() {
        $this->template->setFile(__DIR__ . '/LogoutControl.latte');
        $this->template->render();
    }

}
