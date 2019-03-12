<?php
//============================= Notice-Board v4.0 ===============================
//	author: ComPolyS team, http://e107.compolys.ru, sunout@compolys.ru		
//	coders: Sunout, Geo						
//	language officer Georgy Pyankov
//	license GNU GPL									
//================================== Deсember 2011 =============================
	$view = $_GET['view'];
	$view=(int)$view;
	$conf_dateformat = $pref['nb_dateformat'];
	$conf_comments = $pref['nb_comments'];
	$conf_sizepicsmall = $pref['nb_sizepicsmall'];
	$sql -> db_Select("nb_gnl", "*", "gnl_id='$view'");
	while($row = $sql -> db_Fetch()){
		$gnlScatid = $row['gnl_scatid'];
		}
	$sql -> db_Select("nb_cat", "*", "cat_id='$gnlScatid'");
                while($row = $sql-> db_Fetch()){
			$catSubId = $row['cat_sub_id'];
			$subName = $row['cat_name'];
		}
	$sql -> db_Select("nb_cat", "*", "cat_id='$catSubId'");
                while($row = $sql -> db_Fetch()){
			$catId = $row['cat_id'];
			$catName = $row['cat_name'];
		}
	$catlink = " - <a href='".e_PLUGIN."nboard/nboard.php?cat=$catId&scat=0'>$catName</a>";
	$sublink= " - <a href='".e_PLUGIN."nboard/nboard.php?cat=$catId&scat=$gnlScatid'>$subName</a>";
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
//==================================Debug=======================================
	$text .="<table width='100%'>";
	if((string)$view <> (string)(int)$view){
	die (NB_MES_10);
	} else {
	
	$sql -> db_Select("nb_gnl", "*", "gnl_id='$view'");
	while($row = $sql -> db_Fetch()){
		$gnl_id = $row['gnl_id'];
		$gnl_name = $row['gnl_name'];
		$gnl_city = $row['gnl_city'];
		$gnl_pic1 = $row['gnl_pic1'];
		$gnl_detail = $row['gnl_detail'];
		$gnl_user = $row['gnl_user'];
		$gnl_phone = $row['gnl_phone'];
		$gnl_email = $row['gnl_email'];
		$gnl_date_start = $row['gnl_date_start'];
		$gnl_date_end = $row['gnl_date_end'];
		$gnl_price = $row['gnl_price'];
		$gnl_counter = $row['gnl_counter'];
	$gnl_counter = $gnl_counter +1;
	$sql -> db_Update("nb_gnl", "gnl_counter='$gnl_counter' WHERE gnl_id='$gnl_id'");
	$text .="<tr><td class='fcaption'><h2>$gnl_name</h2></td><td class='fcaption'>".NB_VIEW_14.": $gnl_counter</td></tr>";
	
	if ($gnl_pic1 == ""){	
		$text .="<tr><td class='forumheader3' rowspan='7'><img border=0 src='".e_PLUGIN."nboard/theme/photo_emp.png'></td><td class='forumheader3'>$gnl_detail</td></tr>";
	}
	else {	
		
		if (@fopen("".e_PLUGIN."nboard/nb_pictures/small_$gnl_pic1", "r")){
	$text .="<tr><td class='forumheader3' rowspan='7'>
		<div id='container'>
			<div class='navSectorNormal' onmouseover=\"this.className='navSectorSelected'\" onmouseout=\"this.className='navSectorNormal'\">
			<a href='' class='link'><img src='".e_PLUGIN."nboard/nb_pictures/small_$gnl_pic1'></a>
			<div id='box'>
				<img src='".e_PLUGIN."nboard/nb_pictures/$gnl_pic1'>
			</div>
		</div>
		</div><br></td><td class='forumheader3'>$gnl_detail</td></tr>";
		}
		else{
		$text .="<tr><td class='forumheader3' rowspan='7'>
		<div id='container'>
			<div class='navSectorNormal' onmouseover=\"this.className='navSectorSelected'\" onmouseout=\"this.className='navSectorNormal'\">
			<a href='' class='link'><img src='".e_PLUGIN."nboard/nb_pictures/$gnl_pic1'></a>
			<div id='box'>
				<img src='".e_PLUGIN."nboard/nb_pictures/$gnl_pic1'>
			</div>
		</div>
		</div><br></td><td class='forumheader3'>$gnl_detail</td></tr>";
		}
	}
	$text .="<tr><td class='forumheader3'>".NB_VIEW_03.": $gnl_price</td></tr>";
	$text .="<tr><td class='forumheader3'><a href='$uslink'>".NB_VIEW_08.": $gnl_user</a></td></tr>";
	$text .="<tr><td class='forumheader3'>".NB_VIEW_09.": $gnl_city</td></tr>";
	$text .="<tr><td class='forumheader3'>".NB_VIEW_10.": $gnl_phone</td></tr>";
	$text .="<tr><td class='forumheader3'>".NB_VIEW_11.": <a href='mailto:$gnl_email'>".NB_VIEW_12."</a></td></tr>";
	$text .="<tr><td class='forumheader3'>".NB_VIEW_13.": ".strftime($conf_dateformat,$gnl_date_start)." / ".strftime($conf_dateformat,$gnl_date_end)."</td></tr>";
	$text .="<tr><td class='forumheader3' colspan=2></td></tr>";
	}
}
$text .="</table>";
if ($conf_comments == NB_SEL_YES){
	require_once(e_HANDLER."comment_class.php");
	$com = new comment;
	$table = 'nb_gnl';
//	$pid = $_GET['id'];
	$pid = $gnl_id;
		if (IsSet($_POST['commentsubmit'])){
			$_POST['subject'] = $gnl_name;
			$com->enter_comment(USERNAME, $_POST['comment'], $table, $pid, 0, $_POST['subject'], false);
		}
	$com_result = $com->compose_comment($table, 'comment', $pid,'', '', false, true, false);
	$text .=$com_result['comment'];
	$text .=$com_result['comment_form'];
}
?>