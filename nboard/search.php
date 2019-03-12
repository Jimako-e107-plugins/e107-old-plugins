<?php
//============================= Notice-Board v4.0 ===============================
//	author: ComPolyS team, http://e107.compolys.ru, sunout@compolys.ru		
//	coders: Sunout, Geo						
//	language officer Georgy Pyankov
//	license GNU GPL									
//================================== Deсember 2011 =============================
$catlink =" - <a href='".e_PLUGIN."nboard/nboard.php?search'> ".NB_SARCH_CAP."</a>";
$cat = $_GET['cat'];
$scat = $_GET['scat'];
//================ Head =====================
$text .= "<table class='forumheader3' style='width:100%'><form action='". $PHP_SELF ."' method=post>";
$text .="<tr><td class='forumheader3' width=40%><input type='text' class='tbox' name='stext' value='".NB_SARCH_01."' size=40></td>";
$text .="<td class='forumheader3' width=40%>
	<select name='crit' class='tbox'>
		<option value='gnl_name'>".NB_SARCH_02."</option>
		<option value='gnl_detail'>".NB_SARCH_03."</option>
	</select></td>";
$text .="<td class='forumheader3' width=20%>
	<input class='button' style='cursor:pointer;' type='Submit' value=".NB_BUT_SEA." name='sear'></td></tr><tr></table></form>";
//================ Select ======================
if(IsSet($_POST['sear'])){
	$crit = $_POST['crit'];
	$stext = $_POST['stext'];
	$stext = strtoupper($stext);
	$text .="<table width=100%>";
	$text .="<tr><td class='fcaption' width='30%'><b>".NB_SARCH_04."</td>";
//	$text .="<td class='fcaption' width='10%'><b>".NB_AUTH_1."</td>";
	$text .="<td class='fcaption' width='70%'><b>".NB_SARCH_05."</td></tr>";
	$sql -> db_Select("nb_gnl", "*", "$crit LIKE '%$stext%'") or die(NB_SARCH_06);
	while($row = $sql -> db_Fetch()){
		$gnl_id = $row['gnl_id'];
		$gnl_scatid = $row['gnl_scatid'];
		$gnl_name = $row['gnl_name'];
		$gnl_detail = $row['gnl_detail'];
	$sql2 = new db;
	$sql2 -> db_Select("nb_cat", "*", "cat_sub_id='$gnl_scatid'");
                while($row = $sql2 -> db_Fetch()){
			$cat_name = $row['cat_name'];
			$cat_sub_id = $row['cat_sub_tid'];
		}
	$sql3 = new db;
	$sql3 -> db_Select("nb_cat", "*", "cat_id='$cat_sub_id'");
                while($row = $sql3 -> db_Fetch()){
			$cat_id = $row["cat_id"];
			$cat_name = $row["cat_name"];
		}
	if (!$gnl_picbig == ""){
		"<img src='".e_PLUGIN."nboard/images/photo.png'>";
	}
	$text .="<tr><td class='forumheader2'><a href='".e_PLUGIN."nboard/nboard.php?view=$gnl_id'>$gnl_name</a></td>";
//	$text .="<td class='forumheader2'><a href='".e_PLUGIN."nboard/nboard.php?view=$gnl_id'>$gnl_user</a></td>";
	$text .="<td class='forumheader2'><a href='".e_PLUGIN."nboard/nboard.php?view=$gnl_id'>$gnl_detail</a></td></tr>";
	}
	$text .="</table>";
}
?>