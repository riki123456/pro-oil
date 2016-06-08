<?php

namespace App\Components\Controls\Crud\ManufacturersControl;

use Nette\Application\UI\Form,
    App\Model\Repositories\Repository,
    App\Components\Controls\Crud;

/**
 * Description of ManufacturersControl
 *
 * @author miroslav.petras
 */
class ManufacturersControl extends Crud\CrudControl {

    protected $repoTablename = 'vyrobce';

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
        'nazev' => 'Název',
        'alias' => 'Název v url',
        'keywords' => 'Klíčová slova',
        'description' => 'Popis',
        'display' => 'Zobrazit',
        'poradi' => 'Pořadí'
    );

    /**
     * zavola rodicovsky konstruktor a nastavi repozitar a tabli, nad kterou funguje
     * 
     * @param Repository $repo
     */
    public function __construct(Repository $repo) {
        parent::__construct();
        
        $this->repo = $repo;
    }

    /**
     * akce pro zpracovani formulare po success
     * 
     * @param UI\Form $form
     */
    public function successForm($form) {
        $vals = $form->getValues(true);
        
        #-- upravime 'alias' - je to pro url
        $vals['alias'] = \Nette\Utils\Strings::webalize($vals['nazev']);
        
        #-- vratime formu a zavolame parent metodu
        $form->setValues($vals);
        parent::successForm($form);        
    }
    
    //=================================== PROTECTED ============================

    /**
     * TransfersForm factory.
     * @return Form
     */
    protected function createComponentCrudForm() {
        #-- form (dynamicky - dle akce)
        $form = new Form;
        $form->addProtection('Odešlete formulář znovu prosím (bezpečtnostní token vypršel).');

        #-- buttons
        // tlacitka dame jiz tady, protoze kdyz nejsou ve skupine, padnou pekne
        // az na konec ;)
        $form->addSubmit('ok', 'Uložit');        
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
        $form->addText('nazev', 'Název:')->setRequired('Zadejte název výrobce.');
        
        #-- webova adresa jen pro detail akci
        if($this->presenter->getAction() == 'detail') {
            $form->addText('alias', 'Název v url:')->setRequired('Zadej tvar názvu pro url.');
        } else {
            $form->addHidden('alias');
        }
        
        #-- poradi, ve kterem vyrobce zobrazovat
        $form->addText('poradi', 'Pořadí:')->setDefaultValue(99)->setType('number')->setAttribute('step', '1');
        
        #-- true/false radio list
        $this->formRadioInline($form, 'display', 'Zobrazit:', 1);
        #-- klicova slova
        $form->addText('keywords', 'Klíčová slova:');
        #-- popis
        $form->addTextArea('description', 'Popis:');

        #-- handlers functions
        $form->onSuccess[] = array($this, 'successForm');

        #-- groups toogle
        $this->setGroupsToggle($form);

        #-- bootstrap it
        return $this->boostrapIt($form);
    }

}
