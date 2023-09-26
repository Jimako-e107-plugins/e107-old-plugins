<?php

/*
#######################################
#     AACGC HOS                       #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


require_once("../../class2.php");
require_once(HEADERF);



//---------------------------------------------------------------------------------

$title .= "".$pref['hos_pagetitle'].""; 

//---------------------------------------------------------------------------------

if(ADMIN){
$text .= "<table style='width:100%' class=''><tr>
<td><center>
[<a href='".e_PLUGIN."aacgc_hos/New_HOS.php'> Add to HOS </a>]
</center><br></td></tr>
</table>
";}


if ( check_class($pref['hos_addclass']) ){
$text .= "<table style='width:100%' class=''><tr>
<td><center>
[<a href='".e_PLUGIN."aacgc_hos/New_HOS.php'> Add to HOS </a>]
</center><br></td></tr>
</table>
";}


//---------------------------------------------------------------------------------


$text .= "<center><table style='width:90%' class='indent'>
<tr>
<td style='filter:glow(color=#".$pref['hos_logosfcolor'].", strength=8)' colspan=3 class=''><center>
<font size='8' color='#".$pref['hos_logofcolor']."'><b><u><i>HALL OF SHAME</i></u></b></font>
</center></td>
</tr><tr>
<td colspan=3 class=''><center>
<img src='".e_PLUGIN."aacgc_hos/images/cheater.png'></img>
</center></td>
</tr><tr>
<td colspan=3 class='indent'><center>
<font size='".$pref['hos_detfsize']."'>".$pref['hos_details']."</font>
</center><br><br></td></tr>";

$n = "0";
        $sql ->db_Select("aacgc_hos", "*", "ORDER BY hos_id ASC","");
        while($row = $sql->db_Fetch()){
$n++;
        



$text .= "<tr>
<td style='width:0%' class=''><center>".$n.".</center></td>  
<td class='forumheader3'><center>".$row['game_name']."</center></td>  
<td style='width:30%' class='forumheader3'><center>[<a href='".e_PLUGIN."aacgc_hos/HOS_Details.php?det.".$row['hos_id']."'> View Details </a>]</center></td> 
</tr>";}


$text .= "</table></center>";






//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_hos/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='#808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+




$ns -> tablerender($title, $text);



//----------------------------------------------------------------------------------

require_once(FOOTERF);


