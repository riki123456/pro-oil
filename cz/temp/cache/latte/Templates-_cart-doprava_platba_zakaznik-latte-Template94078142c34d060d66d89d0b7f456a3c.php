<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\CartControl/Templates/_cart-doprava_platba_zakaznik.latte

class Template94078142c34d060d66d89d0b7f456a3c extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('de82636996', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$_l->tmp = $_control->getComponent("zakaznikForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>

<div class="panel panel-body panel-default margin-bottom-base">
    Celková cena s dopravou bez DPH: 
    <span class="pull-right">
        <span id="cena_celkem_doprava_bez_dph">0</span>
        <sup class="fa fa-info-circle fa-size-0a7x" data-toggle="tooltip" data-placement="top" title="Částka je zaokrouhlena na celé koruny nahoru."></sup>
    </span>
    <br>
    <span class="fa-size-1a5x active">Celková cena s dopravou s DPH:
        <span class="pull-right">
            <span id="cena_celkem_doprava_s_dph">0</span>
            <sup class="fa fa-info-circle fa-size-0a7x" data-toggle="tooltip" data-placement="top" title="Částka je zaokrouhlena na celé koruny nahoru."></sup>
        </span>
    </span>
</div><?php
}}