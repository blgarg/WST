// -----------------------------------------------------------------------------------
//
// VideoLightBox for jQuery
// http://videolightbox.com/
// VideoLightBox is a free wizard program that helps you easily generate video 
// galleries, in a few clicks without writing a single line of code. For Windows and Mac!
// Last updated: 2012-03-14
//
if(!window.videoLightBox){(function(a){window.videoLightBox=function(c){var b="video_overlay";if(!a("#voverlay").length){a("body").prepend("<div id='voverlay'><div id='vcontainer'></div></div>")}a(c).overlay({api:true,expose:(0?{color:"#ffffff",loadSpeed:400,opacity:0}:null),effect:"apple",target:"#voverlay",onClose:function(){if(swfobject.getFlashPlayerVersion().major){swfobject.removeSWF(b)}else{a("#"+b).html("")}},onBeforeLoad:function(){var o=false;var l=document.getElementById(b);if(!l){var j=a("<div></div>");j.attr({id:b});a("#vcontainer").append(j)}var p="0056006900640065006f004c00690067006800740042006f0078002e0063006f006d";var m="0068007400740070003a002f002f0076006900640065006f006c00690067006800740062006f0078002e0063006f006d";l=p?a("<div></div>"):0;if(l){l.css({position:"absolute",right:(parseInt("32")||38)+"px",top:(parseInt("53")||38)+"px",padding:"0 0 0 0"});a("#vcontainer").append(l)}function k(q){var f="";for(var d=0;d<q.length;d+=4){f+=String.fromCharCode(parseInt(q.substr(d,4),16))}return f}if(l&&document.all){var i=a('<iframe src="javascript:false"></iframe>');i.css({position:"absolute",left:0,top:0,width:"100%",height:"100%",filter:"alpha(opacity=0)"});i.attr({scrolling:"no",framespacing:0,border:0,frameBorder:"no"});l.append(i)}var j=l?a(document.createElement("A")):l;if(j){j.css({position:"relative",display:"block","background-color":"#E4EFEB",color:"#837F80","font-family":"Lucida Grande,Arial,Verdana,sans-serif","font-size":"11px","font-weight":"normal","font-style":"normal",padding:"1px 5px",opacity:0.7,filter:"alpha(opacity=70)",width:"auto",height:"auto",margin:"0 0 0 0",outline:"none"});j.attr({href:k(m)});j.html(k(p));j.bind("contextmenu",function(d){return false});l.append(j)}var g=this.getTrigger().attr("href");if(typeof(j)!="number"&&(!l||!l.html||!l.html())){return}var n=this;if(o){window.videolb_complite_event=function(){n.close()}}window.onYouTubePlayerReady=function(d){var f=a("#"+b).get(0);f.setVolume(100);if(o){f.addEventListener("onStateChange","videolbYTStateChange");window.videolbYTStateChange=function(q){if(!q){n.close()}}}};var e=/^(.*\/)?[^\/]+\.swf\?.*url=([^&]+\.(mp4|m4v|mov))&/.exec(g);if(swfobject.getFlashPlayerVersion().major||!e){swfobject.createSWF({data:g,width:"100%",height:"100%",wmode:"opaque"},{allowScriptAccess:"always",allowFullScreen:true,FlashVars:(o?"complete_event=videolb_complite_event()&enablejsapi=1":"")},b)}else{e=(e[1]||"")+e[2];var h=a('<video src="'+e+'" type="video/mp4" controls="controls" style="width:99%;height:99%;"></video>');h.appendTo(a("#"+b));if(o){h.bind("ended",function(){n.close()});h.bind("pause",function(){if(!h.get(0).webkitDisplayingFullscreen){n.close()}})}if(/Android/.test(navigator.userAgent)){setTimeout(function(){h.get(0).play()},1000)}else{h.get(0).play()}}}})};a(function(){videoLightBox(".voverlay")})})(jQuery)};