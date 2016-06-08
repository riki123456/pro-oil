<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\OrdersControl/Templates/infoPanel.latte

class Template252bf27e157853c1691d3898615012d1 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7ac4f72830', 'html')
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
<div class="panel panel-yellow">
    <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Orders:", array('type'=>1)), ENT_COMPAT) ?>">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-3">
                    <i class="fa fa-shopping-cart fa-5x"></i>
                </div>
                <div class="col-md-9 text-right">
                    <div class="huge"><?php echo Latte\Runtime\Filters::escapeHtml($ordersCount, ENT_NOQUOTES) ?></div>
                    <div>Počet nových objednávek</div>
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <span class="pull-left">Přejít na seznam</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
        </div>
    </a>
</div>

<?php
}}