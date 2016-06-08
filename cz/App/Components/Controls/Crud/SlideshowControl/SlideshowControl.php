<?php

namespace App\Components\Controls\Crud\SlideshowControl;

use Nette\Application\UI\Form,
    App\Model\Repositories\Repository,
    App\Model,
    App\Components\Controls\Crud;

/**
 * Description of SlideshowControl
 *
 * @author miroslav.petras
 */
class SlideshowControl extends Crud\CrudControl {

    protected $repoTablename = 'slideshow';

    /** @var Repository $repo */
    protected $repo;

    /** @var Model\ImageStorage */
    protected $imageStorage;

    /**
     * konfigurace pro bootstrap table
     * 
     * array('dbColumnName' => 'showName', 'dbColumnName' => 'showName', ...)
     * array('name' => 'Jméno', 'surname' => 'Příjmení', ...)
     * 
     * @var array $tableConfig 
     */
    protected $tableConfig = array(
        'img' => 'Název',
        'link' => 'Odkaz',
        'display' => 'Zobrazit'
    );

    /**
     * zavola rodicovsky konstruktor a nastavi repozitar a tabli, nad kterou funguje
     * 
     * @param Repository $repo
     */
    public function __construct(Repository $repo, Model\ImageStorage $imageStorage) {
        parent::__construct();
        
        $this->repo = $repo;
        $this->imageStorage = $imageStorage;
    }

    public function renderSlideshow() {
        #-- a slider
        $fcol = $this->getPresenter()->getComponent("jsDynamic")->getCompiler()->getFileCollection();
        $fcol->addFile(ROOT_FS_WWW . '/media/responsiveslides.min.js');
        $fcol->addFile(__DIR__ . '/Scripts/slider.js');
        
        $fcol2 = $this->getPresenter()->getComponent('cssDynamic')->getCompiler()->getFileCollection();
        $fcol2->addFile(ROOT_FS_WWW . '/media/responsiveslides.css');

        $this->template->slides = $this->repo->findAllByColumn('slideshow', 'display', 1)->fetchAll();
        shuffle($this->template->slides); //nahodne zamicha s polem
        
        $this->template->setFile(__DIR__ . '/Templates/slider.latte');
        $this->template->render();
    }
    
    /**
     * nejdrive zavola rodicovskou metodu - ta nam vse obhospodari.
     * my potom nastavime jen 'description' a vyrenderujeme.
     * 
     * Pouziva se i pro 'renderDetail' !
     * 
     * @param int $id id polozky
     */
    public function renderEdit($id) {
        #-- vypneme rodici renderovani
        $this->renderNow = false;
        #-- zavolame rodicovskou metodu - naplni nam def. hodnoty
        parent::renderEdit($id);

        #-- upravime description
        $form = $this['crudForm'];
        $form['img']->setOption('description', \Nette\Utils\Html::el('img')->addAttributes(array('src' => $this->imageStorage->getWwwPath($form->getValues(true)['img'], '/slideshow'))));

        #-- renderujeme
        $this->template->render();
    }

    /**
     * zpracovava upload soubor, pote vola parent metodu
     * 
     * @param UI\Form $form
     */
    public function successForm($form) {
        $values = $form->getValues(true);

        if (isset($values['image'])) {
            $image = $values['image'];
            $filename = $values['img'];

            #-- kontrola, zda-li byl obrazek skutecne nahran a zda se jedna o obrazek
            if ($image->isOk() && $image->isImage()) {
                $filename = $image->getSanitizedName();

                #-- velikost musi byt maximalne 700x200
                $cropImage = \Nette\Utils\Image::fromFile($image);
                $cropImage->resize(SLIDESHOW_SIZE_WIDTH, SLIDESHOW_SIZE_HEIGHT, \Nette\Utils\Image::ENLARGE);

                #-- a tem muzeme kopirovat
                $cropImage->save($this->imageStorage->getFsPath($filename, '/slideshow', true));
            }

            #-- do db ulozime cestu k obrazku - pole 'img' ne 'image'
            $this->removeElementFromForm($form, array('image'));
            $values['img'] = $filename;
            $form->setValues($values);
        }

        #-- a zavolame parent metodu
        parent::successForm($form);
    }

    //=================================== PROTECTED ============================

    /**
     * TransfersForm factory.
     * @return Form
     */
    protected function createComponentCrudForm() {
        #-- action
        $_act = $this->getPresenter()->getAction();

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
        if ($_act !== 'add') {
            $form->addHidden('id');
        }

        #-- cely form
        $form->addGroup("firstgroup")->setOption('label', 'Základní údaje');

        #-- upload pro obrazek a hidden input pro info do db        
        if ($_act == 'detail') {
            $form->addText('img', 'Obrázek');
        } elseif ($_act == 'add') {
            $form->addHidden('img');
            $form->addUpload('image', 'Obrázek:')
                    ->setRequired('Vyberte obrázek.')
                    ->addRule(Form::IMAGE, 'Soubor musí být obrázek - .jpg, .gif, .png');
        } elseif ($_act == 'edit') {
            $form->addText('img', 'Obrázek:')
                    ->setAttribute('readonly', true);
        }

        #-- odkaz
        $form->addText('link', 'Odkaz:')->setType('url');

        #-- true/false radio
        $this->formRadioInline($form, 'display', 'Zobrazit:', 1);

        #-- handlers functions
        $form->onSuccess[] = array($this, 'successForm');

        #-- groups toogle
        $this->setGroupsToggle($form);

        #-- bootstrap it
        return $this->boostrapIt($form);
    }

}
