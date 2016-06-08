<?php
// source: /home/riki/work/www/pro-oil/App/Components/Controls/Crud/ItemsControl/Templates/_products-manipulation.latte

class Templatec01c4b6725de6a2589083dd0ad7d7e60 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6ce9404e90', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$_pageRowsSelect = array(1, 3, 6, 9, 12, 15, 18, 21, 24, 30, 36, 42, 54, 66, 81, 99) ?>

<div class="col-xs-7">
    <b>Seřadit zboží:</b> 
    <a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($template->replaceRE($template->replace($itemsUrl, 'DESC', 'ASC'), '/page=[0-9]+&{0,1}/', '')), ENT_COMPAT) ?>
" <?php if ($itemsUrl->getQueryParameter('sortType')=='ASC') { ?> class="active" <?php } ?>>
        <span class="hidden-xs hidden-sm">Od nejlevnějšího </span>
        <span class="fa fa-chevron-up" data-toggle="tooltip" data-position="auto" title="Od nejlevnějšího"></span></a>
    <a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($template->replaceRE($template->replace($itemsUrl, 'ASC', 'DESC'), '/page=[0-9]+&{0,1}/', '')), ENT_COMPAT) ?>
" <?php if ($itemsUrl->getQueryParameter('sortType')=='DESC') { ?> class="active" <?php } ?>>
        <span class="hidden-xs hidden-sm">Od nejdražšího </span>
        <span class="fa fa-chevron-down" data-toggle="tooltip" data-position="auto" title="Od nejdražšího"></span></a>
</div>

<div class="col-xs-3">
    <form class="form-inline pull-right">
        <b class="hidden-xs hidden-sm">Zobrazit: </b>
        <select type="text" id="itemPageRows" class="form-control" data-toggle="tooltip" data-position="auto" title="Zobrazit produktů">
<?php $iterations = 0; foreach ($_pageRowsSelect as $opt) { ?>
                <option value="<?php echo Latte\Runtime\Filters::escapeHtml($template->replaceRE($template->replaceRE($itemsUrl, '/rows=[0-9]+/', 'rows='.$opt), '/page=[0-9]+&{0,1}/', ''), ENT_COMPAT) ?>" 
                        <?php if ($itemsUrl->getQueryParameter('rows') == $opt) { ?>
 selected="selected" <?php } ?>>
                    <?php echo Latte\Runtime\Filters::escapeHtml($opt, ENT_NOQUOTES) ?>

                </option>
<?php $iterations++; } ?>
        </select>
    </form>
</div>


<?php
}}