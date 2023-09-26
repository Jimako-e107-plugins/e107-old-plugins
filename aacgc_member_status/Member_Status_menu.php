<?php

if (e_PAGE != "Member_Status_List.php"){

include_lan(e_PLUGIN."aacgc_member_status/languages/".e_LANGUAGE.".php");

/*
#######################################
#     e107 website system plguin      #
#     AACGC Member Status             #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

global $tp;

//-------------------------# BB Code Support #---------------------------+

include(e_HANDLER."ren_help.php");

//-----------------------------------------------------------------------+

if ($pref['ms_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

//-------------------------Menu Title--------------------------------+

$msmenu_title .= "".MS_12."";

//-------------------------------------------------------------------+

if ($pref['ms_enable_gold'] == "1")
{$gold_obj = new gold();}


if(USER){

        $datestamp = time();
        $sql ->db_Select("aacgc_member_status", "*", "status_user='".USERID."'");
        $row = $sql ->db_Fetch();

        if ($row['status_text'] == ""){

//----------------------------------# Create Status #----------------------------------+

        if ($_POST['add_status'] == '1') {
        $newuser = $tp->toDB($_POST['status_user']);
        $newstatus = $tp->toDB($_POST['status_text']);
        $newdate = $tp->toDB($_POST['status_date']);
        $sql->db_Insert("aacgc_member_status", "NULL, '".$newuser."', '".$newstatus."', '".$newdate."'") or die(mysql_error());}


$msmenu_text .= "<form method='POST' action='".e_PLUGIN."aacgc_member_status/Member_Status_List.php'>";


$msmenu_text .= "
        <table style='width:80%' class='".$themea."' cellspacing='0' cellpadding='0'>
        <tr>
        <td class='".$themea."'>".MS_04.":</td>
        </tr>
        <tr>
        <td class='forumheader3'>
        <input type='hidden' name='status_user' value='".USERID."'>
        <input type='hidden' name='status_date' value='".$datestamp."'>";

if ($pref['ms_enable_bbcode'] == "1"){
$msmenu_text .= "<textarea class='tbox' style='width:".$pref['ms_inputwidth']."px; height:".$pref['ms_inputheight']."px; overflow:hidden' name='status_text' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";
$msmenu_text .= display_help('helpb', 'forum');}
else
{$msmenu_text .= "<textarea class='tbox' style='width:".$pref['ms_inputwidth']."px; height:".$pref['ms_inputheight']."px; overflow:hidden' name='status_text'></textarea>";}
  

$msmenu_text .= "</td>
        </tr>
	<tr>
        <td style='text-align:center' class=''><br>
	<input type='hidden' name='add_status' value='1'>
	<input class='button' type='submit' value='".MS_05."'>
	</td>
        </tr>
</table>
</form>";}


//----------------------------------# Delete Status #----------------------------------+

else
{

        if ($_POST['main_delete']) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
        $sql2->db_Delete("aacgc_member_status", "status_id='".$delete_id[0]."'");}


$msmenu_text .= "<form method='POST' action='".e_PLUGIN."aacgc_member_status/Member_Status_List.php'>";



$msmenu_text .= "
        <table style='width:95%' class='".$themea."' cellspacing='0' cellpadding='0'>
        <tr>
        <td class='".$themea."'>".MS_07.":</td>
        </tr>
        <tr>
        <td class='".$themea."'>".$tp -> toHTML($row['status_text'], TRUE)."</td>
	</tr><tr>
        <td style='text-align:center' class=''><br>
        <input type='hidden' name='main_delete[".$row['status_id']."]'>
        <input class='button' type='submit' value='Delete'>
	</td>
        </tr></table>";

$msmenu_text .= "</form>";}
}
else
{$msmenu_text .= "<i>".MS_08."</i>";}



//---------------------------------------------# Member Status List #----------------------------------------------------

if ($pref['msmenu_enable_members'] == "1"){

$msmenu_text .= "<br><br><center><b><u>".MS_01."</u>:</b></center>";

if ($pref['ms_enable_autoscroll'] == "1")
{$order = "ASC";
$msmenu_text .= "
<script type=\"text/javascript\">
function msmenuup(){msmenu.direction = \"up\";}
function msmenudown(){msmenu.direction = \"down\";}
function msmenustop(){msmenu.stop();}
function msmenustart(){msmenu.start();}
</script>
<marquee height='".$pref['msmenu_height']."px' id='msmenu' scrollamount='".$pref['msmenu_speed']."' onMouseover='this.scrollAmount=".$pref['msmenu_mouseoverspeed']."' onMouseout='this.scrollAmount=".$pref['msmenu_mouseoutspeed']."' direction='down' loop='true'>";}
else
{$order = "DESC";
$msmenu_text .= "<div style='border : 0; padding : 0px; width : auto; height : ".$pref['msmenu_height']."px; overflow : auto; '>";}

if ($pref['msmenu_enable_avatar'] == "1"){
$cols = "2";}
else
{$cols = "";}

$msmenu_text .= "<table style='width:100%' class=''>";


        $sql ->db_Select("aacgc_member_status", "*", "ORDER BY status_id ".$order."", "");
        while($row = $sql ->db_Fetch()){
        $sql2 = new db;
        $sql2 ->db_Select("user", "*", "user_id='".intval($row['status_user'])."'");
        $row2 = $sql2 ->db_Fetch();

        if ($pref['ms_enable_gold'] == "1")
        {$userorb = "".$gold_obj->show_orb($row2['user_id'])."";}
        else
        {$userorb = "".$row2['user_name']."";}

$msmenu_text .= "<tr>";

        if ($pref['msmenu_enable_avatar'] == "1"){
        if ($row2['user_image'] == "")
        {$avatar = "";}
        else
        {$useravatar = $row2[user_image];
        require_once(e_HANDLER."avatar_handler.php");
        $useravatar = avatar($useravatar);
        $avatar = "<img src='".$useravatar."' width=".$pref['msmenu_avatar_size']."px></img>";}
$msmenu_text .= "<td style='width:0%' class='forumheader3'><a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$avatar."</td>";}

        $gen = new convert;
        $updated = $gen -> computeLapse($row['status_date'], false, false, true, 'short');
        $when = ($updated ? $updated : "1 ".LANDT_09)." ".LANDT_AGO; 




$msmenu_text .= "<td style='width:100%' class='".$themea."'><a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$userorb."</a></td>
		 </tr><tr>
		 <td style='width:100%' class='".$themeb."' colspan='".$cols."'>".$tp -> toHTML($row['status_text'], TRUE)."<br><i>(".$when.")</i></td>
        	 </tr>";}


$msmenu_text .= "</table>";


if ($pref['ms_enable_autoscroll'] == "1")
{$msmenu_text .= "
</marquee>
<br>
<table style='width:100%' class=''><tr><td>
<center>
<input class=\"button\" value=\"".MS_14."\" onClick=\"msmenustart();\" type=\"button\">
<input class=\"button\" value=\"".MS_15."\" onClick=\"msmenustop();\" type=\"button\">
<input class=\"button\" value=\"".MS_16."\" onClick=\"msmenuup();\" type=\"button\">
<input class=\"button\" value=\"".MS_17."\" onClick=\"msmenudown();\" type=\"button\">
</center>
</td></tr></table>
<br>
";}
else
{$msmenu_text .= "</div>";}
}
//--------------------------------------------------------------------------------------------------+



$msmenu_text .= "<center><font size='1'>[ <a href='".e_PLUGIN."aacgc_member_status/Member_Status_List.php'>".MS_13."</a> ]</font></center>";



$ns -> tablerender($msmenu_title, $msmenu_text);

}

?>