var trorerBanner=new Class({initialize:function(){this.els=[];this.wrapper=new Element("div",{id:"wrapper"}).injectInside(new Element("div",{id:"border"}).injectInside(document.body));this.panel=new Element("div",{id:"panel",styles:{top:420}}).injectInside(this.wrapper);this.panel.setHTML('<a target="_blank" href="http://www.rorer.ru/prices/?from=tblock#t-rorer">&#1044;&#1072;&#1090;&#1100; &#1086;&#1073;&#1098;&#1103;&#1074;&#1083;&#1077;&#1085;&#1080;&#1077;</a> &nbsp;|&nbsp; <span class="b_refresh">&#1044;&#1088;&#1091;&#1075;&#1072;&#1103; &#1088;&#1077;&#1082;&#1083;&#1072;&#1084;&#1072;</span> &nbsp;|&nbsp; <span class="b_close">&#1059;&#1073;&#1088;&#1072;&#1090;&#1100;</span>');this.panelShade=new Element("div",{id:"panelshade",styles:{display:"none"}}).injectInside(this.wrapper);this._poll_sent=false;var B=new Element("div",{id:"poll"}).injectInside(this.wrapper);B.setHTML('<div class="wrapper"><form action="http://polling.t-rorer.ru/accept_poll.html" id="poll_form" method="post" target="rorerBnForm"><input type="hidden" name="random" value="'+parseInt(Math.random()*65536)+'"><input type="hidden" name="poll_id" value="1"><input type="hidden" name="referer" value="'+rorerBnParams.referer+'"><input type="hidden" name="theme" value="'+rorerBnParams.theme+'"><input type="hidden" name="keywords" value="'+rorerBnParams.keywords+'"><input type="hidden" name="banners" value="'+rorerBnData[0].id+","+rorerBnData[1].id+","+rorerBnData[2].id+'"><h3>&#1050;&#1072;&#1082; &#1091;&nbsp;&#1074;&#1072;&#1089; &#1076;&#1077;&#1083;&#1072;?</h3><input type="radio" name="op3" id="poll_op31" value="1"> <label for="poll_op31">&#1042;&#1089;&#1105; &#1093;&#1086;&#1088;&#1086;&#1096;&#1086;</label><br><input type="radio" name="op3" id="poll_op32" value="2"> <label for="poll_op32">&#1042;&#1089;&#1105; &#1087;&#1083;&#1086;&#1093;&#1086;</label><br><h3>&#1053;&#1072; &#1101;&#1090;&#1086;&#1081; &#1089;&#1090;&#1088;&#1072;&#1085;&#1080;&#1094;&#1077; &#1084;&#1099; &#1087;&#1086;&#1082;&#1072;&#1079;&#1072;&#1083;&#1080; &#1088;&#1077;&#1082;&#1083;&#1072;&#1084;&#1091; &#1074; &#1090;&#1077;&#1084;&#1091;?</h3><input type="radio" name="op1" id="poll_op11" value="1"> <label for="poll_op11">&#1044;&#1072;, &#1074;&#1089;&#1105; &#1087;&#1088;&#1072;&#1074;&#1080;&#1083;&#1100;&#1085;&#1086;</label><br><input type="radio" name="op1" id="poll_op12" value="2"> <label for="poll_op12">&#1053;&#1077; &#1089;&#1086;&#1074;&#1089;&#1077;&#1084;</label><br><input type="radio" name="op1" id="poll_op13" value="3"> <label for="poll_op13">&#1053;&#1077;&#1090;</label><h3>&#1058;&#1072;&#1082;&#1086;&#1081; &#1092;&#1086;&#1088;&#1084;&#1072;&#1090; &#1088;&#1077;&#1082;&#1083;&#1072;&#1084;&#1099; &#1083;&#1091;&#1095;&#1096;&#1077;, &#1095;&#1077;&#1084; &#1086;&#1073;&#1099;&#1095;&#1085;&#1099;&#1077; &#1072;&#1085;&#1080;&#1084;&#1080;&#1088;&#1086;&#1074;&#1072;&#1085;&#1085;&#1099;&#1077; &#1073;&#1072;&#1085;&#1085;&#1077;&#1088;&#1099;?</h3><input type="radio" name="op2" id="poll_op21" value="1"> <label for="poll_op21">&#1050;&#1086;&#1085;&#1077;&#1095;&#1085;&#1086;, &#1083;&#1091;&#1095;&#1096;&#1077;</label><br><input type="radio" name="op2" id="poll_op22" value="2"> <label for="poll_op22">&#1053;&#1080;&#1095;&#1077;&#1084; &#1085;&#1077; &#1083;&#1091;&#1095;&#1096;&#1077;</label><input style="margin:10px 0 0 0;" type="submit" disabled value=" &#1071; &#1090;&#1072;&#1082; &#1089;&#1095;&#1080;&#1090;&#1072;&#1102; "></form><div id="poll_back"><span>&#1042;&#1077;&#1088;&#1085;&#1091;&#1090;&#1100;&#1089;&#1103;</span></div></div>');B.getElement("form").addEvent("submit",function(){new Element("iframe",{name:"rorerBnForm",styles:{position:"absolute",visibility:"hidden"}}).injectInside(this.wrapper);this._poll_sent=true;A.toTop()}.bind(this));$("poll_back").addEvent("click",function(){A.toTop()});$$("#poll_form input[type=radio]").each(function(D){D.addEvent("click",this.pollCheck)},this);var C=new Element("div",{id:"blank"}).injectInside(this.wrapper);var A=new Fx.Scroll(this.wrapper,{wait:false,duration:600,transition:Fx.Transitions.Quint.easeInOut});this.panel.getElement(".b_refresh").addEvent("click",function(){location.reload()});this.panel.getElement(".b_close").addEvent("click",function(){B.setStyle("display","none");C.setStyle("display","block");A.toElement(C)});rorerBnData.each(function(D){if(D){this.els.push(this.genBanner(D))}},this);this.render();this.images=new Asset.images([rorerBnData[0].pic,rorerBnData[1].pic,rorerBnData[2].pic,rorerBnData[0].piczoom,rorerBnData[1].piczoom,rorerBnData[2].piczoom],{onComplete:function(){this.zoomOn.delay(1,this)}.bind(this)})},pollCheck:function(){var A=0;$$("#poll_form input[type=radio]").each(function(B){if(B.checked){A++}});$("poll_form").getElement("input[type=submit]").disabled=(A<3)},showPanel:function(){var C=new Fx.Styles(this.panel,{fps:100,duration:500,transition:Fx.Transitions.Back.easeOut});var A=new Fx.Styles(this.panelShade,{fps:100,duration:500,transition:Fx.Transitions.Quint.easeInOut,onStart:function(){this.panelShade.setStyle("display","block")}.bind(this),onComplete:function(){this.panelShade.setStyle("display","none")}.bind(this)});var B=parseInt(Math.random()*4);if(B==1){this.panel.setStyles({top:401,left:10});C.start({top:[401,363]})}else{if(B==2){this.panel.setStyles({top:363,left:250});C.start({left:[250,10]})}else{if(B==3){this.panel.setStyles({top:363,left:10})}else{this.panel.setStyles({top:363,left:-240});C.start({left:[-240,10]})}}}A.start({opacity:[0.5,0]})},render:function(){this.setPos(this.els[0],[0,16,109,16]);this.setPos(this.els[1],[0,133,109,133]);this.setPos(this.els[2],[0,250,109,250]);this.panel.setStyles({top:362,left:10})},zoomOn:function(){var C=new Fx.Styles(this.els[0].pic,{fps:100,wait:false,duration:400,transition:Fx.Transitions.Quint.easeOut});var B=new Fx.Styles(this.els[1].pic,{fps:100,wait:false,duration:400,transition:Fx.Transitions.Quint.easeOut});var A=new Fx.Styles(this.els[2].pic,{fps:100,wait:false,duration:400,transition:Fx.Transitions.Quint.easeOut});this.els[0].pic.addEvent("mouseover",function(){if(this.els[0].pic.getStyle("width")!="100px"){return }this.els[0].pic.setStyle("z-index",10000);this.els[1].pic.setStyle("z-index",20);this.els[2].pic.setStyle("z-index",20);this.els[0].pic.src=this.images[3].src;C.start({top:6,left:10,width:200,height:200})}.bind(this));this.els[0].pic.addEvent("mouseout",function(){this.els[0].pic.src=this.images[0].src;C.start({top:16,left:0,width:100,height:100})}.bind(this));this.els[1].pic.addEvent("mouseover",function(){if(this.els[1].pic.getStyle("width")!="100px"){return }this.els[0].pic.setStyle("z-index",20);this.els[1].pic.setStyle("z-index",10000);this.els[2].pic.setStyle("z-index",20);this.els[1].pic.src=this.images[4].src;B.start({top:83,left:10,width:200,height:200})}.bind(this));this.els[1].pic.addEvent("mouseout",function(){this.els[1].pic.src=this.images[1].src;B.start({top:133,left:0,width:100,height:100})}.bind(this));this.els[2].pic.addEvent("mouseover",function(){if(this.els[2].pic.getStyle("width")!="100px"){return }this.els[0].pic.setStyle("z-index",20);this.els[1].pic.setStyle("z-index",20);this.els[2].pic.setStyle("z-index",10000);this.els[2].pic.src=this.images[5].src;A.start({top:160,left:10,width:200,height:200})}.bind(this));this.els[2].pic.addEvent("mouseout",function(){this.els[2].pic.src=this.images[2].src;A.start({top:250,left:0,width:100,height:100})}.bind(this))},setPos:function(A,B){A.pic.setStyles({left:B[0],top:B[1]});A.text.setStyles({left:B[2],top:B[3]})},genBanner:function(A){var B={};B.pic=new Element("img",{src:A.pic,"class":"picture",styles:{top:-200,left:-200}}).injectInside(new Element("a",{href:A.url,target:"_blank"}).injectInside(this.wrapper));B.text=new Element("div",{"class":"text",styles:{top:-200,left:-200}}).injectInside(this.wrapper);B.title=new Element("h2").setHTML('<a href="'+A.url+'" target="_blank">'+A.title+"</a>").injectInside(B.text);B.info=new Element("div",{"class":"info"}).setHTML('<a href="'+A.url+'" target="_blank">'+A.info+"</a>").injectInside(B.text);return B}});window.addEvent("load",function(){new trorerBanner()});