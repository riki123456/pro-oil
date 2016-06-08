<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Base\Presenters/../Templates/@layout-simple.latte

class Templatef1c9e87e1d0ef2ab9c07a7b9da5f3c8f extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4c1d7800f4', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
ob_start() ?>
    <div><?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'content', $template->getParameters()) ?></div>
<?php $content = ob_get_clean() ?>

<?php $_b->templates['4c1d7800f4']->renderChildTemplate('../../Base/Templates/Layouts/top.latte', $template->getParameters()) ?>

<div class="container">
    <!-- Flash messages - from admin module -->  
        <?php ob_start(); $_b->templates['4c1d7800f4']->renderChildTemplate('../../Admin/templates/Components/messages-flash.latte', $template->getParameters()); echo $template->strip(ob_get_clean()) ?>

    <!-- /Flash messages -->

    <!-- Page Content -->
    <?php echo $content ?>

    <!-- /Page Content -->
</div>
<!-- /#wrapper -->

<?php $_b->templates['4c1d7800f4']->renderChildTemplate('../../Base/Templates/Layouts/bottom.latte', $template->getParameters()) ;
}}