//<![CDATA[
var classid = "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000";
var codebase = "http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0";
var pluginspage = "http://www.macromedia.com/go/getflashplayer";


var isIE  = (navigator.appVersion.indexOf("MSIE") != -1) ? true : false;
var isWin = (navigator.appVersion.toLowerCase().indexOf("win") != -1) ? true : false;
var isOpera = (navigator.userAgent.indexOf("Opera") != -1) ? true : false;

function runSWFsp(src,width,height,nameid){
    runSWF(src,width,height,nameid,nameid,'','','');
}

function runSWF(src,width,height,name,id,align,bgcolor,flashvars){
  var htmlStr = '';
    if (isIE && isWin && !isOpera){
      htmlStr += '<object classid="' + classid + '" codebase="' + codebase + '" id="' + id + '" name="' + name + '"';
      htmlStr += ' hspace="0" vspace="0"';
      htmlStr += (width != '') ? ' width="' + width + '"' : '';
      htmlStr += (height != '') ? ' height="' + height + '"' : '';
      htmlStr += (align != '') ? ' align="' + align + '"' : '';
      htmlStr += ">";
      htmlStr += '<param name="allowScriptAccess" value="sameDomain" />';
      htmlStr += '<param name="allowFullScreen" value="false" />';
      htmlStr += '<param name="scale" value="noborder" />';
      htmlStr += '<param name="movie" value="' + src + '" />';
      htmlStr += '<param name="menu" value="false" />';
      htmlStr += (bgcolor != '')?'<param name="bgcolor" value="' + bgcolor + '" />':'<param name="wmode" value="transparent" />';
      htmlStr += (flashvars != '')?'<param name="flashvars" value="' + flashvars + '" />':'';
      htmlStr += '</object>';
    }else{
      htmlStr += '<embed src="' + src + '" menu="false" quality="high" scale="noborder"';  
      htmlStr += (bgcolor != '')?' bgcolor="' + bgcolor + '"':' wmode="transparent"';
      htmlStr += (width != '') ? ' width="' + width + '"' : '';
      htmlStr += (height != '') ? ' height="' + height + '"' : '';
      htmlStr += (align != '') ? ' align="' + align + '"' : '';
      htmlStr += '" id="' + id + '" name="' + name + '"';
      htmlStr += ' allowScriptAccess="sameDomain" allowFullScreen="false"';
      htmlStr += ' type="application/x-shockwave-flash" pluginspage="' + pluginspage + '" />';
    }
  document.write(htmlStr);
}
//]]>