<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\CartControl/Templates/_cart-table-zakaznik.latte

class Template01be2c7c7e8c8384414f6b19ae2a5305 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8acb3cb876', 'html')
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
            <td colspan="2">
                <?php if ($dataZakaznik->user_type == 1) { ?> Koncový zákazník <?php } ?>

                <?php if ($dataZakaznik->user_type == 2) { ?> Fyzická osoba<?php } ?>

                <?php if ($dataZakaznik->user_type == 3) { ?> Právnická osoba<?php } ?>

                , 
                <?php if ($dataZakaznik->platce_dph == 1) { ?> plátce DPH <?php } else { ?>
 neplátce DPH <?php } ?>

            </td>
        </tr>
        <?php if ('' != $dataZakaznik->firma) { ?><tr><td>Firma</td><td><?php echo Latte\Runtime\Filters::escapeHtml($dataZakaznik->firma, ENT_NOQUOTES) ?>
</td></tr><?php } ?>

        <?php if ('' != $dataZakaznik->ico) { ?><tr><td>IČO</td><td><?php echo Latte\Runtime\Filters::escapeHtml($dataZakaznik->ico, ENT_NOQUOTES) ?>
</td></tr><?php } ?>

        <?php if ('' != $dataZakaznik->dic) { ?><tr><td>DIČ</td><td><?php echo Latte\Runtime\Filters::escapeHtml($dataZakaznik->dic, ENT_NOQUOTES) ?>
</td></tr><?php } ?>

        
<?php $_b->templates['8acb3cb876']->renderChildTemplate('_cart-table-zakaznik-adresy.latte', $template->getParameters()) ?>
    </table>
<?php } 
}}