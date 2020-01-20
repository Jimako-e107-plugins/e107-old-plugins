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

$lan_file = e_PLUGIN."ytm_gallery/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."ytm_gallery/languages/English.php");

if(file_exists(THEME."images/bullet2.gif"))
	{
		$bullet = "<img src='".THEME_ABS."images/bullet2.gif' alt='bullet' style='vertical-align: middle;' />";
	}
	else
	{
		$bullet = "";
	}

$query  = "
SELECT title_rating, title_tp FROM ".MPREFIX."er_ytm_gallery WHERE id = '1'";

$result = mysql_query($query);

while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
$rate_title_menu        = $row['title_rating'];
$rate_title_tp          = $row['title_tp'];
}

$query02  = "
SELECT movie_code, movie_title, total_votes, total_value, id, ROUND(total_value / total_votes, 2) as average FROM ".MPREFIX."er_ytm_gallery_rating rt
LEFT JOIN ".MPREFIX."er_ytm_gallery_movies rm ON rt.id = rm.movie_code
WHERE active = '1' AND total_votes > '0' ORDER BY average DESC
";

$result02 = mysql_query($query02);


$r_i = 1;

while ($row02 = mysql_fetch_array($result02,MYSQL_ASSOC)) {

      if ($r_i > 10) {break;}
      

$total_votes        = $row02['total_votes'];
$total_value        = $row02['total_value'];
$movie_avg          = $row02['average'];
$rate_title         = $row02['movie_title'];
$rate_code          = $row02['movie_code'];

$title_rate_info    = "" . LAN_YTM_RATING_MENU_0 . ": $movie_avg - " . LAN_YTM_RATING_MENU_1 . " $total_votes " . LAN_YTM_RATING_MENU_2 . "";

$rate_title_count = strlen($rate_title);

if ($rate_title_count > 20) {

$rate_title = substr($rate_title,"0",17);
$rate_title = "$rate_title...";

                      }

$rate_text .= "$bullet <a href='".e_PLUGIN."ytm_gallery/ytm.php?view=$rate_code' title='$title_rate_info'>$rate_title</a><br />";
$r_i++;
}

if ($r_i == 1) {

$rate_text .= "" . LAN_YTM_RATING_MENU . "<br />";

              }

$rate_text .= "<br /><center><a href='".e_PLUGIN."ytm_gallery/ytm_top_page.php'>" . LAN_YTM_RATE_15 . " $rate_title_tp</a></center>";

$ns -> tablerender($rate_title_menu, $rate_text);
?>
