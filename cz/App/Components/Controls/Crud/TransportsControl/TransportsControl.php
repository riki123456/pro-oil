<?php

namespace App\Components\Controls\Crud\TransportsControl;

use Nette\Application\UI\Form,
    App\Model\Repositories\Repository,
    App\Components\Controls\Crud;

/**
 * Description of TransportsControl
 *
 * @author miroslav.petras
 */
class TransportsControl extends Crud\CrudControl {

    protected $repoTablename = 'doprava';

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
        'aktivni' => 'Zobrazovat',
        'vychozi' => 'Výchozí',
        //'popis' => 'Popis',
        'cena_bez_dph' => 'Cena bez DPH',
        'cena_s_dph' => 'Cena s DPH',
        'trvani_min' => 'Trvání min.',
        'trvani_max' => 'Trvání max.'
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
        $form->addText('nazev', 'Název:')
                ->setType('text')
                ->setRequired('Zadejte název dopravy - text pro uživatele.');        
        
        $this->formRadioInline($form, 'aktivni', 'Zobrazovat');
        $this->formRadioInline($form, 'vychozi', 'Výchozí');
        
        /*
        $form->addText('cena', 'Cena:')
                ->setType('number')
                ->setAttribute('step', '0.1')
                ->setRequired('Zadejte cenu dopravy (musí být číslo).')
                ->addRule(Form::FLOAT, 'Cena musí být číslo.');
                //->setAttribute('step', 'any')*/
        $this->formDecimal($form, 'cena_bez_dph', 'Cena bez DPH:');
        $this->formDecimal($form, 'cena_s_dph', 'Cena s DPH:');
        $this->formInteger($form, 'trvani_min', 'Trvání min.');
        $this->formInteger($form, 'trvani_max', 'Trvání max.');
        
        $form->addTextArea('popis', 'Popis:');

        #-- handlers functions
        $form->onSuccess[] = array($this, 'successForm');

        #-- groups toogle
        $this->setGroupsToggle($form);

        #-- bootstrap it
        return $this->boostrapIt($form);
    }

}
