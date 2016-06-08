<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\CartControl/Templates/cart-finish.latte

class Template014571e293a6c7eb580fd05acb604ca0 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('b78bcec253', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
Tracy\Debugger::barDump(($ordData), '$ordData') ?>

<div class="row">
    <h3>Děkujeme vám za zaslání objednávky</h3>
    <p>
        <br>
        Její shrnutí vám bylo zasláno na email: <?php echo Latte\Runtime\Filters::escapeHtml($ordDataZakaznikAdresa->email, ENT_NOQUOTES) ?>.
<?php if (false != $ordDataZakaznikAdresaDodaci) { ?>
            <br>
            <i class="fa-size-0a8x">Na základě uvedené dodací adresy bylo shrnutí zasláno také na email: <?php echo Latte\Runtime\Filters::escapeHtml($ordDataZakaznikAdresaDodaci->email, ENT_NOQUOTES) ?></i>
<?php } ?>
    </p>

<?php if (isset($paymentClass)) { ?>
        <p><?php echo Latte\Runtime\Filters::escapeHtml($paymentClass->finish(), ENT_NOQUOTES) ?></p>
<?php } ?>
    
    <p>
        <br>
        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:"), ENT_COMPAT) ?>" class="btn btn-primary"><span class="fa fa-angle-double-left"></span> Zpět na hlavní stránku obchodu</a>
        <span class="pull-right">
<?php if (constant("ZBOZI_ANALYTICS") == true) { ?>
                <a href="http://www.zbozi.cz/obchod/38206/" title="Hodnocení obchodu na Zboží.cz">
                    <img src="//d1.cdn.szn.cz/1/img/25/15/08/06/1/33/145x41_fNPng8.png" alt="Hodnocení obchodu na Zboží.cz" width="145" height="41">
                </a>
<?php } ?>
        </span>
    </p>
</div>

<?php if (constant("ZBOZI_ANALYTICS") == false) { ?>
    <!-- zbozi.cz -> konverze -->
<?php $_priceZ = (isset($ordData[0]->cena_s_dph)) ? $ordData[0]->cena_s_dph : 0 ;$_idObjZ = (isset($ordData[0]->ciselna_rada)) ? $ordData[0]->ciselna_rada : 0 ?>
    <iframe src="http://www.zbozi.czzzzz/action/38206/conversion?chsum=fqcZdFFmzolUWiUhO6ijBQ==&price=<?php echo Latte\Runtime\Filters::safeUrl(ceil($_priceZ)) ?>
&uniqueId=<?php echo Latte\Runtime\Filters::safeUrl($_idObjZ) ?>" 
            frameborder="0" marginwidth="0" marginheight="0" scrolling="no" 
            style="position:absolute; top:-3000px; left:-3000px; width:1px; height:1px; 
            overflow:hidden;">                
    </iframe>
<?php } ?>

<?php if (constant("HEUREKA_ANALYTICS") == false) { $_idObjH = (isset($ordData[0]->ciselna_rada)) ? $ordData[0]->ciselna_rada : 0 ?>
    <script type="text/javascript">
        var _hrq = _hrq || [];
            _hrq.push(['setKey', 'B01EE4C24A08EC9B331D333858758284']);
            _hrq.push(['setOrderId', '<?php echo $_idObjH ?>']);
<?php $iterations = 0; foreach ($ordData as $d) { $_nazev = htmlspecialchars($d->ora_polozka_nazev . ' ' . $d->ora_polozka_baleni_pocet . $d->ora_polozka_baleni_mj . ' ' . $d->ora_polozka_vyrobce_nazev) ?>
                _hrq.push(['addProduct', '<?php echo $_nazev ?>', '<?php echo ceil($d->ora_cena_s_dph) ?>
', '<?php echo $d->ora_pocet ?>']);            
<?php $iterations++; } ?>
                    
            _hrq.push(['trackOrder']);

        (function() {
            var ho = document.createElement('script'); ho.type = 'text/javascript'; ho.async = true;
            ho.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.heureka.cz/direct/js/ext/1-roi-async.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ho, s);
        })();
    </script>
<?php } 
}}