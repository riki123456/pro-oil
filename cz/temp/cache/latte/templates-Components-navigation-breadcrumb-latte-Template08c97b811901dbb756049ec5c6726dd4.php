<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Front/templates/Components/navigation.breadcrumb.latte

class Template08c97b811901dbb756049ec5c6726dd4 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3e5b9db9fe', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if (isset($breadcrumb)) { ?>
    <div class="row breadcrumb-row hidden-xs">
        <ol class="breadcrumb">
<?php $counter = 1; $barr = $breadcrumb->getBreadcrumb(); $barrCount = count($barr) ?>

<?php $iterations = 0; foreach ($barr as $bindex => $barray) { if ($counter == $barrCount) { ?>
                    <li class="active"><?php echo Latte\Runtime\Filters::escapeHtml($barray[1], ENT_NOQUOTES) ?></li>
<?php } else { ?>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($barray[0]), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($barray[1], ENT_NOQUOTES) ?></a></li>
<?php } ?>

<?php $counter = $counter+1; $iterations++; } ?>
        </ol>
    </div>
<?php } 
}}