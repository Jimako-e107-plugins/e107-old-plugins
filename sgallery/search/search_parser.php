<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_plugins/content/search/search_parser.php,v $
|     $Revision: 739 $
|     $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|     $Author: secretr $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

if (!defined('SGAL_INIT')) { require_once(e_PLUGIN.'sgallery/init.php'); }

// advanced 
$advanced_where = "";
if (isset($_GET['cat']) && is_numeric($_GET['cat'])) {
	$advanced_where .= " AND al.cat_id='".intval($_GET['cat'])."'";
}

$torder = false;
if (isset($_GET['time']) && is_numeric($_GET['time'])) {
	$advanced_where .= " AND al.dt ".($_GET['on'] == 'new' ? '>=' : '<=')." '".(time() - intval($_GET['time']))."'";
	$torder = true;
}

if (isset($_GET['match']) && $_GET['match']) {
	$search_fields = array('al.title');
} else {
	$search_fields = array('al.title', 'al.album_description', 'c.title', 'c.cat_description');
}

// basic
$from = SGAL_MTABLE." AS al LEFT JOIN ".MPREFIX.SGAL_CTABLE." AS c ON c.cat_id=al.cat_id"; //left join hack
$return_fields = "al.album_id, al.cat_id, al.sgal_user, al.title, c.title AS ctitle, c.cat_id AS cid, al.album_description, al.dt, al.path, al.thsrc, al.album_viewed ";

$weights = array('1.2', '0.9', '0.6', '0.6');

$no_results = LAN_198;

$where = "al.active>0 AND al.album_ustatus='1' AND c.active>0";
if(!check_class($sgal_pref['sgal_usermod_visible'])) {
    $where .= " AND al.sgal_user=''";
}
$where .= $advanced_where." AND ";

$order = $torder ? array('al.dt' => DESC, 'al.album_viewed' => DESC) : array('al.album_viewed' => DESC, 'al.dt' => DESC);

//sgal permissions
if(check_class($pref['sgal_active'])) {
    include_lan(SGAL_LAN.'.php');
    include_lan(SGAL_LAN.'_search.php');  
    require_once(SGAL_INCPATH."sgal_batch.php");
    
    if(is_readable(THEME.'sgallery_search_tmpl.php'))
        include(THEME.'sgallery_search_tmpl.php');
    else
        include(SGAL_TMPL.'sgallery_search_tmpl.php');
        
    require_once(SGAL_INCPATH."sgal_file_class.php");
    $fl = new sgal_file;
    
    $ps = $sch -> parsesearch($from, $return_fields, $search_fields, $weights, 'search_sgallery', $no_results, $where, $order);
    $text .= $ps['text'];
    $results = $ps['results'];
}




function search_sgallery($row) {
	global $con, $tp, $sgal_pref, $fl, $sgal_shortcodes, $PHPTHUMB_CONFIG, $SGAL_SEARCH_TEMPLATE, $SGAL_SEARCH_START, $SGAL_SEARCH_END;
	$res['link'] = SGAL_PATH_ABS."gallery.php?view.".$row['album_id'];
	$res['title'] = $tp->toHTML($row['title'], FALSE, "TITLE");
	
    $imagepath = SGAL_ALBUMPATH.$row['path']."/";
    $imagelist = $fl -> sgal_pics($imagepath, $sgal_pref, false);
    $row['sgal_album_files'] = count($imagelist);
	cachevars('c_sgal_item', $row);

    $res['detail'] = $tp->parseTemplate($SGAL_SEARCH_START.$SGAL_SEARCH_TEMPLATE.$SGAL_SEARCH_END, FALSE, $sgal_shortcodes);
	return $res;
}

?>