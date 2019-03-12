<?php
//============================= Notice-Board v4.0 ===============================
//	author: ComPolyS team, http://e107.compolys.ru, sunout@compolys.ru		
//	coders: Sunout, Geo						
//	language officer Georgy Pyankov
//	license GNU GPL									
//================================== Deсember 2011 =============================
	(int)$page = $_GET['page'];
		if ($cat == ''){$cat = 0;}
		if ($scat == ''){$scat = 0;}
		if ($page == ''){$page = 0;}
		if ($page < 0){$page = 0;}
	$text .="<table width='100%'><tr>";
	$sql2 -> db_Select("nb_cat", "*", "cat_sub_id=0") or die (NB_MES_START);
	while($row = $sql2 -> db_Fetch()){
		$cat_id = $row['cat_id'];
		$cat_name = $row['cat_name'];
		$cat_desc = $row['cat_desc'];
		$cat_icon = $row['cat_icon'];
	$onpage = (int)$conf_showrows;
	$table = "".MPREFIX."nb_gnl";
	$page = page();
	$result = sql_result($onpage, $page, $table, $gnl_pigbig);
	$result_cat = sql_cat($onpage, $page, $cat, $table, $gnl_pigbig);
	$result_scat = sql_scat($onpage, $page, $scat, $table, $gnl_pigbig);

	$count = new db;
	$sql = new db;
	$count = $sql -> db_Count("nb_gnl","(*)", "where gnl_scatid in (select cat_id from ".MPREFIX."nb_cat where ".MPREFIX."nb_cat.cat_sub_id='$cat_id')");
	if ($i == $conf_showcols){
		$text  .= "<tr>";
		$i = 0;
	}
	$text  .= "<td class='forumheader3' width='24px'><img src='".e_PLUGIN."nboard/theme/icons_cat/$cat_icon' alt='".NB_INFO."'></td>
		<td class='forumheader3' width='auto'><a href='nboard.php?cat=$cat_id&scat=0'>$cat_name</a><br><font color=#777>$cat_desc</font></td>
		<td class='forumheader3' width='24px'><a href='nboard.php?cat=$cat_id&scat=0'>$count</a></td>";
		$i= $i + 1;
		}	
	$text .="</table>";
//========================== Chek SQL inj ==========================//
if((string)$cat <> (string)(int)$cat || (string)$scat <> (string)(int)$scat){
		die (NB_MES_10);
		}
//========================== banners ===============================//
	$now = strftime($conf_dateformat,$today);
	$sql -> db_Select("nb_ban", "*", "");
	while($row = $sql -> db_Fetch()){
		$ban_id = $row['ban_id'];
		$ban_catid = $row['ban_catid'];
		$ban_org = $row['ban_org'];
		$ban_url = $row['ban_url'];
		$ban_images = $row['ban_images'];
		$ban_datebegin = $row['ban_datebegin'];
		$ban_dateend = $row['ban_dateend'];
	if (($ban_catid == '0' && $cat == 0) && ($ban_dateend > $now || $ban_dateend = $now)) {
	$text .= "<a href='$ban_url'><img src='".e_PLUGIN."nboard/banners/$ban_images' alt='$ban_org' border=0></a>";
	}
	if (($ban_catid == $cat && $cat <> 0) && ($ban_dateend > $now || $ban_dateend = $now)) {
	$text .= "<a href='$ban_url'><img src='".e_PLUGIN."nboard/banners/$ban_images' alt='$ban_org' border=0></a>";
	}
	if (($ban_catid == 'all_pages') && ($ban_dateend > $now || $ban_dateend = $now)) {
	$text .= "<a href='$ban_url'><img src='".e_PLUGIN."nboard/banners/$ban_images' alt='$ban_org' border=0></a>";
	}
	}
//========================== all output notes ======================//
if(((!IsSet($_GET['cat'])) && (!IsSet($_GET['scat']))) || ((IsSet($_GET['cat']) && $_GET['cat'] == 0) && (IsSet($_GET['scat']) && $_GET['scat'] == 0))){
$text .= "<table class='fcaption' width='100%'><tr>";
	$text .="<td class='fcaption' width='10%'><b>".NB_NAME_01."</td>";
//	$text .="<td class='fcaption' width='5%'><b>".NB_VIEW_2."</td>";
	$text .="<td class='fcaption' width='60%'><b>".NB_NAME_02."</td>";
	$text .="<td class='fcaption' width='15%'><b>".NB_NAME_03."</td>";
	$text .="<td class='fcaption' width='15%'><b>".NB_NAME_04."</td></tr>";
$chet = 1;
while($data = mysql_fetch_array($result)){
	$gnl_small = $data['gnl_pic1'];
	if (!$gnl_small == ""){
		$gnl_small = "<img src='".e_PLUGIN."nboard/theme/photo.png'>";
	}			
	if ($chet == 1) {	
	$text .= "<tr><td class='forumheader3'>".strftime($conf_dateformat,$data['gnl_date_start'])."</td><td class='forumheader3'><b><a href='".e_PLUGIN."nboard/nboard.php?cat=$cat&scat=$cat_id&view=".$data['gnl_id']."'>".$data['gnl_name']. "</a></b> ".$gnl_small."</td><td class='forumheader3'>".$data['gnl_price']." </td><td class='forumheader3'>".$data['gnl_city']."<br></td>";
	}
	if ($chet == 2) {	
	$text .= "<tr><td class='forumheader2'>".strftime($conf_dateformat,$data['gnl_date_start'])."</td><td class='forumheader2'><b><a href='".e_PLUGIN."nboard/nboard.php?cat=$cat&scat=$cat_id&view=".$data['gnl_id']."'>".$data['gnl_name']. "</a></b> ".$gnl_small."</td><td class='forumheader2'>".$data['gnl_price']." </td><td class='forumheader2'>".$data['gnl_city']."<br></td>";
	$chet = 0;
	}
	$chet ++;
	}
}
//==================== output notes where Cat selected ======================//
if((IsSet($_GET['cat']) && $_GET['cat'] <> 0) && (IsSet($_GET['scat']) && $_GET['scat'] == 0)){
	$text .="<table style='width:100%'><tr>";
	$sql -> db_Select("nb_cat", "*", "cat_id='$cat'");
                while($row = $sql-> db_Fetch()){
			$catId = $row['cat_id'];
			$catName = $row['cat_name'];
		}
	$catlink = " - <a href='".e_PLUGIN."nboard/nboard.php?cat=$cat&scat=0'>$catName</a>";

	$sql -> db_Select("nb_cat", "*", "cat_sub_id='$cat'");
                while($row = $sql-> db_Fetch()){
			$cat_id = $row['cat_id'];
			$cat_name = $row['cat_name'];
			$cat_icon = $row['cat_icon'];
			$text .= "<td class='notice_1' width='16px'><img src='".e_PLUGIN."nboard/theme/icons_subcat/$cat_icon'></td><td class='notice_1'><b>
		<a href='nboard.php?cat=$cat&scat=$cat_id'>$cat_name</a></b></td>";
		}
	$text .="</tr></table>";
	$text .= "<table style='width:100%'><tr>";
	$text .="<td class='fcaption' width='10%'><b>".NB_NAME_01."</td>";
//	$text .="<td class='fcaption' width='5%'><b>".NB_VIEW_2."</td>";
	$text .="<td class='fcaption' width='60%'><b>".NB_NAME_02."</td>";
	$text .="<td class='fcaption' width='15%'><b>".NB_NAME_03."</td>";
	$text .="<td class='fcaption' width='15%'><b>".NB_NAME_04."</td></tr>";
$chet = 1;
while($data = mysql_fetch_array($result_cat)){
	$gnl_small = $data['gnl_pic1'];
	if (!$gnl_small == ""){
		$gnl_small = "<img src='".e_PLUGIN."nboard/theme/photo.png'>";
	}			
	if ($chet == 1) {	
	$text .= "<tr><td class='forumheader3'>".strftime($conf_dateformat,$data['gnl_date_start'])."</td><td class='forumheader3'><b><a href='".e_PLUGIN."nboard/nboard.php?cat=$cat&scat=$cat_id&view=".$data['gnl_id']."'>".$data['gnl_name']. "</a></b> ".$gnl_small."</td><td class='forumheader3'>".$data['gnl_price']." </td><td class='forumheader3'>".$data['gnl_city']."<br></td>";
	}
	if ($chet == 2) {	
	$text .= "<tr><td class='forumheader2'>".strftime($conf_dateformat,$data['gnl_date_start'])."</td><td class='forumheader2'><b><a href='".e_PLUGIN."nboard/nboard.php?cat=$cat&scat=$cat_id&view=".$data['gnl_id']."'>".$data['gnl_name']. "</a></b> ".$gnl_small."</td><td class='forumheader2'>".$data['gnl_price']." </td><td class='forumheader2'>".$data['gnl_city']."<br></td>";
	$chet = 0;
	}
	$chet ++;
	}
	
}
//================== output notes where Subcat selected =====================//
if(IsSet($_GET['cat'])  && (IsSet($_GET['scat']) && $_GET['scat'] <> 0)){
	$sql -> db_Select("nb_cat", "*", "cat_id='$cat'");
                while($row = $sql-> db_Fetch()){
			$catId = $row['cat_id'];
			$catName = $row['cat_name'];
		}
	$catlink = " - <a href='".e_PLUGIN."nboard/nboard.php?cat=$cat&scat=0'>$catName</a>";
	$sql -> db_Select("nb_cat", "*", "cat_id='$scat'");
                while($row = $sql -> db_Fetch()){
			$subId = $row['cat_id'];
			$subName = $row['cat_name'];
		}
	$sublink = " - <a href='".e_PLUGIN."nboard/nboard.php?cat=$cat&scat=$scat'>$subName</a>";
	$text .="<table style='width:100%'><tr>";
	$sql -> db_Select("nb_cat", "*", "cat_sub_id='$cat'");
                while($row = $sql-> db_Fetch()){
			$cat_id = $row['cat_id'];
			$cat_name = $row['cat_name'];
			$cat_icon = $row['cat_icon'];
			$text .= "<td class='notice_1' width='16px'><img src='".e_PLUGIN."nboard/theme/icons_subcat/$cat_icon'></td><td class='notice_1'><b>
		<a href='nboard.php?cat=$cat&scat=$cat_id'>$cat_name</a></b></td>";
		}
	$text .="</tr></table>";
	$text .= "<table style='width:100%'><tr>";
	$text .="<td class='fcaption' width='10%'><b>".NB_NAME_01."</td>";
//	$text .="<td class='fcaption' width='5%'><b>".NB_VIEW_2."</td>";
	$text .="<td class='fcaption' width='60%'><b>".NB_NAME_02."</td>";
	$text .="<td class='fcaption' width='15%'><b>".NB_NAME_03."</td>";
	$text .="<td class='fcaption' width='15%'><b>".NB_NAME_04."</td></tr>";
$chet = 1;
while($data = mysql_fetch_array($result_scat)){
	$gnl_small = $data['gnl_pic1'];
	if (!$gnl_small == ""){
		$gnl_small = "<img src='".e_PLUGIN."nboard/theme/photo.png'>";
	}			
	if ($chet == 1) {	
	$text .= "<tr><td class='forumheader3'>".strftime($conf_dateformat,$data['gnl_date_start'])."</td><td class='forumheader3'><b><a href='".e_PLUGIN."nboard/nboard.php?cat=$cat&scat=$cat_id&view=".$data['gnl_id']."'>".$data['gnl_name']. "</a></b> ".$gnl_small."</td><td class='forumheader3'>".$data['gnl_price']." </td><td class='forumheader3'>".$data['gnl_city']."<br></td>";
	}
	if ($chet == 2) {	
	$text .= "<tr><td class='forumheader2'>".strftime($conf_dateformat,$data['gnl_date_start'])."</td><td class='forumheader2'><b><a href='".e_PLUGIN."nboard/nboard.php?cat=$cat&scat=$cat_id&view=".$data['gnl_id']."'>".$data['gnl_name']. "</a></b> ".$gnl_small."</td><td class='forumheader2'>".$data['gnl_price']." </td><td class='forumheader2'>".$data['gnl_city']."<br></td>";
	$chet = 0;
	}
	$chet ++;
	}
}
$text .= "</tr></table>";
$text .="<table><tr><td>".$navigation = navigation($onpage, $page, $table)."</td></tr></table>";
?>