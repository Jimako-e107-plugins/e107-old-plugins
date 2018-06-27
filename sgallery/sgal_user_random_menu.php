<?php
/*
 * Corllete Lab Gallery
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * User's albums - Random/Latest pictures menu
 *
 * $Id: sgal_user_random_menu.php 1561 2011-04-21 11:07:58Z secretr $
*/
if (!defined('e107_INIT')) { exit; }
global $PHPTHUMB_CONFIG, $THCONFIG_THDEF, $tp, $sgal_pref, $pref, $SGAL_URAND_MENU, $sgalobj;

if(!check_class($pref['sgal_active']) || !check_class($sgal_pref['sgal_usermod_visible'])) {
    return '';
}

if(!defined('SGAL_PATH')) require_once('init.php');
include_lan(SGAL_LAN.'.php');

require_once(SGAL_INCPATH."sgal_file_class.php");
$fl = new sgal_file;

$text = '';

    //template
    if(!isset($SGAL_URAND_MENU) || !$SGAL_URAND_MENU) {
		if(is_readable(THEME.'templates/sgallery/sgallery_urand_tmpl.php'))
			require_once (THEME.'templates/sgallery/sgallery_urand_tmpl.php');
		else
			require_once (SGAL_TMPL.'sgallery_urand_tmpl.php');
    }

    //width, height, far
    $cfgarr['w'] = defined('SGAL_URAND_W') ? SGAL_URAND_W : $sgal_pref['sgal_thumb_w'];
    $cfgarr['h'] = defined('SGAL_URAND_H') ? SGAL_URAND_H : $sgal_pref['sgal_thumb_h'];
    $cfgarr['far'] = defined('SGAL_URAND_FAR') ? SGAL_URAND_FAR : $sgal_pref['sgal_far'];

    //number albusm to show
    if(defined('SGAL_URAND_NUM'))
        $sgalnum = intval(SGAL_URAND_NUM);
    else
        $sgalnum  = 3;
    //random order or date order?
    if(defined('SGAL_URAND'))
        $sgalorder = SGAL_URAND ? 'rand()' : 'al.dt DESC' ;
    else {
        $sgalorder  = 'rand()';
        define('SGAL_URAND', true);
    }

    //sql
    $qry = "
    SELECT al.*, alc.title AS ctitle
    FROM #sgallery AS al
    LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id
    WHERE al.active > 0 AND al.sgal_user!=''
    GROUP by al.album_id
    ORDER BY {$sgalorder}
    LIMIT 0,{$sgalnum}
    ";
    $foundimg = false;
    if($sql->db_Select_gen($qry)) {

        while($row = $sql->db_Fetch()) {

            $imagepath = SGAL_ALBUMPATH.$row['path']."/";
            $imagelist = $fl -> sgal_pics($imagepath, $sgal_pref, !SGAL_URAND);
            $images = count($imagelist);

            if($images) {
                $foundimg = true;
                $rand_key = array_rand($imagelist);
                $img = $imagelist[$rand_key]['fname'];
                //$alt = SGAL_RANDM_1.' - '.SGAL_RANDM_6;
                $alt = str_replace("'", '', ($row['ctitle'] ? $row['ctitle'].' - ' : '').$row['title']);
                $udata = explode('.', $row['sgal_user']);
                $IMAGE = "<img src='".showThumb($row['path']."/".$img, $cfgarr)."' alt='".$alt."' style='border: 0px none; vertical-align: middle;' />";
                $IMAGE_OPEN = "<a href='".SGAL_ALBUMPATH_ABS.$row['path'].'/'.$img."' class='lightview' rel='gallery_upr' onclick=\"sgalSmartOpen('".showJsThumb($row['path'].'/'.$img, $alt)."'); return false;\" title='".$alt."'>{$IMAGE}</a>";
                $ALBUM_TITLE = $tp->toHTML($row['title'], FALSE, 'parse_sc,no_hook,emotes_off, no_make_clickable');
                $ALBUM_HREFTITLE = SGAL_PATH_ABS."gallery.php?uview.".$row['album_id'];
                $ALBUM_LINK = "<a href='{$ALBUM_HREFTITLE}'>{$ALBUM_TITLE}</a>";
                $ALBUM_ULINK = SGAL_RANDM_10." <a href='".SGAL_PATH_ABS."gallery.php?ulist.".$udata[0]."'>{$udata[1]}</a>";
                $IMAGE_COUNT = $images;

                $text .= preg_replace("/\{(.*?)\}/e", '$\1', $SGAL_URAND_MENU);
            }
        }
    }

$title = SGAL_URAND ? SGAL_RANDM_9 : SGAL_RANDM_9a;
if($text)
    $ns -> tablerender($title, $text, 'clGallery');
?>