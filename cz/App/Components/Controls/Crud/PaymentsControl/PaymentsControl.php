<?php

namespace App\Components\Controls\Crud\PaymentsControl;

use Nette\Application\UI\Form,
    App\Model\Repositories\Repository,
    App\Components\Controls\Crud;

/**
 * Description of PaumentsControl
 *
 * @author miroslav.petras
 */
class PaymentsControl extends Crud\CrudControl {

    protected $repoTablename = 'platba';

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
        //'popis' => 'Popis',
        'cena_bez_dph' => 'Cena bez DPH',
        'cena_s_dph' => 'Cena s DPH',
        'vychozi' => 'Výchozí'
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
        $form->addText('nazev', 'Název:')->setRequired('Zadejte název platby - text pro uživatele.');
        $this->formRadioInline($form, 'aktivni', 'Zobrazovat');
        $this->formRadioInline($form, 'vychozi', 'Výchozí');
        $this->formDecimal($form, 'cena_bez_dph', 'Cena bez DPH:')->setRequired('Cena dopravy je povinná.');
        $this->formDecimal($form, 'cena_s_dph', 'Cena s DPH:')->setRequired('Cena dopravy je povinná.');
                //->setAttribute('step', 'any')
        $form->addTextArea('popis', 'Popis:');

        #-- handlers functions
        $form->onSuccess[] = array($this, 'successForm');

        #-- groups toogle
        $this->setGroupsToggle($form);

        #-- bootstrap it
        return $this->boostrapIt($form);
    }

}
