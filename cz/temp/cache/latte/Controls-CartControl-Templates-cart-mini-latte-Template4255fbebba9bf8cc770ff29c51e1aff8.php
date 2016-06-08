<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\CartControl/Templates/cart-mini.latte

class Template4255fbebba9bf8cc770ff29c51e1aff8 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7be3ce6044', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block _cart-mini
//
if (!function_exists($_b->blocks['_cart-mini'][] = '_lbafd6091e5e__cart_mini')) { function _lbafd6091e5e__cart_mini($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('cart-mini', FALSE)
?>    <div class="pull-right" id="shopping-cart" data-url-main="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("cartMiniUpdate!"), ENT_COMPAT) ?>">
        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:shoppingCart"), ENT_COMPAT) ?>">
            <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="auto" title="Přejít k pokladně">
                    <span class="fa fa-shopping-cart fa-size-1a4x hidden-xs">&nbsp;&nbsp;</span>
                    <span class="text"><b>K pokladně</b></span> 
                    <span class="badge"><span class="hidden-xs"><?php echo Latte\Runtime\Filters::escapeHtml($pocet, ENT_NOQUOTES) ?>
 pol. / </span><?php echo Latte\Runtime\Filters::escapeHtml($template->money($cena_s_dph__celkem, 'Kč'), ENT_NOQUOTES) ?></span>
                </button>
            </div>
        </a>
    </div>
<?php
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); } ?>
<div id="<?php echo $_control->getSnippetId('cart-mini') ?>"><?php call_user_func(reset($_b->blocks['_cart-mini']), $_b, $template->getParameters()) ?>
</div><?php
}}