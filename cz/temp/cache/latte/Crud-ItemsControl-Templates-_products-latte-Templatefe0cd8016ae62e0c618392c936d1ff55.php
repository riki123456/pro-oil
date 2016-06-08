<?php
// source: /home/riki/work/www/pro-oil/App/Components/Controls/Crud/ItemsControl/Templates/_products.latte

class Templatefe0cd8016ae62e0c618392c936d1ff55 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('672f229231', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block _productsContainer
//
if (!function_exists($_b->blocks['_productsContainer'][] = '_lb63bd09708a__productsContainer')) { function _lb63bd09708a__productsContainer($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('productsContainer', FALSE)
;$_control->snippetMode = isset($_snippetMode) && $_snippetMode; $iterations = 0; foreach ($itemData as $item) { $_itemNazevWebalize = \Nette\Utils\Strings::webalize($item['nazev']) ?>
        <div class="col-sm-4 col-xs-6 product-col">
            <div class="panel">
                <div class="panel-body">
                    <div class="product">
                        <div<?php echo ' id="' . ($_l->dynSnippetId = $_control->getSnippetId("product-sn1-{$_itemNazevWebalize}")) . '"' ?>>
<?php ob_start() ?>                            <div class="product-img margin-bottom-small" style="position: relative;">
<?php if ('' != $item['schvaleno_oem']) { ?>
                                    <div style="position: absolute; right: 5px; top: -15px;">
                                        <a href="javascript:void(0);" 
                                            data-confirm="modal" 
                                            data-confirm-title="Schváleno OEM"
                                            data-confirm-text="<?php echo Latte\Runtime\Filters::escapeHtml($item['schvaleno_oem'], ENT_COMPAT) ?>">
                                            <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>/images/schvaleno-oem.png" style="height: 50px;" data-toggle="tooltip" data-placement="top" title="schváleno OEM">
                                        </a>
                                    </div>
<?php } ?>

<?php if ('' == $item['img']) { ?>
                                    <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:itemDetail", array($item['kategorie']['alias'], $item['vyrobce']['alias'], $item['alias'])), ENT_COMPAT) ?>" data-toggle="tooltip" data-placement="top" title="Zobrazit detail produktu">
                                        <img class="img-responsive" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>/images/layout/nopic.png" alt="Obrázek chybí">
                                    </a>
<?php } else { ?>
                                    <!-- vypinam colorbox nad obrazkem
                                    <a href="<?php echo Latte\Runtime\Filters::escapeHtmlComment(constant('ROOT_WEB_WWW')) ?>
/images/items/large/<?php echo Latte\Runtime\Filters::escapeHtmlComment($item['img']) ?>" class="photo" data-toggle="tooltip" data-placement="top" title="Zvětšit obrázek">
                                        <img class="img-responsive" src="<?php echo Latte\Runtime\Filters::escapeHtmlComment(constant('ROOT_WEB_WWW')) ?>
/images/items/normal/<?php echo Latte\Runtime\Filters::escapeHtmlComment($item['img']) ?>
" rel="photo" alt="<?php echo Latte\Runtime\Filters::escapeHtmlComment($item['nazev']) ?>">
                                    </a>      
                                    -->
                                    <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:itemDetail", array($item['kategorie']['alias'], $item['vyrobce']['alias'], $item['alias'])), ENT_COMPAT) ?>" data-toggle="tooltip" data-placement="top" title="Zobrazit detail produktu">
                                        <img class="img-responsive" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>
/images/items/normal/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($item['img']), ENT_COMPAT) ?>
" rel="photo" alt="<?php echo Latte\Runtime\Filters::escapeHtml($item['nazev'], ENT_COMPAT) ?>">
                                    </a>
<?php } ?>
                            </div>
                            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:itemDetail", array($item['kategorie']['alias'], $item['vyrobce']['alias'], $item['alias'])), ENT_COMPAT) ?>" class="product-name" data-toggle="tooltip" data-placement="bottom" title="Zobrazit detail produktu">
                                <span><?php echo Latte\Runtime\Filters::escapeHtml($item['nazev'], ENT_NOQUOTES) ?></span>
                            </a>
                            <span class="product-group margin-bottom-small">(<?php echo Latte\Runtime\Filters::escapeHtml($item['kategorie']['nazev'], ENT_NOQUOTES) ?>)</span>
                            <span class="product-price margin-bottom-small">
                                <span><?php echo Latte\Runtime\Filters::escapeHtml($template->money(ceil($item['cena_bez_dph'] * constant('DPH')), 'Kč'), ENT_NOQUOTES) ?></span>
                                <span class="product-price-int-value hidden"><?php echo Latte\Runtime\Filters::escapeHtml($item['cena_bez_dph'] * constant('DPH'), ENT_NOQUOTES) ?></span>
                                <span class="small">
                                    (vč. DPH <?php echo Latte\Runtime\Filters::escapeHtml(constant('DPH_PROCENTO'), ENT_NOQUOTES) ?>%) 
                                    <span class="fa fa-info-circle" data-toggle="tooltip" data-plament="top" title="Částka je zaokrouhlena na celé koruny nahoru"></span>
                                </span>
                                <br>
                                <span class="small"><i><?php echo Latte\Runtime\Filters::escapeHtml($template->money($item['cena_bez_dph'], 'Kč'), ENT_NOQUOTES) ?> (bez DPH)</i></span>

                            </span>         
                            <span class="availability margin-bottom-base"><?php echo Latte\Runtime\Filters::escapeHtml($item['dostupnost']['nazev'], ENT_NOQUOTES) ?></span>

<?php $_l->dynSnippets[$_l->dynSnippetId] = ob_get_flush() ?>                        </div>

                        <div class="product-bottom">
                            <span class="center cart-mini-update-message" style="display: none;">
                                Zboží bylo přidáno 
                                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:shoppingCart"), ENT_COMPAT) ?>" class="inverse">do košíku</a>
                            </span>
                            <form>
                                <!-- .input-group -->
                                <div class="input-group product-ks margin-bottom-small">
                                    <select name="baleni_dalsi" class="baleni-switcher form-control" data-toggle="tooltip" data-placement="auto" title="balení">                                
<?php $_baleni_dalsi = explode('|', $item['baleni_dalsi']) ;$iterations = 0; foreach ($_baleni_dalsi as $_bd) { $_baleni_dalsi_data = explode('#', $_bd) ?>
                                            <option value="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("productSwitch!", array($_baleni_dalsi_data[0])), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($_baleni_dalsi_data[1] . $_baleni_dalsi_data[2], ENT_NOQUOTES) ?></option>
<?php $iterations++; } ?>
                                    </select>
                                    <input type="number" name="baleni_pocet" class="baleni_pocet form-control" value="1" data-toggle="tooltip" data-placement="auto" title="počet">
                                    <span class="input-group-btn cart-mini-update ">
                                        <button 
                                            class="btn btn-primary" data-toggle="tooltip" data-placement="auto" title="Přidat do košíku" type="button">
                                            <a class="fa fa-cart-plus" style="color: white;"></a>
                                        </button>
                                    </span>
                                </div>
                                <!-- /.input-group -->
                            </form>

                            <div<?php echo ' id="' . ($_l->dynSnippetId = $_control->getSnippetId("product-sn2-{$_itemNazevWebalize}")) . '"' ?>>
<?php ob_start() ?>                                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:itemDetail", array($item['kategorie']['alias'], $item['vyrobce']['alias'], $item['alias'])), ENT_COMPAT) ?>" 
                                   data-item-id="<?php echo Latte\Runtime\Filters::escapeHtml($item['id'], ENT_COMPAT) ?>" class="product-detail btn btn-default margin-bottom-small"
                                   >Detail produktu</a>
<?php $_l->dynSnippets[$_l->dynSnippetId] = ob_get_flush() ?>                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
<?php $iterations++; } $_control->snippetMode = FALSE; if (isset($_l->dynSnippets)) return $_l->dynSnippets; return FALSE; 
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
call_user_func(reset($_b->blocks['_productsContainer']), $_b, $template->getParameters()) ; 
}}