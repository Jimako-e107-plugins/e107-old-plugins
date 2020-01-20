<?php
/*
+---------------------------------------------------------------+
|        YouTube Gallery v4.01 - by Erich Radstake
|        http://www.erichradstake.nl
|        info@erichradstake.nl
|
|        This is a module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(e_HANDLER."userclass_class.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."ytm_gallery/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."ytm_gallery/languages/English.php");
require_once("./plugin.php");
require_once("./ytm_rating_conf.php");

// Check if plugin isn't in upgrade modus
$query20  = "SELECT plugin_version FROM ".MPREFIX."plugin WHERE plugin_path = 'ytm_gallery'";
$result20 = mysql_query($query20);
while ($row20 = mysql_fetch_array($result20,MYSQL_ASSOC)) {
$inst_version = $row20['plugin_version'];
}

if ($inst_version <> $eplug_version){
$text .="<center>";
$text .="<img src='". e_IMAGE_ABS . "admin_images/nopreview.png' border='0' /><br />";
$text .= LAN_YTM_PAGE_26;
$text .="</center>";

   $ns->tablerender(LAN_YTM_PAGE_25, $text);
   require_once(FOOTERF);

   exit();

}else{

$query01  = "SELECT disp_rate, title_tp FROM ".MPREFIX."er_ytm_gallery WHERE id = '1'";
$result01 = mysql_query($query01);
while ($row01 = mysql_fetch_array($result01,MYSQL_ASSOC)) {
$ytm_rate_disp    = $row01['disp_rate'];
$ytm_title_tp     = $row01['title_tp'];
}

if (!$ytm_rate_disp == "1") {

$text .= LAN_YTM_RATE_14;


   $ns->tablerender($ytm_title_tp, $text);
   require_once(FOOTERF);

   exit();
   
}else{

$text .= "" . LAN_YTM_RATE_11 . " <a href = '".e_PLUGIN."ytm_gallery/ytm.php'>" . LAN_YTM_RATE_12 . "</a> " . LAN_YTM_RATE_13 . "<br /><br />";




            $classes02 = e_CLASS_REGEXP;
            $classes02 = str_replace("(^|,)(", "", $classes02);
            $classes02 = str_replace(")(,|$)", "", $classes02);
            $classes02 = (explode("|",$classes02));


            $qspec02_i = 0;
            foreach($classes02 as $class02) {
            $qspec02 = $class02;
            if (!$qspec02_i == 0) {$pre_qspecq02 = "OR";}
            $qspecq02 .= "$pre_qspecq02 cat_auth = '$qspec02' ";
            $qspec02_i++;
            }
            $auth_spec02 .=  "($qspecq02)";

$query02  = "SELECT cat_id, cat_auth, cat_name FROM ".MPREFIX."er_ytm_gallery_category WHERE $auth_spec02 ORDER BY cat_name ASC";

$result02 = mysql_query($query02);

while ($row02 = mysql_fetch_array($result02,MYSQL_ASSOC)) {


$rate_cat_name        = $row02['cat_name'];
$rate_cat_id          = $row02['cat_id'];

$text .= "<b>$rate_cat_name</b><br />";

$query03  = "
SELECT movie_code, movie_title, movie_category, cat_id, total_votes, total_value, id, ROUND(total_value / total_votes, 2) as average FROM ".MPREFIX."er_ytm_gallery_rating rt
LEFT JOIN ".MPREFIX."er_ytm_gallery_movies rm ON rt.id = rm.movie_code
LEFT JOIN ".MPREFIX."er_ytm_gallery_category rc ON rm.movie_category = rc.cat_id
WHERE rc.cat_id = '$rate_cat_id' AND active = '1' AND total_votes > '0' ORDER BY average DESC
";

$result03 = mysql_query($query03);

$tpr_i = 1;

while ($row03 = mysql_fetch_array($result03,MYSQL_ASSOC)) {
$total_votes_p        = $row03['total_votes'];
$total_value_p        = $row03['total_value'];
$movie_avg_p          = $row03['average'];
$rate_title_p         = $row03['movie_title'];
$rate_code_p          = $row03['movie_code'];

      if ($tpr_i > 20) {break;}
      
      if ($tpr_i < 10) {$tpr_i_show = "0$tpr_i";}else{$tpr_i_show = $tpr_i;}

$text .= "$tpr_i_show - <a href='".e_PLUGIN."ytm_gallery/ytm.php?view=$rate_code_p&toppage=on'>$rate_title_p</a> <b>$movie_avg_p</b><br />";


$tpr_i++;
}

if ($tpr_i == 1) {

$text .= "" . LAN_YTM_RATING_MENU . "<br />";

              }

$text .= "<br />";
}



   $ns->tablerender($ytm_title_tp , $text);
   require_once(FOOTERF);
}
}
?>
