<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Front/templates/Default/contact.latte

class Templateb772c6e623c98aeab16469c2ec1370d9 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4f45adf22c', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block rightbar
//
if (!function_exists($_b->blocks['rightbar'][] = '_lb136a1f8183_rightbar')) { function _lb136a1f8183_rightbar($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="margin-bottom-base">
        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:shoppingCart", array('blankCart'=>1)), ENT_COMPAT) ?>">
            <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl(constant('ROOT_WEB_WWW')), ENT_COMPAT) ?>/images/sleva_20_v2.png" class="img-responsive">
        </a>    
    </div>

<?php $_l->tmp = $_control->getComponent("itemsControl"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->renderItemsInAction() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbba27787bed_content')) { function _lbba27787bed_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h2>Kontaktní informace</h2>

<div class="row">
    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr><th>Jméno a příjmeni</th><th>Pozice</th><th>E-mail</th><th>Mobil</th></tr>
        </thead>
        <tbody>
<?php $iterations = 0; foreach ($contactData as $c) { ?>
                <tr>
                    <td><?php echo Latte\Runtime\Filters::escapeHtml($c->name, ENT_NOQUOTES) ?></td>
                    <td><?php echo Latte\Runtime\Filters::escapeHtml($c->position, ENT_NOQUOTES) ?></td>
                    <td><a href="mailto:<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($c->mail), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($c->mail, ENT_NOQUOTES) ?></a></td>
                    <td><?php echo Latte\Runtime\Filters::escapeHtml($c->tel, ENT_NOQUOTES) ?></td>
                </tr>
<?php $iterations++; } ?>
        </tbody>
    </table>

    <?php if (isset($contactPageData->content)) { echo $contactPageData->content ;} ?>

</div><?php
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

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['rightbar']), $_b, get_defined_vars())  ?>


<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}