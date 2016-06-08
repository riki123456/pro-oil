<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\OrdersControl/Templates/_detail-table-zakaznik-adresy.latte

class Template2ae69b85d44c480678687f945a20873a extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('337e2cf15e', 'html')
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
<!-- adresy -->
<?php $adresy = array($dataAdresaFakturacni, $dataAdresaDodaci) ?>

<?php ob_start() ?>
    <tr>
<?php $iterations = 0; foreach ($adresy as $adr) { if ((false != $adr)) { ?>
                <td>Jméno a příjmení:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($template->trim($adr->jmeno), ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($template->trim($adr->prijmeni), ENT_NOQUOTES) ?></td>
<?php } else { ?>
                <td colspan="2">&nbsp;</td>
<?php } $iterations++; } ?>
    </tr>
    <tr>
<?php $iterations = 0; foreach ($adresy as $adr) { if ((false != $adr)) { ?>
                <td>Email:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($adr->email, ENT_NOQUOTES) ?></td>
<?php } else { ?>
                <td colspan="2">&nbsp;</td>
<?php } $iterations++; } ?>
    </tr>
    <tr>
<?php $iterations = 0; foreach ($adresy as $adr) { if ((false != $adr)) { ?>
                <td>Telefon:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($adr->telefon, ENT_NOQUOTES) ?></td>
<?php } else { ?>
                <td colspan="2">&nbsp;</td>
<?php } $iterations++; } ?>
    </tr>
    <tr>
<?php $iterations = 0; foreach ($adresy as $adr) { if ((false != $adr)) { ?>
                <td>Adresa:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($adr->ulice, ENT_NOQUOTES) ?>
, <?php echo Latte\Runtime\Filters::escapeHtml($adr->mesto, ENT_NOQUOTES) ?>, <?php echo Latte\Runtime\Filters::escapeHtml($adr->psc, ENT_NOQUOTES) ?>
, <?php echo Latte\Runtime\Filters::escapeHtml($adr->stat, ENT_NOQUOTES) ?></td>
<?php } else { ?>
                <td colspan="2">&nbsp;</td>
<?php } $iterations++; } ?>
    </tr>
<?php $a = ob_get_clean() ?>

<tr><td colspan="4">&nbsp;</td></tr>
<tr><td colspan="2"><b>Adresa - fakturační</b></td><td colspan="2"><b>Adresa - dodací</b></td></tr>

<?php echo $a ;
}}