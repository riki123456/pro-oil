<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\ItemsControl/Templates/../../Templates/FormManually.latte

class Template84f13fcdccc10d337acb82d1b1898782 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('879f6ea2a5', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block group
//
if (!function_exists($_b->blocks['group'][] = '_lb84b4b4dbed_group')) { function _lb84b4b4dbed_group($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($crudForm->groups) as $group) { if ($group->controls && $group->getOption('visual')) { ?>    <fieldset>
<?php if (isset($group->options['label'])) { ?>        <legend><?php echo Latte\Runtime\Filters::escapeHtml($group->options['label'], ENT_NOQUOTES) ?></legend>
<?php } if (isset($group->options['description'])) { ?>        <i><?php echo Latte\Runtime\Filters::escapeHtml($group->options['description'], ENT_NOQUOTES) ?></i>
<?php } ?>

<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($group->controls) as $control) { if (!$control instanceof Nette\Forms\Controls\Button && !$control->getOption('rendered') && $control->getForm(FALSE) === $crudForm) { if (false !== in_array($control->getName(), $subContainerControls)) { $iterations = 0; foreach ($subContainersDefined as $subKey => $subForm) { if (false === $subForm['rendered']) { $y = $subContainersDefined[$subKey]['rendered'] = true ;$x = $control->setOption('rendered', TRUE) ?>
                            <?php echo $subForm['content'] ?>

<?php } $iterations++; } ?>

<?php } else { ?>
                    <!-- tak predano nic neni, takze jedem v default (nerenderujeme buttony, ty az na konec) -->
<?php call_user_func(reset($_b->blocks['controls']), $_b, get_defined_vars()) ; } } $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>

    </fieldset>
<?php } $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ;
}}

//
// block controls
//
if (!function_exists($_b->blocks['controls'][] = '_lb856a6b433a_controls')) { function _lb856a6b433a_controls($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>                    <div class="form-group">
<?php call_user_func(reset($_b->blocks['label']), $_b, get_defined_vars()) ; call_user_func(reset($_b->blocks['control']), $_b, get_defined_vars())  ?>
                    </div>
<?php
}}

//
// block label
//
if (!function_exists($_b->blocks['label'][] = '_lb2b22414ad7_label')) { function _lb2b22414ad7_label($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>                        <div class="col-sm-2 control-label <?php echo Latte\Runtime\Filters::escapeHtml($control->isRequired() ? 'required' : '', ENT_COMPAT) ?>">
<?php if ($control instanceof Nette\Forms\Controls\Button || $control instanceof Nette\Forms\Controls\Checkbox && !isset($control->label)) { ?>
                                &nbsp;
<?php } else { ?>
                                <?php echo $control->label ?>

<?php } ?>
                        </div>
<?php
}}

//
// block control
//
if (!function_exists($_b->blocks['control'][] = '_lb984f2f4e09_control')) { function _lb984f2f4e09_control($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>                        <div class="col-sm-9">
                            <?php echo $control->control ?>

<?php if ($control instanceof Nette\Forms\Controls\Checkbox) { ?>
                                <?php echo $control->label ?>

<?php } if ($control->getOption('description')) { ?>
                                <?php echo Latte\Runtime\Filters::escapeHtml($control->getOption('description'), ENT_NOQUOTES) ?>

<?php } ?>
                        </div>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$subContainerControls = array() ;if ((isset($subContainersDefined) === true)) { $iterations = 0; foreach ($subContainersDefined as $subKey => $subForm) { $subContainerControls = array_merge($subForm['insideControls'], $subContainerControls) ;$iterations++; } } ?>

<div class="komponent">
<?php if (is_object($crudForm)) $_l->tmp = $crudForm; else $_l->tmp = $_control->getComponent($crudForm); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render('begin') ?>

    <!-- hidden fields -->
<?php $iterations = 0; foreach ($crudForm->getComponents(TRUE, 'Nette\Forms\Controls\HiddenField') as $control) { ?>
    <div><?php echo Latte\Runtime\Filters::escapeHtml($control->control, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>

    <!-- groups (nerenderujeme buttony, ty az na konec) -->
<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['group']), $_b, get_defined_vars())  ?>

    <!-- non-group -->
<?php call_user_func(reset($_b->blocks['controls']), $_b, array('group' => $crudForm) + get_defined_vars()) ?>

    <!-- buttons -->
    <div class="form-group">
        <div class="col-sm-2 control-label">&nbsp;</div>
        <div class="col-sm-9">
<?php $iterations = 0; foreach ($crudForm->getComponents(TRUE, 'Nette\Forms\Controls\Button') as $control) { ?>
                <?php echo Latte\Runtime\Filters::escapeHtml($control->control, ENT_NOQUOTES) ?>

<?php $iterations++; } ?>
        </div>
    </div>

<?php if (is_object($crudForm)) $_l->tmp = $crudForm; else $_l->tmp = $_control->getComponent($crudForm); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render('end') ?>

</div><?php
}}