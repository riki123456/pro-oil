<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\OrdersControl/Templates/graf.latte

class Templatec2cc27342a020cc3f672819b1a36338b extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('d0af2aa00f', 'html')
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
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa <?php echo Latte\Runtime\Filters::escapeHtml($grafTitleIconClass, ENT_COMPAT) ?>
 fa-bar-chart fa-fw"></i> <?php echo Latte\Runtime\Filters::escapeHtml($grafTitle, ENT_NOQUOTES) ?>

    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="morris" id="morris-bar-chart-type-<?php echo Latte\Runtime\Filters::escapeHtml($grafType, ENT_COMPAT) ?>"
             data-name='<?php echo Latte\Runtime\Filters::escapeHtml($grafType == 1 ? "Bar" : "Line", ENT_QUOTES) ?>'
             data-type='<?php echo Latte\Runtime\Filters::escapeHtml($grafType, ENT_QUOTES) ?>'
             data-xkey='<?php echo Latte\Runtime\Filters::escapeHtml($grafXkey, ENT_QUOTES) ?>'
             data-ykeys='<?php echo $grafYkeys ?>'
             data-label='<?php echo $grafLabel ?>'
             data-data='<?php echo $grafData ?>'
             ></div>
    </div>
</div>
<!-- /.panel-body --><?php
}}