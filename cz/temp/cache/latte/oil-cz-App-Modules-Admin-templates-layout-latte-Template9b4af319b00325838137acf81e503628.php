<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Admin/templates/@layout.latte

class Template9b4af319b00325838137acf81e503628 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('58e4f3905a', 'html')
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

<?php $_b->templates['58e4f3905a']->renderChildTemplate('../../Base/Templates/Layouts/top.latte', $template->getParameters()) ?>

<div id="wrapper">
    <!-- loading dialog -->
    <?php ob_start(); $_b->templates['58e4f3905a']->renderChildTemplate("Components/dialogModal_Loading.latte", $template->getParameters()); echo $template->strip(ob_get_clean()) ?>


    <!-- Navigation -->
    <?php ob_start(); $_b->templates['58e4f3905a']->renderChildTemplate("Components/navigation.latte", $template->getParameters()); echo $template->strip(ob_get_clean()) ?>

    <!-- /Navigation -->

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Header -->
<?php if (isset($_b->blocks["header"])) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header"><?php ob_start(); Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'header', $template->getParameters()); echo $template->strip(ob_get_clean()) ?></h1>
                    </div>
                    <!-- /.col-cd-12 -->
                </div>
                <!-- /.row -->
<?php } ?>
            <!-- Header -->

            <!-- Flash messages -->  
            <?php ob_start(); $_b->templates['58e4f3905a']->renderChildTemplate("Components/messages-flash.latte", $template->getParameters()); echo $template->strip(ob_get_clean()) ?>

            <!-- /Flash messages -->

            <!-- Breadcrumb -->
            <?php ob_start(); $_b->templates['58e4f3905a']->renderChildTemplate("Components/navigation.breadcrumb.latte", $template->getParameters()); echo $template->strip(ob_get_clean()) ?>

            <!-- /Breadcrum -->

            <!-- Page Content -->
            <div class="row">
                <div class="col-md-12">
                    <?php echo $content ?>

                </div>
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?php $_b->templates['58e4f3905a']->renderChildTemplate('../../Base/Templates/Layouts/bottom.latte', $template->getParameters()) ;
}}