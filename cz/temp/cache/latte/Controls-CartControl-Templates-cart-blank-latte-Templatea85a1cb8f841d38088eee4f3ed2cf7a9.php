<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\CartControl/Templates/cart-blank.latte

class Templatea85a1cb8f841d38088eee4f3ed2cf7a9 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('cf606565a0', 'html')
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
<div class="row">
    <div class="margin-bottom-large">
        <h4>Tato sekce je určena pro kalkulaci individuálních cen při větších odběrech.</h4>
        Vyplňte formulář níže a odešlete. Naši obchodníci vás budou kontaktovat.
    </div>
    
    <div><?php $_l->tmp = $_control->getComponent("blankCartForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?></div>
</div><?php
}}