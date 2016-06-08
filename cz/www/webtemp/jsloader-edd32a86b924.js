
/*! http://responsiveslides.com v1.54 by @viljamis */
(function(c,I,B){c.fn.responsiveSlides=function(l){var a=c.extend({auto:!0,speed:500,timeout:4E3,pager:!1,nav:!1,random:!1,pause:!1,pauseControls:!0,prevText:"Previous",nextText:"Next",maxwidth:"",navContainer:"",manualControls:"",namespace:"rslides",before:c.noop,after:c.noop},l);return this.each(function(){B++;var f=c(this),s,r,t,m,p,q,n=0,e=f.children(),C=e.size(),h=parseFloat(a.speed),D=parseFloat(a.timeout),u=parseFloat(a.maxwidth),g=a.namespace,d=g+B,E=g+"_nav "+d+"_nav",v=g+"_here",j=d+"_on",
w=d+"_s",k=c("<ul class='"+g+"_tabs "+d+"_tabs' />"),x={"float":"left",position:"relative",opacity:1,zIndex:2},y={"float":"none",position:"absolute",opacity:0,zIndex:1},F=function(){var b=(document.body||document.documentElement).style,a="transition";if("string"===typeof b[a])return!0;s=["Moz","Webkit","Khtml","O","ms"];var a=a.charAt(0).toUpperCase()+a.substr(1),c;for(c=0;c<s.length;c++)if("string"===typeof b[s[c]+a])return!0;return!1}(),z=function(b){a.before(b);F?(e.removeClass(j).css(y).eq(b).addClass(j).css(x),
n=b,setTimeout(function(){a.after(b)},h)):e.stop().fadeOut(h,function(){c(this).removeClass(j).css(y).css("opacity",1)}).eq(b).fadeIn(h,function(){c(this).addClass(j).css(x);a.after(b);n=b})};a.random&&(e.sort(function(){return Math.round(Math.random())-0.5}),f.empty().append(e));e.each(function(a){this.id=w+a});f.addClass(g+" "+d);l&&l.maxwidth&&f.css("max-width",u);e.hide().css(y).eq(0).addClass(j).css(x).show();F&&e.show().css({"-webkit-transition":"opacity "+h+"ms ease-in-out","-moz-transition":"opacity "+
h+"ms ease-in-out","-o-transition":"opacity "+h+"ms ease-in-out",transition:"opacity "+h+"ms ease-in-out"});if(1<e.size()){if(D<h+100)return;if(a.pager&&!a.manualControls){var A=[];e.each(function(a){a+=1;A+="<li><a href='#' class='"+w+a+"'>"+a+"</a></li>"});k.append(A);l.navContainer?c(a.navContainer).append(k):f.after(k)}a.manualControls&&(k=c(a.manualControls),k.addClass(g+"_tabs "+d+"_tabs"));(a.pager||a.manualControls)&&k.find("li").each(function(a){c(this).addClass(w+(a+1))});if(a.pager||a.manualControls)q=
k.find("a"),r=function(a){q.closest("li").removeClass(v).eq(a).addClass(v)};a.auto&&(t=function(){p=setInterval(function(){e.stop(!0,!0);var b=n+1<C?n+1:0;(a.pager||a.manualControls)&&r(b);z(b)},D)},t());m=function(){a.auto&&(clearInterval(p),t())};a.pause&&f.hover(function(){clearInterval(p)},function(){m()});if(a.pager||a.manualControls)q.bind("click",function(b){b.preventDefault();a.pauseControls||m();b=q.index(this);n===b||c("."+j).queue("fx").length||(r(b),z(b))}).eq(0).closest("li").addClass(v),
a.pauseControls&&q.hover(function(){clearInterval(p)},function(){m()});if(a.nav){g="<a href='#' class='"+E+" prev'>"+a.prevText+"</a><a href='#' class='"+E+" next'>"+a.nextText+"</a>";l.navContainer?c(a.navContainer).append(g):f.after(g);var d=c("."+d+"_nav"),G=d.filter(".prev");d.bind("click",function(b){b.preventDefault();b=c("."+j);if(!b.queue("fx").length){var d=e.index(b);b=d-1;d=d+1<C?n+1:0;z(c(this)[0]===G[0]?b:d);if(a.pager||a.manualControls)r(c(this)[0]===G[0]?b:d);a.pauseControls||m()}});
a.pauseControls&&d.hover(function(){clearInterval(p)},function(){m()})}}if("undefined"===typeof document.body.style.maxWidth&&l.maxwidth){var H=function(){f.css("width","100%");f.width()>u&&f.css("width",u)};H();c(I).bind("resize",function(){H()})}})}})(jQuery,this,0);

eval(function(p,a,c,k,e,d){e=function(c){return c};if(!''.replace(/^/,String)){while(c--){d[c]=k[c]||c}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('$(1(){$(".0").2({3:5,4:6})});',7,7,'rslides|function|responsiveSlides|pause|speed|true|800'.split('|'),0,{}))

!function($){"use strict";var BootstrapPaginator=function(element,options){this.init(element,options)},old=null;BootstrapPaginator.prototype={init:function(element,options){this.$element=$(element);var version=options&&options.bootstrapMajorVersion?options.bootstrapMajorVersion:$.fn.bootstrapPaginator.defaults.bootstrapMajorVersion,id=this.$element.attr("id");if(2===version&&!this.$element.is("div"))throw"in Bootstrap version 2 the pagination must be a div element. Or if you are using Bootstrap pagination 3. Please specify it in bootstrapMajorVersion in the option";if(version>2&&!this.$element.is("ul"))throw"in Bootstrap version 3 the pagination root item must be an ul element.";this.currentPage=1,this.lastPage=1,this.setOptions(options),this.initialized=!0},setOptions:function(options){this.options=$.extend({},this.options||$.fn.bootstrapPaginator.defaults,options),this.totalPages=parseInt(this.options.totalPages,10),this.numberOfPages=parseInt(this.options.numberOfPages,10),options&&"undefined"!=typeof options.currentPage&&this.setCurrentPage(options.currentPage),this.listen(),this.render(),this.initialized||this.lastPage===this.currentPage||this.$element.trigger("page-changed",[this.lastPage,this.currentPage])},listen:function(){this.$element.off("page-clicked"),this.$element.off("page-changed"),"function"==typeof this.options.onPageClicked&&this.$element.bind("page-clicked",this.options.onPageClicked),"function"==typeof this.options.onPageChanged&&this.$element.on("page-changed",this.options.onPageChanged),this.$element.bind("page-clicked",this.onPageClicked)},destroy:function(){this.$element.off("page-clicked"),this.$element.off("page-changed"),this.$element.removeData("bootstrapPaginator"),this.$element.empty()},show:function(page){this.setCurrentPage(page),this.render(),this.lastPage!==this.currentPage&&this.$element.trigger("page-changed",[this.lastPage,this.currentPage])},showNext:function(){var pages=this.getPages();pages.next&&this.show(pages.next)},showPrevious:function(){var pages=this.getPages();pages.prev&&this.show(pages.prev)},showFirst:function(){var pages=this.getPages();pages.first&&this.show(pages.first)},showLast:function(){var pages=this.getPages();pages.last&&this.show(pages.last)},onPageItemClicked:function(event){var type=event.data.type,page=event.data.page;this.$element.trigger("page-clicked",[event,type,page])},onPageClicked:function(event,originalEvent,type,page){var currentTarget=$(event.currentTarget);switch(type){case"first":currentTarget.bootstrapPaginator("showFirst");break;case"prev":currentTarget.bootstrapPaginator("showPrevious");break;case"next":currentTarget.bootstrapPaginator("showNext");break;case"last":currentTarget.bootstrapPaginator("showLast");break;case"page":currentTarget.bootstrapPaginator("show",page)}},render:function(){var containerClass=this.getValueFromOption(this.options.containerClass,this.$element),size=this.options.size||"normal",alignment=this.options.alignment||"left",pages=this.getPages(),listContainer=2===this.options.bootstrapMajorVersion?$("<ul></ul>"):this.$element,listContainerClass=2===this.options.bootstrapMajorVersion?this.getValueFromOption(this.options.listContainerClass,listContainer):null,first=null,prev=null,next=null,last=null,p=null,i=0;switch(this.$element.prop("class",""),this.$element.addClass("pagination"),size.toLowerCase()){case"large":case"small":case"mini":this.$element.addClass($.fn.bootstrapPaginator.sizeArray[this.options.bootstrapMajorVersion][size.toLowerCase()])}if(2===this.options.bootstrapMajorVersion)switch(alignment.toLowerCase()){case"center":this.$element.addClass("pagination-centered");break;case"right":this.$element.addClass("pagination-right")}for(this.$element.addClass(containerClass),this.$element.empty(),2===this.options.bootstrapMajorVersion&&(this.$element.append(listContainer),listContainer.addClass(listContainerClass)),this.pageRef=[],pages.first&&(first=this.buildPageItem("first",pages.first),first&&listContainer.append(first)),pages.prev&&(prev=this.buildPageItem("prev",pages.prev),prev&&listContainer.append(prev)),i=0;i<pages.length;i+=1)p=this.buildPageItem("page",pages[i]),p&&listContainer.append(p);pages.next&&(next=this.buildPageItem("next",pages.next),next&&listContainer.append(next)),pages.last&&(last=this.buildPageItem("last",pages.last),last&&listContainer.append(last))},buildPageItem:function(type,page){var itemContainer=$("<li></li>"),itemContent=$("<a></a>"),text="",title="",itemContainerClass=this.options.itemContainerClass(type,page,this.currentPage),itemContentClass=this.getValueFromOption(this.options.itemContentClass,type,page,this.currentPage),tooltipOpts=null;switch(type){case"first":if(!this.getValueFromOption(this.options.shouldShowPage,type,page,this.currentPage))return;text=this.options.itemTexts(type,page,this.currentPage),title=this.options.tooltipTitles(type,page,this.currentPage);break;case"last":if(!this.getValueFromOption(this.options.shouldShowPage,type,page,this.currentPage))return;text=this.options.itemTexts(type,page,this.currentPage),title=this.options.tooltipTitles(type,page,this.currentPage);break;case"prev":if(!this.getValueFromOption(this.options.shouldShowPage,type,page,this.currentPage))return;text=this.options.itemTexts(type,page,this.currentPage),title=this.options.tooltipTitles(type,page,this.currentPage);break;case"next":if(!this.getValueFromOption(this.options.shouldShowPage,type,page,this.currentPage))return;text=this.options.itemTexts(type,page,this.currentPage),title=this.options.tooltipTitles(type,page,this.currentPage);break;case"page":if(!this.getValueFromOption(this.options.shouldShowPage,type,page,this.currentPage))return;text=this.options.itemTexts(type,page,this.currentPage),title=this.options.tooltipTitles(type,page,this.currentPage)}return itemContainer.addClass(itemContainerClass).append(itemContent),itemContent.addClass(itemContentClass).html(text).on("click",null,{type:type,page:page},$.proxy(this.onPageItemClicked,this)),this.options.pageUrl&&itemContent.attr("href",this.getValueFromOption(this.options.pageUrl,type,page,this.currentPage)),this.options.useBootstrapTooltip?(tooltipOpts=$.extend({},this.options.bootstrapTooltipOptions,{title:title}),itemContent.tooltip(tooltipOpts)):itemContent.attr("title",title),itemContainer},setCurrentPage:function(page){if(page>this.totalPages||1>page)throw"Page out of range";this.lastPage=this.currentPage,this.currentPage=parseInt(page,10)},getPages:function(){var totalPages=this.totalPages,pageStart=0===this.currentPage%this.numberOfPages?(parseInt(this.currentPage/this.numberOfPages,10)-1)*this.numberOfPages+1:parseInt(this.currentPage/this.numberOfPages,10)*this.numberOfPages+1,output=[],i=0,counter=0;for(pageStart=1>pageStart?1:pageStart,i=pageStart,counter=0;counter<this.numberOfPages&&totalPages>=i;i+=1,counter+=1)output.push(i);return output.first=1,output.prev=this.currentPage>1?this.currentPage-1:1,output.next=this.currentPage<totalPages?this.currentPage+1:totalPages,output.last=totalPages,output.current=this.currentPage,output.total=totalPages,output.numberOfPages=this.options.numberOfPages,output},getValueFromOption:function(value){var output=null,args=Array.prototype.slice.call(arguments,1);return output="function"==typeof value?value.apply(this,args):value}},old=$.fn.bootstrapPaginator,$.fn.bootstrapPaginator=function(option){var args=arguments,result=null;return $(this).each(function(index,item){var $this=$(item),data=$this.data("bootstrapPaginator"),options="object"!=typeof option?null:option;if(!data)return data=new BootstrapPaginator(this,options),$this=$(data.$element),$this.data("bootstrapPaginator",data),void 0;if("string"==typeof option){if(!data[option])throw"Method "+option+" does not exist";result=data[option].apply(data,Array.prototype.slice.call(args,1))}else result=data.setOptions(option)}),result},$.fn.bootstrapPaginator.sizeArray={2:{large:"pagination-large",small:"pagination-small",mini:"pagination-mini"},3:{large:"pagination-lg",small:"pagination-sm",mini:""}},$.fn.bootstrapPaginator.defaults={containerClass:"",size:"normal",alignment:"left",bootstrapMajorVersion:2,listContainerClass:"",itemContainerClass:function(type,page,current){return page===current?"active":""},itemContentClass:function(type,page,current){return""},currentPage:1,numberOfPages:5,totalPages:1,pageUrl:function(type,page,current){return null},onPageClicked:null,onPageChanged:null,useBootstrapTooltip:!1,shouldShowPage:function(type,page,current){var result=!0;switch(type){case"first":result=1!==current;break;case"prev":result=1!==current;break;case"next":result=current!==this.totalPages;break;case"last":result=current!==this.totalPages;break;case"page":result=!0}return result},itemTexts:function(type,page,current){switch(type){case"first":return"&lt;&lt;";case"prev":return"&lt;";case"next":return"&gt;";case"last":return"&gt;&gt;";case"page":return page}},tooltipTitles:function(type,page,current){switch(type){case"first":return"Go to first page";case"prev":return"Go to previous page";case"next":return"Go to next page";case"last":return"Go to last page";case"page":return page===current?"Current page is "+page:"Go to page "+page}},bootstrapTooltipOptions:{animation:!0,html:!0,placement:"top",selector:!1,title:"",container:!1}},$.fn.bootstrapPaginator.Constructor=BootstrapPaginator}(window.jQuery);
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(b($,X){$.G.17({O:b(){$(\'[1-3]\').D(b(k){h 0=N;k.P();k.S();$("<5 7=\'c\' 2=\'4 R\'></5>").M(\'z\');$(\'#c\').6("<5 7=\'x\' 2=\'4-T\'></5>");$(\'#x\').6("<5 7=\'y\' 2=\'4-H\'></5>");$(\'#y\').6("<5 7=\'l\' 2=\'4-j\'></5><5 7=\'s\' 2=\'4-z\'></5><5 7=\'B\' 2=\'4-J\'></5>");$(\'#l\').6("<a 2=\'u v v-u\' 1-n=\'4\' 14-F=\'U\'></a><q 2=\'4-r\' 7=\'o\'></q>");$(\'#o\').6($(0).1(\'3-r\'));$(\'#s\').6("<p>"+$(0).1(\'3-8\')+"</p>");9($(0).1(\'3-e-8\')||$(0).1(\'3-d-8\')){$(\'#B\').6("<a 7=\'f\' 2=\'t "+$(0).1(\'3-e-2\')+"\' 1-n=\'4\'>12</a><a 7=\'C\' 2=\'t "+$(0).1(\'3-d-2\')+"\' 1-n=\'4\'>V</a>")}9($(0).1(\'3-j-2\')){$(\'#l\').10($(0).1(\'3-j-2\'))}9($(0).1(\'3-e-8\')){$(\'#f\').6($(0).1(\'3-e-8\'))}9($(0).1(\'3-d-8\')){$(\'#C\').6($(0).1(\'3-d-8\'))}$(\'#f\').i(\'D\',b(){h g=$(0).L("g");9(g==\'K\'){h m=$(0).18(\'m\');m.Q()}w{9($(0).1(\'A\')==\'i\'){$.G.A({Y:0.E})}w{W.19=0.E}}});$(\'#c\').i(\'F.15.4\',b(){$(\'#c\').16()});$(\'#c\').4(\'13\');11 I})}})})(Z);',62,72,'obj|data|class|confirm|modal|div|html|id|text|if||function|dConfirm|cancel|ok|dConfirmOk|tagName|var|on|header|event|dConfirmHeader|form|dismiss|dConfirmTitle||h4|title|dConfirmBody|btn|close|fa|else|dConfirmDialog|dConfirmContent|body|ajax|dConfirmFooter|dConfirmCancel|click|href|hidden|nette|content|false|footer|INPUT|prop|appendTo|this|load|preventDefault|submit|fade|stopImmediatePropagation|dialog|true|Ne|document|undefined|url|jQuery|addClass|return|Ano|show|aria|bs|remove|ext|closest|location'.split('|'),0,{}))

eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('$(2(){q();$("#c-1i").z(2(){$(m).1j().A().1h(\'1g\')});$("#c-g").d(\'1d[T="s-1e"]\').1f(2(){$("#c-g #c-g-u").1k()});$("#c-g-u-1l").z(2(){$("#c-g #c-g-u").1m()});$(".N-M").G(\'C\',2(){6 l=$(m);6 4=l.I();9(4){$.1n.1c({4:4,1b:2(){l.p(".E").10()},11:2(){l.p(".E").W();q()}})}});$(\'#Y\').G(\'C\',2(){6 4=$(m).I();9(4){n.J=4}8 t});$b=$("#o-r").19();9(1a!==$b&&$b.v>0){6 B={18:3,17:$b.H,15:$b.v,16:2(7,5,j){9(5===j&&7===\'5\'){8"F"}h{9((7===\'1t\'||7===\'1J\')&&j===1){8\'x\'}h 9((7===\'1O\'||7===\'A\')&&j===$b.v){8\'x\'}h{8\'1N\'}}},1L:2(7,5,j){1S(7){1X:8 1W}},1V:2(e,1T,7,5){6 4=$b.1M.1K(\'5=\'+$b.H,\'5=\'+5);6 D=$("#o-r").d(\'1y.F > a\');9(D.f()===5.1v()){8 t}h 9(4){n.J=4}h{8 t}}};$(\'#o-r\').1D(B)}});2 q(){1s{$(\'a.y\').Q({1E:\'y\',w:1H,1w:2(){6 i=$(m).p(\'.k\');6 V=i.d(\'.k-14\').12(\'S\');6 w=\'<a S="\'+V+\'" L="1R" O="f-1x: 1F;">\'+i.d(\'.k-T\').f()+\' (\'+i.d(\'.N-M 1G:1I\').f()+\')\'+\', <K L="1C">\'+i.d(\'.k-1B\').f()+\'</K>\'+\'</a>\';1u("<R O=\'f-1A: 1z; 1U: P U P U; 1P: #1Q;\'>"+w+"</R>").13("#X .Z");$.Q.1o()}})}1p(e){n.1r.1q(e)}}',62,122,'||function||url|page|var|type|return|if||_data|form|find||text|search|else|_product|current|product|_this|this|window|items|parents|_init_colorbox|pagination||false|expanded|paginationTotalpage|title|disabled|photo|click|next|bp_options|change|clicked|panel|active|on|paginationPage|val|location|span|class|switcher|baleni|style|3px|colorbox|div|href|name|10px|_detail_href|unblock|cboxLoadedContent|itemPageRows|cboxPhoto|block|complete|attr|insertAfter|detail|totalPages|itemContainerClass|currentPage|bootstrapMajorVersion|data|undefined|beforeSend|ajax|input|nazev|focusin|hidden|removeClass|question|parent|show|close|hide|nette|resize|catch|log|console|try|first|jQuery|toString|onComplete|decoration|li|center|align|price|small|bootstrapPaginator|rel|underline|option|null|selected|prev|replace|shouldShowPage|paginationUrl|pointer|last|color|949494|_cboxDetialHref|switch|originalEvent|padding|onPageClicked|true|default'.split('|'),0,{}))

eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('$(5(){m($(".15-18").E>0){2 w=$(".1a-1c").8(".19").1d(1);2 Y=w.8(".k-i-3");2 W=w.8(".k-i-7");Y.17("1s","1e");W.12("k-i-7").U("k-i-10")}$(\'.h-G-C\').L(5(){y($(o))});$(\'.h-G-C\').a(\'1f\').1h(\'1i\',5(){y($(o));s O});v($("l[n=\'M\']").1k(5(){s $(o).1n(\':1j\')}));$("l[n=\'M\']").L(5(){v($(o))})});5 v(6){m(6.E<=0)s;A.1g(1l.1m);2 D=d($("#D").b().4(\',\',\'.\').4(/[^0-9\\.]/g,\'\'));2 I=d($("#I").b().4(\',\',\'.\').4(/[^0-9\\.]/g,\'\'));2 N=6.1r().b().4(\'1q,\',\'#\').4(\', 1p\',\'#\');2 F=0;2 p=0;2 t=N.1o("#");p=d(t.Q().4(\',\',\'.\').4(/[^0-9\\.]/g,\'\'));F=d(t.Q().4(\',\',\'.\').4(/[^0-9\\.]/g,\'\'));2 B=(I+F).J().4(\'.\',\',\');2 x=16.1b((D+p)).J().4(\'.\',\',\');$("#B").b(A(B).R(\'0,0 $\'));$("#x").b(A(x).R(\'0,0 $\'))}5 y(6){2 f=$("#1B-h").q();2 r=(1T!==f.P)?f.P:O;m(6.a(\'.c\').E<1){1U(\'1Vž1S 1R 1N. 1O 1P 1Q 1t. V 1X 22 1Z 1Y 20 21. 1W\')}1L{2 e=6.a(\'.c\');2 13=e.8(\'.c-1z\').q().14;2 u=e.8(\'l[n="T"]\').11();2 Z=e.8(\'.c-K .c-K-1A-1M\').b().4(\',\',\'.\').4(/[^0-9\\.]/g,\'\');2 f={14:S(13),1y:S(u),1x:d(Z)};m(r&&u>0){2 X=6;$.1u.1v({1w:r,q:f,1C:5(){6.U(\'j\');$(".j").a(".H").1D()},1J:5(){$(".j").a(".H").1K();z=X.a(".H").8(".h-G-C-1I");z.1H();e.8(\'l[n="T"]\').11(1);1E(5(){z.1F()},1G);6.12(\'j\')}})}}}',62,127,'||var||replace|function|event||find||parents|text|product|parseFloat|_product|_data||cart|sm|isActive|col|input|if|name|this|_c_s_dph|data|_url|return|cena_doprava_input__arr|_pocet|updateCenaCelkemSdopravou|_row|cena_celkem_doprava_s_dph|updateCart|_msg|numeral|cena_celkem_doprava_bez_dph|update|cena_celkem_s_dph|length|_c_bez_dph|mini|panel|cena_celkem_bez_dph|toString|price|click|doprava_id|cena_doprava_input|false|urlMain|pop|format|parseInt|baleni_pocet|addClass||_col_sm_7|_this|_col_sm_3|_cena||val|removeClass|_id|itemId|obsah|Math|css|kosiku|row|container|ceil|front|eq|none|form|language|on|submit|checked|filter|RKW|lang|is|split|cena|DPH|parent|display|chybu|nette|ajax|url|cena_s_dph|pocet|detail|int|shopping|beforeSend|block|setTimeout|hide|4000|show|message|complete|unblock|else|value|nalezena|omlouvame|se|za|nebyla|ka|null|alert|polo|Dekujeme|pripade|prosim|kontaktujte|nasi|firmu|problemu'.split('|'),0,{}))
