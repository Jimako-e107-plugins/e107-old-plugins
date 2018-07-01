<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Member Of the Month       #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/





require_once("../../class2.php");
require_once(HEADERF);



$title .= "Member Of The Month List";

$text .= "<table style='width:60%' class=''>
          <tr>
          <td class='' colspan=2><center><img width='500px' src='".e_PLUGIN."aacgc_motm/images/MOM.png'></img></center></td>
          </tr>
          <tr>
          <td style='width:50%' class='fcaption'>Month</td>
          <td style='width:50%' class='fcaption'>Member Name</td>
          </tr>";

if ($pref['motm_enable_gold'] == "1"){
 $gold_obj = new gold();}

 $sql->db_Select("aacgc_motm", "*", "ORDER BY motm_id ASC","");
 while($row = $sql->db_Fetch()){
 $sql2 = new db;
 $sql2->db_Select("user", "*", "user_id='".intval($row['motm_user'])."'");
 $row2 = $sql2->db_Fetch();

if ($pref['motm_enable_gold'] == "1"){
$userorb = " ".$gold_obj->show_orb($row2['user_id'])." ";}
else
{$userorb = "".$row2['user_name']."";}


$text .= "<tr>
          <td style='width:50%' class='indent'>".$row['month'].", ".$row['year']."</td>
          <td style='width:50%' class='indent'><a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$userorb."</a></td>
          </tr>";}



$text .= "</table>";




//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_motm/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+

$ns -> tablerender($title, $text);

require_once(FOOTERF);



?>

