<?php
// source: /home/riki/work/www/pro-oil/App/Modules/Front/templates/Error/default.latte

class Templatee88f5d79faca340ffafcf8b17acd8e64 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('023d9cdad4', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lba2b564297f_content')) { function _lba2b564297f_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
    <div class="col-md-6 col-md-offset-3">
                <div class="panel <?php echo $message[1] ?>" style="margin-top: 35%;">
            <div class="panel-heading"><h3><span class="<?php echo $message[2] ?>
"></span> <?php echo Latte\Runtime\Filters::escapeHtml($message[0], ENT_NOQUOTES) ?></h3></div>
            <div class="panel-body">
                <?php echo $message[3] ?>

            </div>
            <div class="panel-footer small">ErrorCode: <?php echo Latte\Runtime\Filters::escapeHtml($errorCode, ENT_NOQUOTES) ?>

                <span class="pull-right"><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Default:"), ENT_COMPAT) ?>" class="fa-size-1a5x">Přejít na hlavní stránku</a></span>
            </div>
        </div>
            </div>
</div>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = '../../../Base/Templates/@layout-simple.latte'; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
// ?>

<?php $mailAdmin = constant("MAIL_ADMIN") ?>

<?php $messages = array(
    0 => array('Nastala výjimka', 'panel-danger', 'fa fa-close', 'Váš prohlížeč poslal žádost, kterou server nemůže zpracovat.'),
    403 =>  array('Přístup zamítnut', 'panel-info', 'fa fa-info-circle', 'Na požadovanou stránku nemáte oprávnění.<br/><br/>Pokud si myslíte, že se jedná o chybu, kontaktujte prosím administrátora na adrese <a class="inverse" href="mailto:' . $mailAdmin . '.cz">' . $mailAdmin . '</a>'),
    404 => array('Stránka nenalezena', 'panel-info', 'fa fa-info-circle', 'Stránka nebyla bohužel nalezena. Zkontrolujte si prosím, zda není adresa zadána špatně.<br/><br/>Pokud si myslíte, že se jedná o chybu, kontaktujte prosím administrátora na adrese <a class="inverse" href="mailto:' . $mailAdmin . '.cz">' . $mailAdmin . '</a>'),
    405 => array('Metoda není povolena', 'panel-warning', 'fa fa-exclamation-triangle', 'Požadovaná metoda není na serveru povolena.'),
    410 => array('Stránka nenalezena', 'panel-info', 'fa fa-info-circle', 'Stránka byla odstraněna ze serveru.'),
    256 => array('Nastala výjimka', 'panel-danger', 'fa fa-close', 'Váš prohlížeč poslal žádost, kterou server nemůže zpracovat.'),
    500 => array('Chyba serveru', 'panel-danger', 'fa fa-exclamation-triangle', 'Omlouváme se, ale na serveru došlo k vnitřní chybě a nemohl dokončit váš požadavek. Prosím zkuste akci zopakovat později.<br/><br/>Děkujeme.'),
    512 => array('Nastala výjimka', 'panel-warning', 'fa fa-exclamation-triangle', 'Váš prohlížeč poslal žádost, kterou server nemůže zpracovat.')
) ?>

<?php $message = isset($messages[$errorCode]) ? $messages[$errorCode] : $messages[0] ?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}