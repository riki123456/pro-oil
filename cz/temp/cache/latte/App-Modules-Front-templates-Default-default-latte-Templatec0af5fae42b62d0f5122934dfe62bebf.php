<?php
// source: /home/riki/work/www/pro-oil/App/Modules/Front/templates/Default/default.latte

class Templatec0af5fae42b62d0f5122934dfe62bebf extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('fcfe961d29', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block rightbar
//
if (!function_exists($_b->blocks['rightbar'][] = '_lb7f17d4cc19_rightbar')) { function _lb7f17d4cc19_rightbar($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
if (!function_exists($_b->blocks['content'][] = '_lbc8998a1bfc_content')) { function _lbc8998a1bfc_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
    <div class="col-xs-12 product-col">
<?php $_l->tmp = $_control->getComponent("slideshowControl"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->renderSlideshow() ?>

        <p>
            Zákazníkům prodáváme oleje a maziva zaručené kvality za přijatelné ceny. 
            Prodej je doplněn o autochemii a autokosmetiku. Naši výhodou je znalost trhu s oleji a mazivy, dále také šíře distribuovaného sortimentu. 
            Pokud ale zákazník požadovaný produkt v našem e-shopu nenajde, může zaslat dotaz na sekci velkoobchod, kde mu pomůžeme.
        </p>
    </div>
</div>

<?php $_l->tmp = $_control->getComponent("itemsControl"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->renderItems($itemsSqlParams) ;
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