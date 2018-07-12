/*
+---------------------------------------------------------------+
|        e107 website system
|        http://e107.org
|
|        PView Gallery by R.F. Carter
|        ronald.fuchs@hhweb.de
+---------------------------------------------------------------+
*/

// Comments -----------------------------------------------------------
function pv_CommentAdd(){
	
	document.getElementsByName('comment_edit')[0].style.display = 'block';
	document.getElementsByName('comment_show')[0].style.display = 'none';
	document.getElementsByName('comment_preview')[0].style.display = 'none';	
}

function pv_CommentShow() {
	document.getElementsByName('comment_show')[0].style.display = 'block';
	document.getElementsByName('comment_edit')[0].style.display = 'none';
	document.getElementsByName('comment_preview')[0].style.display = 'none';
}
// Comments End --------------------------------------------------------

// Popup Window ---------------------------------------------------------
function pv_imagezoom(imageURL,width,height,name,info) {
	var settings = 'scrollbars=yes,resizable=yes,height='+height+',width='+width;
	var generator=window.open('','',settings);
	generator.document.write('<html><head><title>'+name+'</title>');
	generator.document.write('<style type="text/css"> body { margin: 0px; padding: 0px; } </style>');
	generator.document.write('</head><body>');
	generator.document.write('<a href="javascript:self.close()"><img border="0" src="'+imageURL+'" title="'+info+'"></a>'); 
	generator.document.write('</body></html>');
	generator.document.close();
}
// Popup Window End -----------------------------------------------------

// Scroller -------------------------------------------------------------	
var myInterval;

function pv_start() {
	if (!myInterval){
		myInterval = window.setInterval(pv_move,pv_speed);
	}
}
function pv_stop() {
	myInterval = window.clearInterval(myInterval);
}
function pv_move(){
	var x=0;
	
	while (document.getElementsByName("pv_menu")[x]) {
		if (pv_direction == "hor") {
			pv_Pos = document.getElementsByName("pv_menu")[x].style.left;
			pv_Pos = pv_Pos.slice(0,pv_Pos.indexOf("px"))-1;
			if (pv_Pos < - pv_space_hor*(pv_img_count-pv_img_view)) { pv_Pos = pv_boxwidth -1; }
			document.getElementsByName("pv_menu")[x].style.left = String(pv_Pos)+"px";
		}
		if (pv_direction == "vert") {
			pv_Pos = document.getElementsByName("pv_menu")[x].style.top;
			pv_Pos = pv_Pos.slice(0,pv_Pos.indexOf("px"))-1;
			if (pv_Pos < - pv_space_vert*(pv_img_count-pv_img_view)) { pv_Pos = pv_boxheight -1; }
			document.getElementsByName("pv_menu")[x].style.top = String(pv_Pos)+"px";			
		}
		x=x+1;
	}
}
// Scroller End ---------------------------------------------------------

// Statistic menu -------------------------------------------------------
function pv_uploader() {
	document.getElementsByName('pview_menu_uploader')[0].style.display = 'block';
	document.getElementsByName('pview_menu_rating')[0].style.display = 'none';
	document.getElementsByName('pview_menu_views')[0].style.display = 'none';
}
function pv_Rating() {
	document.getElementsByName('pview_menu_uploader')[0].style.display = 'none';
	document.getElementsByName('pview_menu_rating')[0].style.display = 'block';
	document.getElementsByName('pview_menu_views')[0].style.display = 'none';
	
}
function pv_Views() {
	document.getElementsByName('pview_menu_uploader')[0].style.display = 'none';
	document.getElementsByName('pview_menu_rating')[0].style.display = 'none';
	document.getElementsByName('pview_menu_views')[0].style.display = 'block';
	
}

// Statistic menu End ---------------------------------------------------

// Comments menu -------------------------------------------------------
function pv_NewComments() {
	document.getElementsByName('pview_menu_NewComments')[0].style.display = 'block';
	document.getElementsByName('pview_menu_OwnComments')[0].style.display = 'none';
}
function pv_OwnComments() {
	document.getElementsByName('pview_menu_NewComments')[0].style.display = 'none';
	document.getElementsByName('pview_menu_OwnComments')[0].style.display = 'block';	
}

// Comments menu End ---------------------------------------------------

// Admin Frontpage Switcher
function pv_frontpageswitcher() {
	if (document.getElementById('pv_start_page').value == 'classic') {
		document.getElementById('pview_start_advanced').style.display = 'none';
	}
	if (document.getElementById('pv_start_page').value == 'advanced') {
		document.getElementById('pview_start_advanced').style.display = 'block';
	}	
}
// Admin Frontpage Switcher End -------------------------------------