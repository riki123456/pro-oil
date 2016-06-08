<?php
// source: /home/riki/work/www/pro-oil/App/Modules/Front/templates/Error/../../../Base/Templates/@layout-simple.latte

class Template65d1a2274343ad6dde4733851c58488f extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('20c5af5836', 'html')
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

<?php $_b->templates['20c5af5836']->renderChildTemplate('../../Base/Templates/Layouts/top.latte', $template->getParameters()) ?>

<div class="container">
    <!-- Flash messages - from admin module -->  
        <?php ob_start(); $_b->templates['20c5af5836']->renderChildTemplate('../../Admin/templates/Components/messages-flash.latte', $template->getParameters()); echo $template->strip(ob_get_clean()) ?>

    <!-- /Flash messages -->

    <!-- Page Content -->
    <?php echo $content ?>

    <!-- /Page Content -->
</div>
<!-- /#wrapper -->

<?php $_b->templates['20c5af5836']->renderChildTemplate('../../Base/Templates/Layouts/bottom.latte', $template->getParameters()) ;
}}