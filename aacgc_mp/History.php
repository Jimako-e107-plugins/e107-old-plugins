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

if ($pref['aacgcmp_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}


include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");

//-------------------# Title #--------------------

$title .= "".MP_32."";

//------------------------------------------------
if(USER){

$text .= "<a href='".e_PLUGIN."aacgc_mp/Planner.php'><img src='".e_PLUGIN."aacgc_mp/images/back.png' alt='".AMP_65."' /></a><br>
<center><table style='width:100%' class=''>";

$text .= "
	<tr>
	<td colspan='4' class='".$themea."'><center><b>".MP_32."</b></center></td>
	</tr>
	<tr>
	<td style='width:50%' class='".$themea."'>".MP_01."</td>
	<td style='width:25%' class='".$themea."'>".MP_02."</td>
	<td style='width:25%' class='".$themea."'>".MP_03."</td>
	</tr>	
	";

$offset = $pref['aacgcmp_toffset'];
$time = time()  + ($offset * 60 * 60);
$currtime = $time;


$sql->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_mp_members where user_id='".USERID."';");
while($row = $sql->db_fetch()){

$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_mp_meetings where meet_id='".intval($row['user_meet'])."' order by meet_sdate DESC;");
while($row2 = $sql2->db_fetch()){

$mid = $row2['meet_id'];
$mtitle = $row2['meet_title']; 
$msubj = $row2['meet_subj'];
$mdet = $row2['meet_det']; 
$mstat = $row2['meet_status'];
$mrep = $row2['meet_repeat'];
$mclass = $row2['meet_class'];
$mcat = $row2['meet_cat'];
$dformat = $pref['aacgcmp_dformat'];
$msdate = date($dformat, $row2['meet_sdate']);
$medate = date($dformat, $row2['meet_edate']);
$offset = $pref['aacgcmp_toffset'];
$time = time()  + ($offset * 60 * 60);
$currtime = $time;

$text .= "
	<tr>
	<td style='width:; text-align:left' class='".$themeb."'><a href='".e_PLUGIN."aacgc_mp/Details.php?det.".$mid."'>".$tp -> toHTML($mtitle, TRUE)."</a></td>
	<td style='width:; text-align:left' class='".$themeb."'>".$tp -> toHTML($msubj, TRUE)."</td>
	<td style='width:; text-align:left' class='".$themeb."'>".$msdate."<br>".$medate."</td>
	</tr>
";

}}



$text .= "</table></center>";

}
//-------------------# End #------------------
else
{$text .= "".MP_19."";}


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