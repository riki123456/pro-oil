<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\ItemsControl/Templates/items.latte

class Template883b7271a68113d42bf875a3e8c5d467 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('76b8f301d0', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block _productsManipulation
//
if (!function_exists($_b->blocks['_productsManipulation'][] = '_lbff8a119b17__productsManipulation')) { function _lbff8a119b17__productsManipulation($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('productsManipulation', FALSE)
?>    <div class="row product-manipulation-row margin-bottom-base">
<?php $_b->templates['76b8f301d0']->renderChildTemplate("_products-manipulation.latte", $template->getParameters()) ?>
    </div>
<?php
}}

//
// block _productsPaginator
//
if (!function_exists($_b->blocks['_productsPaginator'][] = '_lb8f34a70655__productsPaginator')) { function _lb8f34a70655__productsPaginator($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('productsPaginator', FALSE)
?>    <div class="row">
<?php $_b->templates['76b8f301d0']->renderChildTemplate("_products-paginator.latte", $template->getParameters()) ?>
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); } ?>
<div id="<?php echo $_control->getSnippetId('productsManipulation') ?>"><?php call_user_func(reset($_b->blocks['_productsManipulation']), $_b, $template->getParameters()) ?>
</div>
<div class="row">
<?php $_b->templates['76b8f301d0']->renderChildTemplate("_products.latte", $template->getParameters()) ?>
</div>

<div id="<?php echo $_control->getSnippetId('productsPaginator') ?>"><?php call_user_func(reset($_b->blocks['_productsPaginator']), $_b, $template->getParameters()) ?>
</div><?php
}}