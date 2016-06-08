<?php
// source: /home/riki/work/www/pro-oil/App/Components/Controls/Crud/ItemsControl/Templates/_products-paginator.latte

class Template5c89bfc6aa4e11613d51c0c8205109d5 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('46f88e183a', 'html')
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
<div class="col-xs-12" id="items-pagination-container">
    <ul id="items-pagination" 
        data-pagination-url="<?php echo Latte\Runtime\Filters::escapeHtml($itemsUrl, ENT_COMPAT) ?>" 
        data-pagination-page="<?php echo Latte\Runtime\Filters::escapeHtml($itemsUrl->getQueryParameter('page'), ENT_COMPAT) ?>"
        data-pagination-totalPage="<?php echo Latte\Runtime\Filters::escapeHtml($itemsPageTotal, ENT_COMPAT) ?>">
    </u>
</div><?php
}}