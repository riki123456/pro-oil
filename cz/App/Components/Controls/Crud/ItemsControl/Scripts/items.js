$(function () {
    // colorbox
    _init_colorbox();

    // form-question -> in item detail show form
    $("#form-question").click(function () {
        $(this).parent().next().removeClass('hidden');
    });

    // search form expanded switcher
    $("#form-search").find('input[name="s-nazev"]').focusin(
            function () {
                $("#form-search #form-search-expanded").show();
            }
    );
    $("#form-search-expanded-close").click(
            function () {
                $("#form-search #form-search-expanded").hide();
            }
    );

    // item switcher
    $(".baleni-switcher").on('change', function () {
        var _this = $(this);
        var url = _this.val(); //get selected value
        if (url) {
            $.nette.ajax({
                url: url,
                beforeSend: function () {
                    _this.parents(".panel").block();
                },
                complete: function () {
                    _this.parents(".panel").unblock();

                    // colorbox
                    _init_colorbox();
                }
            });
        }
    });

    // page rows
    $('#itemPageRows').on('change', function () {
        var url = $(this).val(); // get selected value
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });

    // paginator
    $_data = $("#items-pagination").data();
    if (undefined !== $_data && $_data.paginationTotalpage > 0) {

        var bp_options = {
            bootstrapMajorVersion: 3,
            currentPage: $_data.paginationPage,
            totalPages: $_data.paginationTotalpage,
            itemContainerClass: function (type, page, current) {
                if (page === current && type === 'page') {
                    return "active";
                } else {
                    if ((type === 'first' || type === 'prev') && current === 1) {
                        return 'disabled';
                    } else if ((type === 'last' || type === 'next') && current === $_data.paginationTotalpage) {
                        return 'disabled';
                    }
                    else {
                        return 'pointer';
                    }
                }
            },
            shouldShowPage: function (type, page, current) {
                switch (type)
                {
                    default:
                        return true;
                }

            },
            onPageClicked: function (e, originalEvent, type, page) { //return false;
                var url = $_data.paginationUrl.replace('page=' + $_data.paginationPage, 'page=' + page);
                var clicked = $("#items-pagination").find('li.active > a');

                if (clicked.text() === page.toString()) {
                    return false;
                } else if (url) { // require a URL
                    window.location = url; // redirect
                } else {
                    return false;
                }

            }
        };
        $('#items-pagination').bootstrapPaginator(bp_options);
    }
});


//// FUNCTIONS
function _init_colorbox() {
    // colorbox
    // Image links displayed as a group
    try {
        $('a.photo').colorbox({rel: 'photo', title: null,
            /*
             title: function () {
             var _product = $(this).parents('.product');
             var _detail_href = _product.find('.product-detail').attr('href');
             
             return '<a href="' + _detail_href + '" class="_cboxDetialHref" style="text-decoration: underline;">'
             + _product.find('.product-name').text()
             + ', <span class="small">'
             + _product.find('.product-price').text()
             + '</span>'
             + '</a>';
             },*/
            onComplete: function () {
                var _product = $(this).parents('.product');
                var _detail_href = _product.find('.product-detail').attr('href');

                var title = '<a href="' + _detail_href + '" class="_cboxDetialHref" style="text-decoration: underline;">'
                        + _product.find('.product-name').text()
                        + ' ('
                        + _product.find('.baleni-switcher option:selected').text()
                        + ')'
                        + ', <span class="small">'
                        + _product.find('.product-price').text()
                        + '</span>'
                        + '</a>';
                jQuery("<div style='text-align: center; padding: 3px 10px 3px 10px; color: #949494;'>" + title + "</div>")
                        .insertAfter("#cboxLoadedContent .cboxPhoto");

                /*
                 $("#cboxCurrent").hide();
                 $("#cboxTitle").hide();
                 var link = jQuery.colorbox.element();
                 var title = jQuery(link).attr("title");
                 if (title.length < 1 || title === undefined)
                 title = '&nbsp;';
                 jQuery("<div style='text-align: center; padding: 3px 10px 3px 10px; color: #949494;'>" + title + "</div>").insertAfter("#cboxLoadedContent .cboxPhoto");
                 */
                //potrebne resize, kvuli upravam
                $.colorbox.resize();



                /*
                 $("#cboxTitle ._cboxDetialHref").attr('href', _product.find('.product-detail').attr('href'));
                 alert($("#cboxTitle ._cboxDetialHref").attr('href', _product.find('.product-detail').attr('href')))
                 window.console.log($("#cboxTitle ._cboxDetialHref").attr('href', _product.find('.product-detail').attr('href')));
                 */
            }
        });
    } catch (e) {
        window.console.log(e);
    }

    /** COLORBOX *
     jQuery.fn.rikiColorboxInit = function(json, callback) {
     return this.each(function() {
     //z taconite prichazi json jako obsah elementu. je treba ho vytahnout
     var config = __parseConfig(json);
     var obj = jQuery(this);
     
     config.slideshow = (undefined === config.slideshow) ? false : (0 == config.slideshow) ? false : config.slideshow;
     config.slideshowAuto = (undefined === config.slideshowAuto) ? false : (0 == config.slideshowAuto) ? false : config.slideshowAuto;
     config.noclass = (undefined === config.noclass) ? 'private' : config.noclass;
     config.removeBeforeCall = (undefined === config.removeBeforeCall) ? false : config.removeBeforeCall;
     //slideshow text setting
     jQuery.colorbox.settings.slideshowStart = (undefined !== config.presentationStart && config.presentationStart.length > 0) ? config.presentationStart : 'start';
     jQuery.colorbox.settings.slideshowStop = (undefined !== config.presentationStop && config.presentationStop.length > 0) ? config.presentationStop : 'stop';
     //pokud chceme slideshow, upravime malicko link
     if(config.slideshow) jQuery('.cboxSlideshow_on #cboxSlideshow').live('click',jQuery.colorbox.next);
     
     //aktivace
     if(undefined === config.selector || null === config.selector) alert("není definován colorbox selector");
     else {
     var s = jQuery(config.selector).filter(function() {return (! obj.hasClass(config.noclass));});
     
     //pokud bychom nemeli attribut rel, tak pridame. vzdy mame skupinu, i o jednom clenu !
     s.each(function() { 
     if(jQuery(this).attr('rel')) {
     jQuery(this).addClass('grouped'); 
     } else {
     jQuery(this).attr('rel',"ph_images").addClass('taconite_init_automatics_grouped');
     }
     });
     
     //do konfigurace pridame complete funkci, ktera upravuje zobrazeni title
     config.onComplete = function() { 
     jQuery("#cboxTitle").hide(); 
     var link = jQuery.colorbox.element(); 
     var title = jQuery(link).attr("title"); 
     if(title.length < 1 || title === undefined) title = '&nbsp;';
     jQuery("<div style='text-align: center; padding: 3px 10px 3px 10px; color: #949494;'>"+title+"</div>").insertAfter("#cboxLoadedContent .cboxPhoto");
     
     //potrebne resize, kvuli upravam
     jQuery.colorbox.resize();
     };
     
     //a jeste close funkci, ktera pred uzavrenim vypne slideshow
     config.onClosed = function() {
     var c_state = jQuery('#colorbox').is('.cboxSlideshow_on') ? 'on' : 'off';
     if('on' == c_state) jQuery('.cboxSlideshow_on #cboxSlideshow').click(); // stop 
     
     //zavreme
     jQuery.colorbox.close();
     };
     
     //inicializace
     s.colorbox(config, callback);
     }
     });
     };
     
     */
}


