<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Base\Presenters/../Templates/../../Base/Templates/Layouts/top.latte

class Template0c38c1d087d2222905918681d985ac90 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('bd74f3811d', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block stylesFiles
//
if (!function_exists($_b->blocks['stylesFiles'][] = '_lb959fe9aa00_stylesFiles')) { function _lb959fe9aa00_stylesFiles($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("css"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;$_l->tmp = $_control->getComponent("cssDynamic"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
<?php
}}

//
// block styles
//
if (!function_exists($_b->blocks['styles'][] = '_lbd7bf3c576f_styles')) { function _lbd7bf3c576f_styles($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
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

        <!-- STYLES FILES -->

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['stylesFiles']), $_b, get_defined_vars())  ?>
        <!-- /STYLES FILES -->

        <!-- STYLES -->
        <?php call_user_func(reset($_b->blocks['styles']), $_b, get_defined_vars())  ?>

        <!-- /STYLES -->

        <title><?php if (isset($_b->blocks["title"])) { ob_start(); Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'title', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>Pro-Oil Morava s.r.o.</title>

        <script type="text/javascript">
            RKW = {};
            RKW.lang = <?php echo Latte\Runtime\Filters::escapeJs(constant("LANG")) ?>;
            RKW.tinyMCE = {
                class: <?php echo Latte\Runtime\Filters::escapeJs(constant("TINY_MCE_CLASS")) ?>,
                baseurl: '<?php echo constant("TINY_MCE_BASEURL") ?>',
                content_css: '<?php echo constant("ROOT_WEB_WWW") ?>/media/bootstrap/css/front.css'
            };
            RKW.DPH = <?php echo Latte\Runtime\Filters::escapeJs(constant("DPH")) ?>;
        </script>
    </head>

<?php if (isset($googleUniversalAnalytics) && $googleUniversalAnalytics == true) { ?>
        <!-- google universal analytics -->
        <script type="text/javascript">
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            }
            )(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-64470186-1', 'auto');
            ga('send', 'pageview');

        </script>
<?php } ?>

    <body id="body"><?php
}}