<?php
global $PHPTHUMB_CONFIG, $THCONFIG_THDEF, $tp, $sgal_pref, $pref, $sgalobj, $sql;

if (!defined('e107_INIT')) { exit; }
if (!defined('SGAL_INIT')) { 
	require_once(e_PLUGIN.'sgallery/init.php');
}
if(!check_class($pref['sgal_active'])) {
    return '';
}
	include_lan(SGAL_LAN.'_elist.php');

	if(!$active = $sql -> db_Count("plugin", "(*)", " WHERE plugin_path = 'sgallery' AND plugin_installflag = '1' "))
	{
		return '';
	}

	$LIST_CAPTION = $arr[0] ? $arr[0] : SGAL_LISTLAN_0;
	$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");

	if($mode == "new_page" || $mode == "new_menu" ){
		$lvisit = $this -> getlvisit();
		$qry = "al.dt>".intval($lvisit)." AND ";
	}else{
		$qry = "";
	}
	
	if(!check_class($sgal_pref['sgal_usermod_visible'])) {
		$qry .= " al.sgal_user='' AND ";
	} else {
        $qry .= "(c.active > 0 || al.sgal_user!='') AND ";
    }
	
	$bullet = $this -> getBullet($arr[6], $mode);
	
	$qry = "
	SELECT al.*, c.title as ctitle
	FROM #sgallery AS al 
	LEFT JOIN #sgallery_cats AS c ON c.cat_id = al.cat_id 
	WHERE ".$qry."al.active > 0 AND al.album_ustatus > 0
	ORDER BY al.dt DESC LIMIT 0,".intval($arr[7]);

	if(!$sgal_items = $sql->db_Select_gen($qry)){
		$LIST_DATA = SGAL_LISTLAN_1;
	}else{
		while($row = $sql -> db_Fetch()){

			if($row['sgal_user']) {
				$tmp = explode(".", $row['sgal_user']);
				$AUTHOR = $tmp[1];
			}
			

			$rowheading	= $this -> parse_heading($row['title'], $mode);
			$ICON		= $bullet;
			$HEADING	= "<a href='".SGAL_PATH_ABS."gallery.php?".($row['sgal_user'] ? 'uview.' : 'view.').$row['album_id']."' title='".$tp->toAttribute($row['title'])."'>".$rowheading."</a>";
			$CATEGORY	= $row['ctitle'];
			$DATE		= ($arr[5] ? $this -> getListDate($row['dt'], $mode) : "");
			$INFO		= "";
			$LIST_DATA[$mode][] = array( $ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO );
		}
	}
	
?>