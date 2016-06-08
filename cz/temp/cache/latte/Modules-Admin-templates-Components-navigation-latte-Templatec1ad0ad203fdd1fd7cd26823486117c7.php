<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Admin/templates/Components/navigation.latte

class Templatec1ad0ad203fdd1fd7cd26823486117c7 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0bf6f844ff', 'html')
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
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<?php $_b->templates['0bf6f844ff']->renderChildTemplate("navigation.navbar-header.latte", $template->getParameters()) ;$_b->templates['0bf6f844ff']->renderChildTemplate("navigation.navbar-top-links.latte", $template->getParameters()) ;$_b->templates['0bf6f844ff']->renderChildTemplate("navigation.navbar-sidebar.latte", $template->getParameters()) ?>
</nav><?php
}}