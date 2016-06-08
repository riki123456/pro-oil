$(function () {
    // uprava designu, takovy maly workaround
    if($(".obsah-kosiku").length > 0) {
        var _row = $(".container-front").find(".row").eq(1);//.last();
        var _col_sm_3 = _row.find(".col-sm-3");
        var _col_sm_7 = _row.find(".col-sm-7");
        
        _col_sm_3.css("display", "none");
        _col_sm_7.removeClass("col-sm-7").addClass("col-sm-10");
    }
    
    // aktualizace button pro zobrazeni aktualniho mini kosiku
    $('.cart-mini-update').click(function () {
        updateCart($(this));
    });
    $('.cart-mini-update').parents('form').on('submit', function () {
        updateCart($(this));

        return false;
    });
    
    // uvodni update
    updateCenaCelkemSdopravou($("input[name='doprava_id']").filter(function() { return $(this).is(':checked'); }));
    
    // a onclick
    $("input[name='doprava_id']").click(function() {
        updateCenaCelkemSdopravou($(this));
        
    });
});

function updateCenaCelkemSdopravou(event) {
    if(event.length <= 0) return;
    
    // formatovani currency - switch between languages
    numeral.language(RKW.lang);

   // a pocitame
    var cena_celkem_s_dph = parseFloat($("#cena_celkem_s_dph").text().replace(',', '.').replace(/[^0-9\.]/g, ''));
    var cena_celkem_bez_dph = parseFloat($("#cena_celkem_bez_dph").text().replace(',', '.').replace(/[^0-9\.]/g, ''));    
    
    // najdeme si ceny, jsou vzdy posledni 2 v poli
    var cena_doprava_input = event.parent().text().replace('DPH,','#').replace(', cena', '#');
    var _c_bez_dph = 0;
    var _c_s_dph = 0;
    
    var cena_doprava_input__arr = cena_doprava_input.split("#");
    _c_s_dph = parseFloat(cena_doprava_input__arr.pop().replace(',', '.').replace(/[^0-9\.]/g, ''));
    _c_bez_dph = parseFloat(cena_doprava_input__arr.pop().replace(',', '.').replace(/[^0-9\.]/g, ''));
    
    var cena_celkem_doprava_bez_dph = (cena_celkem_bez_dph + _c_bez_dph).toString().replace('.',',');
    var cena_celkem_doprava_s_dph = Math.ceil((cena_celkem_s_dph + _c_s_dph)).toString().replace('.', ',');
    
    $("#cena_celkem_doprava_bez_dph").text(numeral(cena_celkem_doprava_bez_dph).format('0,0 $'));
    $("#cena_celkem_doprava_s_dph").text(numeral(cena_celkem_doprava_s_dph).format('0,0 $'));
    
    /*
    window.console.log(event.parent().text().replace('DPH,','#'));
    window.console.log(event.text());//.text().replace(/[^0-9\.]/g, ''));
    
    window.console.log("CENA ZA POLOZKY: " + cena_celkem_s_dph);
    window.console.log("CENA ZA POLOZKY bez DPH: " + cena_celkem_bez_dph);
    
    window.console.log("cena_doprava_input:");
    window.console.log(cena_doprava_input);
    window.console.log("cena_doprava_input__arr:");
    window.console.log(cena_doprava_input__arr);
    window.console.log("cena_doprava_input - CENY:");
    window.console.log(_c_bez_dph, _c_s_dph);
    
    window.console.log("CENA ZA DOPRAVU: " + cena_celkem_doprava_s_dph);
    window.console.log("CENA ZA DOPRAVU bez DPH: " + cena_celkem_doprava_bez_dph);
    */
}

function updateCart(event) {
    var _data = $("#shopping-cart").data();
    var _url = (null !== _data.urlMain) ? _data.urlMain : false;

    // musime najit informace o produktu!
    // tak nejak spatne spojene s item komponentou ... no, nekdy to snad vylepsim ;)
    if (event.parents('.product').length < 1) {
        alert('položka nebyla nalezena. omlouvame se za chybu. V pripade problemu kontaktujte prosim nasi firmu. Dekujeme');
    } else {
        var _product = event.parents('.product');
        var _id = _product.find('.product-detail').data().itemId;
        var _pocet = _product.find('input[name="baleni_pocet"]').val();
        var _cena = _product.find('.product-price .product-price-int-value').text().replace(',', '.').replace(/[^0-9\.]/g, '');
        var _data = {itemId: parseInt(_id), pocet: parseInt(_pocet), cena_s_dph: parseFloat(_cena)};

        if (_url && _pocet > 0) {
            var _this = event;

            $.nette.ajax({
                url: _url,
                data: _data,
                beforeSend: function () {
                    // START UPDATE
                    event.addClass('isActive');

                    $(".isActive").parents(".panel").block();
                },
                complete: function () {
                    $(".isActive").parents(".panel").unblock();

                    _msg = _this.parents(".panel").find(".cart-mini-update-message");
                    _msg.show();
                    _product.find('input[name="baleni_pocet"]').val(1);
                    setTimeout(function () {
                        _msg.hide();
                    }, 4000);

                    // END UPDATE
                    event.removeClass('isActive');
                }
            });
        }
    }
}