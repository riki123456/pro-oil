<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Admin/templates/Components/navigation.navbar-top-links.latte

class Templatea34c468f04a18da4c8b8c12bebd72859 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('b7c7e4b49f', 'html')
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
<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>
            <?php echo Latte\Runtime\Filters::escapeHtml($user->getIdentity()->getData()['login'], ENT_NOQUOTES) ?>
 [<?php echo Latte\Runtime\Filters::escapeHtml($user->getIdentity()->getData()['role'], ENT_NOQUOTES) ?>]
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user" style="right: 0; left: auto;">
            <li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Users:edit", array($this->user->id)), ENT_COMPAT) ?>
"><i class="fa fa-user fa-fw"></i> Správa profilu</a>
            </li>
            <li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Users:passw", array($this->user->id)), ENT_COMPAT) ?>
"><i class="fa fa-shield fa-fw"></i> Změna hesla</a>
            </li>
            <!-- <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a> -->
            </li>
            <li class="divider"></li>
            <li><?php $_l->tmp = $_control->getComponent("logoutControl"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?></li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links --><?php
}}