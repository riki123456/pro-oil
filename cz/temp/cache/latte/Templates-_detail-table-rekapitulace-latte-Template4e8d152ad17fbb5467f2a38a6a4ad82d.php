<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\OrdersControl/Templates/_detail-table-rekapitulace.latte

class Template4e8d152ad17fbb5467f2a38a6a4ad82d extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('cca8148ef2', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$cena_celkem_bez_dph = 0 ;$iterations = 0; foreach ($data as $d) { $cena_celkem_bez_dph = $cena_celkem_bez_dph + ($d->ora_pocet * $d->ora_cena_bez_dph) ;$iterations++; } ?>

<?php $_cena_celkem_bez_dph__plus__doprava_bez_dph = $cena_celkem_bez_dph + $dataZakaznik->objednavka_hlavicka->doprava_cena_bez_dph ;$_cena_celkem_s_dph__plus__doprava_s_dph = ($cena_celkem_bez_dph * constant("DPH")) + $dataZakaznik->objednavka_hlavicka->doprava_cena_s_dph ?>

<?php $_cena_jenom_dph = ($cena_celkem_bez_dph * (constant("DPH") - 1)) ;$_doprava_jenom_dph = $dataZakaznik->objednavka_hlavicka->doprava_cena_s_dph - $dataZakaznik->objednavka_hlavicka->doprava_cena_bez_dph ?>

<?php $_cena_jenom_dph__plus__doprava_jenom_dph = $_cena_jenom_dph + $_doprava_jenom_dph ?>

<tr><td colspan="6"><b>REKAPITULACE OBJEDNÁVKY</b></td></tr>
<tr>
    <td colspan="5"><b>CENA CELKEM BEZ DPH</b> <i>(suma cen objednaných položek  bez DPH + cena dopravy bez DPH).</i></td>
    <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money($_cena_celkem_bez_dph__plus__doprava_bez_dph, 'Kč'), ENT_NOQUOTES) ?></td>
</tr>
<tr>
    <td colspan="5"><b>DPH <?php echo Latte\Runtime\Filters::escapeHtml(constant("DPH_PROCENTO"), ENT_NOQUOTES) ?> %</b></td>
    <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money(ceil($_cena_jenom_dph__plus__doprava_jenom_dph), 'Kč'), ENT_NOQUOTES) ?></td>
</tr>
<tr>
    <td colspan="5"><b>CENA CELKEM S DPH</b> <i>(cena celkem bez DPH + <?php echo Latte\Runtime\Filters::escapeHtml(constant("DPH_PROCENTO"), ENT_NOQUOTES) ?> % DPH zaokrouhleno na celé číslo)</i></td>
    <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money(ceil($_cena_celkem_s_dph__plus__doprava_s_dph), 'Kč'), ENT_NOQUOTES) ?></td>
</tr>

<?php
}}