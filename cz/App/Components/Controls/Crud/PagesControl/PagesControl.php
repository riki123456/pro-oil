<?php

namespace App\Components\Controls\Crud\PagesControl;

use Nette\Application\UI\Form,
    App\Model\Repositories\Repository,
    App\Components\Controls\Crud;

/**
 * Description of PagesControl
 *
 * @author miroslav.petras
 */
class PagesControl extends Crud\CrudControl {

    protected $repoTablename = 'pages';

    /** @var Repository $repo */
    protected $repo;

    /**
     * konfigurace pro bootstrap table
     * 
     * array('dbColumnName' => 'showName', 'dbColumnName' => 'showName', ...)
     * array('name' => 'Jméno', 'surname' => 'Příjmení', ...)
     * 
     * @var array $tableConfig 
     */
    protected $tableConfig = array(
        'name' => 'Název stránky',
        'alias' => 'Url',
        '_rm_updated_date' => 'Poslední změna'
    );

    /**
     * zavola rodicovsky konstruktor a nastavi repozitar a tabli, nad kterou funguje
     * prida $assets pro dynamicke ovladani skript a stylu
     * 
     * @param Repository $repo
     */
    public function __construct(Repository $repo) {
        parent::__construct();
        
        $this->repo = $repo;
    }

    /**
     * jen prida tinymce.js ... o dalsi se stara parent metoda
     * 
     * @param int $id
     */
    public function renderEdit($id) {
        #-- fileCollection
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(ROOT_FS_WWW . '/media/tinymce/tinymce.min.js');
        
        parent::renderEdit($id);
    }
    
    /**
     * akce pro zpracovani formulare po success
     * 
     * @param UI\Form $form
     */
    public function successForm($form) {
        $vals = $form->getValues(true);
        
        #-- upravime 'alias' - je to pro url
        $vals['alias'] = \Nette\Utils\Strings::webalize($vals['name']);
        
        #-- vratime formu a zavolame parent metodu
        $form->setValues($vals);
        parent::successForm($form);        
    }
    
    //=================================== PROTECTED ============================

    /**
     * PagesForm factory.
     * @return Form
     */
    protected function createComponentCrudForm() {
        #-- form (dynamicky - dle akce)
        $form = new Form;
        $form->addProtection('Odešlete formulář znovu prosím (bezpečtnostní token vypršel).');

        #-- buttons
        // tlacitka dame jiz tady, protoze kdyz nejsou ve skupine, padnou pekne
        // az na konec ;)
        $form->addSubmit('ok', 'Uložit')
                ->getControlPrototype()
                ->onclick('tinyMCE.triggerSave(); setTimeout(function() { $(".tinyMCE").next().show(); }, 10);');

        $form->addButton('cancel', 'Storno')
                ->setOmitted(true)
                ->getControlPrototype()
                ->onclick('window.location=\'' . $this->presenter->link("default") . '\';')
                ->addClass('btn-default');

        #-- pridame inputy dle akce
        if ($this->presenter->getAction() !== 'add') {
            $form->addHidden('id');
        }

        #-- cely form        
        $form->addGroup("firstgroup")->setOption('label', 'Základní údaje');
        $form->addText('name', 'Název stránky:')->setRequired('Zadejte název stránky.');
        
        #-- webova adresa jen pro detail akci
        if ($this->presenter->getAction() == 'detail') {
            $form->addText('alias', 'Název v url:')->setRequired('Zadej tvar názvu pro url.');
        } else {
            $form->addHidden('alias');
        }
        
        #-- content
        $form->addTextArea('content', 'Obsah stránky:')
                ->setRequired('Stránka musí mít alespoň nějaký obsah.')
                ->getControlPrototype()->setClass('tinyMCE');
        
        #-- handlers functions
        $form->onSuccess[] = array($this, 'successForm');

        #-- groups toogle
        $this->setGroupsToggle($form);

        #-- bootstrap it
        return $this->boostrapIt($form);
    }

}
