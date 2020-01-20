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
|
|        In this page I included a rating script from:
|        ryan masuga, masugadesign.com
|        ryan@masugadesign.com
|        Licensed under a Creative Commons Attribution 3.0 License.
|        http://creativecommons.org/licenses/by/3.0/
|        See readme.txt for full credit details.
|
+---------------------------------------------------------------+
*/

function rating_bar($id,$units='',$static='') { 

require_once("../../class2.php");
require_once("./ytm_rating_conf.php");

$query01  = "SELECT ytm_rate_class FROM ".MPREFIX."er_ytm_gallery WHERE id = '1'";
$result01 = mysql_query($query01);
while ($row01 = mysql_fetch_array($result01,MYSQL_ASSOC)) {
$ytm_rate_class            = $row01['ytm_rate_class'];
}

//set some variables
$ip = $_SERVER['REMOTE_ADDR'];
if (!$units) {$units = 10;}
if (!$static) {$static = FALSE;}

// get votes, values, ips for the current rating bar
$query=mysql_query("SELECT total_votes, total_value, used_ips FROM $rating_dbname.$rating_tableName WHERE id='$id' ")or die(" Error: ".mysql_error());


// insert the id in the DB if it doesn't exist already
// see: http://www.masugadesign.com/the-lab/scripts/unobtrusive-ajax-star-rating-bar/#comment-121
if (mysql_num_rows($query) == 0) {
$sql = "INSERT INTO $rating_dbname.$rating_tableName (`id`,`total_votes`, `total_value`, `used_ips`) VALUES ('$id', '0', '0', '')";
$result = mysql_query($sql);
}

$numbers=mysql_fetch_assoc($query);


if ($numbers['total_votes'] < 1) {
	$count = 0;
} else {
	$count=$numbers['total_votes']; //how many votes total
}
$current_rating=$numbers['total_value']; //total number of rating added together and stored
$tense=($count==1) ? "". LAN_YTM_RATE ."" : "". LAN_YTM_RATE_0 .""; //plural form votes/vote

// determine whether the user has voted, so we know how to draw the ul/li
$voted=mysql_num_rows(mysql_query("SELECT used_ips FROM $rating_dbname.$rating_tableName WHERE used_ips LIKE '%".$ip."%' AND id='".$id."' ")); 

// now draw the rating bar
$rating_width = @number_format($current_rating/$count,2)*$rating_unitwidth;
$rating1 = @number_format($current_rating/$count,1);
$rating2 = @number_format($current_rating/$count,2);


if ($static == 'static') {

		$static_rater = array();
		$static_rater[] .= "\n".'<div class="ratingblock">';
		$static_rater[] .= '<div id="unit_long'.$id.'">';
		$static_rater[] .= '<ul id="unit_ul'.$id.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;">';
		$static_rater[] .= '<li class="current-rating" style="width:'.$rating_width.'px;">'. LAN_YTM_RATE_1 .' '.$rating2.'/'.$units.'</li>';
		$static_rater[] .= '</ul>';
		$static_rater[] .= '<p class="static">'.LAN_YTM_RATE_2.': <strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.')</p>';
		$static_rater[] .= '</div>';
		$static_rater[] .= '</div>'."\n\n";

		return join("\n", $static_rater);


} else {

      $rater ='';
      $rater.='<div class="ratingblock">';

      $rater.='<div id="unit_long'.$id.'">';
      $rater.='  <ul id="unit_ul'.$id.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;">';
      $rater.='     <li class="current-rating" style="width:'.$rating_width.'px;"></li>';

$aut_set = "0";

      for ($ncount = 1; $ncount <= $units; $ncount++) { // loop from 1 to the number of units

      if(check_class($ytm_rate_class)) {

      $aut_set = "1";

           if(!$voted) { // if the user hasn't yet voted, draw the voting stars
              $rater.='<li><a href="db.php?j='.$ncount.'&amp;q='.$id.'&amp;t='.$ip.'&amp;c='.$units.'" title="'.$ncount.' '. LAN_YTM_RATE_3 .' '.$units.'" class="r'.$ncount.'-unit rater" rel="nofollow">'.$ncount.'</a></li>';
           }

      }

      }
      $ncount=0; // resets the count

      $ytm_vote_msg = '<br />'.LAN_YTM_RATE_8.'';
      
      $rater.='  </ul>';
      $rater.='<center>';
      if($voted){ $ytm_vote_msg = '<br />'.LAN_YTM_RATE_7.'';}
      if ($aut_set == "0") {$ytm_vote_msg = '<br />'. LAN_YTM_RATE_9 .'';}
      $rater.=''.LAN_YTM_RATE_2.': <strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.')'.$ytm_vote_msg.'';
      $rater.='</center>';
      $rater.='</div>';
      $rater.='</div>';
      return $rater;
 }
}
?>
