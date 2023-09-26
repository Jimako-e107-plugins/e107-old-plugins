<?php

/*
####################################
#  AACGC Attendance List           #
#  M@CH!N3 admin@aacgc.com         # 
####################################
*/



global $sc_style;


//-------------------------Menu Title--------------------------------+

$elmenu_title .= "".$pref['elmenu_title']."";

//-------------------------------------------------------------------+




if ($pref['el_enable_scroll'] == "1"){
$elmenu_text .= "<marquee height='".$pref['elmenu_height']."px' scrollamount='".$pref['elmenu_speed']."' onMouseover='this.scrollAmount=".$pref['elmenu_mouseoverspeed']."' onMouseout='this.scrollAmount=".$pref['elmenu_mouseoutspeed']."' direction='up' loop='true'>";}

$elmenu_text .= "<table style='width:100%' class=''>";


$order = "".$pref['el_event_order']."";



        $sql ->db_Select("aacgc_event_listing", "*", "ORDER BY ".$pref['el_event_order']."","");
        while($row = $sql ->db_Fetch()){

$elmenu_text .= "
<tr>
<td class='indent'><a href='".e_PLUGIN."aacgc_event_listing/Event_Details.php?det.".$row['event_id']."'><font size='".$pref['elmenu_eventfsize']."'>".$row['event_name']."</font><br>(".$row['event_date'].")</a><br><br>[<a href='".e_PLUGIN."aacgc_event_listing/Join_Event.php?det.".$row['event_id']."'> Join Event </a>]</td>
</tr>";}



$elmenu_text .= "</table>";


if ($pref['el_enable_scroll'] == "1"){
$elmenu_text .= "</marquee>";}


$sql3 = new db;
$sql3->db_Select("user", "*", "user_id='".USERID."'");
$row3 = $sql3->db_Fetch();

if(ADMIN){
$elmenu_text .= "<table style='width:100%' class=''><tr>
<td><center>
[<a href='".e_PLUGIN."aacgc_event_listing/New_Event.php'> Add Event </a>]
</center></td></tr>
</table>
";}
else if ($row3['user_class'] == "".$pref['el_addclass'].""){
$elmenu_text .= "<table style='width:100%' class=''><tr>
<td><center>
[<a href='".e_PLUGIN."aacgc_event_listing/New_Event.php'> Add Event </a>]
</center></td></tr>
</table>
";}


//--------------------------------------------------------------------+



$ns -> tablerender($elmenu_title, $elmenu_text);


?>