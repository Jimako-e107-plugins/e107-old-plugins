<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Latest module: e107_plugins/sgallery/e_latest.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT') || !ADMIN) { exit; }

if(!defined('SGAL_INIT')) {
    require_once(e_PLUGIN.'sgallery/init.php');
    include_lan(SGAL_LAN.'_admin.php');
}

//pics
$cnt = 0;
$qry = "SELECT SUM(submit_picnum) AS pic_count FROM ".MPREFIX.SGAL_STABLE;
if($sql->db_Select_gen($qry)) {
    $result = $sql -> db_Fetch();
    $cnt = $result['pic_count'];
/*
    if($cnt) {
        $text .= "
            <div style='padding-bottom: 2px;'>
            <img src='".SGAL_IMAGES."icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />
        ";
        $text .= " <a href='".SGAL_PATH."admin_config.php?submitted.p'>".SGAL_LATEST_2.": {$cnt}</a>";
        $text .= "\n</div>";
    }
*/
}
//albums
$cnt += $sql -> db_Count('sgallery', '(*)', "WHERE album_ustatus='0'");
if($cnt) {
    $text .= "
        <div style='padding-bottom: 2px;'>
        <img src='".SGAL_IMAGES."icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' />
    ";
    $text .= " <a href='".SGAL_PATH."admin_config.php?submitted'>".SGAL_LATEST_1.": {$cnt}</a>";
    $text .= "\n</div>";
}

?>