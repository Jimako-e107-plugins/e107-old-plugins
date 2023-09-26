<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Member Status             #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

global $tp;

require_once("../../class2.php");
require_once(HEADERF);

include_lan(e_PLUGIN."aacgc_member_status/languages/".e_LANGUAGE.".php");

if ($pref['ms_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

//-------------------------# Page Title #--------------------------------+

$mspage_title .= "".MS_01."";

//-----------------------------------------------------------------------+

if ($pref['ms_enable_gold'] == "1")
{$gold_obj = new gold();}

if(USER){

//-------------------------# BB Code Support #---------------------------+

include(e_HANDLER."ren_help.php");

//-----------------------------------------------------------------------+


//----------------# Check Current User for Status #----------------------+

	$datestamp = time();
        $sql ->db_Select("aacgc_member_status", "*", "status_user='".USERID."'");
        $row = $sql ->db_Fetch();

        if ($row['status_text'] == ""){

//---------------------# Add Status #----------------------------------------------

if ($_POST['add_status'] == '1') {

$newuser = $tp->toDB($_POST['status_user']);
$newstatus = $tp->toDB($_POST['status_text']);
$newdate = $tp->toDB($_POST['status_date']);
$sql->db_Insert("aacgc_member_status", "NULL, '".$newuser."', '".$newstatus."', '".$newdate."'") or die(mysql_error());

$ns->tablerender("", "<center><b>".MS_02.".</b><br><br>[<a href='".e_PLUGIN."aacgc_member_status/Member_Status_List.php'> ".MS_03." </a>]</center>");

require_once(FOOTERF);}

//----------------------# Status Form #---------------------------------------------

$ms_text .= "<form method='POST' action='Member_Status_List.php'>";

$ms_text .= "
        <table style='width:80%' class='".$themea."' cellspacing='0' cellpadding='0'>
        <tr>
        <td class='".$themea."'>".MS_04.":</td>
        </tr>
        <tr>
        <td class='".$themea."'>
        <input type='hidden' name='status_user' value='".USERID."'>
        <input type='hidden' name='status_date' value='".$datestamp."'>";

if ($pref['ms_enable_bbcode'] == "1"){
$ms_text .= "<textarea class='tbox' style='width:".$pref['mspage_inputwidth']."px; height:".$pref['mspage_inputheight']."px; overflow:hidden' name='status_text' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";
$ms_text .= display_help('helpb', 'forum');}
else
{$ms_text .= "<textarea class='tbox' style='width:".$pref['mspage_inputwidth']."px; height:".$pref['mspage_inputheight']."px; overflow:hidden' name='status_text'></textarea>";}
  

$ms_text .= "</td>
        </td>
        </tr>
	<tr>
        <td style='text-align:center' class=''><br>
	<input type='hidden' name='add_status' value='1'>
	<input class='button' type='submit' value='".MS_05."'>
	</td>
        </tr>
</table>
<br>
</form>";}


//-----------------# Delete Status #--------------------------------------------------+

else
{

        if ($_POST['main_delete']) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
        $sql2->db_Delete("aacgc_member_status", "status_id='".$delete_id[0]."'");
$ns->tablerender("", "<center><b>".MS_06.".</b><br><br>[<a href='".e_PLUGIN."aacgc_member_status/Member_Status_List.php'> ".MS_03." </a>]</center>");
require_once(FOOTERF);}


//--------------------# Show Current Status #-----------------------------------------+

$ms_text .= "<form method='POST' action='Member_Status_List.php'>";

        $gen = new convert;
        $updated = $gen -> computeLapse($row['status_date'], false, false, true, 'short');
        $when = ($updated ? $updated : "1 ".LANDT_09)." ".LANDT_AGO;
 
$ms_text .= "
        <table style='width:95%' class='".$themea."' cellspacing='0' cellpadding='0'>
        <tr>
        <td class='".$themea."'><center><b><u>".MS_07."</u>:</b></center></td>
        </tr>
        <tr>
        <td class='".$themeb."'>".$tp -> toHTML($row['status_text'], TRUE)."</td>
	</tr>
	<tr>
        <td style='' class=''><font size='1'>
	".MS_10.": <i>(".$when.")</i>
	</font></td>
        </tr>
	<tr>
        <td style='text-align:center' class=''><br>
        <input type='hidden' name='main_delete[".$row['status_id']."]'>
        <input class='button' type='submit' value='".MS_11."'>
	</td>
        </tr></table>";

$ms_text .= "</form>";}
}
else

//----------------# Guests Must Register or Login #-----------------------------------+

{$ms_text .= "<i>".MS_08."</i>";}

//------------------------------------------------------------------------------------+

if ($pref['mspage_enable_avatar'] == "1"){
$cols = "3";}
else
{$cols = "2";}


//---------------------------# Show All Member Status #-------------------------------+

$ms_text .= "<br><br><br>
	<table style='width:100%' class='".$themea."'>
	<tr>
	<td colspan='".$cols."' class=''><center><b><u>".MS_09."</u>:</b></center></td>
	</tr>";

        $sql ->db_Select("aacgc_member_status", "*", "ORDER BY status_id DESC","");
        while($row = $sql ->db_Fetch()){
        $sql2 = new db;
        $sql2 ->db_Select("user", "*", "user_id = '".intval($row['status_user'])."'");
        $row2 = $sql2 ->db_Fetch();

        if ($pref['ms_enable_gold'] == "1")
        {$userorb = "<font color='#00FF00'>".$gold_obj->show_orb($row2['user_id'])."</font>";}
        else
        {$userorb = "".$row2['user_name']."";}

$ms_text .= "<tr>";

        if ($pref['mspage_enable_avatar'] == "1"){
        if ($row2['user_image'] == "")
        {$avatar = "<img src='".e_PLUGIN."aacgc_member_status/images/default.png' width='".$pref['mspage_avatar_size']."px' />";}
        else
        {$useravatar = $row2[user_image];
        require_once(e_HANDLER."avatar_handler.php");
        $useravatar = avatar($useravatar);
        $avatar = "<img src='".$useravatar."' width='".$pref['mspage_avatar_size']."px' />";}

$ms_text .= "<td style='width:0%' class='".$themea."'><a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$avatar."</a></td>";}

        $gen = new convert;
        $updated = $gen -> computeLapse($row['status_date'], false, false, true, 'short');
        $when = ($updated ? $updated : "1 ".LANDT_09)." ".LANDT_AGO; 


$ms_text .= "
        <td style='width:30%' class='".$themeb."'><a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$userorb."</a></td>
	<td style='width:70%' class='".$themeb."'>".$tp -> toHTML($row['status_text'], TRUE)."<br><i>(".$when.")</i></td>
        </tr>";}


$ms_text .= "</table>";



//--------------------------------------------------------------------+

//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_member_status/plugin.php');
$ms_text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+


$ns -> tablerender($ms_title, $ms_text);

require_once(FOOTERF);


?>
