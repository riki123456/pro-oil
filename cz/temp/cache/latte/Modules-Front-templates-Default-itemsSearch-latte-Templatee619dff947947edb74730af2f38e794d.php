<?php
// source: /home/riki/work/www/pro-oil/App/Modules/Front/templates/Default/itemsSearch.latte

class Templatee619dff947947edb74730af2f38e794d extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5a487ace99', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block rightbar
//
if (!function_exists($_b->blocks['rightbar'][] = '_lb41f3b48c14_rightbar')) { function _lb41f3b48c14_rightbar($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="margin-bottom-base">
        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:shoppingCart", array('blankCart'=>1)), ENT_COMPAT) ?>">
            <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>/images/sleva_20_v3.png" class="img-responsive">
        </a>    
    </div>

<?php $_l->tmp = $_control->getComponent("itemsControl"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->renderItemsInAction() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb226212d519_content')) { function _lb226212d519_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("itemsControl"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->renderItems($itemsSqlParams) ;
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
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['rightbar']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}