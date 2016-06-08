<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Admin/templates/Cron/default.latte

class Template967d6894391cfca515625133ee9f029b extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('00f0b94480', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb6615520ae6_content')) { function _lb6615520ae6_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h2>Seznam přípustných akcí pro CRON</h2>
<br>

<ul class="nav nav-tabs nav-tabs-default">
    <li role="presentation" class="active">
        <a href="#1" aria-controls="1" role="tab" data-toggle="tab">Kontrola existence obrázků</a>
    </li>
    <li role="presentation">
        <a href="#2" aria-controls="2" role="tab" data-toggle="tab">Změna velikosti obrázků</a>
    </li>
    <li role="presentation">
        <a href="#3" aria-controls="3" role="tab" data-toggle="tab">Generování XML pro zbozi.cz</a>
    </li>
    <li role="presentation">
        <a href="#4" aria-controls="4" role="tab" data-toggle="tab">Generování XML pro heureka.cz</a>
    </li>
    <li role="presentation">
        <a href="#5" aria-controls="4" role="tab" data-toggle="tab">Generování SITEMAP XML</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane tab-pane-default fade in active" id="1">
        <p>
            Skript projde polozky v databázi a zkontroluje, zda existují na disku uvedené obrázky.
            <br><br>
            Akci spustíte <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Cron:testImages", array(1)), ENT_COMPAT) ?>"><u><b>zde</b></u></a>
        </p>
    </div>
    <div role="tabpanel" class="tab-pane tab-pane-default fade" id="2">
        <p>
            Skript projde zdrojové obrázky a vygeneruje pro ně odpovídající další velikosti (jen pro ty, které ještě generované nic nemají.
            <br>
            Zároveň přidá tzv. "watermark".
            <br><br>
            Akci spustíte <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Cron:resizeImages", array(1)), ENT_COMPAT) ?>"><u><b>zde</b></u></a>
        </p>
    </div>
    <div role="tabpanel" class="tab-pane tab-pane-default fade" id="3">
        <p>
            Skript vygeneruje XML pro službu zbozi.cz
            <br><br>             
            Nový formát, zatím jej seznam.cz nepoužívá
            (<a href="http://napoveda.seznam.cz/cz/zbozi/specifikace-xml-pro-obchody/specifikace-xml-feedu/">specifikace</a>)<br>
            Akci spustíte <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Cron:generateZboziXML", array(1)), ENT_COMPAT) ?>"><u><b>zde</b></u></a>
            <br><br>
            
            <b>Starý formát 
                (<a href="http://napoveda.seznam.cz/cz/zbozi/specifikace-xml-pro-obchody/specifikace-stareho-xml-feedu/">specifikace</a>): 
                Akci spustíte <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Cron:generateZboziXML", array(1, true)), ENT_COMPAT) ?>"><u>zde</u></a>
            </b>
        </p>    
    </div>
    <div role="tabpanel" class="tab-pane tab-pane-default fade" id="4">
        Skript vygeneruje XML pro službu heureka.cz
        <br><br>
        Akci spustíte <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Cron:generateHeurekaXML", array(1)), ENT_COMPAT) ?>"><u><b>zde</b></u></a>
    </div>
    <div role="tabpanel" class="tab-pane tab-pane-default fade" id="5">
        Skript vygeneruje SITEMAP (sitemap.xml)
        <br><br>
        Akci spustíte <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Cron:generateSitemapXML", array(1)), ENT_COMPAT) ?>"><u><b>zde</b></u></a>
    </div>
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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}