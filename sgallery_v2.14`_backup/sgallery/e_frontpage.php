<?php
global $PHPTHUMB_CONFIG, $THCONFIG_THDEF, $tp, $sgal_pref, $pref, $sgalobj, $sql;

if (!defined('e107_INIT')) { exit; }
if (!defined('SGAL_INIT')) { 
	require_once(e_PLUGIN.'sgallery/init.php');
}
$ch_class = $_POST['type'] == 'user_class' ? $_POST['class'] : USERCLASS;
if(check_class($pref['sgal_active'],$ch_class)) { 
    include_lan(SGAL_LAN.'_efrontpage.php');
    
    
    
    $sql2 = new db;
    $where = " AND al.album_ustatus>0";
    //all user albums list - check user visibility permissions only
    if(!check_class($sgal_pref['sgal_usermod_visible'],$ch_class)) {
        $where .= " AND al.sgal_user=''";
    }
    
    //mysql data - loop
    $qry = "
    SELECT alc.title AS ctitle, alc.cat_id AS cid 
    FROM #sgallery_cats AS alc
    LEFT JOIN #sgallery AS al ON al.cat_id = alc.cat_id AND al.active > 0 AND al.album_ustatus > 0{$where}
    WHERE alc.active > 0 AND al.album_id > 0
    GROUP by alc.cat_id  ORDER by alc.cat_order ASC
    ";
    if($sql2->db_Select_gen($qry)) {
    	$front_page['sgallery']['title'] = SGAL_EFRPLAN_0;
    	if(check_class($sgal_pref['sgal_usermod_visible'],$ch_class)) //not nowbody
            $front_page['sgallery']['page'][] = array('page' => $PLUGINS_DIRECTORY.'sgallery/gallery.php?list.'.$row['cid'], 'title' => SGAL_EFRPLAN_2);
            
        while ($row = $sql2 -> db_Fetch()) {
    		$front_page['sgallery']['page'][] = array('page' => $PLUGINS_DIRECTORY.'sgallery/gallery.php?list.'.$row['cid'], 'title' => SGAL_EFRPLAN_1.': '.$row['ctitle'].' ');
    	}
    }
}
?>