<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\CartControl/Templates/cart.latte

class Template69397070c1655f2ed172a5608035747b extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('d640641f80', 'html')
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
<div class="row"><?php $_b->templates['d640641f80']->renderChildTemplate('_cart-obsah_kosiku.latte', $template->getParameters()) ?></div>
<div class="row"><?php $_b->templates['d640641f80']->renderChildTemplate('_cart-doprava_platba_zakaznik.latte', $template->getParameters()) ?>
</div><?php
}}