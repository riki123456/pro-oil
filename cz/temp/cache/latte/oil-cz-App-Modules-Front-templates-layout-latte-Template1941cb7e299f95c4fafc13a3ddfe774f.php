<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Front/templates/@layout.latte

class Template1941cb7e299f95c4fafc13a3ddfe774f extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1d9a1933e1', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block rightbar
//
if (!function_exists($_b->blocks['rightbar'][] = '_lb5968ce5df5_rightbar')) { function _lb5968ce5df5_rightbar($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
ob_start() ?>
    <div><?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'content', $template->getParameters()) ?></div>
<?php $content = ob_get_clean() ?>

<?php $_b->templates['1d9a1933e1']->renderChildTemplate('../../Base/Templates/Layouts/top.latte', array('googleUniversalAnalytics' => constant("GOOGLE_ANALYTICS")) + $template->getParameters()) ?>

<!-- Navigation -->
<?php ob_start(); $_b->templates['1d9a1933e1']->renderChildTemplate("Components/navigation.latte", $template->getParameters()); echo $template->strip(ob_get_clean()) ?>

<!-- /Navigation -->

<div class="container container-front">
<?php $_b->templates['1d9a1933e1']->renderChildTemplate("Components/navigation-sub.latte", $template->getParameters()) ?>

    <!-- .row -->
    <div class="row">
        <!-- .col -->
        <div class="col-sm-3">
            <!-- Navigation sub - search and shop basket -->
            <?php ob_start(); $_b->templates['1d9a1933e1']->renderChildTemplate("Components/navigation-sidebar.latte", $template->getParameters()); echo $template->strip(ob_get_clean()) ?>

            <!-- /Navigation -->
        </div>
        <!-- /.col -->

        <!-- .col -->
        <div class="col-sm-7">
            <!-- Flash messages -->  
            <?php ob_start(); $_b->templates['1d9a1933e1']->renderChildTemplate("Components/messages-flash.latte", $template->getParameters()); echo $template->strip(ob_get_clean()) ?>

            <!-- /Flash messages -->

<?php $_b->templates['1d9a1933e1']->renderChildTemplate("Components/navigation.breadcrumb.latte", $template->getParameters()) ?>

            <?php echo $content ?>

        </div>
        <!-- /.col -->

        <!-- .col -->
        <div class="col-sm-2 rightbar">
            <?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['rightbar']), $_b, get_defined_vars())  ?>

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

<div class="container-fluid" id="footer">
<?php $_b->templates['1d9a1933e1']->renderChildTemplate("Components/footer.latte", $template->getParameters()) ?>
</div>

<?php $_b->templates['1d9a1933e1']->renderChildTemplate('../../Base/Templates/Layouts/bottom.latte', $template->getParameters()) ;
}}