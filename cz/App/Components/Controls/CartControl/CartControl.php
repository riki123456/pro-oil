<?php

namespace App\Components\Controls\CartControl;

use App\Components,
    Nette\Application\UI\Form,
    App\Model\Repositories\Repository,
    App\Model\Repositories\RepositoryOrders;

/**
 * Description of CategoriessControl
 *
 * @author miroslav.petras
 */
class CartControl extends Components\BaseControl {

    CONST SESSION_SECTION = 'shopping-cart';
    CONST PATTERN_C_S_DPH_START = "C_sDPH_START";
    CONST PATTERN_C_S_DPH_END = "C_sDPH_END";
    CONST PATTERN_C_BEZ_DPH_START = "C_bezDPH_START";
    CONST PATTERN_C_BEZ_DPH_END = "C_bezDPH_END";

    /** @var Repository $repo */
    protected $repo;

    /** @var RepositoryOrders $repo */
    protected $repoOrder;

    /**
     * @var \Nette\Mail\IMailer $mailer
     */
    protected $mailer;

    /**
     * @var \App\Model\Payment $paymentClass
     */
    protected $paymentClass;

    /**
     * @var \App\Model\Heureka\Overeno $heurekaOverenoClass
     */
    protected $heurekaOverenoClass;

    /**
     * zavola rodicovsky konstruktor a nastavi repozitar
     * 
     * @param Repository $repo
     * @param \Nette\Mail\IMailer $mailer
     * @param RepositoryOrders $repoOrder
     * @param \App\Model\Payment $paymentClass
     * @param \App\Model\Heureka $heurekaOverenoClass
     */
    public function __construct(Repository $repo, \Nette\Mail\IMailer $mailer, RepositoryOrders $repoOrder, \App\Model\Payment $paymentClass, \App\Model\Heureka\Overeno $heurekaOverenoClass) {
        parent::__construct();

        $this->repo = $repo;
        $this->repoOrder = $repoOrder;
        $this->mailer = $mailer;
        $this->paymentClass = $paymentClass;
        $this->heurekaOverenoClass = $heurekaOverenoClass;
    }

    /**
     * zpracuje objednani polozky
     * - jen prida do session a updatuje 'mini' prehled
     * - dalsi logiku uz dela jina metoda v presenteru (objednavani apod.)
     */
    public function handleCartMiniUpdate() {
        // default data
        $this->template->pocet = 0;
        $this->template->cena_s_dph = 0;
        $this->template->cena_s_dph__celkem = 0;

        // z requestu
        $id = $this->getPresenter()->getRequest()->getParameter('itemId');
        $pocet = $this->getPresenter()->getRequest()->getParameter('pocet');
        $cena_s_dph = $this->getPresenter()->getRequest()->getParameter('cena_s_dph');

        #-- set sessin data
        $this->setSessionValue($id, $pocet, $cena_s_dph);

        #-- nastavime view
        foreach ($this->getSessionData() as $item) {
            $this->template->pocet += $item['pocet'];
            $this->template->cena_s_dph = $item['cena_s_dph'];
            $this->template->cena_s_dph__celkem += $item['cena_s_dph__celkem'];
        }

        $this->redrawControl('cart-mini');
        $this->template->setFile(__DIR__ . '/Templates/cart-mini.latte');
    }

    /**
     * zpracuje akce nad kosikem (remove, removeItem, recalculate)
     * 
     * @param string $action
     * @param int $id
     */
    public function handleCart($action, $id = 0) {
        $section = $this->getSessionSection();
        if (false !== $section) {
            switch ($action) {
                case 'remove':
                    $section->remove();
                    break;
                case 'removeItem':
                    if (isset($section->polozky) && isset($section->polozky[$id])) {
                        unset($section->polozky[$id]);
                    }
                    break;
                case 'recalculate':
                    $p = $this->getPresenter()->getRequest()->getPost('items');
                    if (is_array($p)) {
                        $section->polozky = array();

                        foreach ($p as $id => $vals) {
                            $this->setSessionValue($id, $vals['pocet'], $vals['cena_s_dph']);
                        }
                    } else {
                        $section->polozky = array();
                    }
                    break;
            }
        }
    }

    /**
     * "prazdna" objednavka - formular pro napsani "cehokoliv" ;)
     */
    public function renderBlankCart() {
        #-- fileCollection - js
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(ROOT_FS_WWW . '/media/nette/live-form-validation.min.js');
        $fcol->addFile(__DIR__ . '/../Scripts/Form.js');

        #-- vyrenderujeme
        $this->template->setFile(__DIR__ . '/Templates/cart-blank.latte');
        $this->template->render();
    }

    /**
     * zpracovani objednavky
     */
    public function renderCart() {
        #-- fileCollection - js
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(ROOT_FS_WWW . '/media/nette/live-form-validation.min.js');
        $fcol->addFile(ROOT_FS_WWW . '/media/numeral/numeral.min.js');
        $fcol->addFile(ROOT_FS_WWW . '/media/numeral/languages/cs.min.js');
        $fcol->addFile(__DIR__ . '/../Scripts/Form.js');

        #-- template params
        $this->template->orders = array();
        $this->template->orders_session = array();

        #-- nacteme ze session - opatrne ;)
        $polozky = $this->getSessionData();

        if (false !== $polozky) {
            $polozkyKeys = array_keys($polozky);
            $sqlWhere = rtrim(str_repeat('id = ? OR ', count($polozkyKeys)), ' OR');

            if (count($polozkyKeys) == 1) {
                $query = $this->repo->findAll('polozka')->where($sqlWhere, $polozkyKeys[0]);
            } elseif (count($polozkyKeys) > 1) {
                $query = $this->repo->findAll('polozka')->where($sqlWhere, $polozkyKeys);
            } else {
                $query = $this->repo->findAll('polozka')->where('1=0');
            }

            $this->template->orders = $query->fetchAll();
            $this->template->orders_session = $polozky;
        }

        #-- typy doprav
        $this->template->transports = $this->repo->findAllByColumn('doprava', 'aktivni', 1)->order('nazev');
        #-- typy plateb
        $this->template->payments = $this->repo->findAllByColumn('platba', 'aktivni', 1)->order('nazev');

        #-- vyrenderujeme
        $this->template->setFile(__DIR__ . '/Templates/cart.latte');
        $this->template->render();
    }

    /**
     * zpracovani vysledne stranky po ulozeni objednavky
     * take zpracuje pro heureku sluzbu "overeno zakazniky"
     * 
     * @param int $formId
     */
    public function renderCartFinished($formId) {
        #-- fileCollection - js
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(__DIR__ . '/Scripts/cart.js');

        #-- data o objednavce
        $ordDataFull = $this->repoOrder->getDetailDataFull('objednavka_hlavicka', $formId);
        $this->template->ordData = $ordDataFull[0];
        $this->template->ordDataZakaznik = $ordDataFull[1];
        $this->template->ordDataZakaznikAdresa = $ordDataFull[2];
        $this->template->ordDataZakaznikAdresaDodaci = $ordDataFull[3];

        #-- payment class - na zpracovani plateb tretich stran
        $this->paymentClass->setOrderData($ordDataFull);
        $this->template->paymentClassData = $this->paymentClass->processOrderData();

        if (null != $this->paymentClass->getPaymentResponseId()) {
            $this->repo->update('objednavka_hlavicka', array('platba_servicesId' => $this->paymentClass->getPaymentResponseId()), 'id = ?', $this->template->ordData[0]->id);
        }

        #-- overeno zakazniky - heureka
        if (HEUREKA_OVERENO_ZAKAZNIKY == true) {
            try {
                #-- set customer email - MANDATORY
                $email = (isset($this->template->ordDataZakaznikAdresaDodaci['email']) ? $this->template->ordDataZakaznikAdresaDodaci['email'] : $this->template->ordDataZakaznikAdresa['email']);
                $this->heurekaOverenoClass->setEmail($email);

                #-- add products using item ID
                foreach ($this->template->ordData as $prod) {
                    $this->heurekaOverenoClass->addProductItemId($prod->ora_polozka_id);

                    #-- u vyrobku mame schovanou i ciselnou radu objednavky
                    #-- add order ID - BIGINT (0 - 18446744073709551615)
                    $this->heurekaOverenoClass->setOrderId($prod->ciselna_rada);
                }

                #-- send request
                $this->heurekaOverenoClass->send();
            } catch (\App\Model\Heureka\Overeno\Exception $e) {
                trigger_error($e->getMessage());
            }
        }

        #-- vyrenderujeme        
        $this->template->setFile(__DIR__ . '/Templates/cart-finish.latte');
        $this->template->render();
    }

    /**
     * vyrenderuje 'mini' prehled objednanych polozek
     * - updatovano pres ajax pri objednani
     */
    public function renderCartMini() {
        // fileCollection - js
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(__DIR__ . '/Scripts/cart.js');

        // default data
        $this->template->pocet = 0;
        $this->template->cena_s_dph__celkem = 0;

        // session section
        $section = $this->getSessionSection();
        if (false !== $section) {
            // sekce pro kosik vyexpiruje při zavření prohlížeče
            $section->setExpiration(0);

            #-- session data
            $polozky = $this->getSessionData();
            if (false !== $polozky) {
                foreach ($polozky as $item) {
                    $this->template->pocet += $item['pocet'];
                    $this->template->cena_s_dph = $item['cena_s_dph'];
                    $this->template->cena_s_dph__celkem += $item['cena_s_dph__celkem'];
                }
            }
        }

        $this->template->setFile(__DIR__ . '/Templates/cart-mini.latte');
        $this->template->render();
    }

    /**
     * zpracovani formulare - jen odesle email
     * 
     * @param Form $form
     */
    public function successBlankCartForm($form) {
        $values = $form->getValues();

        $mail = new \Nette\Mail\Message();
        $mail->setFrom($values->email, $values->jmeno);
        //$mail->addTo(MAIL_PRODEJCE);
        //$mail->addCc(MAIL_KANCELAR);
        $mail->addTo(MAIL_ESHOP);
        $mail->addBcc(MAIL_ADMIN);
        $mail->setSubject("Poptávka kalkulace individuální ceny");
        $mail->setBody($values->zprava);

        try {
            $this->mailer->send($mail);

            $this->presenter->flashMessage('Email byl v pořádku odeslán.', FLASH_OK);
        } catch (\Exception $e) {
            $this->presenter->flashMessage('Email se nepodařilo odeslat. Zkuste prosím akci opakovat později.', FLASH_ERR);

            trigger_error($e->getMessage(), E_USER_WARNING);
        }
    }

    /**
     * Zpracování formuláře - odeslani a ulozeni objednavky
     * Posila take informativni email
     * 
     * @param Form $form
     */
    public function successZakaznikForm($form) {
        #-- roboti nam odesilaji objednavky - bez polozek
        #-- tak to osetrime
        $sdata = $this->getSessionData();
        if (false === $sdata || empty($sdata)) {
            $this->presenter->flashMessage('V objednávce nejsou uvedeny žádné položky!', FLASH_ERR);
            #-- redirect
            $this->getParent()->successZakaznikForm($form, null);
        }

        #-- data as array
        $data = $form->getValues(true);

        #-- a jedeeem db transakce ... vsechno postupne ;)
        $this->repo->getDb()->beginTransaction();
        try {
            #-- hlavicka
            $hlavicka = $this->getOrderHead($data);
            $hlavickaNew = $this->repo->insert('objednavka_hlavicka', $hlavicka);

            #-- radky
            //$radky = array();
            foreach ($this->getOrderRows($hlavickaNew->id) as $radek) {
                $this->repo->insert('objednavka_radky', $radek);
            }


            #-- zakaznik
            $zakaznik = $this->getOrderCustomer($data, $hlavickaNew->id);
            $zakaznikNew = $this->repo->insert('objednavka_zakaznik', $zakaznik);

            #-- adresy
            $zakaznik_adresa = $this->getOrderCustomerAddress($data, $zakaznikNew->id, 1);
            $this->repo->insert('objednavka_zakaznik_adresy', $zakaznik_adresa);

            $zakaznik_adresa_d = array();
            if ('' != $data['djmeno']) {
                $zakaznik_adresa_d = $this->getOrderCustomerAddress($data, $zakaznikNew->id, 2);
                $this->repo->insert('objednavka_zakaznik_adresy', $zakaznik_adresa_d);
            }

            #-- ulozili jsme ;)
            $this->repo->getDb()->commit();

            #-- muzeme smazat session
            if (false !== $this->getSessionSection()) {
                $this->getSessionSection()->remove();
            }
        } catch (\Exception $e) {
            $this->repo->getDb()->rollBack();

            throw new \Exception($e->getMessage(), $e->getCode());
        }

        #-- template data, for finish page and email body
        $template = $this->createTemplate();
        $template->getLatte()->addFilter('money', \App\Helpers\Format::loadHelper('money'));

        #-- sql  
        $tdata = $this->repoOrder->getDetailDataFull('objednavka_hlavicka', $hlavickaNew->id);
        $template->data = $tdata[0];
        $template->dataZakaznik = $tdata[1];
        $template->dataAdresaFakturacni = $tdata[2];
        $template->dataAdresaDodaci = $tdata[3];

        #-- email s informacemi
        //$htmlBody = $template->setFile(__DIR__ . '/Templates/cart-finish.latte');
        $htmlBody = $template->setFile(__DIR__ . '/Templates/cart-table.latte');
        $this->sendOrderEmail(
                $zakaznik_adresa, $zakaznik_adresa_d, 'Objednávka č. ' . $hlavickaNew->ciselna_rada, $htmlBody
        );

        #-- redirect
        $this->getParent()->successZakaznikForm($form, $hlavickaNew->id);
    }

    //=================================== PROTECTED ============================
    /**
     * BlankCartForm
     * @return Form
     */
    protected function createComponentBlankCartForm() {
        // fileCollection - js
        $fcol = $this->presenter->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(__DIR__ . '/../Scripts/recaptcha.js');
        
        $form = new Form;
        $form->addProtection('Odešlete formulář znovu prosím (bezpečtnostní token vypršel).');

        #-- inputs
        $form->addText('jmeno', 'Vaše jméno:')->setRequired('Jméno musí být vyplněno.');
        $form->addText('email', 'Váš email:')->setType('email')
                ->setRequired('Email musí být vyplněn.')
                ->addRule(Form::EMAIL, "Email nemá správný formát.");
        $form->addTextArea('zprava', 'Vaše poptávka:')->setRequired('Poptávka musí být vyplněna.')
                ->getControlPrototype()->addAttributes(array('rows' => 10));
        $form->addReCaptcha('captcha', NULL, 'Ověření se nezdařilo. Zkuste prosím akci zopakovat.');
        
        #-- buttons
        $form->addSubmit('ok', 'Odeslat');

        #-- handlers functions
        $form->onSuccess[] = array($this, 'successBlankCartForm');

        #-- return
        return $this->boostrapIt($form);
    }

    /**
     * ZakaznikForm factory.
     * @return Form
     */
    protected function createComponentZakaznikForm() {
        #-- form (dynamicky - dle akce)
        $form = new Form;
        $form->addProtection('Odešlete formulář znovu prosím (bezpečtnostní token vypršel).');

        #-- buttons
        // tlacitka dame jiz tady, protoze kdyz nejsou ve skupine, padnou pekne
        // az na konec ;)
        $form->addSubmit('ok', 'Odeslat objednávku');

        #-- cely form
        #-- 1. group
        $form->addGroup("1")->setOption('label', 'Doprava a platba');

        #-- platba
        #-- mame patterny, ktere prelozime v po provedeni dotazu na html. Je to prasarna, ale alespon neprasime sql
        $pair = $this->repo->getPairsConcatByWhere(
                'platba', 'CONCAT(nazev, "' . self::PATTERN_C_BEZ_DPH_START . '", cena_bez_dph, "' . self::PATTERN_C_BEZ_DPH_END . '","' . self::PATTERN_C_S_DPH_START . '", cena_s_dph, "' . self::PATTERN_C_S_DPH_END . '")', 'id', 'nazev', 'aktivni = ?', 1, 'nazev');
        if (count($pair) > 0) {
            $vychozi2 = $this->repo->findOneByColumn('platba', 'vychozi', 1);

            //mame patterny, ktere prelozime v po provedeni dotazu na html. Je to prasarna, ale alespon neprasime sql
            $radio = $this->formRadio($form, 'platba_id', 'Platba', $vychozi2 == false ? 0 : $vychozi2->id, $this->replaceRadioPattern($pair));
            $radio->getSeparatorPrototype()->addAttributes(array('class' => 'payment'));
        }

        #-- doprava
        $pair2 = $this->repo->getPairsConcatByWhere('doprava', 'CONCAT(nazev, "' . self::PATTERN_C_BEZ_DPH_START . '", cena_bez_dph, "' . self::PATTERN_C_BEZ_DPH_END . '","' . self::PATTERN_C_S_DPH_START . '", cena_s_dph, "' . self::PATTERN_C_S_DPH_END . '")', 'id', 'cena', 'aktivni = ?', 1, 'nazev');
        if (count($pair2) > 0) {
            $vychozi = $this->repo->findOneByColumn('doprava', 'vychozi', 1);

            //mame patterny, ktere prelozime v po provedeni dotazu na html. Je to prasarna, ale alespon neprasime sql   
            $radio = $this->formRadio($form, 'doprava_id', 'Doprava', $vychozi == false ? 0 : $vychozi->id, $this->replaceRadioPattern($pair2));
        }

        #-- 2. group
        $form->addGroup("2")->setOption('label', 'Fakturační adresa')->setOption('open', true);
        #-- nize uvedene 4 pole se ukazuji dle toho, jak vybereme radio
        $radio = $this->formRadioInline($form, 'user_type', 'Zákazník', 1, array(1 => 'koncový', 2 => 'fyzická osoba', 3 => 'právnická osoba'));
        $radio->addCondition(Form::EQUAL, 2)->toggle('t-firma')->toggle('t-ico')->toggle('t-platce_dph');
        $radio->addCondition(Form::EQUAL, 3)->toggle('t-firma')->toggle('t-ico')->toggle('t-dic')->toggle('t-platce_dph');

        $firma = $form->addText('firma', 'Firma')->setOption('id', 't-firma');
        $firma->addConditionOn($form['user_type'], Form::EQUAL, 2)->setRequired('Zadejte jméno firmy');
        $firma->addConditionOn($form['user_type'], Form::EQUAL, 3)->setRequired('Zadejte jméno firmy');

        $ico = $form->addText('ico', 'IČO')->setOption('id', 't-ico');
        $ico->addConditionOn($form['user_type'], Form::EQUAL, 2)->setRequired('Zadejte IČO');
        $ico->addConditionOn($form['user_type'], Form::EQUAL, 3)->setRequired('Zadejte IČO');

        $form->addText('dic', 'DIČ')->setOption('id', 't-dic')
                ->addConditionOn($form['user_type'], Form::EQUAL, 3)
                ->setRequired('Zadejte DIČ');
        $this->formRadioInline($form, 'platce_dph', 'Plátce DPH')->setOption('id', 't-platce_dph')->setRequired();

        $form->addText("jmeno", "Jméno:")->setRequired('Zadejte jméno');
        $form->addText("prijmeni", "Příjmení:")->setRequired('Zadejte příjmení');
        $form->addText("email", "Email:")->setType('email')->setRequired("Zadejte email")->addRule(Form::EMAIL, "Email nemá správný formát.");
        $form->addText("telefon", "Telefon:")->setRequired('Zadejte telefon');
        $form->addText("ulice", "Ulice, č. p.:")->setRequired('Zadejte ulici');
        $form->addText("mesto", "Město:")->setRequired('Zadejte město');
        $form->addText("psc", "PSČ:")->setRequired('Zadejte psč');
        $form->addSelect('stat', 'Stát:', $this->repo->getPairs('stat', 'id', 'nazev', 'nazev'));
        //->setPrompt('-- vyberte stát --');
        //->setRequired('Zadejte stát');
        $form->addTextArea('note', 'Poznámka:')->getControlPrototype()->addAttributes(array('rows' => 5));

        $form->addCheckbox("x", "Dodací adresa se liší od fakturační")->setOmitted()->addCondition(Form::EQUAL, true)->toggle('dodaci-adresa');

        #-- 3. group
        $form->addGroup("3")->setOption('id', 'dodaci-adresa')->setOption('label', 'Dodací adresa')->setOption('open', true);
        $form->addText("djmeno", "Jméno:")->addConditionOn($form['x'], Form::EQUAL, true)->setRequired('Zadejte jméno');
        $form->addText("dprijmeni", "Příjmení:")->addConditionOn($form['x'], Form::EQUAL, true)->setRequired('Zadejte příjmení');

        $email = $form->addText("demail", "Email:")->setType('email');
        $email->addConditionOn($form['x'], Form::EQUAL, true)->setRequired('Zadejte email');
        $email->addCondition(Form::FILLED)->addRule(Form::EMAIL, "Email nemá správný formát.");

        $form->addText("dtelefon", "Telefon:")->addConditionOn($form['x'], Form::EQUAL, true)->setRequired('Zadejte telefon');
        $form->addText("dulice", "Ulice, č. p.:")->addConditionOn($form['x'], Form::EQUAL, true)->setRequired('Zadejte ulici');
        $form->addText("dmesto", "Město:")->addConditionOn($form['x'], Form::EQUAL, true)->setRequired('Zadejte město');
        $form->addText("dpsc", "PSČ:")->addConditionOn($form['x'], Form::EQUAL, true)->setRequired('Zadejte psč');
        $form->addSelect('dstat', 'Stát:', $this->repo->getPairs('stat', 'id', 'nazev', 'nazev'))
                ->setPrompt('-- vyberte stát --');
        //->addConditionOn($form['x'], Form::EQUAL, true)->setRequired('Zadejte stát');
        #-- handlers functions
        $form->onSuccess[] = array($this, 'successZakaznikForm');

        #-- groups toogle
        $this->setGroupsToggle($form);

        #-- bootstrap it
        return $this->boostrapIt($form);
    }

    //=================================== PRIVATE ==============================
    /**
     * prida do session informaci o objednavane polozce
     * 
     * @param int $id polozky
     * @param int $pocet pocet objednavanych kusu
     * @param float $cena_s_dph cena polozky s DPH
     */
    private function setSessionValue($id, $pocet, $cena_s_dph) {
        $section = $this->getSessionSection();
        if (false === $section) {
            $section = $this->getSession()->getSection(self::SESSION_SECTION);
        }

        if (!isset($section->polozky)) {
            $section->polozky = array();
        }

        #-- mame uz polozky v session - objednavali jsme?
        if (isset($section->polozky[$id])) {
            $section->polozky[$id]['pocet'] = $section->polozky[$id]['pocet'] + $pocet;
            $section->polozky[$id]['cena_s_dph'] = $cena_s_dph;
            $section->polozky[$id]['cena_s_dph__celkem'] = $section->polozky[$id]['cena_s_dph__celkem'] + ($pocet * $cena_s_dph);
            $section->polozky[$id]['polozka_data'] = $this->repo->findOneById('polozka', $id)->toArray();
        }
        #-- nemame, zalozime novou
        else {
            $section->polozky[$id] = array(
                'pocet' => $pocet,
                'cena_s_dph' => $cena_s_dph,
                'cena_s_dph__celkem' => $pocet * $cena_s_dph,
                'polozka_data' => $section->polozky[$id]['polozka_data'] = $this->repo->findOneById('polozka', $id)->toArray()
            );
        }
    }

    /**
     * vrati session 
     * 
     * @return \Nette\Http\Session
     */
    private function getSession() {
        return $this->getPresenter()->getSession();
    }

    /**
     * vratin sekci ze session - sekce jen pro CartControl
     * 
     * @return \Nette\Http\SessionSection|false
     */
    private function getSessionSection() {
        $ret = false;

        $session = $this->getSession();
        if ($session->hasSection(self::SESSION_SECTION)) {
            $ret = $session->getSection(self::SESSION_SECTION);
        }

        return $ret;
    }

    /**
     * vrati seznam polozek ze session - radky objednavky (jen id, pocet, celkova cena za pocet polozek)
     * 
     * @return array|false
     */
    private function getSessionData() {
        $ret = false;

        $section = $this->getSessionSection();
        if (false !== $section) {
            if (isset($section->polozky)) {
                $ret = $section->polozky;
            }
        }

        return $ret;
    }

    /**
     * vrati data pripravena pro insert do tabulky objednavka_hlavicka
     * 
     * @param array $data z requestu
     * @return array
     */
    private function getOrderHead(array $data) {
        $count = $this->repo->findAllByWhere('objednavka_hlavicka', 'YEAR(datum) = ?', date('Y'))->count();
        $count_str = str_repeat('0', 4 - strlen($count)) . ($count + 1);

        $platbaId = (isset($data['platba_id']) ? $data['platba_id'] : -1);
        $platba = $this->repo->findOneById('platba', $platbaId);

        $dopravaId = (isset($data['doprava_id']) ? $data['doprava_id'] : - 1);
        $doprava = $this->repo->findOneById('doprava', $dopravaId);

        return array(
            'platba_nazev' => ($platba) ? $platba->nazev : '',
            'platba_cena_bez_dph' => ($platba) ? $platba->cena_bez_dph : 0,
            'platba_cena_s_dph' => ($platba) ? $platba->cena_s_dph : 0,
            'doprava_nazev' => $doprava->nazev,
            'doprava_cena_bez_dph' => ($doprava) ? $doprava->cena_bez_dph : 0,
            'doprava_cena_s_dph' => ($doprava) ? $doprava->cena_s_dph : 0,
            //'platba_id' => $data['platba_id'],
            //'doprava_id' => $data['doprava_id'],
            'cena_bez_dph' => $this->getOrderPriceWithDph() / DPH,
            'cena_s_dph' => $this->getOrderPriceWithDph(),
            'datum' => \Nette\Utils\DateTime::from(time()),
            'ciselna_rada' => date('Y') . $count_str,
            'note' => $data['note']
        );
    }

    /**
     * vrati data urcena pro insert do tabulky objednavka_radky
     * 
     * @param int $objednavkaId id objednavky
     * @return array
     */
    private function getOrderRows($objednavkaId) {
        $sdata = $this->getSessionData();
        $r = array();

        if (false !== $sdata) {
            foreach ($sdata as $id => $val) {
                $polozka = $this->repo->findOneById('polozka', $id);

                array_push($r, array(
                    'objednavka_id' => $objednavkaId,
                    'polozka_id' => $id,
                    'polozka_dostupnost' => $polozka->dostupnost->nazev,
                    'polozka_nazev' => $polozka->nazev,
                    'polozka_cena_bez_dph' => $val['polozka_data']['cena_bez_dph'],
                    'polozka_cena_s_dph' => $val['polozka_data']['cena_bez_dph'] * DPH,
                    'polozka_baleni_pocet' => $polozka->baleni_pocet,
                    'polozka_baleni_mj' => $polozka->baleni_mj,
                    'polozka_pocet' => $val['pocet'],
                    'polozka_vyrobce_nazev' => $polozka->vyrobce->nazev
                        )
                );
            }
        }

        return $r;
    }

    /**
     * vrati data urcena pro insert do tabulky objednavka_zakaznik
     * 
     * @param array $data data z requestu
     * @param int $objednavkaId id objednavky
     * @return array
     */
    private function getOrderCustomer(array $data, $objednavkaId) {
        return array(
            'objednavka_hlavicka_id' => $objednavkaId,
            'user_id' => NULL, // RFIXME - pokud bude prihlaseny nejaky user, pak dosadim ID  a je to ...
            'user_type' => $data['user_type'],
            'platce_dph' => $data['platce_dph'],
            'firma' => $data['firma'],
            'ico' => $data['ico'],
            'dic' => $data['dic']
        );
    }

    /**
     * vrati data urcena pro insert do tabulky objednavka_zakaznik_adresy
     * 
     * @param array $data data z requestu
     * @param int $objednavkaZakaznikId id zakaznika, ktery objednavku udelal (je to jeho adresa)
     * @param int $addressType typ adresy, 1:povinna, 2:dodaci
     * @return array
     */
    private function getOrderCustomerAddress(array $data, $objednavkaZakaznikId, $addressType) {
        $prefix = $addressType == 1 ? '' : 'd';
        $stat = NULL;

        if (null != $data[$prefix . 'stat'] && '' != $data[$prefix . 'stat']) {
            $stat .= $this->repo->findOneById('stat', $data[$prefix . 'stat'])->nazev;
        }

        return array(
            'objednavka_zakaznik_id' => $objednavkaZakaznikId,
            'address_type' => $addressType,
            'jmeno' => $data[$prefix . 'jmeno'],
            'prijmeni' => $data[$prefix . 'prijmeni'],
            'email' => $data[$prefix . 'email'],
            'telefon' => $data[$prefix . 'telefon'],
            'ulice' => $data[$prefix . 'ulice'],
            'mesto' => $data[$prefix . 'mesto'],
            'psc' => $data[$prefix . 'psc'],
            'stat' => $stat
        );
    }

    /**
     * posle mail se shrnutim objednavky, prodejci i zakaznikovi
     * 
     * @param array $zakaznik_adresa informace o zakaznikovi (hlavni adresa)
     * @param array $zakaznik_adresa_d informace o zakaznikovi (dodaci adresa)
     * @param string $subject subjekt
     * @param string $htmlBody telo zpravy
     */
    private function sendOrderEmail($zakaznik_adresa, $zakaznik_adresa_d, $subject, $htmlBody) {
        #-- mail mamka (dasa - objednavky)
        $mail = new \Nette\Mail\Message();
        $mail->setFrom(MAIL_OBJEDNAVKY, MAIL_OBJEDNAVKY_NAME);
        $mail->addTo($zakaznik_adresa['email']);
        if (isset($zakaznik_adresa_d['email']) && '' != $zakaznik_adresa_d['email']) {
            $mail->addTo($zakaznik_adresa_d['email']);
        }

        $mail->addCc(MAIL_OBJEDNAVKY);
        $mail->addBcc(MAIL_ADMIN);
        $mail->setSubject($subject);
        $mail->setHtmlBody($htmlBody);

        try {
            $this->mailer->send($mail);
        } catch (\Exception $e) {
            $this->presenter->flashMessage('Email se nepodařilo odeslat. Zkuste prosím akci opakovat později.', FLASH_ERR);

            trigger_error($e->getMessage(), E_USER_WARNING);
        }
    }

    /**
     * vrati celkovou cenu objednavky
     * 
     * @return float
     */
    private function getOrderPriceWithDph() {
        $p = $this->getSessionData();
        $r = 0;

        if (false !== $p) {
            foreach ($p as $v) {
                $r += isset($v['cena_s_dph__celkem']) ? $v['cena_s_dph__celkem'] : 0;
            }
        }

        return $r;
    }

    /**
     * prevezme vysledek sql a nahradi PATTERNY potrebnymi hodnotami
     * - bohuzel, jinak potrebne hodnoty do popisu radio buttonu nedostanu :(
     * 
     * @param array $pair pole radku z sql
     * @return array upravene labely u radio buttonu
     */
    private function replaceRadioPattern($pair) {
        $pair_upr = array();

        foreach ($pair as $id => $p) {
            $upr2 = $p;

            $matches_s_dph = array();
            $matches_bez_dph = array();

            $pattern = array();
            $pattern[] = self::PATTERN_C_S_DPH_START;
            $pattern[] = self::PATTERN_C_S_DPH_END;
            $pattern[] = self::PATTERN_C_BEZ_DPH_START;
            $pattern[] = self::PATTERN_C_BEZ_DPH_END;

            $replace = array();
            $replace[] = ', ';
            $replace[] = ' s DPH';
            $replace[] = ', cena ';
            $replace[] = ' bez DPH';

            $cena_vetsi_nez_nula = false;

            preg_match('/' . self::PATTERN_C_S_DPH_START . '([0-9\.,]+)' . self::PATTERN_C_S_DPH_END . '/', $upr2, $matches_s_dph);
            if (isset($matches_s_dph[1])) {
                $pattern[] = $matches_s_dph[1];
                $replace[] = \App\Helpers\Format::money($matches_s_dph[1], 'Kč');

                if ($matches_s_dph[1] > 0) {
                    $cena_vetsi_nez_nula = true;
                }
            }

            preg_match('/' . self::PATTERN_C_BEZ_DPH_START . '([0-9\.,]+)' . self::PATTERN_C_BEZ_DPH_END . '/', $upr2, $matches_bez_dph);
            if (isset($matches_bez_dph[1])) {
                $pattern[] = $matches_bez_dph[1];
                $replace[] = \App\Helpers\Format::money($matches_bez_dph[1], 'Kč');

                if ($matches_bez_dph[1] > 0) {
                    $cena_vetsi_nez_nula = true;
                }
            }

            //\Tracy\Dumper::dump($cena_vetsi_nez_nula);

            if ($cena_vetsi_nez_nula) {
                $pair_upr[$id] = str_replace($pattern, $replace, $upr2);
            } else {
                for ($i = 0; $i < count($pattern); $i++) {
                    $upr2 = str_replace($pattern[$i], '', $upr2);
                }

                $pair_upr[$id] = $upr2;
            }

            //\Tracy\Dumper::dump($pair_upr);
        }
        // die();
        return $pair_upr;
    }

}
