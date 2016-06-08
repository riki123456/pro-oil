<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Base\Presenters/../Templates/login.latte

class Templateef66302c25d6ae6ab8fed4f8a5684b72 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('68708aa034', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb2d0b2a574f_title')) { function _lb2d0b2a574f_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přihlášení<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb6bfc366ed0_content')) { function _lb6bfc366ed0_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="login-panel panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Přihlášení</h3>
            </div>
            <div class="panel-body">
<?php $_l->tmp = $_control->getComponent("loginForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
            </div>
        </div>
    </div>
</div><?php
}}

//
// end of blocks
//

// template extending

$_l->extends = "@layout-simple.latte"; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
// ?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>



<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}