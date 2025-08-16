/********************************************************************************************
* PageEar advertising CornerAd by Webpicasso Media
* Leave copyright notice.
*
* Lizenzvereinbarung / License agreement
* http://www.webpicasso.de/blog/lizenzvereinbarungen-license-agreements/
*
* @copyright www.webpicasso.de
* @author    christian harz <pagepeel-at-webpicasso.de>
*********************************************************************************************/


/*
 *  Konfiguration / Configuration
 */

// URL zum kleinen Bild / URL to small image
var pagearSmallImg = pageear_small;
// URL zu pageear_s.swf / URL to small pageear swf
var pagearSmallSwf = pagear_SmallSwf;

// URL zum großen Bild / URL to big image
var pagearBigImg = pageear_large;
// URL zu pageear_b.swf / URL to big pageear swf
var pagearBigSwf = pagear_BigSwf;

// Wackelgeschwindigkeit der Ecke 1-4 (2=Standard)
// Movement speed of small pageear 1-4 (2=Standard)
var speedSmall = pageear_speed;
// Bild spiegelt sich in der aufgeschlagenen Ecke ( true | false )
// Mirror image ( true | false )
var mirror = pageear_mirror;
// Farbe der aufgeschlagenen Ecke wenn mirror false ist
// Color of pagecorner if mirror is false
var pageearColor = pageear_colour;
// Zu öffnende URL bei klick auf die geöffnete Ecke
// URL to open on pageear click
var jumpTo = pageear_link
// Öffnet den link im neuen Fenster (new) oder im selben (self)
// Browser target  (new) or self (self)
var openLink = pageear_target;
// Öffnet das pagepeel automatisch wenn es geladen ist (false:deaktiviert | 0.1 - X Sekunden bis zum öffnen)
// Opens pageear automaticly (false:deactivated | 0.1 - X seconds to open)
var openOnLoad = pageear_openonload;
// Sekunden bis sich das pagepeel wieder schließt, funktioniert nur im Zusammenhang mit der openOnLoad-Funktion
// Second until pageear close after openOnLoad
var closeOnLoad = pageear_closeonload;
// Ecke in der das Pagepeel erscheinen soll (lt: linke obere Ecke | rt: rechte obere Ecke )
// Set direction of pageear in left or right top browser corner (lt: left | rt: right )
var setDirection = pageear_direction;
// Weiches einblenden des pageear wenn Bild geladen (0-5: 0=aus, 1=langsam, 5=schnell )
// Fade in pageear if image completly loaded (0-5: 0=off, 1=slow, 5=fast )
var softFadeIn = pageear_fadein;

/*
 *  Ab hier nichts mehr ändern  / Do not change anything after this line
 */

// Flash check vars
var requiredMajorVersion = 6;
var requiredMinorVersion = 0;
var requiredRevision = 0;

// Copyright
var copyright = 'Webpicasso Media, www.webpicasso.de';

// Size small peel
var thumbWidth  = 100;
var thumbHeight = 100;

// Size big peel
var bigWidth  = 500;
var bigHeight = 500;

// Css style default x-position
var xPos = 'right';

// GET - Params
var queryParams = 'pagearSmallImg='+escape(pagearSmallImg);
queryParams += '&pagearBigImg='+escape(pagearBigImg);
queryParams += '&pageearColor='+pageearColor;
queryParams += '&jumpTo='+escape(jumpTo);
queryParams += '&openLink='+escape(openLink);
queryParams += '&mirror='+escape(mirror);
queryParams += '&copyright='+escape(copyright);
queryParams += '&speedSmall='+escape(speedSmall);
queryParams += '&openOnLoad='+escape(openOnLoad);
queryParams += '&closeOnLoad='+escape(closeOnLoad);
queryParams += '&setDirection='+escape(setDirection);
queryParams += '&softFadeIn='+escape(softFadeIn);
	writeObjects ();
function openPeel(){
	document.getElementById('bigDiv').style.top = '0px';
	document.getElementById('bigDiv').style[xPos] = '0px';
	document.getElementById('thumbDiv').style.top = '-1000px';
}

function closePeel(){
	document.getElementById("thumbDiv").style.top = "0px";
	document.getElementById("bigDiv").style.top = "-1000px";
}

function writeObjects () {

    // Get installed flashversion
    var hasReqestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);

    // Check direction
    if(setDirection == 'lt') {
        xPosBig = 'left:-1000px';
        xPos = 'left';
    } else {
        xPosBig = 'right:1000px';
        xPos = 'right';
    }

    // Write div layer for big swf
    document.write('<div id="bigDiv" style="position:absolute;width:'+ bigWidth +'px;height:'+ bigHeight +'px;z-index:9999;'+xPosBig+';top:-100px;">');

    // Check if flash exists/ version matched
    if (hasReqestedVersion) {
    	AC_FL_RunContent(
    				"src", pagearBigSwf+'?'+ queryParams,
    				"width", bigWidth,
    				"height", bigHeight,
    				"align", "middle",
    				"id", "bigSwf",
    				"quality", "high",
    				"bgcolor", "#FFFFFF",
    				"name", "bigSwf",
    				"wmode", "transparent",
    				"allowScriptAccess","always",
    				"type", "application/x-shockwave-flash",
    				'codebase', 'http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab',
    				"pluginspage", "http://www.adobe.com/go/getflashplayer"
    	);
    } else {  // otherwise do nothing or write message ...
    	document.write('no flash installed');  // non-flash content
    }
    // Close div layer for big swf
    document.write('</div>');

    // Write div layer for small swf
    document.write('<div id="thumbDiv" style="position:absolute;width:'+ thumbWidth +'px;height:'+ thumbHeight +'px;z-index:9999;'+xPos+':0px;top:0px;">');

    // Check if flash exists/ version matched
    if (hasReqestedVersion) {
    	AC_FL_RunContent(
    				"src", pagearSmallSwf+'?'+ queryParams,
    				"width", thumbWidth,
    				"height", thumbHeight,
    				"align", "middle",
    				"id", "bigSwf",
    				"quality", "high",
    				"bgcolor", "#FFFFFF",
    				"name", "bigSwf",
    				"wmode", "transparent",
    				"allowScriptAccess","always",
    				"type", "application/x-shockwave-flash",
    				'codebase', 'http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab',
    				"pluginspage", "http://www.adobe.com/go/getflashplayer"
    	);
    } else {  // otherwise do nothing or write message ...
    	document.write('no flash installed');  // non-flash content
    }
    document.write('</div>');
    setTimeout('document.getElementById("bigDiv").style.top = "-1000px";',100);
}

