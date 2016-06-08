<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\ItemsControl/Templates/items-mini.latte

class Template1d958efaea5a2554dc474bfad08766ed extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('97866daaeb', 'html')
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
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">Akční nabídka</div>
    </div>
<?php $iterations = 0; foreach ($itemData as $item) { ?>
        <div class="panel-body small">
            <div class="product-img-akce" style="position: relative;">
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:itemDetail", array($item->kategorie->alias, $item->vyrobce->alias, $item->alias)), ENT_COMPAT) ?>" data-toggle="tooltip" data-placement="auto" title="Zobrazit detail produktu">
<?php if ('' != $item->schvaleno_oem) { ?>
                        <div style="position: absolute; right: 2px; top: 2px;">
                            <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>/images/schvaleno-oem.png" style="height: 20px;">
                        </div>
<?php } ?>

<?php if ('' == $item->img) { ?>
                        <img class="img-responsive" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>/images/layout/nopic.png" alt="Obrázek chybí">
<?php } else { ?>
                        <img class="img-responsive" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>
/images/items/small/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($item->img), ENT_COMPAT) ?>
" alt="<?php echo Latte\Runtime\Filters::escapeHtml($item->nazev, ENT_COMPAT) ?>">
<?php } ?>

                    <div><?php echo Latte\Runtime\Filters::escapeHtml($item->nazev, ENT_NOQUOTES) ?></div>
                    <span class="product-price">
                        <b><?php echo Latte\Runtime\Filters::escapeHtml($template->money(ceil($item->cena_bez_dph * constant('DPH')), 'Kč'), ENT_NOQUOTES) ?></b>
                        <i>(vč. DPH 21%)</i> 
                        <span class="fa fa-info-circle" data-toggle="tooltip" data-plament="top" title="Částka je zaokrouhlena na celé koruny nahoru"></span>
                    </span>         
                </a> 
                <hr>
            </div>
        </div>
<?php $iterations++; } ?>
</div><?php
}}