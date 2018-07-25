/*
+---------------------------------------------------------------+
|        e107 website system
|        http://e107.org
|
|        PView Gallery by R.F. Carter
|        ronald.fuchs@hhweb.de
+---------------------------------------------------------------+
*/

// Rating ---------------------------------------------------------------
function pv_colorchange(Value){
	var Image;
	for (var i = 1; i <= Value; i++) {
	Image = "star" + String(i);
	document.getElementsByName(Image)[0].src = "templates/Fun/images/rate/star.png";
	}
}

function pv_colorreset() {
	var Image;
	for (var i = 1; i <= 10; i++) {
	Image = "star" + String(i);
	document.getElementsByName(Image)[0].src = "templates/Fun/images/rate/star_gray.png";
	}
}
// Rating End -----------------------------------------------------------
