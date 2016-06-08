$(window).load(function () {
    try {
        // vlastni funkce na nette toggle
        Nette.toggle = function (id, visible) {
            var el = $('#' + id);
            alert('tohle je nette.toggle');
            if (visible) {
                el.slideDown();
            } else {
                el.slideUp();
            }
        };

        // vlastni funkce pro nette form validaci
        // Global object
        NetteOrigin = {
            validateForm: Nette.validateForm
        };

        Nette.validateForm = function (form) {
            var valid = NetteOrigin.validateForm(form);

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

    // 1. vse zavreme       
    _fields.find("> div").hide();
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
        $(this).find(".fa-minus-square-o").toggleClass('fa-plus-square-o');
        $(this).parents('fieldset').find("> div").toggle("fast");
    });

    // ukazeme formy - mame vse hotovo :)
    setTimeout(function () {
        $("form").removeClass("hidden");
    }, 50);
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
    if ($('.tinyMCE').length > 0) {
        try {
            tinyMCE.baseURL = "/www/media/tinymce";// trailing slash important

            tinyMCE.init({
                mode: "specific_textareas",
                editor_selector: "tinyMCE",
                language: $('html').prop('lang'),
                height: $('html').attr('data-height'),
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

