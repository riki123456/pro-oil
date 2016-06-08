<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Admin\Presenters/../templates/Components/Presenters/crud.latte

class Templatea891761c3571a7dd0e8d78338f455bca extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('dad215c1bb', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb70e4aa157c_title')) { function _lb70e4aa157c_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?> <?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb403b9f1167_content')) { function _lb403b9f1167_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("{$itemPresenterName}Control"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->{"render$itemActionName"}($itemId) ;
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars()) ?>
 

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}