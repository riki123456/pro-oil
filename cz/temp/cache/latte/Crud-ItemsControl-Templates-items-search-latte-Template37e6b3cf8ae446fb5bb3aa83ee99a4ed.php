<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Components\Controls\Crud\ItemsControl/Templates/items-search.latte

class Template37e6b3cf8ae446fb5bb3aa83ee99a4ed extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('678a28bb7a', 'html')
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
<form class="form-horizontal" id="form-search" action="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Default:itemsSearch"), ENT_COMPAT) ?>">
    <input type="hidden" name="do" value="itemsControl-itemsSearch">
    
    <!-- .input-group -->
    <div class="input-group" id="input-search">
        <input type="text" name="s-nazev" value=<?php echo '"' . Latte\Runtime\Filters::escapeHtml($defVal['s-nazev'], ENT_COMPAT) . '"' ?> class="form-control" placeholder="Klikni zde a najdi si olej do svého vozu">
        <span class="input-group-btn">
            <button class="btn btn-primary" data-toggle="tooltip" data-placement="auto" title="Spustit vyhledávání" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
    <!-- /.input-group -->
    
    <div id="form-search-expanded">
        <div class="form-group">
            <a class="pull-right" id="form-search-expanded-close" href="javascript:void(0);">zavřít <span class="fa fa-close"></span></a>
        </div>
        
        <div class="form-group">
            <div class="col-sm-3">
                <div class="control-label small">
                    <label for="s-kategorie">Kategorie:</label>
                </div>
            </div>
            <div class="col-sm-9">
                <select name="s-kategorie" id="s-kategorie" class="form-control">
                    <option value="">-- vyber --</option>
<?php $iterations = 0; foreach ($kategorie as $k) { ?>
                        <option value="<?php echo Latte\Runtime\Filters::escapeHtml($k->id, ENT_COMPAT) ?>
" <?php if ($k->id == $defVal['s-kategorie']) { ?> selected="selected" <?php } ?>
><?php echo Latte\Runtime\Filters::escapeHtml($k->nazev, ENT_NOQUOTES) ?></option>
<?php $iterations++; } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3">
                <div class="control-label small">
                    <label for="s-vyrobce">Výrobce:</label>
                </div>
            </div>
            <div class="col-sm-9">
                <select name="s-vyrobce" class="form-control">
                    <option value="">-- vyber --</option>
<?php $iterations = 0; foreach ($vyrobce as $v) { ?>
                        <option value="<?php echo Latte\Runtime\Filters::escapeHtml($v->id, ENT_COMPAT) ?>
" <?php if ($v->id == $defVal['s-vyrobce']) { ?> selected="selected" <?php } ?>><?php echo Latte\Runtime\Filters::escapeHtml($v->nazev, ENT_NOQUOTES) ?></option>
<?php $iterations++; } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3">
                <div class="control-label small">
                    <label for="s-sae">Norma - SAE:</label>
                </div>
            </div>
            <div class="col-sm-9">
                <input type="text" name="s-sae" value="<?php echo Latte\Runtime\Filters::escapeHtml($defVal['s-sae'], ENT_COMPAT) ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3">
                <div class="control-label small">
                    <label for="s-api">Norma - API:</label>
                </div>
            </div>
            <div class="col-sm-9">
                <input type="text" name="s-api" value="<?php echo Latte\Runtime\Filters::escapeHtml($defVal['s-api'], ENT_COMPAT) ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3">
                <div class="control-label small">
                    <label for="s-acea">Norma - ACEA:</label>

                </div>
            </div>
            <div class="col-sm-9">
                <input type="text" name="s-acea" value="<?php echo Latte\Runtime\Filters::escapeHtml($defVal['s-acea'], ENT_COMPAT) ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3">
                <div class="control-label small">
                    <label for="s-norma-vyrobce">Norma - výrobce:</label>

                </div>
            </div>
            <div class="col-sm-9">
                <input type="text" name="s-norma-vyrobce" value="<?php echo Latte\Runtime\Filters::escapeHtml($defVal['s-norma-vyrobce'], ENT_COMPAT) ?>" class="form-control">
            </div>
        </div>
    </div>
</form><?php
}}