<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Front/templates/Components/footer.latte

class Templatedbfbf05bdb1c34c8f942c2a787d800f4 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('52db10cd50', 'html')
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
<!--<div class="footer-fix"></div>-->

<div class="footer-content">
    <div>
        <span>(c) 2012 Pro-Oil Morava s.r.o.</span>  /  <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:page", array('o-spolecnosti')), ENT_COMPAT) ?>
">O společnosti</a>  / <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:page", array('obchodni-podminky')), ENT_COMPAT) ?>
">Obchodní podmínky</a>  /  <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:page", array('sluzby')), ENT_COMPAT) ?>
">Služby</a>  /  <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:itemsInAction"), ENT_COMPAT) ?>
">Akční nabídka</a>  /  <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:contact", array('kontaktni-informace')), ENT_COMPAT) ?>
">Kontakt</a>
    </div>
    <div>
        <span>Responsive design </span> <a href="http://www.rksystem.cz" target="_blank">Miroslav Petráš</a>  /  
        <span>Tvorba webových stránek</span> <a href="http://www.rksystem.cz" target="_blank">RKsystem</a>
    </div>
</div><?php
}}