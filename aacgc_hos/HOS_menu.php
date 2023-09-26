<?php

/*
####################################
#  AACGC HOS                       #
#  M@CH!N3                         #
#  admin@aacgc.com                 # 
####################################
*/



global $sc_style;


//-------------------------Menu Title--------------------------------+

$hosmenu_title .= "".$pref['hos_menutitle']."";

//-------------------------------------------------------------------+



$hosmenu_text .= "<table style='width:100%' class=''>";


$hoss = $sql -> db_Count("aacgc_hos");


$hosmenu_text .= "
<tr><td class='forumheader3'><center>Hall of Shame Total: ".$hoss."</center></td></tr>
<tr><td><center><img width='".$pref['hos_menuimgsize']."px' src='".e_PLUGIN."aacgc_hos/images/cheater.png'></img></center></td></tr>
<tr><td class='forumheader3'><center>[ <a href='".e_PLUGIN."aacgc_hos/HOS.php'> Visit HOS </a> ]<center></td></tr>
";


$hosmenu_text .= "</table>";


if ($pref['hos_enable_last'] == "1"){
$hosmenu_text .= "
<script type=\"text/javascript\">
function hosmenuup(){hosmenu.direction = \"up\";}
function hosmenudown(){hosmenu.direction = \"down\";}
function hosmenustop(){hosmenu.stop();}
function hosmenustart(){hosmenu.start();}
</script>
<marquee height='".$pref['hosmenu_height']."px' id='hosmenu' scrollamount='".$pref['hosmenu_speed']."' onMouseover='this.scrollAmount=".$pref['hosmenu_mouseoverspeed']."' onMouseout='this.scrollAmount=".$pref['hosmenu_mouseoutspeed']."' direction='up' loop='true'>
<table style='width:95%' class='indent'>";


        $sql ->db_Select("aacgc_hos", "*", "ORDER BY hos_id DESC LIMIT 0,10","");
        while($row = $sql ->db_Fetch()){

$hosmenu_text .= "<tr><td class='indent'><center><a href='".e_PLUGIN."aacgc_hos/HOS_Details.php?det.".$row['hos_id']."'>".$row['game_name']."</a></center></td></tr>";}


$hosmenu_text .= "</table></marquee>
<br>
<table style='width:100%' class=''><tr><td>
<center>
<input class=\"button\" value=\"Start\" onClick=\"hosmenustart();\" type=\"button\">
<input class=\"button\" value=\"Stop\" onClick=\"hosmenustop();\" type=\"button\">
<input class=\"button\" value=\"Up\" onClick=\"hosmenuup();\" type=\"button\">
<input class=\"button\" value=\"Down\" onClick=\"hosmenudown();\" type=\"button\">
</center>
</td></tr></table>
";}




if(ADMIN){
$hosmenu_text .= "<table style='width:100%' class=''><tr>
<td class='forumheader3'><center>
[<a href='".e_PLUGIN."aacgc_hos/New_HOS.php'> Add to HOS </a>]
</center></td></tr>
</table>
";}

if ( check_class($pref['hos_addclass']) ){
$hosmenu_text .= "<table style='width:100%' class=''><tr>
<td class='forumheader3'><center>
[<a href='".e_PLUGIN."aacgc_hos/New_HOS.php'> Add to HOS </a>]
</center></td></tr>
</table>
";}

//--------------------------------------------------------------------+



$ns -> tablerender($hosmenu_title, $hosmenu_text);


?>