(function($, undefined) {

/**
 * ZATIM MOC NEFUNGUJE ;(( ... spatne se mi zobrazuje spinner. Vubec ne u odkazu ....
 * $.nette.ext('spinner', {
            init: function () {
                spinner = $('<div></div>', { id: "ajax-spinner" });
                spinner.appendTo("body");
            },
            before: function (settings, ui, e) { 
                $("#ajax-spinner").css({
                    display: "block",
                    left: e.pageX,
                    top: e.pageY
                });
                
                window.console.log(e);
                window.console.log(ui);
                alert('before');
            },
            complete: function () {
                $("#ajax-spinner").css({
                    display: "none"
                });
            }
        });
 */

/**
 * PUVODNI KONFIGURACE
 
$.nette.ext('spinner', {
	init: function () {
		this.spinner = this.createSpinner();
		this.spinner.appendTo('body');
	},
	start: function () {
		this.spinner.show(this.speed);
	},
	complete: function () {
		this.spinner.hide(this.speed);
	}
}, {
	createSpinner: function () {
		return $('<div>', {
			id: 'ajax-spinner',
			css: {
				display: 'none'
			}
		});
	},
	spinner: null,
	speed: undefined
});
*/
})(jQuery);
