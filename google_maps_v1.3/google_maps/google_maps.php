<?php
/*

===============================================================
   GOOGLE Maps - v1.3 - by keithschm
   www.keithschmitt.com
keithschm AT GMAIL DOT COM

Map Class from   www.phpinsider.com  ported for use on E107
===============================================================
+---------------------------------------------------------------+
|        e107 website system
|        Easy Admin Page by Cameron. (www.e107coders.org)
|        a part of Your_plugin v3.1  multilanguage by Juan  Reseau.li
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|		 Suitable only for e107 v0.7
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."google_maps/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."google_maps/languages/English.php");
 require('GoogleMapAPI.class.php');

// ============= START OF THE BODY ====================================



//get config info
$sql -> db_Select("google_maps", "*", "map_id='1'");
while($row = $sql-> db_Fetch()){
        extract($row);
     }
//end get config



//start new map
$map = new GoogleMapAPI('map');


// set Google Map Key
$map->setAPIKey($map_api);


//Get info from Database
$sql -> db_Select_gen("SELECT #user.user_id, #user.user_name,  #user.user_email, #user.user_forums, #user.user_join, #user.user_lastvisit, #user.user_image, #user_extended.user_location FROM #user LEFT JOIN #user_extended ON #user_extended.user_extended_id = #user.user_id where #user.user_class='".$map_class."' or #user.user_class regexp '^".$map_class.",' or #user.user_class regexp ',".$map_class.",' or #user.user_class regexp ',".$map_class."'");

while($row = $sql-> db_Fetch()){


//label vars
$address = $row['user_location'];
$title = $row['user_name'];
$html = '<b>';
$html .= $row['user_name'];
$html .= '</b><br />';
$html .= $row['user_location'];
$html .= '<br />';

if ($map_email == 1) {
$html .= $row['user_email'];
$html .= '<br />';
}

if ($map_posts == 1) {
$html .= '<b>Total Posts:</b> ';
$html .= $row['user_forums'];
$html .= '<br />';
}

if ($map_member_since == 1) {
$gen = new convert;
$member_since = $gen->convert_date($row['user_join'], "long");
$html .= '<b>Member Since:</b> ';
$html .= $member_since;
$html .= '<br />';
}
if ($map_lastseen == 1) {
$gen2 = new convert;
$last_seen = $gen2->convert_date($row['user_lastvisit'], "long");
$html .= '<b>Last Seen:</b> ';
$html .= $last_seen;
$html .= '<br />';

if ($map_avatar == 1) {
$image = $row['user_image'];
if ($image != '') {
$html .= '<img src =';
$html .= $image;
$html .= '>';
}
}

}//end while





//add map points
$map->addMarkerByAddress($address, $title, $html);
}

?>

<!--Dump the map-->
<?php $map->printHeaderJS(); ?>
    <?php $map->printMapJS(); ?>
    <!-- necessary for google maps polyline drawing in IE -->
    <style type="text/css">
      v\:* {
        behavior:url(#default#VML);
      }
    </style>

   <SCRIPT LANGUAGE="JavaScript" TYPE="TEXT/JAVASCRIPT">
   	<!--

   	window.onload=onLoad;

   	//-->
   	</SCRIPT>

    <table border=1>
    <tr><td>
    <?php $map->printMap(); ?>
    </td><td>
    <?php $map->printSidebar(); ?>
    </td></tr>
    </table>
  <!--End Dump the map-->


<?php
// ========= End of the BODY ===================================================
// use FOOTERF for USER PAGES and e_ADMIN."footer.php" for Admin pages.
// Utiliser FOOTERF pour des PAGES UTILISATEUR et e_ADMIN. "footer.php" pour pages d'Admin.
require_once(FOOTERF);
?>
