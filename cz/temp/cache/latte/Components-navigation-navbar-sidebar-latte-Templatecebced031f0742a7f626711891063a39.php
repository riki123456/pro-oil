<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Admin/templates/Components/navigation.navbar-sidebar.latte

class Templatecebced031f0742a7f626711891063a39 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('da7c0a9317', 'html')
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
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <!--<li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            <!-- /input-group --
            </li>-->
            <li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:"), ENT_COMPAT) ?>
"><i class="fa fa-dashboard fa-fw"></i> Hlavní stránka</a>
            </li>           
            <li class="divider"></li>
            
            <li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Orders"), ENT_COMPAT) ?>
"><i class="fa fa-shopping-cart fa-fw"></i> Objednávky<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Orders:default", array('type' => 1)), ENT_COMPAT) ?>
"><i class="fa fa-plus fa-fw"></i> nové</a></li>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Orders:default", array('type' => 2)), ENT_COMPAT) ?>
"><i class="fa fa-check fa-fw"></i> potvrzené</a></li>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Orders:default", array('type' => 3)), ENT_COMPAT) ?>
"><i class="fa fa-close fa-fw"></i> zamítnuté</a></li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Items:"), ENT_COMPAT) ?>
"><i class="fa fa-cubes fa-fw"></i> Položky</a>
            </li>            
            
            <li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Orders"), ENT_COMPAT) ?>
"><i class="fa fa-database fa-fw"></i> Číselníky<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Categories:"), ENT_COMPAT) ?>
"><i class="fa fa-server fa-fw"></i> Kategorie položek</a>
                    </li>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Manufacturers:"), ENT_COMPAT) ?>
"><i class="fa fa-wrench fa-fw"></i> Výrobci</a>
                    </li>    
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uom:"), ENT_COMPAT) ?>
"><i class="fa fa-balance-scale fa-fw"></i> Měrné jednotky</a>
                    </li>    
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Availability:"), ENT_COMPAT) ?>
"><i class="fa fa-clock-o fa-fw"></i> Dostupnost skladem</a>
                    </li> 
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Payments:"), ENT_COMPAT) ?>
"><i class="fa fa-cc-visa fa-fw"></i> Platby</a>
                    </li> 
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Transports:"), ENT_COMPAT) ?>
"><i class="fa fa-truck fa-fw"></i> Doprava</a>
                    </li>                         
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li class="divider"></li>
                        
            <li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Orders"), ENT_COMPAT) ?>
"><i class="fa fa-file-text fa-fw"></i> Správa webových stránek<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">                    
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Contacts:"), ENT_COMPAT) ?>
"><i class="fa fa-envelope fa-fw"></i> Kontakty</a>
                    </li>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Slideshow:"), ENT_COMPAT) ?>
"><i class="fa fa-video-camera fa-fw"></i> Slideshow</a>
                    </li>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Pages:"), ENT_COMPAT) ?>
"><i class="fa fa-file-text fa-fw"></i> Stránky HTML</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <li class="divider"></li>
            
            <li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Users:"), ENT_COMPAT) ?>
"><i class="fa fa-users fa-fw"></i> Správa uživatelů</a>
            </li>
            
            <li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Cron:"), ENT_COMPAT) ?>
"><i class="fa fa-calendar fa-fw"></i> CRON akce</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-default --><?php
}}