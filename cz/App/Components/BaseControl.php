<?php

namespace App\Components;

use Nette\Application\UI,
    Nette\Utils\Html,
    Nette\Forms\Controls;

/**
 * Předek všech komponent.
 */
class BaseControl extends UI\Control {

    protected static $imageUploadValueName = 'image';

    /**
     * pripoji latte filtr - money
     * 
     * @param Nette\ComponentModel\IComponent $presenter
     */
    public function attached($presenter) {
        parent::attached($presenter);

        $latte = $this->template->getLatte();
        $latte->addFilter('money', \App\Helpers\Format::loadHelper('money'));
    }

    /**
     * obecna metoda pro renderovani. Jeji sablonu musim definovat v konkretni komponente/Control
     * - existuje hlavne proto, ze pri invalidaci snippetu si tuto metodu proste nette vola ... jinak mi to nefunguje ;(
     */
    public function render() {
        if (!$this->presenter->isAjax()) {
            $msg = 'Metoda "render()" v BaseControl.php je urcena je pro renderovani ajax! Vice neni osetreno, implementovano, otestovano';
            throw new \Nette\NotImplementedException($msg);
        }

        $this->template->render();
    }

    /**
     * odebere skupiny z formulare. Pozor, odebira zaroven i elementy ze skupiny!
     * 
     * @param \Nette\Application\UI\Form
     * @param array $groups
     */
    protected function removeGroupFromForm(UI\Form $form, array $groups) {
        for ($i = 0; $i < count($groups); $i++) {
            $form->removeGroup($groups[$i]);
        }
    }

    /**
     * zrusi elementy z formulare
     * 
     * @param \Nette\Application\UI\Form
     * @param array $elements elementy ke zruseni
     */
    protected function removeElementFromForm(UI\Form $form, array $elements) {
        for ($i = 0; $i < count($elements); $i++) {
            if (isset($form[$elements[$i]])) {
                unset($form[$elements[$i]]);
            }
        }
    }

    /**
     * nastavi skupinu jako 'toggle' 
     * ... potrebuje mit definovano $group->setOption('label', 'Neco co se zobrazi jako nazev group')
     * ... muzu definovat povinne otevreni (js pak tohle nemeni) jako $group->setOption('alwaysOpen', true);
     * ... a taky js, ktery to toggle dela ze ;)
     * 
     * @param \Nette\Application\UI\Form $form
     */
    protected function setGroupsToggle(UI\Form $form) {
        $firstGroup = true;

        foreach ($form->getGroups() as $group) {
            #-- prvni group oteviram vzdy
            $plusMinusIcon = ($firstGroup) ? 'fa-plus-square-o' : 'fa-plus-square-o fa-minus-square-o';

            #-- muzu mit natvrdo nastaveno, at otevru !
            if($group->getOption('open') == true) {
                $plusMinusIcon = 'fa-plus-square-o';
            }
            
            #-- ted uz html kod
            $group->setOption("label", Html::el('div')
                            ->addClass("nette-form-group-toggle")
                            ->setHtml($group->getOption('label') . ' <span class="fa ' . $plusMinusIcon . ' pull-right"></span>'));

            #-- zpracoval jsem prvni grupu, takze priznak pro ostatni uz na false
            $firstGroup = false;
        }
    }

    /**
     * Renderovani upravavene pro Bootstrap
     * 
     * @param object $component
     * @return \Nette\Object
     */
    protected function boostrapIt($component) {
        $r = $component;

        if ($component instanceof UI\Form) {
            $r = $this->bootstrapForm($component);
        }

        return $r;
    }

    /**
     * 
     * @param UI\Form $form
     * @param string $inputName
     * @param string $labelName
     * @param boole $isRequired - default true
     * @return \Nette\Forms\Controls\UploadControl $up
     */
    protected function formImage($form, $inputName, $labelName, $isRequired = true) {
        $form->addHidden($inputName);

        $up = $form->addUpload(self::$imageUploadValueName, $labelName);
        $up->addCondition(UI\Form::FILLED)->addRule(UI\Form::IMAGE, 'Soubor musí být ve formátu - .jpg, .gif, .png');
        if ($isRequired) {
            $up->addConditionOn($form['img'], ~ UI\Form::FILLED)->addRule(UI\Form::REQUIRED, 'Položka je povinná.');
        }

        return $up;
    }

    /**
     * 
     * @param UI\Form $form
     * @param string $inputName
     * @param string $labelName
     * @param mixed $defaultValue
     * @return \Nette\Forms\Controls\TextInput $ti
     */
    protected function formInteger($form, $inputName, $labelName, $defaultValue = '') {
        $ti = $form->addText($inputName, $labelName);
        $ti->setType('number')
                ->setDefaultValue($defaultValue)
                ->setAttribute('step', '1')
                ->setAttribute('style', 'width: 40%;')
                ->setRequired('Zadejte hodnotu (musí být číslo).')
                ->addRule(UI\Form::INTEGER, 'Hodnota musí být číslo.');

        return $ti;
    }

    /**
     * 
     * @param UI\Form $form
     * @param string $inputName
     * @param string $labelName
     * @param mixed $defaultValue
     * @return \Nette\Forms\Controls\TextInput $ti
     */
    protected function formDecimal($form, $inputName, $labelName, $defaultValue = '') {
        $ti = $form->addText($inputName, $labelName);
        $ti->setType('number')
                ->setDefaultValue($defaultValue)
                ->setAttribute('step', '0.1')
                ->setAttribute('style', 'width: 40%;')
                ->setRequired('Zadejte hodnotu (musí být číslo).')
                ->addRule(UI\Form::FLOAT, 'Hodnota musí být číslo.');

        return $ti;
    }

    /**
     * zjednoduseni pro vygenerovani inline radio setu
     * 
     * @param UI\Form $form
     * @param string $inputName
     * @param string $labelName
     * @param mixed $defaultValue
     * @param array $values
     * @return \Nette\Forms\Controls\RadioList $radio
     */
    protected function formRadioInline($form, $inputName, $labelName, $defaultValue = 0, $values = array(0 => 'NE', 1 => 'ANO')) {
        $radio = $form->addRadioList($inputName, $labelName, $values);
        $radio->setDefaultValue($defaultValue)->getControlPrototype()->setType('radio');
        $radio->getItemLabelPrototype()->addClass('radio-inline');

        return $radio;
    }
    
    /**
     * zjednoduseni pro vygenerovani inline radio setu
     * 
     * @param UI\Form $form
     * @param string $inputName
     * @param string $labelName
     * @param mixed $defaultValue
     * @param array $values
     * @return \Nette\Forms\Controls\RadioList $radio
     */
    protected function formRadio($form, $inputName, $labelName, $defaultValue = 0, $values = array(0 => 'NE', 1 => 'ANO')) {
        $radio = $form->addRadioList($inputName, $labelName, $values);
        $radio->setDefaultValue($defaultValue)->getControlPrototype()->setType('radio');

        return $radio;
    }

    //============================== PRIVATE ===================================
    /**
     * bootstrap form behavior
     * 
     * @param \App\Components\UI\Form $form
     * @return \Nette\Application\UI\Form
     */
    private function bootstrapForm(UI\Form $form) {
        #-- use wrappers for bootstraping
        $this->bootstrapByWrappers($form);

        #-- make form and controls compatible with Twitter Bootstrap
        $form->getElementPrototype()->class('form-horizontal hidden');

        foreach ($form->getControls() as $control) {
            #-- button
            if ($control instanceof Controls\Button) {
                $this->bootstrapFormControlButton($control);
            }
            #-- text
            elseif ($control instanceof Controls\TextBase) {
                $this->bootstrapFormControlText($control);
            } elseif ($control instanceof Controls\UploadControl) {
                $this->bootstrapFormControlUpload($control);
            }
            #-- select
            elseif ($control instanceof Controls\SelectBox) {
                $this->bootstrapFormControlSelect($control);
            }
            #-- select multi
            elseif ($control instanceof Controls\MultiSelectBox) {
                $this->bootstrapFormControlSelectMulti($control);
            }
            #-- checkbox
            elseif ($control instanceof Controls\Checkbox) {
                $this->bootstrapFormControlCheckbox($control);
            }
            #-- checkbox list
            elseif ($control instanceof Controls\CheckboxList) {
                $this->bootstrapFormControlCheckboxList($control);
            }
            #-- radio list
            elseif ($control instanceof Controls\RadioList) {
                $this->bootstrapFormControlRadioList($control);
            }
        }

        return $form;
    }

    /**
     * upravuje renderovani formu na boostrap-form pomoci wrapperu
     * 
     * @param \Nette\Application\UI\Form $form
     */
    private function bootstrapByWrappers(UI\Form $form) {
        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = NULL;
        $renderer->wrappers['control']['container'] = 'div class=col-sm-9';
        $renderer->wrappers['control']['description'] = 'span class=help-block';
        $renderer->wrappers['control']['errorcontainer'] = 'span class=help-block';

        $renderer->wrappers['label']['container'] = 'div class="col-sm-2 control-label"';

        $renderer->wrappers['pair']['container'] = 'div class=form-group';
        $renderer->wrappers['pair']['.error'] = 'has-error';

        $renderer->wrappers['error']['container'] = NULL;
        $renderer->wrappers['error']['item'] = 'div class="alert alert-danger"';
    }

    /**
     * 
     * @param \Nette\Forms\Controls\BaseControl $control text
     */
    private function bootstrapFormControlText($control) {
        $control->getControlPrototype()->addClass('form-control');
    }

    /**
     * 
     * @param \Nette\Forms\Controls\BaseControl $control upload
     */
    private function bootstrapFormControlUpload($control) {
        $control->getControlPrototype()->addClass('form-control');
    }

    /**
     * 
     * @param \Nette\Forms\Controls\BaseControl $control select
     */
    private function bootstrapFormControlSelect($control) {
        $control->getControlPrototype()->addClass('form-control');
    }

    /**
     * 
     * @param \Nette\Forms\Controls\BaseControl $control select multi
     */
    private function bootstrapFormControlSelectMulti($control) {
        $control->getControlPrototype()->addClass('form-control');
    }

    /**
     * 
     * @param \Nette\Forms\Controls\BaseControl $control checkbox
     */
    private function bootstrapFormControlCheckbox($control) {
        $control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
    }

    /**
     * 
     * @param \Nette\Forms\Controls\BaseControl $control checkbox list
     */
    private function bootstrapFormControlCheckboxList($control) {
        $attrs = $control->getLabelPrototype()->attributes();

        if (false !== strpos($attrs, 'class') && false !== strpos($attrs, '-inline')) {
            $control->getSeparatorPrototype()->setName(NULL);
        } else {
            $control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
        }
    }

    /**
     * 
     * @param \Nette\Forms\Controls\BaseControl $control radio list
     */
    private function bootstrapFormControlRadioList($control) {
        $attrs = $control->getItemLabelPrototype()->attributes();

        if (false !== strpos($attrs, 'class') && false !== strpos($attrs, '-inline')) {
            $control->getSeparatorPrototype()->setName(NULL);
        } else {
            $control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
        }
    }

    /**
     * 
     * @param \Nette\Forms\Controls\BaseControl $control button
     */
    private function bootstrapFormControlButton($control) {
        #-- pokud uz by byla nejaka trida definovana (a obsahovala definici buttonu: btn-xxx),
        #-- pak pridavame jen 'btn'. Jinak pro jistotu vse pro button
        $attrs = $control->getControlPrototype()->attributes();

        if (false !== strpos($attrs, 'class') && false !== strpos($attrs, 'btn-')) {
            $control->getControlPrototype()->addClass('btn');
        } else {
            $control->getControlPrototype()->addClass('btn btn-primary');
        }
    }

}
