<?php

/*
#######################################
#     AACGC Event Listing             #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


require_once("../../class2.php");
require_once(HEADERF);



//---------------------------------------------------------------------------------

$title .= "".$pref['aacgc_bt_pagetitle'].""; 

//---------------------------------------------------------------------------------

$text .= "<table style='width:100%' class=''>
          <tr><td><center><font size='".$pref['aacgc_bt_headerfs']."'><b><u>".$pref['aacgc_bt_header']."</u></b></font></center></td></tr>
          <tr><td><center><font size='".$pref['aacgc_bt_introfs']."'>".$pref['aacgc_bt_intro']."</font></center></td></tr>
          </table><br><br>";

$text .= "<br><br><table style='width:100%' class=''>";



$sql->db_Select("aacgc_bt_cat", "*", "ORDER BY cat_id ASC","");
while($row = $sql->db_Fetch()){

$text .= "<tr><td class='forumheader3'><center><a href='".e_PLUGIN."aacgc_btracker/Bracket_Details.php?det.".$row['cat_id']."'><font size='".$pref['aacgc_bt_catfs']."'>".$row['cat_name']."</font></a></center></td></tr>";}




$text .= "</table>";



//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_btracker/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+





$ns -> tablerender($title, $text);



//----------------------------------------------------------------------------------

require_once(FOOTERF);


