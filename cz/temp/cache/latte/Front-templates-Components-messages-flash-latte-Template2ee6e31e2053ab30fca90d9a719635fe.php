<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Front/templates/Components/messages-flash.latte

class Template2ee6e31e2053ab30fca90d9a719635fe extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('badb85bc59', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($flashes) { ?>
    <div class="row flash-messages">
<?php $iterations = 0; foreach ($flashes as $flash) { ?>
            <div class="alert alert-<?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>">
                <div style="float: left; width: 90%;"><?php echo $flash->message ?></div>
                <div>
                    <?php if ($flash->type == constant("FLASH_OK")) { ?><span class="pull-right fa fa-check-circle fa-size-1a5x"></span>
                    <?php } elseif ($flash->type == constant("FLASH_ERR")) { ?><span class="pull-right fa fa-times-circle fa-size-1a5x"></span>
                    <?php } elseif ($flash->type == constant("FLASH_INFO")) { ?><span class="pull-right fa fa-info-circle fa-size-1a5x"></span>
                    <?php } elseif ($flash->type == constant("FLASH_WARN")) { ?><span class="pull-right fa fa-exclamation-circle fa-size-1a5x"></span>
<?php } ?>
                </div>
                <div style="clear: both;"></div>
            </div>
<?php $iterations++; } ?>
    </div>
    <!-- /.row -->
<?php } 
}}