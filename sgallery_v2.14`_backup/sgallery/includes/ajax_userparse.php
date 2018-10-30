<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|       Ajax Parser: e107_plugins/sgallery/includes/ajax_parse.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
require_once('../../../class2.php');
header("Content-Type: text/html; charset=".CHARSET);

if(!USER) { exit; }

//plugin defs
require_once('../init.php');


include_lan(SGAL_LAN.'_render.php');
//get (sub) actions
$qs = (e_QUERY ? explode(".", e_QUERY) : array());

$action = varset($qs[0], '');
$sub_action = varset($qs[1], '');

//check user management permissions
if(!check_class($sgal_pref['sgal_usermod_allow'])) {
    exit;
}

//override sgal prefs - user albums as module on top of Gallery API
$tmppref = array();
$tmppref['sgal_restrict_size'] = $sgal_pref['sgal_usermod_urestrict'];
$tmppref['sgal_restrict_w'] = $sgal_pref['sgal_usermod_urestrict_w'] ? $sgal_pref['sgal_usermod_urestrict_w'] : 640;
$tmppref['sgal_restrict_h'] = $sgal_pref['sgal_usermod_urestrict_h'] ? $sgal_pref['sgal_usermod_urestrict_h'] : 480;
$tmp = $sgal_pref['sgal_usermod_rmethods'] ? explode(',', $sgal_pref['sgal_usermod_rmethods']) : array();
$tmppref['sgal_allow_uresize'] = in_array('uresize', $tmp) ? '1' : '0';
$tmppref['sgal_allow_autoresize'] = in_array('autoresize', $tmp) ? '1' : '0';

$sgal_pref = $sgalobj->setExtConfig($tmppref, 'SgalleryUserPrefs');

//actions start -------------------------------------------------->
$cont = '';
$text = '';
//upload resize type start
if($action == 'up_type') {
    // TO DO premissions
    
    $sgal_pref['sgal_restrict_w'] = varsettrue($qs[2], $sgal_pref['sgal_restrict_w']);
    $sgal_pref['sgal_restrict_h'] = varsettrue($qs[3], $sgal_pref['sgal_restrict_h']);
    $sgal_pref['sgal_w'] = varsettrue($qs[4], $sgal_pref['sgal_w']);
    $sgal_pref['sgal_h'] = varsettrue($qs[5], $sgal_pref['sgal_h']);    
    $syscomm = '';

    switch($sub_action) {
        case 'restrict_resize': 
                $text = "<span class='smalltxt'>".SGAL_LANRND_30." - <strong>".$sgal_pref['sgal_restrict_w']."px</strong> X <strong>".$sgal_pref['sgal_restrict_h']."px</strong></span>";
                break;
        case 'auto_resize': 
                $text = "<span class='smalltxt'>".SGAL_LANRND_31." - <strong>".$sgal_pref['sgal_w']."px</strong> X <strong>".$sgal_pref['sgal_h']."px</strong></span>";
                break;
        case 'user_resize': 
                $text = "<span class='smalltxt'>".SGAL_LANRND_31.":&nbsp;</span><input class='tbox' style='text-align:right' type='text' name='user_resize_w' value='".$sgal_pref['sgal_w']."' size='4' maxlength='4' />&nbsp;px&nbsp;&nbsp;X&nbsp;&nbsp;<input style='text-align:right' class='tbox' type='text' name='user_resize_h' value='".$sgal_pref['sgal_h']."' size='4' maxlength='4' />&nbsp;px";
                break;
        case 'crop_resize': 
                $text = "<span class='smalltxt'>Under Construction</span>";
                break;
        case 'none': 
                $text = "<span class='smalltxt'>".SGAL_LANRND_29."<strong>";
                break;
    }
//upload resize type end
} elseif($action == 'album_pics' && $sub_action) {
    $id = intval($sub_action);
    $cont = $id;
    
    if ($sql->db_Select("sgallery", "path, thsrc", "album_id='{$id}' AND sgal_user LIKE '".USERID.".%' "))
    {
        $row = $sql -> db_Fetch();
        if($row['path']) {
        
            if (!defined('ADMIN_WIDTH')) {
            	define('ADMIN_WIDTH', 'width: 95%');
            }
            if (!defined('ADMIN_EDIT_ICON'))
            {
            	define("ADMIN_EDIT_ICON", "<img src='".e_IMAGE_ABS."admin_images/edit_16.png' alt='' title='".LAN_EDIT."' style='border:0px; height:16px; width:16px' />");
            	define("ADMIN_EDIT_ICON_PATH", e_IMAGE_ABS."admin_images/edit_16.png");
            }
            if (!defined('ADMIN_DELETE_ICON'))
            {
            	define("ADMIN_DELETE_ICON", "<img src='".e_IMAGE_ABS."admin_images/delete_16.png' alt='' title='".LAN_DELETE."' style='border:0px; height:16px; width:16px' />");
            	define("ADMIN_DELETE_ICON_PATH", e_IMAGE_ABS."admin_images/delete_16.png");
            }
            
            //init render object

            
            $clrender = $sgalobj->loadObj('render_class');
            $text = $clrender -> adminImageList("{e_PLUGIN}sgallery/pics/".$row['path'],array(), $row['thsrc'], 'main,rethumb,delete,notitle', './includes/');
           
        }
    }
    if(!$text) $text = SGAL_LANRND_122;

//upload resize type end
} elseif($action == 'album_pics_approve' && $sub_action) {
    $id = intval($sub_action);
    $cont = 'app'.$id;
    
    if ($sql->db_Select("sgallery", "path, thsrc", "album_id='{$id}' AND sgal_user LIKE '".USERID.".%' "))
    {
        $row = $sql -> db_Fetch();
        if($row['path']) {
            require_once(SGAL_INCPATH."sgal_file_class.php");
            
            $fl = new sgal_file;
            
            $imagepath = SGAL_ALBUMPATH.$row['path']."/";
            $imagelist = $fl -> sgal_approve_pics($imagepath, $sgal_pref);
            
            if (!defined('ADMIN_WIDTH')) {
            	define('ADMIN_WIDTH', 'width: 95%');
            }
            if (!defined('ADMIN_EDIT_ICON'))
            {
            	define("ADMIN_EDIT_ICON", "<img src='".e_IMAGE_ABS."admin_images/edit_16.png' alt='' title='".LAN_EDIT."' style='border:0px; height:16px; width:16px' />");
            	define("ADMIN_EDIT_ICON_PATH", e_IMAGE_ABS."admin_images/edit_16.png");
            }
            if (!defined('ADMIN_DELETE_ICON'))
            {
            	define("ADMIN_DELETE_ICON", "<img src='".e_IMAGE_ABS."admin_images/delete_16.png' alt='' title='".LAN_DELETE."' style='border:0px; height:16px; width:16px' />");
            	define("ADMIN_DELETE_ICON_PATH", e_IMAGE_ABS."admin_images/delete_16.png");
            }
            
            //init render object

            if(!empty($imagelist)) {
                $clrender = $sgalobj->loadObj('render_class');
                $text = $clrender -> adminImageList("{e_PLUGIN}sgallery/pics/".$row['path'],$imagelist, $row['thsrc'], 'rethumb,delete,notitle', './includes/');
            }

        }
    }
    if(!$text) $text = SGAL_LANRND_122;
}

echo "<div id='cont_{$cont}'>".$text."</div>";

$page = ob_get_clean();
//header - IE cache issues?
$etag = md5($page);
header("Cache-Control: must-revalidate");
header("ETag: {$etag}");
header("Content-Length: ".strlen($page), true);
echo $page;
?>