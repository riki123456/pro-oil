<?php

namespace App\Components\Controls\Crud\UsersControl;

use Nette\Application\UI\Form,
    App\Model\Repositories\Repository,
    App\Components\Controls\Crud;

/**
 * Description of UsersControl
 *
 * @author miroslav.petras
 */
class UsersControl extends Crud\CrudControl {

    protected $repoTablename = 'users';

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
        'jmeno' => 'Jméno',
        'prijmeni' => 'Příjmení',
        'email' => 'Email',
        'telefon' => 'Telefon',
        'mesto' => 'Město',
        'ico' => 'IČO',
        'dic' => 'DIČ'
    );

    /** @var array seznam definovanych roli */
    private $roles;

    /**
     * zavola rodicovsky konstruktor a nastavi repozitar a tabli, nad kterou funguje
     * 
     * @param Repository $repo
     */
    public function __construct(Repository $repo) {
        parent::__construct();
        
        $this->repo = $repo;

        #-- defined roles
        foreach (get_defined_constants() as $key => $name) {
            if (\Nette\Utils\Strings::startsWith($key, 'ROLE_')) {
                $this->roles[$name] = $name;
            }
        }

        $this->roles = array_reverse($this->roles);
    }

    /**
     * info panel
     */
    public function renderInfoPanel() {
        $this->template->usersCount = count($this->repo->findAll($this->repoTablename));

        $this->template->setFile(__DIR__ . '/Templates/infoPanel.latte');
        $this->template->render();
    }

    /**
     * Odstraní uzivatele.
     * 
     * @param int $id
     */
    public function handleDelete($id) {
        $user = $this->repo->findOneById($this->repoTablename, $id);

        if ($user->role == ROLE_ROOT && false == $this->presenter->user->isInRole(ROLE_ROOT)) {
            $this->presenter->flashMessage('Uzivatele ROOT může odstranit jen ROOT!', FLASH_ERR);

            #-- redirect
            $this->presenter->redirect('this');
        } else {
            parent::handleDelete($id);
        }
    }

    /**
     * Defaultní pohled - tabulka
     */
    public function renderDefault() {
        #-- jen root muze videt a editovat sam sebe + admina
        if ($this->presenter->user->isInRole(ROLE_ROOT) == false) {
            $this->dataTable = $this->repo->findAllByWhere($this->repoTablename, 'role NOT IN (?, ?)', array(ROLE_ROOT, ROLE_ADMIN));
        }

        parent::renderDefault();
    }

    /**
     * formular pro zmenu hesla
     * 
     * @param type $id id uzivatele
     */
    public function renderPassw($id) {
        parent::renderEdit($id);
    }

    /**
     * Zpracování formuláře - upravuje zasifrovani hesla.
     * Pak uz vola parent metodu
     * 
     * @param Form $form
     */
    public function successForm($form) {
        $data = $form->getValues(true);

        if (isset($data['password'])) {
            $data['password'] = \Nette\Security\Passwords::hash($data['password']);
        }

        $form->setValues($data);

        parent::successForm($form);
    }

    //=================================== PROTECTED ============================

    /**
     * UserForm factory.
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
                ->setAttribute('onClick', 'window.location=\'' . $this->presenter->link("default") . '\';')
                ->getControlPrototype()->addClass('btn-default');


        #-- pridame inputy dle akce
        switch ($this->presenter->getAction()) {
            case 'add':
                $this->editForm($form, true);
                break;
            case 'edit':
            case 'detail':
                $form->addHidden('id');
                $this->editForm($form);
                break;
            case 'passw':
                $form->addHidden('id');
                $this->passwForm($form);
                break;
        }

        #-- handlers functions
        $form->onSuccess[] = array($this, 'successForm');

        #-- groups toogle
        $this->setGroupsToggle($form);

        #-- bootstrap it
        return $this->boostrapIt($form);
    }

    //=================================== PRIVATE ==============================

    /**
     * 
     * @param UI\Form $form
     * @param bool $isAddForm zda resime formular pro pridani noveho uzivatele
     */
    private function editForm(\Nette\Application\UI\Form $form, $isAddForm = false) {
        #-- prihlasovani
        $form->addGroup("prihlaseni")->setOption('label', 'Přihlašovací údaje');
        $form->addText('login', 'Login:')->setRequired('Zadejte login.');
        $form->addSelect('role', 'Oprávnění:', $this->roles)->setPrompt(' -- vyberte roli --')->setRequired('Zadejte oprávnění.');

        #-- heslo - jen pri novem uzivateli !
        if ($isAddForm == true) {
            $this->passwForm($form, $isAddForm);
        }

        #-- kontakt
        $form->addGroup("kontakt")->setOption('label', 'Kontaktní údaje');

        #-- typ uzivatele
        $radiosU = array(1 => 'koncový', 2 => 'fyzická osoba', 3 => 'právnická osoba');
        $this->formRadioInline($form, 'user_type', 'Typ uživatele:', 1, $radiosU);

        #-- platce dph
        $this->formRadioInline($form, 'platce_dph', 'Plátce DPH:');

        $form->addText("jmeno", "Jméno:");
        $form->addText("prijmeni", "Příjmení:");
        $form->addText("email", "Email:")->setType('email')->setRequired("Zadejte email.")->addRule(Form::EMAIL, "Email nemá správný formát.");
        $form->addText("telefon", "Telefon:");
        $form->addText("ulice", "Ulice a č. p.:");
        $form->addText("mesto", "Město:");
        $form->addText("psc", "PSČ:");
        $form->addText("stat", "Stát:");

        #-- finance
        $form->addGroup("finance")->setOption('label', 'Finanční údaje');
        $form->addText("ico", "IČO:");
        $form->addText("dic", "DIČ:");
    }

    /**
     * formular pro zmenu hesla
     * 
     * @param UI\Form $form
     */
    private function passwForm(\Nette\Application\UI\Form $form) {
        if ($form->getGroup('prihlaseni') == false) {
            $form->addGroup("prihlaseni")->setOption('label', 'Přihlašovací údaje');
        }

        $form->addPassword('password', 'Heslo:')->setRequired('Zadejte heslo.');
        $form->addPassword('passwordCheck', 'Heslo - kontrola:')
                ->setOmitted(true)
                ->setRequired('Zadejte to samé heslo pro kontrolu.')
                ->addRule(Form::EQUAL, "Hesla se musí shodovat !", $form["password"]);
    }

}
