<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\ItemsControl/Templates/_products-paginator.latte

class Templateef11d2bd3d68a2bc30f5b5a07703774d extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('867c802b6c', 'html')
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