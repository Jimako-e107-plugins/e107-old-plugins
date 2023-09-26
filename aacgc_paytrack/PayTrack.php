<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Payment Tracker           #
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

if ($pref['aacgcpt_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}


include_lan(e_PLUGIN."aacgc_paytrack/languages/".e_LANGUAGE.".php");

//-------------------# Title #--------------------

$title .= "".$pref['aacgcpt_pagetitle']."";

//------------------------------------------------

if ( check_class($pref['aacgcpt_viewclass']) OR (ADMIN) OR ($pref['aacgcpt_viewclass'] == "all") ){

$dformat = $pref['aacgcpt_dformat'];
$offset = $pref['aacgcpt_toffset'];
$time = time()  + ($offset * 60 * 60);
$currtime = $time;
$showcurrenttime = date($dformat, $time);

//-------------------# Header / Intro #-----------

$text .= "<table style='width:100%' class='".$themea."'>
	  <tr>
          <td class='' colspan=2><center>".$tp -> toHTML($pref['aacgcpt_header'], TRUE)."</center></td>
          </tr><tr>
          <td class='".$themeb."' colspan=2><center>".$tp -> toHTML($pref['aacgcpt_intro'], TRUE)."</center></td>
          </tr><tr>
          <td class='".$themeb."' colspan=2><center>".$showcurrenttime."</center></td>
          </tr>";

if ( check_class($pref['aacgcpt_addclass']) OR (ADMIN) ){
$create = "<a href='".e_PLUGIN."aacgc_paytrack/Add.php'><img src='".e_PLUGIN."aacgc_paytrack/images/add.png' align='left' /></a>";
$delete = "<a href='".e_PLUGIN."aacgc_paytrack/Edit.php?del'><img src='".e_PLUGIN."aacgc_paytrack/images/del.png' align='right' /></a>";
$text .= "<tr>
          <td colspan=2 class=''>".$create."".$delete."</td>
          </tr>";}

$text .= "</table>
	  <br><br>";


//-----------------------------------------------------------


$sql ->db_Select("aacgc_paytrack_cat", "*", "ORDER BY cat_order ASC","");
while($row = $sql ->db_Fetch()){
$catid = $row['cat_id'];
$cattitle = $row['cat_title'];
$catdet = $row['cat_det'];

$text .= "<table style='width:100%' class='".$themea."'>";

$text .= "
	<tr>
	<td colspan='7' class='".$themea."'><b>".$tp -> toHTML($cattitle, TRUE)."</b><br><div style='width:96%' class='".$themeb."'>".$tp -> toHTML($catdet, TRUE)."</div></td>
	</tr>
	<tr>
	<td style='width:25%' class='".$themea."'>".PT_01."</td>
	<td style='width:0%' class='".$themea."'>".PT_02."</td>
	<td style='width:0%' class='".$themea."'>".PT_03."</td>
	<td style='width:0%' class='".$themea."'>".PT_04."</td>
	<td style='width:25%' class='".$themea."'>".PT_05."</td>
	<td style='width:25%' class='".$themea."'>".PT_06."</td>
	<td style='width:0%' class='".$themea."'>".PT_07."</td>
	</tr>	
	";

$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_paytrack_members where user_cat='".intval($catid)."' order by user_ddate ASC;");
while($row2 = $sql2->db_fetch()){

$sql3 = new db;
$sql3->mySQLresult = @mysql_query("select * from ".MPREFIX."user where user_id='".intval($row2['user_id'])."';");
$row3 = $sql3->db_fetch();

$pid = $row2['pay_id'];
$puserid = $row2['user_id'];
$pusername = $row3['user_name']; 
$pcamo = $row2['user_camount'];
$pdamo = $row2['user_damount']; 
$ptamo = $row2['user_tamount'];
$pstat = $row2['user_status'];

if($row2['user_cdate'] == "")
{$pcdate = "";}
else
{$pcdate = date($dformat, $row2['user_cdate']);}

if($row2['user_ddate'] == "")
{$pddate = "";}
else
{$pddate = date($dformat, $row2['user_ddate']);}


if($pstat == "1"){$status = "<img src='".e_PLUGIN."aacgc_paytrack/images/payed.png'/>";}
if($pstat == "0"){$status = "<img src='".e_PLUGIN."aacgc_paytrack/images/unpayed.png'/>";}

if ( check_class($pref['aacgcpt_addclass']) OR (ADMIN) ){
$editlinks = "<a href='".e_PLUGIN."aacgc_paytrack/Edit.php?det.".$pid."'>";
$editlinke = "</a>";}

$text .= "
	<tr>
	<td style='width:' class='".$themeb."'>".$editlinks."".$pusername."".$editlinke."</td>
	<td style='width:' class='".$themeb."'>".$pref['aacgcpt_csymbol']."".$pcamo."</td>
	<td style='width:' class='".$themeb."'>".$pref['aacgcpt_csymbol']."".$pdamo."</td>
	<td style='width:' class='".$themeb."'>".$pref['aacgcpt_csymbol']."".$ptamo."</td>
	<td style='width:' class='".$themeb."'>".$pcdate."</td>
	<td style='width:' class='".$themeb."'>".$pddate."</td>
	<td style='width:' class='".$themeb."'><center>".$status."</center></td>
	</tr>
";


}

$text .= "</table><br><br>";}}

else

{$text .= "<i>".PT_19."</i>";}


//-------------------# End #------------------


//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_paytrack/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+

$ns -> tablerender($title, $text);

//-------------------------------------------------------------------------

require_once(FOOTERF);

?>