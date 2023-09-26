<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Meeting Planner           #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

global $tp;

require_once("../../class2.php");
require_once(HEADERF);

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}


if ($pref['aacgcmp_enable_gold'] == "1")
{$gold_obj = new gold();}

if ($pref['aacgcmp_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}


include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");


//-------------------# Title #--------------------

$title .= "".$pref['aacgcmp_pagetitle']."";

//----------------------------------------------------------------------+

$sql ->db_Select("aacgc_mp_meetings", "*", "meet_id='".intval($sub_action)."'");
$row = $sql ->db_Fetch();

$sql2 = new db;
$sql2 ->db_Select("aacgc_mp_cat", "*", "cat_id='".intval($row['meet_cat'])."'");
$row2 = $sql2 ->db_Fetch();

$mid = $row['meet_id'];
$mtitle = $row['meet_title']; 
$msubj = $row['meet_subj'];
$mdet = $row['meet_det']; 
$mstat = $row['meet_status'];
$mrep = $row['meet_repeat'];
$mclass = $row['meet_class'];
$dformat = $pref['aacgcmp_dformat'];
$msdate = date($dformat, $row['meet_sdate']);
$medate = date($dformat, $row['meet_edate']);
$mcat = $row['meet_cat'];

$catid = $row2['cat_id'];
$cattitle = $row2['cat_title'];
$catdet = $row2['cat_det'];

if($mstat == "0")
{$status = "<font color='#FF0000'>".MP_11."</font>";}
if($mstat == "1")
{$status = "<font color='#00FF00'>".MP_10."</font>";}

$sql->mySQLresult = @mysql_query("select user_meet, count(user_id) as participants from ".MPREFIX."aacgc_mp_members where user_meet='".intval($mid)."';");
$result = $sql->db_fetch();

//-----------------------# determain if close time has past #---------------------------------+
 
$hours = $pref['aacgcmp_closetime'];
$closetime = $row['meet_sdate']  - ($hours * 60 * 60);

$offset = $pref['aacgcmp_toffset'];
$time = time()  + ($offset * 60 * 60);
$currtime = $time;

if($closetime <= $currtime)
{$offtime = "1";}
else
{$offtime = "0";}


if(($mstat == "1") AND ($offtime == "1")){

$mstat = "0";

$sql->db_Update("aacgc_mp_meetings", "
meet_title='".$tp->toDB($mtitle)."', 
meet_det='".$tp->toDB($mdet)."', 
meet_subj='".$tp->toDB($msubj)."', 
meet_sdate='".$tp->toDB($row['meet_sdate'])."', 
meet_edate='".$tp->toDB($row['meet_edate'])."', 
meet_status='".$tp->toDB($mstat)."', 
meet_repeat='".$tp->toDB($mrep)."', 
meet_class='".$tp->toDB($mclass)."', 
meet_cat='".$tp->toDB($mcat)."' 
WHERE meet_id='".$mid."'");

if($mrep == "1"){
$weekly = $pref['aacgcmp_hoursperweek'];
$newsdate = $row['meet_sdate']  + ($weekly * 60 * 60);
$newedate = $row['meet_edate']  + ($weekly * 60 * 60);
$newstat = "1";
$sql->db_Insert("aacgc_mp_meetings", "NULL, '".$mtitle."', '".$mdet."', '".$msubj."', '".$newsdate."', '".$newedate."', '".$newstat."', '".$mrep."', '".$mclass."', '".$mcat."'") or die(mysql_error());
}

if($mrep == "2"){
$monthly = $pref['aacgcmp_hourspermonth'];
$newsdate = $row['meet_sdate']  + ($monthly * 60 * 60);
$newedate = $row['meet_edate']  + ($monthly * 60 * 60);
$newstat = "1";
$sql->db_Insert("aacgc_mp_meetings", "NULL, '".$mtitle."', '".$mdet."', '".$msubj."', '".$newsdate."', '".$newedate."', '".$newstat."', '".$mrep."', '".$mclass."', '".$mcat."'") or die(mysql_error());
}

$ns -> tablerender($title, "<div style='text-align:center'>".MP_40.".<br><br><a href='".e_PLUGIN."aacgc_mp/Details.php?det.".$mid."'>".MP_41."</a></div>");
require_once(FOOTERF);
}
//----------------------------

//-------------------------# Edit Icon #---------------------------------------------+

if ( check_class($pref['aacgcmp_addclass']) OR (ADMIN) ){
$edit = "<a href='".e_PLUGIN."aacgc_mp/Edit.php?edit.".$mid."'><img src='".e_PLUGIN."aacgc_mp/images/edit.png' align='right' alt='".AMP_65."' /></a>";}

//-------------------------# Meeting Details #---------------------------------------------+

$text .= "<a href='".e_PLUGIN."aacgc_mp/Planner.php'><img src='".e_PLUGIN."aacgc_mp/images/back.png' align='left' alt='".AMP_65."' /></a>".$edit."<br>

	<table style='width:100%' class='".$themea."'>
	<tr>
	<td colspan='4' class=''><center><font size='3'><b>".$tp -> toHTML($mtitle, TRUE)."</b></font></center><br></td>
	</tr>
	<tr>
	<td colspan='4' class='".$themeb."'><div style='width:auto' class='".$themea."'>".MP_05.":</div><br>".$tp -> toHTML($msubj, TRUE)."</td>
	</tr>
	<tr>
	<td colspan='4' class='".$themeb."'><div style='width:auto' class='".$themea."'>".MP_06.":</div><br>".$tp -> toHTML($mdet, TRUE)."</td>
	</tr>
	<tr>
	<td style='width:25%' class='".$themea."'>".MP_07.":</td>
	<td style='width:25%' class='".$themeb."'>".$msdate."</td>
	<td style='width:25%' class='".$themea."'>".MP_08.":</td>
	<td style='width:25%' class='".$themeb."'>".$medate."</td>
	</tr>
	<tr>
	<td colspan='4' class='".$themea."'>".MP_09.": ".$status."</td>
	</tr>
	<tr>
	<td colspan='2' class='".$themea."'>".MP_42.":</td>
	<td colspan='2' class='".$themeb."'>".$result['participants']."</td>
	</tr>
	</table>

";

//-----------------------# Meeting Members #-----------------------------------------------+
if(USER){
if (($mclass == "members") AND ($mstat == "1")){
$join = "<a href='".e_PLUGIN."aacgc_mp/Join.php?det.".$mid."'><img src='".e_PLUGIN."aacgc_mp/images/add.png' align='right' /></a>";}

if ( check_class($mclass) AND ($mstat == "1")){
$join = "<a href='".e_PLUGIN."aacgc_mp/Join.php?det.".$mid."'><img src='".e_PLUGIN."aacgc_mp/images/add.png' align='right' /></a>";}
}

$text .= "<br><br><br>
	<table style='width:100%' class='".$themea."'>
	<tr>
	<td colspan='4'>".$join."<center><b><u>".MP_12."</u></b></center></td>
	</tr>
	<tr>
	<td style='width:20%' class='".$themea."' colspan='2'>".MP_13."</td>
	<td style='width:0%' class='".$themea."'>".MP_14."</td>
	<td style='width:80%' class='".$themea."'>".MP_15."</td>
	</tr>";


$sql3 = new db;
$sql3 ->db_Select("aacgc_mp_members", "*", "user_meet='".intval($mid)."'");
while($row3 = $sql3 ->db_Fetch()){

$sql4 = new db;
$sql4 ->db_Select("user", "*", "user_id='".intval($row3['user_id'])."'");
$row4 = $sql4 ->db_Fetch();

$uid = $row3['id'];
$userid = $row3['user_id'];
$username = $row4['user_name'];
$choice = $row3['user_choice'];
$comment = $row3['user_det'];
$onlineuser = "".USERID."";

if($choice == "1"){$ch = "".MP_24."";}
if($choice == "2"){$ch = "".MP_25."";}
if($choice == "3"){$ch = "".MP_26."";}

if ($pref['aacgcmp_enable_gold'] == "1")
{$userorb = "<a href='".e_BASE."user.php?id.".$userid."'>".$gold_obj->show_orb($userid)."</a>";}
else
{$userorb = "<a href='".e_BASE."user.php?id.".$userid."'>".$username."</a>";}

if (ADMIN){
$edit = "<a href='".e_PLUGIN."aacgc_mp/admin_edit_members.php?edit.".$uid."'><img src='".e_PLUGIN."aacgc_mp/images/edit.png' align='left' /></a>";}
elseif ($onlineuser == $userid){
$edit = "<a href='".e_PLUGIN."aacgc_mp/Join.php?edit.".$uid."'><img src='".e_PLUGIN."aacgc_mp/images/edit.png' align='left' /></a>";}
else
{$edit = "";}

$text .= "
	<tr>
	<td style='width:0%' class=''>".$edit."</td>
	<td style='width:' class='".$themeb."'>".$userorb."</td>
	<td style='width:' class='".$themeb."'>".$ch."</td>
	<td style='width:' class='".$themeb."'>".$tp -> toHTML($comment, TRUE)."</td>
	</tr>
";}


$text .= "</table>";


//----------------------------------------------------------------------+





//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_mp/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+

$ns -> tablerender($title, $text);

//-------------------------------------------------------------------------

require_once(FOOTERF);

?>