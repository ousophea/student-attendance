(function(d){d.widget("AW.expando",{initialMargin:false,initialHeight:false,isExpanded:false,_init:function c(){this.validate();this.initialMargin=parseInt(this.element.css("margin-top"));this.initialHeight=parseInt(this.options.mirror.height());var j=this,h=this.options.opener,g=this.options.event,i=this.options.closer||this.element.find(".close");d(h).bind(g,function(){j.expand();return false});d(i).bind(g,function(){j.close();return false})},expand:function b(){this.toggleMirror(true,250);this.element.show();this.element.css({overflow:"auto"});var l=this,k=this.options.mirror,g=this.options.height,j=this.cachedMargin||parseInt(this.element.css("margin-top")),h=j-(g/2),i={marginTop:h,height:g};this.cachedMargin=j;this.element.animate(i,700,"easeInOutQuart",function(){l.options.content.fadeIn(500)});this.isExpanded=true},toggleMirror:function a(j,i){var k=this.options.mirror,i=i||0,g=j?this.options.height:this.initialHeight,h={height:g};setTimeout(function(){k.animate(h,400)},i)},close:function f(){var i=this,h=this.initialMargin+(this.options.height/2),g={"margin-top":h,height:0};this.options.content.fadeOut(350,function(){i.toggleMirror(false);i.element.animate(g,{queue:false},1000,"easeInOutQuart")});this.isExpanded=false},validate:function e(){if(typeof this.options.opener=="undefined"||typeof this.options.height=="undefined"||typeof this.options.mirror=="undefined"){throw new Error("OptionsError: Required options are: ['"+["opener","height","mirror"].join("', '")+"'].")}}});d.extend(d.AW.expando.prototype,{version:"0.0.1",options:{event:"click"}})})(jQuery);if(typeof AW.Pages.Features=="undefined"){AW.Pages.Features={}}AW.Pages.Features.index={load:function load(){var a=this;this.header=$("div.features-header");this.watchDemo=$("div.demo-button");this.video=$("div.full-video");this.content=this.video.find("div.container");this.video.expando({height:570,opener:this.watchDemo,mirror:this.header,content:this.content});this.content.hide();this.video.css({height:0,marginTop:215,overflow:"hidden"})}};AW.Pages.ContactUs={};AW.Pages.ContactUs.index={load:function load(){var e=this;this.values={"WTKT: Technical Question":"showTech","WTKT: Billing Question":"showBilling","WTKT: Cancellation - Include Login & Password":"showCancel","CTKT: Technical Question":"showTech","CTKT: Billing Question":"showBilling","CTKT: Cancellation - Include Login & Password":"showCancel"};this.types={"Getting Started":"showStart",Messages:"showMessages","Web Form":"showWebforms",Other:"hideTechMeta"};this.about=$("#about");this.meta=$("#inquiry-meta");this.hold=this.meta.find("#hold-package");this.tech=this.meta.find("#technical-meta");this.type=this.tech.find("#question-type");this.start=this.meta.find("#getting-started-meta");this.messages=this.meta.find("#messages-meta");this.webform=this.meta.find("#web-form-meta");this.billing=this.meta.find("#billing-meta");this.cancel=this.meta.find("#cancellation-meta");this.about.bind("change",function(n){if(typeof e[e.values[this.value]]=="function"){e[e.values[this.value]].call(e);if(e.values[this.value]=="showCancel"){e.cancelQuestion()}else{e.normalQuestion()}}else{e.hideAll();e.normalQuestion()}});this.type.bind("change",function(n){if(typeof e[e.types[this.value]]=="function"){e[e.types[this.value]].call(e)}else{e.hideTechMeta()}});this.hideNonTech=function i(){this.hold.hide();this.billing.hide();this.cancel.hide()};this.hideTech=function b(){this.tech.hide();this.hideTechMeta()};this.hideTechMeta=function f(){this.start.hide();this.messages.hide();this.webform.hide()};this.hideAll=function d(){this.hideNonTech();this.hideTech()};this.showTech=function c(){this.hideAll();this.tech.show()};this.showBilling=function l(){this.hideAll();this.billing.show()};this.showCancel=function a(){this.hideAll();this.hold.show();this.cancel.show()};this.cancelQuestion=function j(){$("#question-label").html("Would you mind telling us why you're canceling?")};this.normalQuestion=function j(){$("#question-label").text("Question/Comment/Feedback:")};this.showStart=function h(){this.hideTechMeta();this.start.show()};this.showMessages=function k(){this.hideTechMeta();this.messages.show()};this.showWebforms=function m(){this.hideTechMeta();this.webform.show()};this.hideAll();if(typeof window.filterId!="undefined"&&window.filterId){$("#about").val("WTKT: Other");var g="Please reference: filterId "+filterId+"\n\n";$("#question").val(g)}}};if(typeof AW.Pages.Public=="undefined"){AW.Pages.Public={}}AW.Pages.Public.index={load:function load(){this.cycler=$("div.cycle-fader");this.cycler.cycle({timeout:8000,prev:"#slide-left",next:"#slide-right"})}};if(typeof AW.Pages.Public=="undefined"){AW.Pages.Public={}}AW.Pages.Public.pricing={load:function load(){$("#show-advanced-pricing").click(function(){$("#pricing-advanced").slideToggle("slow");return false})}};