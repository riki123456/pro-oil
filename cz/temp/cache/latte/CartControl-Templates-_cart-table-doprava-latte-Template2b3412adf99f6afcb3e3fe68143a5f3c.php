<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\CartControl/Templates/_cart-table-doprava.latte

class Template2b3412adf99f6afcb3e3fe68143a5f3c extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('aa2a7c2b20', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if (count($dataZakaznik) > 0) { if ('' != $dataZakaznik->objednavka_hlavicka->doprava_nazev) { ?>
        <tr><td colspan="6"><b>CENA DOPRAVY</b></td></tr>
        <tr>
            <td><b>Způsob dopravy:</b></td>
            <td colspan="2"><?php echo Latte\Runtime\Filters::escapeHtml($dataZakaznik->objednavka_hlavicka->doprava_nazev, ENT_NOQUOTES) ?></td>
            <td><b>Cena dopravy:</b></td>
            <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money($dataZakaznik->objednavka_hlavicka->doprava_cena_bez_dph, 'Kč'), ENT_NOQUOTES) ?></td>
            <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money(ceil($dataZakaznik->objednavka_hlavicka->doprava_cena_s_dph), 'Kč'), ENT_NOQUOTES) ?></td>
        </tr>
        
        <tr><td colspan="6">&nbsp;</td></tr>
<?php } ?>
    
<?php if ('' != $dataZakaznik->objednavka_hlavicka->platba_nazev) { ?>
        <tr><td colspan="6"><b>PLATBA</b></td></tr>
        <tr>
            <td><b>Způsob platby:</b></td>
            <td colspan="2"><?php echo Latte\Runtime\Filters::escapeHtml($dataZakaznik->objednavka_hlavicka->platba_nazev, ENT_NOQUOTES) ?></td>
            <td><b>Cena platby:</b></td>
            <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money($dataZakaznik->objednavka_hlavicka->platba_cena_bez_dph, 'Kč'), ENT_NOQUOTES) ?></td>
            <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money(ceil($dataZakaznik->objednavka_hlavicka->platba_cena_s_dph), 'Kč'), ENT_NOQUOTES) ?></td>
        </tr>
        
        <tr><td colspan="6">&nbsp;</td></tr>
<?php } } 
}}