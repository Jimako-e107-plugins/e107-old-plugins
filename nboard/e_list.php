<link rel='stylesheet' href='theme/nboard.css' type='text/css'/>
<?php
//============================= Notice-Board v4.0 ===============================
//	author: ComPolyS team, http://e107.compolys.ru, sunout@compolys.ru		
//	coders: Sunout, Geo						
//	language officer Georgy Pyankov
//	license GNU GPL									
//================================== Deсember 2011 =============================
 if (!defined('e107_INIT')) { exit; }
	if(!$calendar_install = $sql -> db_Select("plugin", "*", "plugin_path = 'nboard' AND plugin_installflag = '1' "))
 	{
		return;
 	}
	$LIST_CAPTION = $arr[0];
	$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");
	$LIST_CAPTION = $arr[0];
	$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");
	if($mode == "new_page" || $mode == "new_menu" ){
		$lvisit = $this -> getlvisit();
		$qry = "gnl_date_start>".$lvisit;

	}else{
		$qry = "gnl_id != '0' ";
	}
	$qry .= "ORDER BY gnl_date_start DESC LIMIT 0".intval($arr[7]);
	$bullet = $this -> getBullet($arr[6], $mode);
//	if(!$chatbox_posts = $sql -> db_Select("nb_gnl", "*", $qry)){ 
	if(!$chatbox_posts = $sql -> db_Select("nb_gnl", "*", "gnl_pic1<>'' AND $qry")){ 
		$LIST_DATA = LIST_CHATBOX_2;
	}else{
		while($row = $sql -> db_Fetch()) {
			$cb_id		= substr($row['gnl_id'] , 0, strpos($row['gnl_id'] , "."));
			$cb_nick	= $row['gnl_user'] ;
			$cb_message	= "<a href=".e_PLUGIN."nboard/nboard.php?view=".$row['gnl_id'].">".$row['gnl_name']."</a>";
			$rowheading	= $this -> parse_heading($cb_message, $mode);
			if ($row['gnl_pic1'] == ''){
			$ICON		= "<img src='".e_PLUGIN."nboard/theme/photo_emp_small.png' style='width:50px; border:0px solid #000;' alt='' />";
			} else {
				if (@fopen("".e_PLUGIN."nboard/nb_pictures/small_$gnl_pic1", "r")){
					$ICON	= "<a href='".e_PLUGIN."nboard/nb_pictures/".$row['gnl_pic1']."'><img src='".e_PLUGIN."nboard/nb_pictures/small_".$row['gnl_pic1']."' style='width:50px; border:0px solid #000;' alt='' /></a>";
				}
				else{
					$ICON	= "<a href='".e_PLUGIN."nboard/nb_pictures/".$row['gnl_pic1']."'><img src='".e_PLUGIN."nboard/nb_pictures/".$row['gnl_pic1']."' style='width:50px; border:0px solid #000;' alt='' /></a>";
				}
			}
//			$ICON		= $bullet;
			$HEADING	= $rowheading;
			$AUTHOR		= ($arr[3] ? ($cb_id != 0 ? "<a href='".e_BASE."user.php?id.$cb_id'>".$cb_nick."</a>" : $cb_nick) : "");
			//$CATEGORY	= "";
			$DATE		= ($arr[5] ? (strftime('%d.%m.%Y',$row['gnl_date_start'])) : "");
			/*$INFO		= "";*/
			$LIST_DATA[$mode][] = array( $ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO );
		}
	}
?>