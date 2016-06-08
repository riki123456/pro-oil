<?php
// source: D:\!__robota\00__PHP\pro-oil.cz\App\Modules\Admin/templates/Components/dialogModal_Loading.latte

class Template8b3bdcf3221f8a73771b4436297c69d8 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('b5d64016dd', 'html')
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
<div id="Loading_Container">
    <div id="Dialog_Loading" class="modal fade in" aria-hidden="false" style="display: block; padding-right: 17px;">
        <div id="Dialog_Loading-modal" class="modal-dialog">
            <div id="Dialog_Loading-content" class="modal-content">
                <div id="Dialog_Loading-body" class="modal-body">
                    <div class="container-fluid">
                        <div class="row fa-size-2x">
                            <div class="col-md-10">
                                <p class="">Probíhá načítání dat</p>
                            </div>
                            <div class="col-md-2">
                                <span class="fa fa-cog fa-spin "></span>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
        </div>
    </div>

    <div class="modal-backdrop fade in"></div>
</div><?php
}}