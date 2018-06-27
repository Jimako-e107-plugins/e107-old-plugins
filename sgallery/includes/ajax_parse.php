<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|       Ajax Parser: e107_plugins/sgallery/includes/ajax_parse.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 741 $
|        $Date: 2008-04-23 14:31:38 +0300 (Wed, 23 Apr 2008) $
|        $Author: secretr $
|	Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
require_once('../../../class2.php');
header("Content-Type: text/html; charset=".CHARSET);

if(!ADMIN) { exit; }
if(!getperms("P")){ exit; }

//plugin defs
require_once('../init.php');


include_lan(SGAL_LAN.'_render.php');
//get (sub) actions
$qs = (e_QUERY ? explode(".", e_QUERY) : array());

$action = varset($qs[0], '');
$sub_action = varset($qs[1], '');
$id = varset($qs[2], '');
//actions start -------------------------------------------------->
$cont = '';
$text = '';
//upload resize type start
if($action == 'up_type') {
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
    include_lan(SGAL_LAN.'_admin.php');
    $id = intval($sub_action);
    $cont = $id;
    
    if ($sql->db_Select("sgallery", "path, album_description", "album_id='{$id}'"))
    {
        $row = $sql -> db_Fetch();
        if($row['path']) {
            require_once(SGAL_INCPATH."sgal_file_class.php");
            
            $fl = new sgal_file;
            
            $imagepath = SGAL_ALBUMPATH.$row['path']."/";
        
            $imagelist = $fl -> sgal_pics($imagepath, $sgal_pref);
        
            $thumbs = '';
            
            foreach($imagelist as $img){
                 if(!is_file($imagepath.$img['fname'])) {
                      continue;
                 }
                 $cfg = array();
                 $cfg['w'] = 40;
                 $cfg['h'] = 30;
                 $cfg['far'] = 'C';
                 $cfg['bg'] = $sgal_pref['sgal_bg'];
                 $cfg['fltr'][] = 'bord|1|0|0|C0C0C0';
                 $url = makeURL("{e_PLUGIN}sgallery/pics/".$row['path'].'/'.$img['fname']);
                 $thumbpath = makeURL($imagepath);
                 $text .= "<div style='float: left; margin: 0px 3px'><a href='".SGAL_ALBUMPATH_ABS.$row['path']."/{$img['fname']}' class='lightview' rel='gallery_{$id}' title='{$img['fname']}' onclick=\"sgalSmartOpen('".showJsThumb($thumbpath.$img['fname'], $img['fname'].': '.SGAL_LANADM_36, 'relative')."', 1, this); return false;\"><img src='".showThumb($url, $cfg, 'relative', "./includes/")."' alt='".$img['fname']."' style='border: 0px none;' /></a></div>";
            }
        }
    }
    if(!$text) $text = SGAL_LANADM_50;
    $text .= $row['album_description'] ? "<div style='clear: both; padding-top: 10px;'><strong>".SGAL_LANADM_14a.":</strong> ".$tp -> toHtml($row['album_description'], TRUE, 'DESCRIPTION,emotes_off')."</div>" : '';
} //upload resize type end
elseif($action == 'album_editpics' && $sub_action) {
    $id = intval($sub_action);
    $cont = $id;
    include_lan(SGAL_LAN.'_admin.php');
    if ($sql->db_Select("sgallery", "path,thsrc", "album_id='{$id}'"))
    {
        $row = $sql -> db_Fetch();
        if($row['path']) {
        
            //admin compat
            include_lan(e_LANGUAGEDIR.e_LANGUAGE.'/admin/lan_admin.php');
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
            $text = $clrender -> adminImageList("{e_PLUGIN}sgallery/pics/".$row['path'],array(), $row['thsrc'], 'all', './includes/');
           
        }
    }
    if(!$text) $text = SGAL_LANADM_50;
}
elseif($action == 'album_approve' && $sub_action) {

    $id = intval($id);
    $cont = 'app'.$id;
    include_lan(SGAL_LAN.'_admin.php');
    include_lan(SGAL_LAN.'.php'); //should be manager lan - TO DO
    if ($sql->db_Select("sgallery", "*", "album_id='{$id}'"))
    {
        $row = $sql -> db_Fetch();
        
        if($sub_action == 'edit') {
            $text = "<div style='clear: both; padding: 5px 0px; text-align: center'><strong>".SGAL_LANADM_56."</strong></div>";
        }
        
        $tmp = explode('.', $row['sgal_user']);
        $uid = varsettrue($tmp[0], 0);
        $uname = varsettrue($tmp[1], 'n/a');
        
        //shortcodes
        require_once(SGAL_INCPATH."sgal_batch.php");
        cachevars('c_sgal_item', $row);
        
        //load user stats
        $tp->parseTemplate('{SGAL_USER_MYSTATS='.$uid.'}', FALSE, $sgal_shortcodes); 
        
        $tstats = getcachedvars('sgal_useritem');
        $tmp = getcachedvars('sgal_useritem_'.USERID);
        $alstats = $tmp[$id];
        unset($tmp);
        
        $template = "
            <table cellpadding='2' cellspacing='3' style='padding: 10px'>
            <tr>
                <td colspan='3'>
                    <strong>".SGAL_LANADM_57." ({$uname} #{$uid}):</strong>
                </td>
            </tr>
            <tr>
                <td style='padding: 5px; vertical-align: top'>
                    <span style='text-decoration: underline;'>".SGAL_LANMNG_29."</span><br />
                    ".SGAL_LANMNG_30.": <em>{SGAL_USER_ALSTATUS}</em><br />
                    ".SGAL_LANMNG_31.": <em>{SGAL_USER_ALPREFSIZE}</em><br />
                    ".SGAL_LANMNG_32.": <em>{SGAL_USER_ALPICSIZE}</em>
                </td>
                <td style='padding: 5px; vertical-align: top'>
                    <span style='text-decoration: underline;'>".SGAL_LANMNG_33."</span><br />
                    ".SGAL_LANMNG_34.": <em>{SGAL_USER_PICPREFNUMBER}</em><br />
                    ".SGAL_LANMNG_35.": <em>{SGAL_USER_ALPICNUMBER}</em><br />
                    ".SGAL_LANMNG_36.": <em>{SGAL_USER_ALAWPICNUMBER}</em><br />
                </td>
                <td style='padding: 5px; vertical-align: top'>
                    <span style='text-decoration: underline;'>".SGAL_LANMNG_37."</span><br />
                    ".SGAL_LANMNG_31.": <em>{SGAL_USER_TOTALPREFSIZE}</em><br />
                    ".SGAL_LANMNG_32.": <em>{SGAL_USER_TOTALPICSIZE}</em><br />
                    ".SGAL_LANMNG_38.": <em>{SGAL_USER_ALPREFNUMBER}</em><br />
                    ".SGAL_LANMNG_39.": <em>{SGAL_USER_ALBUMNUMBER}</em><br />
                </td>
            </tr>
            </table>

            <div style='clear: both;'><!-- --></div>
        ";
        //print_a($tstats);print_a($alstats);
        $text .= $tp->parseTemplate($template,FALSE,$sgal_shortcodes);
        
        if($row['path']) {
            require_once(SGAL_INCPATH."sgal_file_class.php");
            
            $fl = new sgal_file;
            
            $imagepath = SGAL_ALBUMPATH.$row['path']."/";
        
            $imagelist = $fl -> sgal_approve_pics($imagepath, $sgal_pref);

            //admin compat
            include_lan(e_LANGUAGEDIR.e_LANGUAGE.'/admin/lan_admin.php');
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
            
            if(!empty($imagelist)) {
                //init render object
                $opt = $sub_action == 'edit' ? 'delete' : 'empty' ; 
                
                $clrender = $sgalobj->loadObj('render_class');
                $text .= $clrender -> adminImageList("{e_PLUGIN}sgallery/pics/".$row['path'], $imagelist, $row['thsrc'], $opt, './includes/');
            }
        }
        if(!$text) $text = SGAL_LANADM_50;
        $text .= $row['album_description'] && $sub_action == 'view' ? "<div style='clear: both; padding-top: 10px;'><strong>".SGAL_LANADM_14a.":</strong> ".$tp -> toHtml($row['album_description'], TRUE, 'DESCRIPTION,emotes_off')."</div>" : '';
    }

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