<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Front/templates/Components/navigation-sub.latte

class Templateb8b1cf64cf4c5847e7dea95a926a1945 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('83c1102ee3', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<div class="row margin-bottom-large">
    <div class="col-md-4 hidden-xs hidden-sm">
        <a href="/">
            <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>/images/layout/logo_nove.png" widht="310" height="40" alt="pro-oil" class="img-responsive hidden-xs">
        </a>
    </div>
    <div class="col-md-4 col-sm-7 col-xs-5">
<?php $_l->tmp = $_control->getComponent("itemsControl"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->renderItemsSearch() ?>
    </div>
    <div class="col-md-4 col-sm-5 col-xs-7 pull-right">
<?php $_l->tmp = $_control->getComponent("cartControl"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->renderCartMini() ?>
    </div>
</div>
<?php
}}