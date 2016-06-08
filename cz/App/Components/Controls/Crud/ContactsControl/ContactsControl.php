<?php

namespace App\Components\Controls\Crud\ContactsControl;

use Nette\Application\UI\Form,
    App\Model\Repositories\Repository,
    App\Components\Controls\Crud;

/**
 * Description of ManufacturersControl
 *
 * @author miroslav.petras
 */
class ContactsControl extends Crud\CrudControl {

    protected $repoTablename = 'kontakty';

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
        'name' => 'Jméno',
        'mail' => 'Email',
        'tel' => 'Telefon',
        'position' => 'Pozice',
        'poradi' => 'Pořadí zobrazení'
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
        $form->addText('name', 'Jméno:')->setType('text');
        $form->addText('mail', 'Email:')->setType('email')->setRequired('Zadejte email.')->addCondition(Form::FILLED)->addRule(Form::EMAIL, 'Email nemá správný tvar.');
        $form->addText('tel', 'Telefon:')->setType('tel')->setRequired('Zadejte telefon.');
        $form->addText('position', 'Pozice:')->setType('text')->setRequired('Zadejte pozici ve firmě.');

        #-- handlers functions
        $form->onSuccess[] = array($this, 'successForm');

        #-- groups toogle
        $this->setGroupsToggle($form);

        #-- bootstrap it
        return $this->boostrapIt($form);
    }

}
