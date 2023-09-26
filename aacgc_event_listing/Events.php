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

$title .= "".$pref['el_pagetitle'].""; 

//---------------------------------------------------------------------------------

if(ADMIN){
$text .= "<table style='width:100%' class=''><tr>
<td><center>
[<a href='".e_PLUGIN."aacgc_event_listing/New_Event.php'> Add Event </a>]
</center></td></tr>
</table>
";}
else if ( check_class($pref['el_autoaddclass']) ){
$text .= "<table style='width:100%' class=''><tr>
<td><center>
[<a href='".e_PLUGIN."aacgc_event_listing/New_Event.php'> Add Event </a>]
</center></td></tr>
</table>
";}




        $sql ->db_Select("aacgc_event_listing", "*", "ORDER BY ".$pref['el_event_order']." ASC","");
        while($row = $sql->db_Fetch()){

if ($row['event_cost'] == "")
{$cost = "";}
else
{$cost = "<tr>
          <td class='indent'>Cost: ".$row['event_cost']."</td>
          </tr>";}
     

$text .= "<table style='width:100%' class='indent'><br>";


$text .= "<tr>   
          <td style='width:30%' class='indent' rowspan=4><center><font size='3'>".$row['event_name']."</font></center></td>
          <td style='width:40%' class='indent'>Location: ".$row['event_locatiom']."</td>
          <td style='width:30%' class='indent' rowspan=4><center>
          [<a href='".e_PLUGIN."aacgc_event_listing/Event_Details.php?det.".$row['event_id']."'> More Details </a>]
          <br><br>
          [<a href='".e_PLUGIN."aacgc_event_listing/Join_Event.php?det.".$row['event_id']."'> Join Event </a>]
          </td>
          </tr>";

$text .= "".$cost."";

$text .= "<tr>
          <td class='indent'>Date: ".$row['event_date']."</td>
          </tr><tr>
          <td class='indent'>Host: ".$row['event_host']."</td>
          </tr>";


$text .= "</tr></table><br>";}






//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_event_listing/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+





$ns -> tablerender($title, $text);



//----------------------------------------------------------------------------------

require_once(FOOTERF);


