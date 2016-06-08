<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud/Templates/Table.latte

class Template499647f746abae999fc8bfabc2923be0 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3042992b0d', 'html')
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
    <div class="panel-body komponent table-responsive">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables" 
                   <?php if (isset($tableConfig['data-page-length'])) { ?> data-page-length="<?php echo Latte\Runtime\Filters::escapeHtml($tableConfig['data-page-length'], ENT_COMPAT) ?>
" <?php } else { ?> data-page-length="15" <?php } ?>

                   <?php if (isset($tableConfig['data-order'])) { ?> data-order='<?php echo Latte\Runtime\Filters::escapeHtml($tableConfig['data-order'], ENT_QUOTES) ?>
' <?php } ?>

                   >
                <thead>
                    <tr>
<?php $iterations = 0; foreach ($tableConfig as $dbName => $showName) { if (strpos($dbName, 'data-') === false) { ?>
                                <th><?php echo Latte\Runtime\Filters::escapeHtml($showName, ENT_NOQUOTES) ?></th>

<?php } $iterations++; } ?>

                        <th data-orderable="false" class="col-md-1">
<?php if (isset($newButton) && $newButton == true) { ?>
                                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("add"), ENT_COMPAT) ?>" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> Nová položka</a>
<?php } ?>
                        </th>
                    </tr>
                </thead>
                <tbody class="small">
<?php $iterations = 0; foreach ($tableData as $tData) { ?>
                        <tr>
<?php $iterations = 0; foreach ($tableConfig as $dbName => $showName) { if (strpos($dbName, 'data-') === false) { ?>

<?php $pom = explode('#', $dbName); if (count($pom) > 1) { ?>
                                        <td><?php echo Latte\Runtime\Filters::escapeHtml($tData[$pom[0]][$pom[1]], ENT_NOQUOTES) ?></td>
<?php } else { ?>
                                        <td><?php echo Latte\Runtime\Filters::escapeHtml($tData[$dbName], ENT_NOQUOTES) ?></td>
<?php } ?>

<?php } $iterations++; } ?>

                            <td class="center">
                                <div class="btn-group">
<?php if (isset($detailButton) && $detailButton == true) { ?>
                                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("detail", array($tData->id)), ENT_COMPAT) ;if (isset($tableConfig['data-admin-url-params'])) { echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($tableConfig['data-admin-url-params']), ENT_COMPAT) ;} ?>" 
                                           class="fa fa-file-o btn btn-xs btn-default" 
                                           data-toggle="tooltip" data-placement="auto" title="detail" role="button"></a>
<?php } if (isset($editButton) && $editButton == true) { ?>
                                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("edit", array($tData->id)), ENT_COMPAT) ;if (isset($tableConfig['data-admin-url-params'])) { echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($tableConfig['data-admin-url-params']), ENT_COMPAT) ;} ?>" 
                                           class="fa fa-edit btn btn-xs btn-default" 
                                           data-toggle="tooltip" data-placement="auto" title="editace" role="button"></a> 
<?php } if (isset($deleteButton) && $deleteButton == true) { ?>
                                        <a 
                                           data-confirm="modal"
                                           data-confirm-title="Potvrzení"
                                           data-confirm-text="Opravdu chcete smazat tuto položku?"
                                           data-confirm-ok-class="btn-danger"
                                           data-confirm-ok-text="Smazat"
                                           data-confirm-cancel-class="btn-primary"
                                           data-confirm-cancel-text="Storno"
                                           class="fa fa-trash-o btn btn-xs btn-default"
                                           data-toggle="tooltip" data-placement="auto" title="smazat" role="button" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete!", array($tData->id)), ENT_COMPAT) ?>
"></a>
<?php } ?>
                                </div>
                            </td>
                        </tr>
<?php $iterations++; } ?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel --><?php
}}