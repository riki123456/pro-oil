<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Front/templates/Default/page.latte

class Template49b6e05b42904f8693701a94c2bb238a extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8a1dfd9225', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block rightbar
//
if (!function_exists($_b->blocks['rightbar'][] = '_lbf2c25d88f3_rightbar')) { function _lbf2c25d88f3_rightbar($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="margin-bottom-base">
        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:shoppingCart", array('blankCart'=>1)), ENT_COMPAT) ?>">
            <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>/images/sleva_20_v2.png" class="img-responsive">
        </a>    
    </div>

<?php $_l->tmp = $_control->getComponent("itemsControl"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->renderItemsInAction() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbf98340b55e_content')) { function _lbf98340b55e_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
    <?php if (isset($pageData->content)) { echo $pageData->content ;} ?>

</div><?php
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