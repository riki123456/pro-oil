<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\OrdersControl/Templates/detail-table.latte

class Template4e23790bd1f689a5ad13f8d129605029 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('e0cbc08262', 'html')
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
<div class="panel panel-default">    
    <div class="panel-body komponent small">
        <div class="row">
            <div class="col-md-12">
<?php if (count($dataZakaznik) > 0) { $_stavObj = $dataZakaznik->objednavka_hlavicka->stav ?>

                    <b>Stav objednávky:</b> <?php echo Latte\Runtime\Filters::escapeHtml(($_stavObj == 1) ? 'nová' : (($_stavObj == 2) ? 'schválená' : 'zamítnutá'), ENT_NOQUOTES) ?>

                    <div class="btn-group pull-right">
                        <a 
                           class="btn btn-success <?php echo Latte\Runtime\Filters::escapeHtml(($_stavObj == 2) ? 'disabled' : '', ENT_COMPAT) ?>" role="button"
                           data-confirm="modal"
                           data-confirm-title="Potvrzení"
                           data-confirm-text="Opravdu chcete SCHVÁLIT tuto objednávku?"
                           data-confirm-ok-class="btn-primary"
                           data-confirm-ok-text="Ano"
                           data-confirm-cancel-class="btn-default"
                           data-confirm-cancel-text="Ne"
                            href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("changeType!", array($dataZakaznik->objednavka_hlavicka_id, 2)), ENT_COMPAT) ?>
"><span class="fa fa-check"></span> schválit</a>
                        <a 
                           class="btn btn-danger <?php echo Latte\Runtime\Filters::escapeHtml(($_stavObj == 3) ? 'disabled' : '', ENT_COMPAT) ?>"
                           data-confirm="modal"
                           data-confirm-title="Potvrzení"
                           data-confirm-text="Opravdu chcete ZAMÍTNOUT tuto položku?"
                           data-confirm-ok-class="btn-primary"
                           data-confirm-ok-text="Ano"
                           data-confirm-cancel-class="btn-default"
                           data-confirm-cancel-text="Ne"
                            href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("changeType!", array($dataZakaznik->objednavka_hlavicka_id, 3)), ENT_COMPAT) ?>
"><span class="fa fa-remove"></span> zamítnout</a>
                    </div>
<?php } ?>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-12 dataTable_wrapper table-responsive">
                <table class="table table-bordered table-condensed table-primary">
<?php $_b->templates['e0cbc08262']->renderChildTemplate('_detail-table-polozky.latte', $template->getParameters()) ;$_b->templates['e0cbc08262']->renderChildTemplate('_detail-table-doprava.latte', $template->getParameters()) ?>

<?php if ('' != $dataZakaznik->objednavka_hlavicka->note) { ?>
                        <tr>
                            <td><b>Poznámka</b></td>
                            <td colspan="5"><?php echo Latte\Runtime\Filters::escapeHtml($dataZakaznik->objednavka_hlavicka->note, ENT_NOQUOTES) ?></td>
                        </tr>
                        <tr><td colspan="6">&nbsp;</td></tr>
<?php } ?>

<?php $_b->templates['e0cbc08262']->renderChildTemplate('_detail-table-rekapitulace.latte', $template->getParameters()) ?>
                </table>
                
<?php $_b->templates['e0cbc08262']->renderChildTemplate('_detail-table-zakaznik.latte', $template->getParameters()) ?>
            </div>
        </div>
    </div>
</div><?php
}}