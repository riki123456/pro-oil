$(function () {
    // nette (ajax) init
    try {
        $.nette.init();
    } catch (e) {
    }

    // blockUI plugin config
    try {
        $.blockUI.defaults.css = {
            padding: 0,
            margin: 0,
            width: '30%',
            top: '40%',
            left: '35%',
            textAlign: 'center',
            color: '#fff',
            border: 0, //'3px solid #aaa', 
            backgroundColor: 'transparent', //'#fff', 
            cursor: 'wait'
        };
        $.blockUI.defaults.overlayCSS.backgroundColor = '#474845';
        $.blockUI.defaults.message = '<span class="fa fa-cog fa-spin fa-size-4x"></span>';
    } catch (e) {
        window.console.log(e);
    }

    // window.console.log
    try {
        // reseni problemu s window.console (hlavne v IE)
        if (!window.console)
            window.console = {
                log: function () {
                },
                info: function () {
                },
                warn: function () {
                },
                error: function () {
                }
            };
    } catch (e) {
        window.console.log(e);
    }

    try {
        // bootstrap tooltip
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]',
            container: 'body'
        });
        // bootstrap tooltip - img
        $('body').tooltip({
            selector: '[data-toggle="tooltip-img"]',
            container: 'body',
            html: true,
            title: function () {
                return '<img src="' + $(this).attr('data-image') + '" />';
            }
        });
    } catch (e) {
        window.console.log(e);
    }

    var url = window.location;
    var element = $($.parseHTML('<a href="#">'));
    $('ul.nav a').each(function () {
        if (url.href.indexOf(this.href) === 0) {
            if (this.href.length > element.attr('href').length) {
                element = $(this);
            }
        }
    });

    element.addClass('active').parent().parent().addClass('in'); //.parent();
    if (element.next().is('ul')) {
        element.next().addClass('in');
    }
    /*
     if (element.is('li')) {
     element.addClass('active');
     }
     */
});
