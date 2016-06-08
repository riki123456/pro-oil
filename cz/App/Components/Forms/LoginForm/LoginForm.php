<?php

namespace App\Components\Forms\LoginForm;

use Nette\Application\UI\Form,
    Nette\Security\AuthenticationException,
    App\Components;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginForm
 *
 * @author miroslav.petras
 */
class LoginForm extends Components\BaseControl {

    /**
     * Defaultní pohled.
     */
    public function render() {
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(ROOT_FS_WWW . '/media/nette/live-form-validation.min.js');
        $fcol->addFile(__DIR__ . '/../../Controls/Scripts/Form.js');

        $this->template->setFile(__DIR__ . '/LoginForm.latte');
        $this->template->render();
    }

    /**
     * LoginForm factory.
     * @return Form
     */
    protected function createComponentLoginForm() {
        $form = new Form;
        $form->addProtection();
        $form->addText('username', 'Login:')
                ->setRequired('Zadejte login.');
        $form->addPassword('password', 'Heslo:')
                ->setRequired('Zadejte heslo.');
        $form->addCheckbox('remember', 'Chci zůstat přihlášený');
        $form->addSubmit('ok', 'Přihlásit se');
        $form->onSuccess[] = $this->success;

        // bootstrap it
        $this->boostrapIt($form);
        $renderer = $form->getRenderer();
        $renderer->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';

        return $form;
    }

    /**
     * Zpracování formuláře.
     * Presmerovava dle hodnoty parametru 'backlink', kde je schovany posledni request pred ukazanim login stranky
     * pokud hodnotu nemame, pak presmerovavame na 'Default'
     * 
     * @param Form $form
     */
    public function success($form) {
        $values = $form->getValues();
        if ($values->remember) {
            #-- chceme si pamatovat 30 dni. Nicmene, muze byt nastaveno mensi limit pro zivotnost session, takze musime testnout
            $_30_days = ((30 * 24) * 60) * 60;
            $_sessionLimit = (int) ini_get('session.gc_maxlifetime');

            if ($_30_days > $_sessionLimit) {
                $_rememberTime = $_sessionLimit;
            } else {
                $_rememberTime = $_30_days;
            }

            $this->presenter->getUser()->setExpiration('+ ' . $_rememberTime . ' seconds', FALSE);
        } else {
            $this->presenter->getUser()->setExpiration('+ ' . (20 * 60) . ' seconds', TRUE); // 20 minut
        }

        try {
            $this->presenter->getUser()->login($values->username, $values->password);
            $this->getPresenter()->flashMessage("Přihlášení proběhlo úspěšně", FLASH_OK);
        } catch (AuthenticationException $e) {
            $form->addError('Přihlášení selhalo. ' . $e->getMessage());
            return;
        }

        $link = $this->getPresenter()->getParameter('backlink');
        if (null == $link) {
            $this->getPresenter()->redirect('Default:');
        } else {
            $this->getPresenter()->restoreRequest($link);
        }
    }

}
