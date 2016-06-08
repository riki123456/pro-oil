<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\SlideshowControl/Templates/slider.latte

class Template1da79e0e256cbf05ff6c608a59fdefa3 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('596f4a2203', 'html')
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
<ul class="rslides margin-bottom">
<?php $iterations = 0; foreach ($slides as $slide) { ?>
        <li>
<?php if (empty($slide->link)) { ?>
                <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>
/images/slideshow/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($slide->img), ENT_COMPAT) ?>">
<?php } else { ?>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($slide->link), ENT_COMPAT) ?>">
                    <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>
/images/slideshow/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($slide->img), ENT_COMPAT) ?>">
                </a>
<?php } ?>
        </li>
<?php $iterations++; } ?>
</ul><?php
}}