<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Front/templates/Components/navigation-sidebar.latte

class Template3e1c4759026edc89fdf5e7cefc343438 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1cd48d4c47', 'html')
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
<div class="sidebar-nav">
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand">Kategorie</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
            <ul class="nav navbar-nav">
<?php $iterations = 0; foreach ($sidebarMenu as $kategorie_arr) { $k = $kategorie_arr['kategorie'] ;Tracy\Debugger::barDump(($k), '$k') ;if ($k->display == 1) { ?>
                        <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:items", array($k->alias)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($k->nazev, ENT_NOQUOTES) ?></a></a>
                            <ul class="nav nav-second-level navbar-nav collapse">
<?php $iterations = 0; foreach ($kategorie_arr['vyrobce'] as $v) { ?>
                                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:items", array($k->alias, $v->alias)), ENT_COMPAT) ?>
">
                                            <?php echo Latte\Runtime\Filters::escapeHtml($v->nazev, ENT_NOQUOTES) ?>

                                        </a>
                                    </li>
<?php $iterations++; } ?>
                            </ul>
<?php } $iterations++; } ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div><?php
}}