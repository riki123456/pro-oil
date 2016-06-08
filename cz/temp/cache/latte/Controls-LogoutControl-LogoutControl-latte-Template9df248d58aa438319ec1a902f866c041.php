<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\LogoutControl/LogoutControl.latte

class Template9df248d58aa438319ec1a902f866c041 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8bfb5b9e72', 'html')
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
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("logout!"), ENT_COMPAT) ?>
"><i class="fa fa-sign-out fa-fw"></i> Odhlásit se</a><?php
}}