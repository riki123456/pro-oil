<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\ItemsControl/Templates/item-form.latte

class Templateee85af4a1136ad9e727d2ddf66f65701 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('69d223bc19', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$formContainers = array('baleni' => array('content' => '', 'rendered' => false, 'insideControls' => array('cena_bez_dph', 'baleni_pocet', 'baleni_mj'))) ?>

<?php ob_start() ?>
    <div class="form-group">
        <div class="col-sm-2 control-label <?php echo Latte\Runtime\Filters::escapeHtml($crudForm->getComponent('cena_bez_dph')->control->isRequired() ? 'required' : '', ENT_COMPAT) ?>">
            <?php echo Latte\Runtime\Filters::escapeHtml($crudForm->getComponent('cena_bez_dph')->label, ENT_NOQUOTES) ?>

        </div>
        <div class="col-sm-9">
            <div class="input-group" style="width: 100%;">
                <?php echo Latte\Runtime\Filters::escapeHtml($crudForm->getComponent('cena_bez_dph')->control, ENT_NOQUOTES) ?>

                <input type="text" disabled="disabled" name="" style="width: 60px;" class="form-control" value="kč za">
                
                <?php echo Latte\Runtime\Filters::escapeHtml($crudForm->getComponent('baleni_pocet')->control, ENT_NOQUOTES) ?>

                
                <?php echo Latte\Runtime\Filters::escapeHtml($crudForm->getComponent('baleni_mj')->control, ENT_NOQUOTES) ?>


            </div>
        </div>
    </div>
<?php $formContainers['baleni']['content'] = ob_get_clean() ?>

<?php $_b->templates['69d223bc19']->renderChildTemplate('../../Templates/FormManually.latte', array('subContainersDefined' => $formContainers) + $template->getParameters()) ;
}}