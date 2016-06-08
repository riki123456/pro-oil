<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Base\Presenters/../Templates/../../Base/Templates/Layouts/bottom.latte

class Template7784eeb0f3225dbeb91de159538012d5 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('248cf1c84b', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block scriptsFiles
//
if (!function_exists($_b->blocks['scriptsFiles'][] = '_lbb1e0754989_scriptsFiles')) { function _lbb1e0754989_scriptsFiles($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("js"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;$_l->tmp = $_control->getComponent("jsDynamic"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>

<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbbf59574632_scripts')) { function _lbbf59574632_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
?>
<!-- SCRIPT FILES -->

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['scriptsFiles']), $_b, get_defined_vars())  ?>
<!-- /SCRIPT FILES -->

<!-- SCRIPTS -->
<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>


<script type="text/javascript">
    $(function () {
        setTimeout(function () {
            if ($("#Loading_Container").length > 0)
                $("#Loading_Container").remove();
        }, 250);
    });
</script>
<!-- /SCRIPTS -->

</body>
</html><?php
}}