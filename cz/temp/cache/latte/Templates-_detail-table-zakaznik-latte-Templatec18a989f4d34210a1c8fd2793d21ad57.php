<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\OrdersControl/Templates/_detail-table-zakaznik.latte

class Templatec18a989f4d34210a1c8fd2793d21ad57 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('52b9a9c2cd', 'html')
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
<!-- udaje o zakaznikovi, firme ... -->
<hr>
<h3>Údaje zákazníka</h3>

<?php if (count($dataZakaznik) > 0) { ?>
    <table width="95%">
        <tr>
            <td colspan="4">
                <?php if ($dataZakaznik->user_type == 1) { ?> Koncový zákazník <?php } ?>

                <?php if ($dataZakaznik->user_type == 2) { ?> Fyzická osoba<?php } ?>

                <?php if ($dataZakaznik->user_type == 3) { ?> Právnická osoba<?php } ?>

                , 
                <?php if ($dataZakaznik->platce_dph == 1) { ?> plátce DPH <?php } else { ?>
 neplátce DPH <?php } ?>

            </td>
        </tr>
        <?php if ('' != $dataZakaznik->firma) { ?><tr><td>Firma:</td><td colspan="3"><?php echo Latte\Runtime\Filters::escapeHtml($dataZakaznik->firma, ENT_NOQUOTES) ?>
</td></tr><?php } ?>

        <?php if ('' != $dataZakaznik->ico) { ?><tr><td>IČO:</td><td colspan="3"><?php echo Latte\Runtime\Filters::escapeHtml($dataZakaznik->ico, ENT_NOQUOTES) ?>
</td></tr><?php } ?>

        <?php if ('' != $dataZakaznik->dic) { ?><tr><td>DIČ:</td><td colspan="3"><?php echo Latte\Runtime\Filters::escapeHtml($dataZakaznik->dic, ENT_NOQUOTES) ?>
</td></tr><?php } ?>

        
<?php $_b->templates['52b9a9c2cd']->renderChildTemplate('_detail-table-zakaznik-adresy.latte', $template->getParameters()) ?>
    </table>
<?php } 
}}