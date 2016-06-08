$(window).load(function () {
    try {
        // vlastni funkce na nette toggle
        Nette.toggle = function (id, visible) {
            var el = $('#' + id);

            if (visible) {
                el.slideDown("fast");
                el.attr('data-display-before', 'block');
            } else {
                el.slideUp("fast");
                el.attr('data-display-before', 'none');
            }
        };

        // vlastni funkce pro nette form validaci
        // Global object
        NetteOrigin = {
            validateForm: Nette.validateForm
        };

        Nette.validateForm = function (form) {
            // validujeme
            var valid = NetteOrigin.validateForm(form);

            // vyhodnoceni validace
            if (!valid) {
                // otevreme prislusnou form-group, at jde videt error
                $('.error-message')
                        .parents('fieldset')
                        .filter(function () {
                            return $(this).find('.fa-plus-square-o').length;
                        })
                        .find('.nette-form-group-toggle').trigger('click');

                return valid;
            }

            return true;
        };
    } catch (e) {
        window.console.log(e);
    }

    /**
     * uprava pro google pamatovac u formularu ... at si nepamatuje ;) 
     */
    var _inputs = $('input[type="text"]').add($('input[type="password"]'));

    _inputs.each(function () {
        if ($(this).val() === '') {
            $(this).val(' ');
        }
    });

    setTimeout(function () {
        var _inputs = $('input[type="text"]').add($('input[type="password"]'));

        _inputs.each(function () {
            if ($(this).val() === ' ') {
                $(this).val('');
            }
        });
    }, 20);

    /**
     * toggle form group
     */
    var _fields = $(".nette-form-group-toggle").parents('fieldset');
    _fields.find("legend").css('cursor', 'pointer');

    // 1. vse zavreme, do attr data-display-before si pridame info, v jakem stavu byl div pred zavrenim
    // to pak vyuziju pri otevreni ... at nedelam spatne s nette toggle form controls
    _fields.find("> div").each(function () {
        $(this).attr('data-display-before', $(this).css('display'));
        $(this).hide();
    });
    // 2. otevreme ten, co NEma tridu: fa-minus-square-o
    _fields.filter(function () {
        return ($(this).find('.fa-minus-square-o').length <= 0);
    }).find("> div").show();
    _fields.filter(function () {
        return ($(this).find('.fa-minus-square-o').length <= 0);
    }).find(".fa-plus-square-o")
            .addClass("fa-minus-square-o").toggleClass("fa-plus-square-o");
    // 3. pridame onclick udalost na label (NE nad ikonku)
    $(".nette-form-group-toggle").on('click', function () {
        var _pom = $(this).find(".fa-minus-square-o");
        _pom.toggleClass('fa-plus-square-o');

        if (_pom.hasClass('fa-plus-square-o')) {
            $(this).parents('fieldset').find("> div").slideUp("fast");
        } else {
            $(this).parents('fieldset').find("> div")
                    .filter(function () {
                        return $(this).attr('data-display-before') !== 'none';
                    })
                    .slideDown("fast");

        }
    });

    // ukazeme formy - mame vse hotovo :)
    setTimeout(function () {
        $("form").removeClass("hidden");
    }, 200);
});

// prevede formular na detail (udela jen pro vse "disabled" ;) ...)
// a skryje vsechny butony krome "zpet"
$(document).ready(function () {
    if ($('form[data-form-type="detail"]').length > 0) {
        var _form = $('.komponent > form[data-form-type="detail"]');
        _form.find('.btn-primary').hide();

        $.each(_form.serializeArray(), function (index, value) {
            $('[name="' + value.name + '"]').prop('disabled', true);
        });

        $.each(_form.find('input[type="file"]'), function () {
            $(this).prop('disabled', true);
        });
    }
});

// inicializace tinyMce
$(document).ready(function () {
    if ($('.' + RKW.tinyMCE.class).length > 0) {
        try {
            tinyMCE.baseURL = RKW.tinyMCE.baseurl;// trailing slash important

            tinyMCE.init({
                mode: "specific_textareas",
                editor_selector: RKW.tinyMCE.class,
                language: RKW.lang,
                content_css: RKW.tinyMCE.content_css,
                //height: $(this).attr('data-height'), RFIXME: jak a proc tady ziskavat vysku??
                theme: "modern",
                setup: function (editor) {
                    editor.on('init', function (event) {
                        editor.getContainer().className += ' form-control';
                    });
                },
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
        } catch (e) {
            window.console.log(e);
        }
    }
});

