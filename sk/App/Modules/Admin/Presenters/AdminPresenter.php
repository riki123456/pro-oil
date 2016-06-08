<?php

namespace App\Modules\Admin\Presenters;

use App\Modules\Base\Presenters;

abstract class AdminPresenter extends Presenters\BasePresenter {

    //=================== Crud - only for links ================================
    // - metody musi byt definovany, aby v latte proslo $this->link()
    // - pokud metoda neni definova, zarve pri vytvareni odkazu
    // - metoda(y) nedelaji nic ... jen maji sve view (.latte)
    //==========================================================================
    public function renderEdit($id) {
        unset($id);
    }

    public function renderDetail($id) {
        unset($id);
    }

    //=================== PROTECTED ============================================
    /**
     * metoda se provede pres samotnym renderovanim
     * - nahrava css a js pro admina
     * - resi nam breadcrumb, hlavni i pro jednotlive render akce potomka
     * - resi nam nastaveni spolecneho view pro Crud akce a predavani zakladniho ID parametru
     */
    protected function beforeRender() {
        parent::beforeRender();

        #-- title
        $this->template->title = $this->getConfigValue('titles', 'default');
        
        #-- breadcrumb
        $this->breadcrumb->replace('main', $this->link('Default:'), 'Hlavní strana'); // replace pro odkaz na hlavni stranu. Z .neon prichazi pro front modul
        $this->breadcrumb->add('default', $this->link($this->getConfigValue('presenter') . ":"), $this->template->title);
        $this->template->breadcrumb = $this->breadcrumb;
        
        #-- breadcrumb a spolecny template (+ promenne) pro Crud akce
        if (true == $this->getConfigValue('crud')) {
            if (false == $this->breadcrumb->hasIndex($this->getAction())) {
                $link = $this->link($this->getConfigValue('presenter') . ":" . $this->getAction());
                $this->breadcrumb->add($this->getAction(), $link, $this->getConfigValue('titles', $this->getAction()));
            }

            #-- spolecny template a jeho promenne
            $this->template->itemId = $this->getParameter('id');
            $this->template->itemPresenterName = strtolower($this->getPresenterName());
            $this->template->itemActionName = strtolower($this->getAction());
            $this->template->setFile(__DIR__ . '/../templates/Components/Presenters/crud.latte');
        }
    }

    /**
     * vrati hodnotu z konfigurace (pro presentera)
     * 
     * @param string $index hlavni index v poli
     * @param string $subindex pod-index hlavniho indexu v poli
     * @return string hodnota konfigurace
     * @throws \UnexpectedValueException pokud neni index (subindex) v poli definovan
     */
    protected function getConfigValue($index, $subindex = '') {
        $return = '';

        #-- nalezli jsme hlavni index
        if (isset($this->presenterConfig[$index])) {
            #-- chceme jeste pod-index?
            if ('' != $subindex) {
                if (isset($this->presenterConfig[$index][$subindex])) {
                    $return = $this->presenterConfig[$index][$subindex];
                } else {
                    trigger_error("Hodnota pro SUBINDEX NENALEZENA !. index: '$index', subindex: '$subindex'. Konfigurace: " . serialize($this->presenterConfig), E_USER_WARNING);
                }
            } else {
                $return = $this->presenterConfig[$index];
            }
        } else {
            trigger_error("Hodnota pro INDEX NENALEZENA !. index: '$index', subindex: '$subindex'. Konfigurace: " . serialize($this->presenterConfig), E_USER_WARNING);
        }

        return $return;
    }

}
