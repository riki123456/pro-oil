tinymce.PluginManager.add("layer",function(a){function b(a){do if(a.className&&-1!=a.className.indexOf("mceItemLayer"))return a;while(a=a.parentNode)}function c(b){var c=a.dom;tinymce.each(c.select("div,p",b),function(a){/^(absolute|relative|fixed)$/i.test(a.style.position)&&(a.hasVisual?c.addClass(a,"mceItemVisualAid"):c.removeClass(a,"mceItemVisualAid"),c.addClass(a,"mceItemLayer"))})}function d(c){var d,e,f=[],g=b(a.selection.getNode()),h=-1,i=-1;for(e=[],tinymce.walk(a.getBody(),function(a){1==a.nodeType&&/^(absolute|relative|static)$/i.test(a.style.position)&&e.push(a)},"childNodes"),d=0;d<e.length;d++)f[d]=e[d].style.zIndex?parseInt(e[d].style.zIndex,10):0,0>h&&e[d]==g&&(h=d);if(0>c){for(d=0;d<f.length;d++)if(f[d]<f[h]){i=d;break}i>-1?(e[h].style.zIndex=f[i],e[i].style.zIndex=f[h]):f[h]>0&&(e[h].style.zIndex=f[h]-1)}else{for(d=0;d<f.length;d++)if(f[d]>f[h]){i=d;break}i>-1?(e[h].style.zIndex=f[i],e[i].style.zIndex=f[h]):e[h].style.zIndex=f[h]+1}a.execCommand("mceRepaint")}function e(){var b=a.dom,c=b.getPos(b.getParent(a.selection.getNode(),"*")),d=a.getBody();a.dom.add(d,"div",{style:{position:"absolute",left:c.x,top:c.y>20?c.y:20,width:100,height:100},"class":"mceItemVisualAid mceItemLayer"},a.selection.getContent()||a.getLang("layer.content")),tinymce.Env.ie&&b.setHTML(d,d.innerHTML)}function f(){var c=b(a.selection.getNode());c||(c=a.dom.getParent(a.selection.getNode(),"DIV,P,IMG")),c&&("absolute"==c.style.position.toLowerCase()?(a.dom.setStyles(c,{position:"",left:"",top:"",width:"",height:""}),a.dom.removeClass(c,"mceItemVisualAid"),a.dom.removeClass(c,"mceItemLayer")):(c.style.left||(c.style.left="20px"),c.style.top||(c.style.top="20px"),c.style.width||(c.style.width=c.width?c.width+"px":"100px"),c.style.height||(c.style.height=c.height?c.height+"px":"100px"),c.style.position="absolute",a.dom.setAttrib(c,"data-mce-style",""),a.addVisual(a.getBody())),a.execCommand("mceRepaint"),a.nodeChanged())}a.addCommand("mceInsertLayer",e),a.addCommand("mceMoveForward",function(){d(1)}),a.addCommand("mceMoveBackward",function(){d(-1)}),a.addCommand("mceMakeAbsolute",function(){f()}),a.addButton("moveforward",{title:"layer.forward_desc",cmd:"mceMoveForward"}),a.addButton("movebackward",{title:"layer.backward_desc",cmd:"mceMoveBackward"}),a.addButton("absolute",{title:"layer.absolute_desc",cmd:"mceMakeAbsolute"}),a.addButton("insertlayer",{title:"layer.insertlayer_desc",cmd:"mceInsertLayer"}),a.on("init",function(){tinymce.Env.ie&&a.getDoc().execCommand("2D-Position",!1,!0)}),a.on("mouseup",function(c){var d=b(c.target);d&&a.dom.setAttrib(d,"data-mce-style","")}),a.on("mousedown",function(c){var d,e=c.target,f=a.getDoc();tinymce.Env.gecko&&(b(e)?"on"!==f.designMode&&(f.designMode="on",e=f.body,d=e.parentNode,d.removeChild(e),d.appendChild(e)):"on"==f.designMode&&(f.designMode="off"))}),a.on("NodeChange",c)});