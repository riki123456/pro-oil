<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\OrdersControl/Templates/_detail-table-polozky.latte

class Templatec7dad9a1a1edc10f490cf2e85e501a39 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9e8fe6c26c', 'html')
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
<tr><td colspan="6"><b>OBJEDNANÉ POLOŽKY</b></td></tr>
<tr>
    <td><b>NÁZEV</b></td>
    <td><b>Počet</b></td>
    <td><b>MJ</b></td>
        <td><b>Cena/ks bez DPH</b></td>
    <td><b>Cena Celkem bez  DPH</b></td>
    <td><b>Cena celkem s DPH (<?php echo Latte\Runtime\Filters::escapeHtml(constant("DPH_PROCENTO"), ENT_NOQUOTES) ?> %)</b></td>
</tr>
<?php $iterations = 0; foreach ($data as $d) { ?>
    <tr>
        <td><?php echo Latte\Runtime\Filters::escapeHtml($d->ora_polozka_nazev, ENT_NOQUOTES) ?></td>
        <td><?php echo Latte\Runtime\Filters::escapeHtml($d->ora_polozka_baleni_pocet, ENT_NOQUOTES) ;echo Latte\Runtime\Filters::escapeHtml($d->ora_polozka_baleni_mj, ENT_NOQUOTES) ?></td>
        <td><?php echo Latte\Runtime\Filters::escapeHtml($d->ora_pocet, ENT_NOQUOTES) ?></td>
                <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money($d->ora_cena_bez_dph, 'Kč'), ENT_NOQUOTES) ?></td>
        <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money($d->ora_pocet * $d->ora_cena_bez_dph, 'Kč'), ENT_NOQUOTES) ?></td>
        <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money(ceil($d->ora_pocet * $d->ora_cena_s_dph), 'Kč'), ENT_NOQUOTES) ?></td>
    </tr>
<?php $iterations++; } ?>

<tr><td colspan="6">&nbsp;</td></tr><?php
}}