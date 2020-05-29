<?php
/*
+------------------------------------------------------------------------------+
|   EasyGallery - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
echo (" 
<script type='text/javascript'>
function phpSG_Dropdown(){
	window.location = '?sort=' + document.phpSG.sortOrd.options[document.phpSG.sortOrd.selectedIndex].value + \"&perPage=\" + document.phpSG.perPage.options[document.phpSG.perPage.selectedIndex].value + \"&album=\" + document.phpSG.album.value;
}
</script>");
?>