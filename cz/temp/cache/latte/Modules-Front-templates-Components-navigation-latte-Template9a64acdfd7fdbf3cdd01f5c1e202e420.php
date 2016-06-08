<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Front/templates/Components/navigation.latte

class Template9a64acdfd7fdbf3cdd01f5c1e202e420 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0d18b678d8', 'html')
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
    <div class="container-fluid margin-bottom-large" id="container-navbar-top">
        <nav class="navbar navbar-default navbar-black container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Hlavní strana</a>
                <a class="navbar-brand active" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:itemsInAction"), ENT_COMPAT) ?>
">Akční nabídka</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:page", array('sluzby')), ENT_COMPAT) ?>
">Služby</a></li>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:page", array('obchodni-podminky')), ENT_COMPAT) ?>
">Obchodní podmínky</a></li>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:page", array('o-spolecnosti')), ENT_COMPAT) ?>
">O společnosti</a></li>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:contact", array('kontaktni-informace')), ENT_COMPAT) ?>
">Kontakt</a></li>
                    <!--
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                    -->
                </ul>
                
                <!--
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                -->
                <ul class="nav navbar-nav navbar-right">
                    <!--
                    <li><a href="#">Přihlášení</a></li>
                    <li><a href="#">Registrace</a></li>
                    -->
                    <!--
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                    -->
                </ul>
            </div><!-- /.navbar-collapse -->

        </nav>
    </div><!-- /.container-fluid -->
<?php
}}