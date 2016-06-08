<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Admin/templates/Components/navigation.navbar-header.latte

class Templateaceeef4ddc00c883fadb934cd53b1953 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('f5d86354e9', 'html')
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
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:Default:default"), ENT_COMPAT) ?>
">Pro-Oil Morava s.r.o.</a>
</div>
<!-- /.navbar-header --><?php
}}