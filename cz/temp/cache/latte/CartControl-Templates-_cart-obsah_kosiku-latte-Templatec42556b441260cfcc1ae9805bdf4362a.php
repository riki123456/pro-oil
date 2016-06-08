<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\CartControl/Templates/_cart-obsah_kosiku.latte

class Templatec42556b441260cfcc1ae9805bdf4362a extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('ea67a90dd7', 'html')
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
<div class="panel panel-body panel-default">
    <!-- tohle je jen div, ktery urcuje, ze chceme zneviditelnit levy sloupec s menu (podle class="obsah-kosiku" -->    
    <div class="center fa-size-2x obsah-kosiku"></div>
    
    <form method="post" action="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("cart", array('recalculate')), ENT_COMPAT) ?>">
        <div class="table-responsive">
            <table class="table table-condensed">
                <thead>
                    <tr><th>Název</th><th>Počet</th><th>MJ</th><th>Cena/ks bez DPH</th><th>Cena celkem bez DPH</th><th>Cena celkem s DPH (<?php echo Latte\Runtime\Filters::escapeHtml(constant("DPH_PROCENTO"), ENT_NOQUOTES) ?>&nbsp;%)<th>&nbsp;</th></tr>
                </thead>
                <tbody>
<?php $cena_celkem_bez_dph = 0 ;$iterations = 0; foreach ($orders as $order) { $_pocet = $orders_session[$order->id]['pocet'] ;$_cena_bez = $order->cena_bez_dph ;$_cena_s = $order->cena_bez_dph * constant('DPH') ;$cena_celkem_bez_dph = $cena_celkem_bez_dph + ($_pocet * $_cena_bez) ?>
                        <tr>
                            <td><?php echo Latte\Runtime\Filters::escapeHtml($order->nazev, ENT_NOQUOTES) ?></td>
                            <td>
                                <input type="text" class="form-control" size="1" name="items[<?php echo Latte\Runtime\Filters::escapeHtml($order->id, ENT_COMPAT) ?>
][pocet]" value="<?php echo Latte\Runtime\Filters::escapeHtml($_pocet, ENT_COMPAT) ?>">
                                <!-- kvuli zpetne kompatibilite, jiz nepouzivame -->
                                <input type="hidden" name="items[<?php echo Latte\Runtime\Filters::escapeHtml($order->id, ENT_COMPAT) ?>
][cena_s_dph]" value="<?php echo Latte\Runtime\Filters::escapeHtml($_cena_s, ENT_COMPAT) ?>">
                            </td>
                            <td><?php echo Latte\Runtime\Filters::escapeHtml($order->baleni_pocet, ENT_NOQUOTES) ;echo Latte\Runtime\Filters::escapeHtml($order->baleni_mj, ENT_NOQUOTES) ?></td>
                            <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money($_cena_bez, 'Kč'), ENT_NOQUOTES) ?></td>
                            <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money($_pocet * $_cena_bez, 'Kč'), ENT_NOQUOTES) ?></td>
                            <td><?php echo Latte\Runtime\Filters::escapeHtml($template->money(ceil($_pocet * $_cena_s), 'Kč'), ENT_NOQUOTES) ?></td>
                            <td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("cart!", array('removeItem', $order->id)), ENT_COMPAT) ?>" class="fa fa-remove inverse"></a></td>
                        </tr>
<?php $iterations++; } ?>

                    <tr><td colspan="7">&nbsp;</td></tr>
                    <tr>
                        <td colspan="5">Cena celkem bez DPH <i>(suma cen objednaných položek bez DPH)</i></td>
                        <td colspan="2" style="text-align: right;">
                            <span id="cena_celkem_bez_dph"><?php echo Latte\Runtime\Filters::escapeHtml($template->money($cena_celkem_bez_dph, 'Kč'), ENT_NOQUOTES) ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><span class="fa-size-1a5x active">Cena celkem s DPH <i>(cena celkem bez DPH * <?php echo Latte\Runtime\Filters::escapeHtml(constant('DPH_PROCENTO'), ENT_NOQUOTES) ?>%)</i></span></td>
                        <td colspan="2" style="text-align: right;">
                            <span class="fa-size-1a5x active">
                                <span id="cena_celkem_s_dph"><?php echo Latte\Runtime\Filters::escapeHtml($template->money(ceil($cena_celkem_bez_dph * constant('DPH')), 'Kč'), ENT_NOQUOTES) ?></span>
                                <sup class="fa fa-info-circle fa-size-0a7x" data-toggle="tooltip" data-placement="top" title="Částka je zaokrouhlena na celé koruny nahoru."></sup>
                            </span>
                        </td>
                    </tr>

                    <tr>

                        <td colspan="7">
                            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:"), ENT_COMPAT) ?>" class="btn btn-primary"><span class="fa fa-angle-double-left"></span> Zpět do obchodu</a>
                            <div class="pull-right">
                                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("cart!", array('remove')), ENT_COMPAT) ?>" class="btn btn-primary"><span class="fa fa-remove"></span> Vyprázdnit košík</a>
                                <!-- tenhle odkaz jen reloadne stranku. Tim nacte znova session a mame prepocitano ;) -- do session se totiz uklada pri zmene inputu v objednavce :) -->
                                <button type="submit" href="#" class="btn btn-primary"><span class="fa fa-refresh"></span> Přepočítat cenu</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
</div><?php
}}