<?php
/*
 * Corllete Lab Gallery
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Random Album Menu
 *
 * $Id: sgal_multirand_menu.php 1561 2011-04-21 11:07:58Z secretr $
*/
if (!defined('e107_INIT')) { exit; }
global $PHPTHUMB_CONFIG, $THCONFIG_THDEF, $tp, $sgal_pref, $pref, $MRAND_MENU_LOOP, $sgalobj;

if(!check_class($pref['sgal_active'])) {
    return '';
}

if(!defined('SGAL_PATH')) require_once('init.php');
include_lan(SGAL_LAN.'.php');

require_once(SGAL_INCPATH."sgal_file_class.php");
$fl = new sgal_file;

$text = '';

    //template
    if(!isset($MRAND_MENU_LOOP) || !$MRAND_MENU_LOOP) {
		if(is_readable(THEME.'templates/sgallery/sgallery_multirand_tmpl.php'))
			require_once (THEME.'templates/sgallery/sgallery_multirand_tmpl.php');
		else
			require_once (SGAL_TMPL.'sgallery_multirand_tmpl.php');
    }

    if(!isset($sgal_pref['sgal_rand_multinum']) || !$sgal_pref['sgal_rand_multinum'])
        $sgal_pref['sgal_rand_multinum'] = 3;


    //number albusm to show
    if(defined('SGAL_RAND_MULTINUM'))
        $sgalnum = intval(SGAL_RAND_MULTINUM);
    else
        $sgalnum  = $sgal_pref['sgal_rand_multinum'];
    //random order or date order?
    if(defined('SGAL_RAND'))
        $sgalorder = SGAL_RAND ? 'rand()' : 'al.dt DESC' ;
    else {
        $sgalorder  = 'rand()';
        define('SGAL_RAND', true);
    }

    //width, height, far
    $cfgarr['w'] = defined('SGAL_RAND_W') ? SGAL_RAND_W : $sgal_pref['sgal_thumb_w'];
    $cfgarr['h'] = defined('SGAL_RAND_H') ? SGAL_RAND_H : $sgal_pref['sgal_thumb_h'];
    $cfgarr['far'] = defined('SGAL_RAND_FAR') ? SGAL_RAND_FAR : $sgal_pref['sgal_far'];


    $where = '';
    if(!check_class($sgal_pref['sgal_usermod_visible'])) {
        $where = " AND al.sgal_user=''";
    }

    //sql
    $qry = "
    SELECT al.*, alc.title AS ctitle
    FROM #sgallery AS al
    LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id
    WHERE al.active > 0 AND alc.active > 0{$where}
    GROUP by al.album_id
    ORDER BY {$sgalorder}
    LIMIT {$sgalnum}
    ";

    $foundimg = false;
    if($sql->db_Select_gen($qry)) {

        while($row = $sql->db_Fetch()) {
            $imagepath = SGAL_ALBUMPATH.$row['path']."/";
            $imagelist = $fl -> sgal_pics($imagepath, $sgal_pref, !SGAL_RAND);
            $images = count($imagelist);

            if($images) {
                $foundimg = true;
                $rand_key = array_rand($imagelist);
                $img = (defined('SGAL_RAND_SHOW_MAIN_PIC') && SGAL_RAND_SHOW_MAIN_PIC) ? $row['thsrc'] : $imagelist[$rand_key]['fname'];
                //$alt = SGAL_RANDM_1.' - '.SGAL_RANDM_6;
                $alt = str_replace("'", '', ($row['ctitle'] ? $row['ctitle'].' - ' : '').$row['title']);
                $IMAGE = "<img src='".showThumb($row['path']."/".$img, $cfgarr)."' alt='".$alt."' style='border: 0px none; vertical-align: middle;' />";
                $IMAGE_OPEN = "<a href='".SGAL_ALBUMPATH_ABS.$row['path'].'/'.$img."' class='lightview' rel='gallery_ar' onclick=\"sgalSmartOpen('".showJsThumb($row['path'].'/'.$img, $alt)."'); return false;\" title='".$alt."'>{$IMAGE}</a>";
                $ALBUM_TITLE = $tp->toHTML($row['title'], FALSE, 'parse_sc,no_hook,emotes_off, no_make_clickable');
                $ALBUM_HREFTITLE = SGAL_PATH_ABS."gallery.php?view.".$row['album_id'].".1.1";
                $ALBUM_LINK = "<a href='{$ALBUM_HREFTITLE}'>{$ALBUM_TITLE}</a>";
                $IMAGE_COUNT = $images;

                $text .= preg_replace("/\{(.*?)\}/e", '$\1', $MRAND_MENU_LOOP);

            }

        }
        if(!$foundimg) $text = "";

    }

$title = SGAL_RAND ? SGAL_RANDM_8 : SGAL_RANDM_3;
if($text)
    $ns -> tablerender($title, $text, 'clGallery_mrand');
?>
