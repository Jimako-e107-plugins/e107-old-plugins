<?php
/*
 * Corllete Lab Gallery
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Shortcode Batch File
 *
 * $Id: sgal_batch.php 1218 2010-11-12 12:56:00Z sonice $
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
$sgal_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);
/*
SC_BEGIN SGAL_GAL_TITLE
global $tp;
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
return $tp -> toHTML($sgal_item['ctitle'], FALSE, 'TITLE');
SC_END

SC_BEGIN SGAL_GAL_DESCRIPTION
global $tp;
$sgal_item = getcachedvars('c_sgal_item');
$parms = $parm ? explode('%%',$parm) : array(); // truncate char number| pre | post | 
$trn = varsettrue($parms[0], 0);
if($trn) {
$ret = $tp -> toHTML($sgal_item['cat_description'], TRUE, 'DESCRIPTION');
return varset($parms[1], '').sgal_utf8_html_truncate($ret, intval($trn), "...").varset($parms[2], '');
}
$ret = $tp -> toHTML($sgal_item['cat_description'], TRUE, 'DESCRIPTION');
return $ret ? trim(varset($parms[1], '')).$ret.trim(varsettrue($parms[2], '')) : '';
SC_END

SC_BEGIN SGAL_GAL_MAINIMG_LINK
global $tp, $sgal_pref, $THCONFIG_THDEF;
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
if($param['action'] != 'glist')
    return '';
    
$parms = $parm ? explode('%%',$parm) : array(); 
$tmp = $parms[0] ? explode(',',$parms[0]) : array();
$cfg['w'] = varsettrue($tmp[0], 0) ? $tmp[0] : $sgal_pref['sgal_thgal_w'];
$cfg['h'] = varsettrue($tmp[1], 0) ? $tmp[1] : $sgal_pref['sgal_thgal_h'];
$cfg['far'] = varsettrue($tmp[2], 0) ? $tmp[2] : $sgal_pref['sgal_far'];
$cfg['q'] = varsettrue($tmp[3], 0) ? $tmp[3] : 80;

$nopic = varsettrue($parms[1], '');
if($sgal_item['thsrc'])
    $link = "<a href='".SGAL_PATH_ABS."gallery.php?list.".$sgal_item['cid'].".".$param['cpage']."' title='".$tp->toHTML($sgal_item['ctitle'], FALSE, 'parse_sc,no_hook,emotes_off, no_make_clickable, value')."'><img src='".showThumb($sgal_item['path']."/".$sgal_item['thsrc'], $cfg)."' alt='".$tp->toHTML($sgal_item['ctitle'], FALSE, 'parse_sc,no_hook,emotes_off, no_make_clickable, value')."' style='border: 0px none; vertical-align: middle;' /></a>";
else 
    $link = "<a href='".SGAL_PATH_ABS."gallery.php?list.".$sgal_item['cid'].".".$param['cpage']."' title='".$tp->toHTML($sgal_item['ctitle'], FALSE, 'parse_sc,no_hook,emotes_off, no_make_clickable, value')."'><img src='".showThumb(($nopic ? makeURL(THEME."images/").$nopic : makeURL("{e_PLUGIN}sgallery/images/").'gallery_120.png'), $cfg, 'relative')."' alt='' style='border: 0px none;' /></a>";
return $link;
SC_END

SC_BEGIN SGAL_GAL_LINK
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
$tmp = SGAL_PATH_ABS.'gallery.php?list.'.$sgal_item['cid'].($param['cpage'] ? '.'.$param['cpage'] : '');
return $tmp;
SC_END

SC_BEGIN SGAL_GALROW_W
$param = getcachedvars('c_sgal_param');
if($param['action'] != 'glist')
    return '';
return $param['sgal_galrow_w'];
SC_END

SC_BEGIN SGAL_GAL_ALBUMCNT
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
if($param['action'] != 'glist')
    return '';
return $sgal_item['al_count'];
SC_END

SC_BEGIN SGAL_GAL_PICCNT
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
if($param['action'] != 'glist')
    return '';
return ($sgal_item['sgal_gal_piccnt'] ? $sgal_item['sgal_gal_piccnt'] : n/a);
SC_END

SC_BEGIN SGAL_GAL_VIEWCNT
$sgal_item = getcachedvars('c_sgal_item');
return ($sgal_item['cat_viewed'] ? $sgal_item['cat_viewed'] : 0);
SC_END

SC_BEGIN SGAL_ITEM_ADMINEDIT
global $sql;
if(!ADMIN) return '';
$pid = getcachedvars('c_sgal_pid');
if(!$pid) {
    if($sql->db_Select('plugin', 'plugin_id', "plugin_path = 'sgallery' ")) {
		$row=$sql->db_Fetch();
		$pid='P'.$row[0];
		cachevars('c_sgal_pid', $pid);
    }
}
if(!$pid || !getperms($pid)) return '';
$parms = $parm ? explode('%%',$parm) : array(); // action(gallery or album) | pre | post | title
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
$act = varsettrue($parms[0], '');
if(!$act) varsettrue($param['action'], 'glist');
$q = $act != 'glist' && $act != 'gallery' ? "main.edit.{$sgal_item['album_id']}.0": "category.edit.{$sgal_item['cid']}";
return trim(varset($parms[1], ''))."<a href='".SGAL_PATH_ABS."admin_config.php?{$q}' title='".SGAL_LAN_14."'>".varsettrue($parms[3], SGAL_LAN_14)."</a>".trim(varset($parms[2], ''));
SC_END

SC_BEGIN SGAL_ITEM_USEREDIT
global $sgal_pref;
$sgal_item = getcachedvars('c_sgal_item');
if(!USER || !$sgal_item['sgal_user'] || !check_class($sgal_pref['sgal_usermod_allow'])) return '';
$parms = $parm ? explode('%%',$parm) : array(); // pre | post | title
$param = getcachedvars('c_sgal_param');
$ud = explode('.', $sgal_item['sgal_user']);
if(!USERID || !$ud[0] || USERID != intval($ud[0])) return '';
return trim(varset($parms[0], ''))."<a href='".SGAL_PATH_ABS."mygallery.php?edit.{$sgal_item['album_id']}'>".varsettrue($parms[2], SGAL_LAN_19)."</a>".trim(varset($parms[1], ''));
SC_END

SC_BEGIN SGAL_ITEM_USERCREATE
global $sgal_pref;
$sgal_item = getcachedvars('c_sgal_item');

if(!USER || !check_class($sgal_pref['sgal_usermod_allow']) || !check_class($sgal_pref['sgal_usermod_albumcreate']) ) return '';
$parms = $parm ? explode('%%',$parm) : array(); // pre | post | title
$ud = explode('.', $sgal_item['sgal_user']);

return trim(varset($parms[0], ''))."<a href='".SGAL_PATH_ABS."mygallery.php?create'>".varsettrue($parms[2], SGAL_LAN_21)."</a>".trim(varset($parms[1], ''));
SC_END

SC_BEGIN SGAL_GAL_UALBUMSLINK
global $sgal_pref;
//1. my|USERID|empty==all   2. pre string 3. post string  4.title - text or html source
$parms = explode('%%', $parm);
if($parms[0] == 'my') {
    if(!USER) return '';
    if(!USER || !check_class($sgal_pref['sgal_usermod_allow'])) return '';
    $id = USERID;
    $ttl = varsettrue($parms[3], SGAL_LAN_18);
} elseif($parms[0] && is_numeric($parms[0])) {
    if(!check_class($sgal_pref['sgal_usermod_visible']) ) return '';
    $id = intval($parms[0]);
    $ttl = varsettrue($parms[3], SGAL_LAN_17);
} else {
    if(!check_class($sgal_pref['sgal_usermod_visible'])) return '';
    $ttl = varsettrue($parms[3], SGAL_LAN_16);
    $id = '0';
}
$ret = trim(varset($parms[1], ''))."<a href='".SGAL_PATH_ABS."gallery.php?ulist.{$id}.1'>".$ttl."</a>".trim(varset($parms[2], ''));
return $ret;
SC_END

SC_BEGIN SGAL_USER_UALBUMSLINK
global $tp, $sgal_shortcodes;
$sgal_item = getcachedvars('c_sgal_item');
if(!$sgal_item['sgal_user']) return '';
$parms = $parm ? explode('%%',$parm) : array(); // pre | post | title - text or html source
$ud = explode('.', $sgal_item['sgal_user']);
$ret = $tp -> parseTemplate('{SGAL_GAL_UALBUMSLINK='.$ud[0].'%% %% %%'.varsettrue($parms[2], '').'}', FALSE, $sgal_shortcodes);
return $ret ? trim(varset($parms[0], '')).$ret.trim(varset($parms[1], '')) : '';
SC_END

SC_BEGIN SGAL_ALBUM_ID
$sgal_item = getcachedvars('c_sgal_item');
if(!$sgal_item)
    return '0';
return $sgal_item['album_id'];
SC_END

SC_BEGIN SGAL_ALBUM_TITLE
global $tp;
$sgal_item = getcachedvars('c_sgal_item');
if(!$sgal_item['title'])
    return '';
return $tp -> toHTML($sgal_item['title'], FALSE, 'TITLE');
SC_END

SC_BEGIN SGAL_ALBUM_DESCRIPTION
global $tp;
$sgal_item = getcachedvars('c_sgal_item');
$parms = $parm ? explode('%%',$parm) : array(); // truncate char number| pre | post | 
$trn = varsettrue($parms[0], 0);
if($trn) {
$ret = $tp -> toHTML($sgal_item['album_description'], TRUE, 'DESCRIPTION');
return varset($parms[1], '').sgal_utf8_html_truncate($ret, intval($trn), "...").varset($parms[2], '');
}
$ret = $tp -> toHTML($sgal_item['album_description'], TRUE, 'DESCRIPTION');
return $ret ? trim(varset($parms[1], '')).$ret.trim(varset($parms[2], '')) : ($parms['3'] ? $parms['3'] : '');
SC_END

SC_BEGIN SGAL_ALBUM_RATING
global $rater,$sgal_pref;
$sgal_item = getcachedvars('c_sgal_item');
$parms = $parm ? explode('%%',$parm) : array(); // truncate char number| pre | post | 
$rate = "";
if(check_class($sgal_pref['sgal_album_rating']) && !(ANON == TRUE && USER == FALSE) )
{
	if(!is_object($rater)){ 
	    require_once(e_HANDLER."rate_class.php");
        $rater = new rater; 
    }
	$rate = $rater -> composerating('sgallery', $sgal_item['album_id'], true, false, false);
}
return $rate ? trim(varset($parms[0], '')).$rate.trim(varset($parms[1], '')) : '';
SC_END

SC_BEGIN SGAL_ALBUMVIEW_DESCRIPTION
global $tp;
$sgal_item = getcachedvars('c_sgal_item');
return $tp -> toHTML($sgal_item['album_description'], TRUE, 'DESCRIPTION');
SC_END

SC_BEGIN SGAL_GALINFO
global $tp;
$sgal_item = getcachedvars('c_sgal_item');
return $sgal_item['sgal_galinfo'];
SC_END

SC_BEGIN SGAL_ALBUM_USERDATA
global $sgal_pref, $tp;
$sgal_item = getcachedvars('c_sgal_item');

if(!$sgal_item['sgal_user']) return '';
$parms= $parm ? explode('%%', $parm) : array('','','');
$tmp = explode('.', $sgal_item['sgal_user']);
if($tmp[0])
{
	$udata = get_user_data($tmp[0]);
	$uname = $udata['user_login'] ? $tp->toHTML($udata['user_login'], TRUE, "no_make_clickable") : ($udata['user_name'] ? $tp->toHTML($udata['user_name'], TRUE, "no_make_clickable") : $tmp[1]);
}
else $uname = varset($tmp[1], 'n/a');

if(!$tmp[0] || !check_class($sgal_pref['sgal_usermod_visible'])) return '';
if(!$parms[0]) $parms[0] = 'plain'; //available parms - id|profile|albums|plain - default plain
switch($parms[0]) {
    case 'profile': $ret = "<a href='".SITEURL."user.php?id.{$tmp[0]}'>{$uname}</a>";
        break;
    case 'albums': $ret = "<a href='".SGAL_PATH_ABS."gallery.php?ulist.{$tmp[0]}'>{$uname}</a>";
        break;
    case 'id': $ret = $tmp[0];
        break;
    default: $ret = $tmp[1];
} 
return trim(varset($parms[1], '')).$ret.trim(varset($parms[2], ''));
SC_END

SC_BEGIN SGAL_ALBUM_DATE
global $con;
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
if(!$sgal_item['dt'])
    return '';
if(!$con) $con = new convert;
return  $con -> convert_date($sgal_item['dt'], $parm ? $parm : 'short');
SC_END

SC_BEGIN SGAL_ALBUM_LINK
global $tp;
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
if($parm) {
    $act = $parm;
} else {
    if($param['action'] == 'list' || $param['action'] == 'view') $act = 'view';
    elseif($param['action'] == 'ulist' || $param['action'] == 'uview') $act = 'uview';
    else return '';
}
if(!$sgal_item['album_id']) return SGAL_PATH_ABS.'gallery.php';
return $tmp = SGAL_PATH_ABS.'gallery.php?'.$act.'.'.$sgal_item['album_id'].'.'.$param['cpage'];
SC_END

SC_BEGIN SGAL_ALBUM_MAINIMG
global $tp, $sgal_pref, $THCONFIG_THDEF;
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
$parms = $parm ? explode('|',$parm) : array(); 
$tmp = $parms[0] ? explode(',',$parms[0]) : array();
$cfg['w'] = varsettrue($tmp[0], 0) ? $tmp[0] : $sgal_pref['sgal_thalbum_w'];
$cfg['h'] = varsettrue($tmp[1], 0) ? $tmp[1] : $sgal_pref['sgal_thalbum_h'];
$cfg['far'] = varsettrue($tmp[2], 0) ? $tmp[2] : $sgal_pref['sgal_far'];
$cfg['q'] = varsettrue($tmp[3], 0) ? $tmp[3] : 80;
$nopic = varsettrue($parms[1], '');
if($sgal_item['path'] && $sgal_item['thsrc'] && is_readable(SGAL_ALBUMPATH.$sgal_item['path'].'/'.$sgal_item['thsrc'])){
    $imgpath = $sgal_item['path'].'/'.$sgal_item['thsrc'];
    $alt = str_replace(array('<', '>', '"', '&', "'"), array('&lt;', '&gt;', '&quot;', '&amp;', '&#039;'), $tp->toHTML($sgal_item['title'], FALSE, 'TITLE'));
    $return = "<img src='".showThumb($imgpath, $cfg)."' alt='{$alt}' style='border: 0px none; vertical-align: middle;' />";
} else {
    $return = "<img src='".showThumb(($nopic ? makeURL(THEME."images/").$nopic : makeURL("{e_PLUGIN}sgallery/images/").'gallery_120.png'), $cfg, 'relative')."' alt='' style='border: 0px none;' />";
}
return $return;
SC_END

SC_BEGIN SGAL_ALBUM_MAINIMG_NAME
$sgal_item = getcachedvars('c_sgal_item');
return ($sgal_item ? $sgal_item['thsrc'] : $parm);
SC_END

SC_BEGIN SGAL_ALBUM_MAINIMG_OPENLINK
global $THCONFIG_THDEF, $tp, $sgal_shortcodes;
$sgal_item = getcachedvars('c_sgal_item');
$alt = $tp->toHTML($sgal_item['title'], FALSE, 'TITLE');
$alt = str_replace(array('<', '>', '"', '&', "'"), array('&lt;', '&gt;', '&quot;', '&amp;', '&#039;'), $alt);
$img = $tp->parseTemplate("{SGAL_ALBUM_MAINIMG=".$parm."}", FALSE, $sgal_shortcodes);
$url = $sgal_item['thsrc'] ? SGAL_PATH_ABS."pics/".$sgal_item['path']."/".$sgal_item['thsrc'] : '#';
return "<a href='".$url."' title='".$alt."' rel='shadowbox'>{$img}</a>";
SC_END

SC_BEGIN SGAL_ALBUM_MAINIMG_LINK
global $THCONFIG_THDEF, $tp, $sgal_shortcodes;
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
if(!$sgal_item['album_id']) return '';
if($param['action'] == 'list' || $param['action'] == 'view') $act = 'view';
elseif($param['action'] == 'ulist' || $param['action'] == 'uview') $act = 'uview';
else $act = 'view';
$img = $tp->parseTemplate("{SGAL_ALBUM_MAINIMG=".$parm."}", FALSE, $sgal_shortcodes);
$alt = $tp->toHTML($sgal_item['title'], FALSE, 'TITLE');
$alt = str_replace(array('<', '>', '"', '&', "'"), array('&lt;', '&gt;', '&quot;', '&amp;', '&#039;'), $alt);
$return = "<a href='".SGAL_PATH_ABS."gallery.php?{$act}.".$sgal_item['album_id'].".".$param['cpage'].".".$param['imgpage']."' title='".$alt."'>{$img}</a>";
return $return;
SC_END

SC_BEGIN SGAL_ALBUM_FILES
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
return $sgal_item['sgal_album_files'] ? $sgal_item['sgal_album_files'] : '0';
SC_END

SC_BEGIN SGAL_ALBUM_VIEWCNT
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
return ($sgal_item['album_viewed'] ? $sgal_item['album_viewed'] : 0);
SC_END

SC_BEGIN SGAL_USER_ALSTATUS
$sgal_item = getcachedvars('c_sgal_item');
if(!varset($sgal_item['album_id'], 0)) return trim(varset($parms[0], '')).SGAL_NA.trim(varset($parms[1], ''));
$parms = $parm ? explode('%%', $parm) : array('','','');
if($sgal_item['album_ustatus']) {
    if($sgal_item['active']) $stat = SGAL_LAN_22;
    else $stat = SGAL_LAN_23a;
} else $stat = SGAL_LAN_23;
return trim(varset($parms[0], '')).$stat.trim(varset($parms[1], ''));
SC_END

SC_BEGIN SGAL_USER_ALPREFNUMBER
global $sgal_pref;
return $sgal_pref['sgal_usermod_albumcount'] ? $sgal_pref['sgal_usermod_albumcount'] : SGAL_LAN_24; 
SC_END

SC_BEGIN SGAL_USER_ALBUMNUMBER
global $tp, $sgal_shortcodes;
$sgal_useritem = getcachedvars('sgal_useritem');
if(!$sgal_useritem) {
    $tp->parseTemplate('{SGAL_USER_MYSTATS}', FALSE, $sgal_shortcodes);
    $sgal_useritem = getcachedvars('sgal_useritem');
}
return $sgal_useritem['sgal_user_albumnumber'];
SC_END

SC_BEGIN SGAL_USER_PICPREFNUMBER
global $sgal_pref;
return $sgal_pref['sgal_usermod_piccount'] ? $sgal_pref['sgal_usermod_piccount'] : SGAL_LAN_24; 
SC_END

SC_BEGIN SGAL_USER_ALPICNUMBER
global $tp, $sgal_shortcodes;
$sgal_item = getcachedvars('c_sgal_item');
$aid = $sgal_item['album_id'];
$sgal_useritem = getcachedvars('sgal_useritem_'.USERID);
if(!varsettrue($sgal_useritem[$aid], '')) {
    $tp->parseTemplate('{SGAL_USER_MYSTATS}', FALSE, $sgal_shortcodes);
    $sgal_useritem = getcachedvars('sgal_useritem_'.USERID);
}
return $sgal_useritem[$aid]['sgal_user_alpicnumber'] ? $sgal_useritem[$aid]['sgal_user_alpicnumber'] : 0;
SC_END

SC_BEGIN SGAL_USER_ALPICSIZE
global $tp, $sgal_shortcodes;
$sgal_item = getcachedvars('c_sgal_item');
$aid = $sgal_item['album_id'];
$sgal_useritem = getcachedvars('sgal_useritem_'.USERID);
if(!varsettrue($sgal_useritem[$aid], '')) {
    $tp->parseTemplate('{SGAL_USER_MYSTATS}', FALSE, $sgal_shortcodes);
    $sgal_useritem = getcachedvars('sgal_useritem_'.USERID);
}

return sgal_convsize($sgal_useritem[$aid]['sgal_user_alpicsize'], '0 kb'); 
SC_END

SC_BEGIN SGAL_USER_TOTALPICSIZE
global $tp, $sgal_shortcodes;
$sgal_useritem = getcachedvars('sgal_useritem');
if(!$sgal_useritem) {
    $tp->parseTemplate('{SGAL_USER_MYSTATS}', FALSE, $sgal_shortcodes);
    $sgal_useritem = getcachedvars('sgal_useritem');
}
return sgal_convsize($sgal_useritem['sgal_user_totalpicsize'], '0 kb'); 
SC_END

SC_BEGIN SGAL_USER_MYSTATS
global $sql, $sgal_pref, $_fl;
//PRIVATE!!!
if($parm) $id = intval($parm);
else {
    if(!USER) return '';
    $id = USERID;
}

$sgal_myuseritem = getcachedvars('sgal_useritem_'.$id);
$sgal_useritem = getcachedvars('sgal_useritem');
if(!$sgal_useritem || !$sgal_myuseritem) {
    $sgal_useritem = array();
    $sgal_myuseritem = array();
    $sgal_useritem['sgal_user_totalpicsize'] = 0;
    $sgal_useritem['sgal_user_albumnumber'] = 0;
    if($sql -> db_Select("sgallery", "album_id, path", " sgal_user LIKE '".$id.".%'"))
    {
        while ($row = $sql->db_Fetch()) {
            $sgal_useritem['sgal_user_albumnumber']++;
            if(!$row['path']) continue;
            $aid = $row['album_id'];
            $imagepath = SGAL_ALBUMPATH.$row['path']."/";
            $sgal_myuseritem[$aid]['sgal_user_alpicsize'] = sgal_dirsize($imagepath);
            $sgal_useritem['sgal_user_totalpicsize'] += $sgal_myuseritem[$aid]['sgal_user_alpicsize'];
            if(!$_fl) {
                require_once(SGAL_INCPATH."sgal_file_class.php");
                $_fl = new sgal_file;
            }
            $tmp = $_fl -> sgal_pics($imagepath, $sgal_pref, false);
            $tmp = $tmp && is_array($tmp)  ? count($tmp) : 0;
            $sgal_myuseritem[$aid]['sgal_user_alpicnumber'] =  $tmp;
            
            $tmp = $_fl -> sgal_approve_pics($imagepath, $sgal_pref, false);
            $tmp = $tmp && is_array($tmp)  ? count($tmp) : 0;
            $sgal_myuseritem[$aid]['sgal_user_alawpicnumber'] = $tmp;
            unset($tmp);
        }
    }
    cachevars("sgal_useritem_{$id}", $sgal_myuseritem);
    cachevars('sgal_useritem', $sgal_useritem);
}  
return ''; 
SC_END

SC_BEGIN SGAL_USER_ALAWPICNUMBER
global $tp, $sgal_shortcodes;
$sgal_item = getcachedvars('c_sgal_item');
$aid = $sgal_item['album_id'];
$sgal_useritem = getcachedvars('sgal_useritem_'.USERID);
if(!varset($sgal_useritem[$aid], '')) {
    $tp->parseTemplate('{SGAL_USER_MYSTATS}', FALSE, $sgal_shortcodes);
    $sgal_useritem = getcachedvars('sgal_useritem_'.USERID);
}
return varset($sgal_useritem[$aid]['sgal_user_alawpicnumber'], '0'); 
SC_END

SC_BEGIN SGAL_USER_ALPREFSIZE
global $sgal_pref;
return sgal_convsize($sgal_pref['sgal_usermod_albumsize'], SGAL_LAN_24); 
SC_END

SC_BEGIN SGAL_USER_TOTALPREFSIZE
global $sgal_pref;
return sgal_convsize($sgal_pref['sgal_usermod_totalsize'], SGAL_LAN_24); 
SC_END

SC_BEGIN SGAL_CATEGORY_BOX
global $sql, $sgal_pref, $tp;
$sgal_catbox = getcachedvars('sgal_catbox');
$sgal_item = getcachedvars('c_sgal_item');
$parms = $parm ? explode('%%', $parm) : array('','');
$uid = 0;
$catid = varset($sgal_item['cat_id'], 0);
if(!check_class($sgal_pref['sgal_usermod_galleries'])) return varsettrue($parms[0], '') ? trim(varsettrue($parms[1])).$parms[0].trim(varsettrue($parms[2])) : '';
if(!$sgal_catbox) {
    $sgal_catbox = array();
    $sgal_catbox[0] = SGAL_NONE;
    if($sql -> db_Select("sgallery_cats", "cat_id, title as ctitle", "active>0 ORDER BY cat_order ASC")) {
        while ($row = $sql->db_Fetch()) {
        	$cid = $row['cat_id'];
            $sgal_catbox[$cid] = $row['ctitle'];
        }
        cachevars('sgal_catbox', $sgal_catbox);
    }
}
$multi = $parms[3] ? " size='15' width='40' style='width: 100%;'" : '';

$ret = "<select class='tbox sgal-catbox' id='sgal_catbox' name='cat_id'{$multi}>\n";
foreach ($sgal_catbox as $cid=>$ttl) {
    $selected = $cid == $catid ? " selected='selected'" : '';
	$ret .= "<option value='{$cid}'".$selected.">".$tp->toHTML($ttl, FALSE, 'TITLE')."</option>\n";
}
$ret .= "</select>";
return trim(varsettrue($parms[1])).$ret.trim(varsettrue($parms[2]));
SC_END

SC_BEGIN SGAL_BREADC
$param = getcachedvars('c_sgal_param');
if(isset($param['sgal_breadc']))
    return $param['sgal_breadc'];
return '';
SC_END

SC_BEGIN SGAL_ALBUM_W
$param = getcachedvars('c_sgal_param');
if($param['action'] != 'list' && $param['action'] != 'ulist')
    return '';
return $param['sgal_album_w'];
SC_END

SC_BEGIN THIMG_MAX_WH
$param = getcachedvars('c_sgal_param');
if($parm) $param['max_wh'] = $param['max_wh'] + intval($parm);
return $param['max_wh'];
SC_END

SC_BEGIN SGAL_ALBUM_IMGNAME
$sgal_imgitem = getcachedvars('c_sgal_imgitem');
if(!$sgal_imgitem) return '';
return $sgal_imgitem['fname'];
SC_END

SC_BEGIN SGAL_ALBUM_FOLDER
$sgal_item = getcachedvars('c_sgal_item');
if(!$sgal_item) return '';
return $sgal_item['path'];
SC_END

SC_BEGIN SGAL_ALBUM_IMGLINK
global $tp, $sgal_pref, $THCONFIG_THDEF;
//1. thumb parameters (width,height,FAR,quality)  2. no picture theme image file name - will look at THEME.'images/'.parm[1]

$sgal_item = getcachedvars('c_sgal_item');
$sgal_imgitem = getcachedvars('c_sgal_imgitem');
$param = getcachedvars('c_sgal_param');
$parms = $parm ? explode('%%',$parm) : array(); 
$tmp = $parms[0] ? explode(',',$parms[0]) : array();
$cfg['w'] = varsettrue($tmp[0], 0) ? $tmp[0] : $sgal_pref['sgal_thumb_w'];
$cfg['h'] = varsettrue($tmp[1], 0) ? $tmp[1] : $sgal_pref['sgal_thumb_h'];
$cfg['far'] = varsettrue($tmp[2], 0) ? $tmp[2] : $sgal_pref['sgal_far'];
$cfg['q'] = varsettrue($tmp[3], 0) ? $tmp[3] : 80;
$nopic = varsettrue($parms[1], '');
$src = varsettrue($parms[2], '');

$alt = str_replace("'", '', ($sgal_item['ctitle'] ? $sgal_item['ctitle'].' - ' : '').$sgal_item['title']); 
if($sgal_item['path'] && $sgal_imgitem['fname'] && is_readable(SGAL_ALBUMPATH.$sgal_item['path'].'/'.$sgal_imgitem['fname'])){
    $imgpath = $sgal_item['path'].'/'.$sgal_imgitem['fname'];
    $return = $src ?  showThumb($imgpath, $cfg) : "<a href='".SGAL_ALBUMPATH_ABS.$sgal_item['path'].'/'.$sgal_imgitem['fname']."' class='lightview' rel='gallery_{$sgal_item['album_id']}' onclick=\"sgalSmartOpen('".showJsThumb($sgal_item['path'].'/'.$sgal_imgitem['fname'], $alt)."'); return false;\" title='".$alt."'>"
        ."<img src='".showThumb($imgpath, $cfg)."' alt='{$alt}' style='border: 0px none; vertical-align: middle;' /></a>";
} else {
    $return = $src ? (showThumb(($nopic ? makeURL("{THEME}images/").$nopic : makeURL("{e_PLUGIN}sgallery/images/").'gallery_120.png'), $cfg, 'relative')) : "<img src='".showThumb(($nopic ? makeURL("{THEME}images/").$nopic : makeURL("{e_PLUGIN}sgallery/images/").'gallery_120.png'), $cfg, 'relative')."' alt='' style='border: 0px none;' />";
}
return $return;
SC_END

SC_BEGIN SGAL_ALBUM_IMGTABLE
global $THCONFIG_THDEF, $SGALLERY_ALBUM_IMAGE, $tp, $sgal_shortcodes;
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');

if($param['action'] != 'view' && $param['action'] != 'uview')
    return '';

return $tp->parseTemplate($SGALLERY_ALBUM_IMAGE, FALSE, $sgal_shortcodes);
SC_END

SC_BEGIN SGAL_VIEW_W
$param = getcachedvars('c_sgal_param');
if($param['action'] != 'view' && $param['action'] != 'uview')
    return '';
return $param['sgal_view_w'];
SC_END

SC_BEGIN SGAL_ALBUM_LATEST_LINK
$param = getcachedvars('c_sgal_param');
return varsettrue($param['sgal_latest_pictureslink'], '');
SC_END

SC_BEGIN SGAL_ALBUM_DATE_DAY
global $con;
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
if(!$sgal_item['dt'])
    return '';
return strftime('%d', $sgal_item['dt']) ;
SC_END

SC_BEGIN SGAL_ALBUM_DATE_MONTH
global $con;
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
if(!$sgal_item['dt'])
    return '';
return strftime('%m', $sgal_item['dt']) ;
SC_END

SC_BEGIN SGAL_ALBUM_DATE_YEAR
global $con;
$sgal_item = getcachedvars('c_sgal_item');
$param = getcachedvars('c_sgal_param');
if(!$sgal_item['dt'])
    return '';
return strftime('%Y', $sgal_item['dt']) ;
SC_END
*/
?>