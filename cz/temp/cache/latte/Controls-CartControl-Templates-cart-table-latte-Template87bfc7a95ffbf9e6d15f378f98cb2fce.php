<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\CartControl/Templates/cart-table.latte

class Template87bfc7a95ffbf9e6d15f378f98cb2fce extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5b17049ccc', 'html')
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
<!DOCTYPE html>

<html lang="<?php echo Latte\Runtime\Filters::escapeHtml(constant("LANG"), ENT_COMPAT) ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php if (isset($metaDescription)) { ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($metaDescription, ENT_COMPAT) ?> <?php } else { ?>
 Společnost Pro-Oil se zabývá prodejem a distribucí kvalitních značkových motorových, převodových olejů pro osobní i nákladní vozy za přijatelné ceny. Známé trh s oleji a mazivy.<?php } ?>">
        <meta name="keywords" content="<?php if (isset($metaKeywords)) { ?> <?php echo Latte\Runtime\Filters::escapeHtml($metaKeywords, ENT_COMPAT) ?>
 <?php } else { ?> castrol,mol,mogul,motor,olej,oil,vozy,vůz,osobní,auto,mineralni,5w,10w,15w,api,sae,levný,levně,kvalitní<?php } ?>">
        <meta name="author" content="RNDr. Miroslav Petráš, petras.miroslav@email.cz, www.rksystem.cz">
        <link rel="shortcut icon" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>/favicon.png" type="image/x-icon">
    </head>
    <body>
        <h2>Dobrý den,</h2>
        <p>děkujeme vám za zaslání objednávky č. <?php echo Latte\Runtime\Filters::escapeHtml($dataZakaznik->objednavka_hlavicka->ciselna_rada, ENT_NOQUOTES) ?>. V co nejkratší době bude vyřízená a expedována.</p>
        <p>Níže následuje její shrnutí.</p><br>

        <table width="95%">
<?php $_b->templates['5b17049ccc']->renderChildTemplate('_cart-table-polozky.latte', $template->getParameters()) ;$_b->templates['5b17049ccc']->renderChildTemplate('_cart-table-doprava.latte', $template->getParameters()) ?>

<?php if ('' != $dataZakaznik->objednavka_hlavicka->note) { ?>
                <tr>
                    <td><b>Poznámka</b></td>
                    <td colspan="5"><?php echo Latte\Runtime\Filters::escapeHtml($dataZakaznik->objednavka_hlavicka->note, ENT_NOQUOTES) ?></td>
                </tr>
                <tr><td colspan="6">&nbsp;</td></tr>
<?php } ?>

<?php $_b->templates['5b17049ccc']->renderChildTemplate('_cart-table-rekapitulace.latte', $template->getParameters()) ?>
        </table>

<?php $_b->templates['5b17049ccc']->renderChildTemplate('_cart-table-zakaznik.latte', $template->getParameters()) ?>

        <p>
            S pozdravem a přáním příjemného dne Váš prodejce olejů a maziv Pro-Oil Morava s.r.o.<br>
            <a href="http://www.<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant("DOMAIN")), ENT_COMPAT) ?>
">http://www.<?php echo Latte\Runtime\Filters::escapeHtml(constant("DOMAIN"), ENT_NOQUOTES) ?></a><br>
            Tel.: <?php echo Latte\Runtime\Filters::escapeHtml(constant("MAIL_TELEFON"), ENT_NOQUOTES) ?><br>
            E-mail: <a href="mailto:<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant("MAIL_OBJEDNAVKY")), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml(constant("MAIL_OBJEDNAVKY"), ENT_NOQUOTES) ?></a><br>
        </p>
    </body>
</html><?php
}}