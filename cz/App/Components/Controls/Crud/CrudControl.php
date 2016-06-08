<?php

namespace App\Components\Controls\Crud;

use App\Components;

/**
 * Predek pro vsechny Crud komponenty
 */
class CrudControl extends Components\BaseControl {

    /** @var Table\Selection */
    protected $dataTable;

    /** @var Table\IRow */
    protected $dataItem;

    /** @var buttons */
    protected $newButton = true;
    protected $editButton = true;
    protected $detailButton = true;
    protected $deleteButton = true;

    /** @var disableRender flag */
    protected $renderNow = true;

    /**
     * Zpracování formuláře.
     * 
     * Pokud neni v nadrizenem presenteru definovana stejnojmenna akce, pak
     * tato metoda provadi alespon $this->presenter->redirect('this').
     * 
     * V opacnem pripade nechavame reseni redirectu na presenter metode
     * 
     * @param Form $form
     */
    public function successForm($form) {
        #-- nacteme data ve formatu pole
        $values = $form->getValues(true);

        #-- pridame info o tom, kdo updatuje/zaklada
        $values['_rm_updated_by'] = $this->presenter->user->id;

        #-- rozlisime editaci vs. novy
        try {
            if (isset($values['id']) && $values['id'] != 0) {
                $this->repo->updateByPrimary($this->repoTablename, $values, $values['id']);
            } else {
                $this->repo->insert($this->repoTablename, $values);
            }

            #-- info
            $this->presenter->flashMessage('Data byla uložena v pořádku.', FLASH_OK);
        } catch (\Exception $e) {
            $this->presenter->flashMessage('Data se nepodařilo uložit. Chyba: ' . $e->getMessage(), FLASH_ERR);
        }

        #-- pripadne dokonceni akce presenterm
        $method_fullname = explode('::', __METHOD__);
        $method_name = array_pop($method_fullname);

        if (method_exists($this->presenter, $method_name)) {
            call_user_func(array($this->presenter, $method_name), $form);
        } else {
            $this->presenter->redirect('this');
        }
    }

    /**
     * renderuje prazdny formular pro novou polozku, vyuziva k tomu renderEdit
     */
    public function renderAdd() {
        $this->renderEdit(0);
    }

    /**
     * renderuje detail polozky, vyuziva k tomu renderEdit
     * upravi $form tak, aby obsahoval data-form-type="detail" - dle toho pak js disabluje inputy
     * 
     * @param int $id
     */
    public function renderDetail($id) {
        $this['crudForm']->getElementPrototype()->data('form-type', 'detail'); //->attributes();

        $this->renderEdit($id);
    }

    /**
     * renderuje editacni formular pro uzivatele
     * pridava css a js pro form - nektere jen pro edit akci !
     * 
     * @param int $id
     */
    public function renderEdit($id) {
        #-- fileCollection
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        if ($this->getPresenter()->getAction() != 'detail') {
            $fcol->addFile(ROOT_FS_WWW . '/media/nette/live-form-validation.min.js');
        }
        $fcol->addFile(__DIR__ . '/../Scripts/Form.js');
        
        $this->template->itemValues = isset($this->dataItem) ? $this->dataItem : $this->repo->findOneById($this->repoTablename, $id);

        if ($this->template->itemValues) {
            $this['crudForm']->setDefaults($this->template->itemValues);
        }

        $this->template->crudForm = $this['crudForm'];
        $this->template->setFile(__DIR__ . '/Templates/FormManually.latte');
        
        if ($this->renderNow == true) {
            $this->template->render();
        }
    }

    /**
     * Odstraní polozku.
     * 
     * @param int $id
     */
    public function handleDelete($id) {
        $this->repo->delete($this->repoTablename, $id);
        $this->presenter->flashMessage('Položka byla odstraněna.', FLASH_OK);

        #-- redirect
        $this->presenter->redirect('this');

        /*
          if ($this->presenter->isAjax()) {
          $this->redrawControl('users');
          $this->presenter->redrawControl('flash');
          } else {
          $this->presenter->redirect('this');
          }
         * 
         */
    }

    /**
     * Defaultní pohled - tabulka
     * pridava css a js pro dataTables
     */
    public function renderDefault() {
        #-- fileCollection - js
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(ROOT_FS_WWW . '/media/dataTables/jquery.dataTables.min.js');
        $fcol->addFile(ROOT_FS_WWW . '/media/dataTables/jquery.dataTables.bootstrap.min.js');
        $fcol->addFile(ROOT_FS_WWW . '/media/bootstrap-dialogConfirm.js');
        $fcol->addFile(__DIR__ . '/../Scripts/Table.js');

        $fcol2 = $this->presenter->getComponent("cssDynamic")->getCompiler()->getFileCollection();
        $fcol2->addFile(ROOT_FS_WWW . '/media/dataTables/dataTables.bootstrap.css');
        $fcol2->addFile(ROOT_FS_WWW . '/media/dataTables/dataTables.responsive.css');
        $fcol2->addFile(ROOT_FS_WWW . '/media/dataTables/dataTables.css');

        #-- buttony
        $this->template->newButton = $this->newButton;
        $this->template->editButton = $this->editButton;
        $this->template->detailButton = $this->detailButton;
        $this->template->deleteButton = $this->deleteButton;

        #-- config
        $this->template->tableConfig = $this->tableConfig;

        #-- data        
        $this->template->tableData = isset($this->dataTable) ? $this->dataTable : $this->repo->findAll($this->repoTablename);

        #-- render
        $this->template->setFile(__DIR__ . '/Templates/Table.latte');

        if ($this->renderNow == true) {
            $this->template->render();
        }
    }

}
