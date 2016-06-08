<?php
// source: /home/riki/work/www/pro-oil/App/Components/Controls/Crud/ItemsControl/Templates/item-detail.latte

class Template99b421ed407c4734e05f7a80019e98de extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4c74a412e5', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block _productsContainer
//
if (!function_exists($_b->blocks['_productsContainer'][] = '_lba3a795a9b0__productsContainer')) { function _lba3a795a9b0__productsContainer($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('productsContainer', FALSE)
;$_control->snippetMode = isset($_snippetMode) && $_snippetMode; Tracy\Debugger::barDump(($itemData), '$itemData') ;$_itemNazevWebalize = \Nette\Utils\Strings::webalize($itemData['nazev']) ?>
    <div class="row">
        <div class="col-xs-12 product-col">
            <div class="panel">
                <div class="panel-body">
                    <div class="product product-detail">
                        <div<?php echo ' id="' . ($_l->dynSnippetId = $_control->getSnippetId("product-sn1-{$_itemNazevWebalize}")) . '"' ?>>
<?php ob_start() ?>                            <div class="row">
                                <div class="col-xs-12">
                                    <h2>
                                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:itemDetail", array($itemData['kategorie']['alias'], $itemData['vyrobce']['alias'], $itemData['alias'])), ENT_COMPAT) ?>" 
                                           class="product-name" data-toggle="tooltip" data-placement="bottom" title="Zobrazit detail produktu">
                                            <span><?php echo Latte\Runtime\Filters::escapeHtml($itemData['nazev'], ENT_NOQUOTES) ?></span>
                                        </a>
                                    </h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="product-img margin-bottom-small">
<?php if ('' == $itemData['img']) { ?>
                                            <img class="img-responsive" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>/images/layout/nopic.png" alt="Obrázek chybí">
<?php } else { ?>
                                            <a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>
/images/items/large/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($itemData['img']), ENT_COMPAT) ?>" class="photo" data-toggle="tooltip" data-placement="bottom" title="Zvětšit obrázek">
                                                <img class="img-responsive" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>
/images/items/normal/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($itemData['img']), ENT_COMPAT) ?>
" rel="photo" alt="<?php echo Latte\Runtime\Filters::escapeHtml($itemData['nazev'], ENT_COMPAT) ?>">
                                            </a>      
<?php } ?>
                                    </div>
                                </div>
                                <div class="col-xs-9">
                                    <p><?php echo Latte\Runtime\Filters::escapeHtml($itemData['popis_kratky'], ENT_NOQUOTES) ?></p>
                                    <div><b>Specifikace SAE: </b><?php echo Latte\Runtime\Filters::escapeHtml($itemData['specifikace_sae'], ENT_NOQUOTES) ?></div>
                                    <div><b>Specifikace API: </b><?php echo Latte\Runtime\Filters::escapeHtml($itemData['specifikace_api'], ENT_NOQUOTES) ?></div>
                                    <div><b>Specifikace ACEA: </b><?php echo Latte\Runtime\Filters::escapeHtml($itemData['specifikace_acea'], ENT_NOQUOTES) ?></div>
                                    <div><b>Specifikace výrobce: </b><?php echo Latte\Runtime\Filters::escapeHtml($itemData['specifikace_vyrobce'], ENT_NOQUOTES) ?></div>

                                    <hr>

                                    <div class="fa-size-1a4x active product-price">
                                        Cena: <span><?php echo Latte\Runtime\Filters::escapeHtml($template->money(ceil($itemData['cena_bez_dph'] * constant('DPH')), 'Kč'), ENT_NOQUOTES) ?></span>
                                        <span class="product-price-int-value hidden"><?php echo Latte\Runtime\Filters::escapeHtml($itemData['cena_bez_dph'] * constant('DPH'), ENT_NOQUOTES) ?></span>
                                        <span class="small">
                                            (vč. DPH <?php echo Latte\Runtime\Filters::escapeHtml(constant('DPH_PROCENTO'), ENT_NOQUOTES) ?>%) 
                                            <span class="fa fa-info-circle" data-toggle="tooltip" data-plament="top" title="Částka je zaokrouhlena na celé koruny nahoru"></span>
                                        </span>
                                    </div>
                                    <div>Cena bez DPH: <?php echo Latte\Runtime\Filters::escapeHtml($template->money($itemData['cena_bez_dph'], 'Kč'), ENT_NOQUOTES) ?></div>

                                    <hr>
                                </div>
                            </div>
<?php $_l->dynSnippets[$_l->dynSnippetId] = ob_get_flush() ?>                        </div>
                        <div class="row">
                            <div class="col-xs-3 center"<?php echo ' id="' . ($_l->dynSnippetId = $_control->getSnippetId("product-sn2-{$_itemNazevWebalize}")) . '"' ?>>
<?php ob_start() ?>                                <span class="availability fa-size-1a3x"><?php echo Latte\Runtime\Filters::escapeHtml($itemData['dostupnost']['nazev'], ENT_NOQUOTES) ?></span>
<?php $_l->dynSnippets[$_l->dynSnippetId] = ob_get_flush() ?>                            </div>
                            <div class="col-xs-9">
                                <div class="product-bottomm fa-size-2x">
                                    <span class="center cart-mini-update-message" style="display: none;">
                                        Zboží bylo přidáno 
                                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:shoppingCart"), ENT_COMPAT) ?>" class="inverse">do košíku</a>
                                    </span>
                                    <form>
                                        <!-- .input-group -->
                                        <div class="input-group product-ks margin-bottom-small">
                                            <select name="baleni_dalsi" class="baleni-switcher form-control" data-toggle="tooltip" data-placement="auto" title="balení">  
<?php if (isset($itemDataBaleniDalsi)) { $_baleni_dalsi = explode('|', $itemDataBaleniDalsi) ;$iterations = 0; foreach ($_baleni_dalsi as $_bd) { $_baleni_dalsi_data = explode('#', $_bd) ?>
                                                        <option value="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("productSwitch!", array($_baleni_dalsi_data[0], 'detail')), ENT_COMPAT) ?>
" <?php if ($itemData['baleni_pocet'] == $_baleni_dalsi_data[1]) { ?> selected="selected"<?php } ?>>
                                                            <?php echo Latte\Runtime\Filters::escapeHtml($_baleni_dalsi_data[1] . $_baleni_dalsi_data[2], ENT_NOQUOTES) ?>

                                                        </option>
<?php $iterations++; } } ?>
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

                                    <div class="hidden"<?php echo ' id="' . ($_l->dynSnippetId = $_control->getSnippetId("product-sn3-{$_itemNazevWebalize}")) . '"' ?>>
<?php ob_start() ?>                                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:itemDetail", array($itemData['kategorie']['alias'], $itemData['vyrobce']['alias'], $itemData['alias'])), ENT_COMPAT) ?>" 
                                           data-item-id="<?php echo Latte\Runtime\Filters::escapeHtml($itemData['id'], ENT_COMPAT) ?>" class="product-detail btn btn-default margin-bottom-small"
                                           >Detail produktu</a>
<?php $_l->dynSnippets[$_l->dynSnippetId] = ob_get_flush() ?>                                    </div>
                                </div>

                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3 center">
<?php if ('' != $itemData['schvaleno_oem']) { ?>
                                    <a href="javascript:void(0);" class="item-schvaleno-oem fa-size-1a3x" style="color: #bc1616;"
                                       data-confirm="modal" data-confirm-title="Schváleno OEM"
                                       data-confirm-text="<?php echo Latte\Runtime\Filters::escapeHtml($itemData['schvaleno_oem'], ENT_COMPAT) ?>">
                                        Schváleno OEM
                                        <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>/images/schvaleno-oem.png" style="height: 50px;">
                                    </a>
<?php } ?>
                            </div>
                            <div class="col-xs-9">
                                <div<?php echo ' id="' . ($_l->dynSnippetId = $_control->getSnippetId("product-sn4-{$_itemNazevWebalize}")) . '"' ?>>
<?php ob_start() ?>                                    <div class="fa-size-2x">Popis produktu</div>
                                    <?php echo Latte\Runtime\Filters::escapeHtml($itemData['popis_dlouhy'], ENT_NOQUOTES) ?>

<?php $_l->dynSnippets[$_l->dynSnippetId] = ob_get_flush() ?>                                </div>

                                <hr>

                                <div class="fa-size-1a5x margin-bottom-base">
                                    <a href="javascript:void(0);" id="form-question">
                                        <span class="fa fa-question-circle"></span> Zeptejte se prodejce
                                    </a>
                                </div>
                                <span class="hidden"><?php $_l->tmp = $_control->getComponent("questionForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?></span>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>

            <!--
            <hr/>
            <p class="fa-size-2x center"><b>Související zboží</b></p>
            -->

        </div>
    </div>
<?php $_control->snippetMode = FALSE; if (isset($_l->dynSnippets)) return $_l->dynSnippets; return FALSE; 
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