//$Id: fbox_switch.js 669 2007-11-15 17:07:13Z secretr $
function fboxCheckeAjax(loadL) {
    /* <![CDATA[ */
	if(typeof sendInfo == 'undefined') {
		document.write('<script type="text/javascript" src="'+loadL+'"></script>');
	}
	/* ]]> */
}

function fboxPrepare(contid, ltext, activeObj, imgsrc) { 
	
    var contobj = document.getElementById(contid);
    ltext = unescape(ltext);
    if(contobj) fboxSimpleLoader(contid, ltext, imgsrc, null, null);

    var a = document.getElementsByTagName('a');
	for (var i=0; i<a.length; i++){
		var anchor = a[i];
		//className 
		var elClass = String(anchor.className); 
		if(elClass.match('fbox-nav')) {
			anchor.className = 'fbox-nav';	
		}
	}
	
	if(activeObj)
	   activeObj.className = 'fbox-nav-active';
}

function fboxSimpleLoader(info, msg, imgsrc, before, append){
    var el = document.getElementById(info);
    if(!before) var elbefore = el.firstChild;
    else var elbefore = document.getElementById(before);
    
    var pElement = document.createElement('div');
    pElement.setAttribute('style', 'float: right');
    pElement.setAttribute('class', 'forumheader');
    
    var text = document.createTextNode(msg);
    
    var ctxt = document.createElement('span');
    ctxt.setAttribute('class', 'searchhighlight');
    
    if(imgsrc) {
        var imgElement = document.createElement('img');
        imgElement.setAttribute('src', imgsrc);
        imgElement.setAttribute('style', 'vertical-align: bottom; padding-right: 10px; border: 0 none');
        pElement.appendChild(imgElement);
    }
    
    ctxt.appendChild(text);
    pElement.appendChild(ctxt);
    
    if(!append) el.insertBefore(pElement, elbefore);
    else el.appendChild(pElement);
}

function fboxSetActiveItem(cont, idq, url, activeObj, ltext, imgsrc) {
	fboxPrepare(cont, ltext, activeObj, imgsrc);
    var dobj = new Date();
    var rndget = dobj.getTime(); //IE6 cache issue!!!
	url=url+'?item.' + idq + '.' + rndget;
	//sendInfo(url, cont);
	setTimeout('sendInfo("' + url + '", "' + cont + '")',150);
}