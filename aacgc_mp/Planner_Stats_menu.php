<?php

/*
####################################
#  AACGC Attendance List           #
#  M@CH!N3 admin@aacgc.com         # 
####################################
*/


global $sc_style, $tp;

if ($pref['aacgcmp_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

//-------------------------Menu Title--------------------------------+

$mpmenu_title .= "".$pref['aacgcmp_menutitle']."";

//-------------------------------------------------------------------+

$mpmenu_text .= "<div style='width:auto' class='".$themea."'>";

//-------------------------------------------------------------------+

if($pref['aacgcmp_menulimit'] == "0")
{$limit = "";}
else
{$limit = "LIMIT 0,".$pref['aacgcmp_menulimit']."";}


$mpmenu_text .= "<table style='width:100%' class=''>
		 <tr>
		 <td style='text-align:center' class='".$themea."'>".MP_34."</td>
		 </tr>
		 <tr>
		 <td style='text-align:center' class='".$themea."'>
		 <div style='width:100%; height:".$pref['aacgcmp_menuheight']."px; overflow:auto'>
		 <table style='width:100%' class=''>";


        $sql ->db_Select("aacgc_mp_meetings", "*", "meet_status='1' ORDER BY meet_sdate ASC ".$limit."");
        while($row = $sql ->db_Fetch()){

	$mid = $row['meet_id'];
	$mtitle = $row['meet_title']; 
	$msubj = $row['meet_subj'];
	$mdet = $row['meet_det']; 
	$mstat = $row['meet_status'];
	$mrep = $row['meet_repeat'];
	$mclass = $row['meet_class'];
	$mcat = $row['meet_cat'];
	$dformat = $pref['aacgcmp_dformat'];
	$msdate = date($dformat, $row['meet_sdate']);
	$medate = date($dformat, $row['meet_edate']);

	if($mstat == "1"){$status = "<img src='".e_PLUGIN."aacgc_mp/images/open.png' />";}
	if($mstat == "0"){$status = "<img src='".e_PLUGIN."aacgc_mp/images/closed.png' />";}

$mpmenu_text .= "<tr>
		 <td style='width:0%' class='".$themea."'>".$status."</td>
		 <td style='width:100%; text-align:left' class='".$themeb."'><a href='".e_PLUGIN."aacgc_mp/Details.php?det.".$mid."'>".$tp -> toHTML($mtitle, TRUE)."<br />($msdate)</a></td>
		 </tr>";}

$mpmenu_text .= "</table></div></td></tr></table><br>";

//-------------------------------------------------------------------+

$button = "<img src='".e_PLUGIN."aacgc_mp/images/button.png' />";

$mpmenu_text .= "<table style='width:100%' class='".$themea."'><tr><td>";

if ( check_class($pref['aacgcmp_addclass']) OR (ADMIN) )
{$mpmenu_text .= "".$button." <a href='".e_PLUGIN."aacgc_mp/New.php'>".MP_17."</a><br>";}

$mpmenu_text .= "".$button." <a href='".e_PLUGIN."aacgc_mp/Planner.php'>".MP_39."</a><br>";

if (USER)
{$mpmenu_text .= "".$button." <a href='".e_PLUGIN."aacgc_mp/History.php'>".MP_33."</a><br>";}

$mpmenu_text .= "".$button." <a href='".e_PLUGIN."aacgc_mp/Archives.php'>".MP_18."</a><br>";

$mpmenu_text .= "</td></tr></table>";

//-------------------------------------------------------------------+
if($pref['aacgcmp_enable_menustats'] == "1"){
$sql->mySQLresult = @mysql_query("select *, count(meet_id) as cm from ".MPREFIX."aacgc_mp_meetings where meet_status='1';");
$cmeetings = $sql->db_fetch();

$sql->mySQLresult = @mysql_query("select *, count(meet_id) as pm from ".MPREFIX."aacgc_mp_meetings where meet_status='0';");
$pmeetings = $sql->db_fetch();

$tmeetings = $sql -> db_Count("aacgc_mp_meetings");

$mpmenu_text .= "<br><table style='width:100%' class=''>
		 <tr>
		 <td colspan='2' style='text-align:center' class='".$themea."'>".MP_38."</td>
		 </tr>
		 <tr>
		 <td style='width:0%' class='".$themea."'>".MP_35."</td>
		 <td style='width:100%' class='".$themeb."'>".$cmeetings['cm']."</td>
		 </tr>
		 <tr>
		 <td style='width:0%' class='".$themea."'>".MP_36."</td>
		 <td style='width:100%' class='".$themeb."'>".$pmeetings['pm']."</td>
		 </tr>
		 <tr>
		 <td style='width:0%' class='".$themea."'>".MP_37."</td>
		 <td style='width:100%' class='".$themeb."'>".$tmeetings."</td>
		 </tr>
		 </table>";
}
//--------------------------------------------------------------------+

$mpmenu_text .= "</div>";


$ns -> tablerender($mpmenu_title, $mpmenu_text);


?>