<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\UsersControl/Templates/infoPanel.latte

class Template3a369b5b057839327a780e0ddf0a6e31 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('e39bccb977', 'html')
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
<div class="panel panel-green">
    <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Users:"), ENT_COMPAT) ?>">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-3">
                    <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-md-9 text-right">
                    <div class="huge"><?php echo Latte\Runtime\Filters::escapeHtml($usersCount, ENT_NOQUOTES) ?></div>
                    <div>Počet registrovaných uživatelů</div>
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <span class="pull-left">Přejít na seznam</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
        </div>
    </a>
</div><?php
}}