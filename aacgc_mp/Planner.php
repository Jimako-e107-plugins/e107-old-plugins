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

if ($pref['aacgcmp_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}


include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");

//-------------------# Title #--------------------

$title .= "".$pref['aacgcmp_pagetitle']."";

//------------------------------------------------

$dformat = $pref['aacgcmp_dformat'];
$offset = $pref['aacgcmp_toffset'];
$time = time()  + ($offset * 60 * 60);
$currtime = $time;
$showcurrenttime = date($dformat, $time);

//-------------------# Header / Intro #-----------

if ( check_class($pref['aacgcmp_addclass']) OR (ADMIN) ){
$create = "<a href='".e_PLUGIN."aacgc_mp/New.php'>".MP_17."</a>";}

$archives = "<a href='".e_PLUGIN."aacgc_mp/Archives.php'>".MP_18."</a>";

if(USER){
$history = "<a href='".e_PLUGIN."aacgc_mp/History.php'>".MP_33."</a>";
}
$text .= "<table style='width:100%' class='".$themea."'>
	  <tr>
          <td class='' colspan=3><center>".$tp -> toHTML($pref['aacgcmp_header'], TRUE)."</center></td>
          </tr><tr>
          <td class='".$themeb."' colspan=3><center>".$tp -> toHTML($pref['aacgcmp_intro'], TRUE)."</center></td>
          </tr><tr>
          <td class='".$themeb."' colspan=3><center>".$showcurrenttime."</center></td>
          </tr><tr>
          <td style='width:33%' class='".$themeb."'><center>".$create."</center></td>
          <td style='width:34%' class='".$themeb."'><center>".$archives."</center></td>
          <td style='width:33%' class='".$themeb."'><center>".$history."</center></td>
          </tr>

	  </table>
	  <br><br>";


//-----------------------------------------------------------


$sql ->db_Select("aacgc_mp_cat", "*", "ORDER BY cat_order ASC","");
while($row = $sql ->db_Fetch()){
$catid = $row['cat_id'];
$cattitle = $row['cat_title'];
$catdet = $row['cat_det'];

$text .= "<table style='width:100%' class='".$themea."'>";

$text .= "
	<tr>
	<td colspan='4' class='".$themea."'><b>".$tp -> toHTML($cattitle, TRUE)."</b><br><div style='width:96%' class='".$themeb."'>".$tp -> toHTML($catdet, TRUE)."</div></td>
	</tr>
	<tr>
	<td style='width:50%' class='".$themea."' colspan='2'>".MP_01."</td>
	<td style='width:25%' class='".$themea."'>".MP_02."</td>
	<td style='width:25%' class='".$themea."'>".MP_03."</td>
	</tr>	
	";

$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_mp_meetings where meet_cat='".intval($catid)."' and meet_sdate>='".$currtime."' order by meet_sdate ASC;");
while($row2 = $sql2->db_fetch()){

$mid = $row2['meet_id'];
$mtitle = $row2['meet_title']; 
$msubj = $row2['meet_subj'];
$mdet = $row2['meet_det']; 
$mstat = $row2['meet_status'];
$mrep = $row2['meet_repeat'];
$mclass = $row2['meet_class'];
$mcat = $row2['meet_cat'];
$msdate = date($dformat, $row2['meet_sdate']);
$medate = date($dformat, $row2['meet_edate']);


//----# determain if close time has past
 
$hours = $pref['aacgcmp_closetime'];
$closetime = $row2['meet_sdate']  - ($hours * 60 * 60);

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
meet_sdate='".$tp->toDB($row2['meet_sdate'])."', 
meet_edate='".$tp->toDB($row2['meet_edate'])."', 
meet_status='".$tp->toDB($mstat)."', 
meet_repeat='".$tp->toDB($mrep)."', 
meet_class='".$tp->toDB($mclass)."', 
meet_cat='".$tp->toDB($mcat)."' 
WHERE meet_id='".$mid."'");

if($mrep == "1"){
$weekly = $pref['aacgcmp_hoursperweek'];
$newsdate = $row2['meet_sdate']  + ($weekly * 60 * 60);
$newedate = $row2['meet_edate']  + ($weekly * 60 * 60);
$newstat = "1";
$sql->db_Insert("aacgc_mp_meetings", "NULL, '".$mtitle."', '".$mdet."', '".$msubj."', '".$newsdate."', '".$newedate."', '".$newstat."', '".$mrep."', '".$mclass."', '".$mcat."'") or die(mysql_error());
}

if($mrep == "2"){
$monthly = $pref['aacgcmp_hourspermonth'];
$newsdate = $row2['meet_sdate']  + ($monthly * 60 * 60);
$newedate = $row2['meet_edate']  + ($monthly * 60 * 60);
$newstat = "1";
$sql->db_Insert("aacgc_mp_meetings", "NULL, '".$mtitle."', '".$mdet."', '".$msubj."', '".$newsdate."', '".$newedate."', '".$newstat."', '".$mrep."', '".$mclass."', '".$mcat."'") or die(mysql_error());
}

}
//----------------------------
if($pref['aacgcmp_enable_staticon'] == "1"){
if($mstat == "1"){$status = "<img src='".e_PLUGIN."aacgc_mp/images/open.png' /><br>";}
if($mstat == "0"){$status = "<img src='".e_PLUGIN."aacgc_mp/images/closed.png' /><br>";}
$th = $themeb;
}
if ( check_class($pref['aacgcmp_addclass']) OR (ADMIN) ){
$edit = "<a href='".e_PLUGIN."aacgc_mp/admin_edit_members.php?edit.".$mid."'><img src='".e_PLUGIN."aacgc_mp/images/edit.png' align='right' alt='".AMP_65."' /></a>";}

//----------------------------


$text .= "
	<tr>
	<td style='width:0%' class='".$th."'>".$status."".$edit."</td>
	<td style='width:50%; text-align:left' class='".$themeb."'><a href='".e_PLUGIN."aacgc_mp/Details.php?det.".$mid."'>".$tp -> toHTML($mtitle, TRUE)."</a></td>
	<td style='width:25%; text-align:left' class='".$themeb."'>".$tp -> toHTML($msubj, TRUE)."</td>
	<td style='width:25%; text-align:left' class='".$themeb."'>".$msdate."<br>".$medate."</td>
	</tr>
";


}

//$text .= "<tr><td colspan='4'><br><br></td></tr>";

$text .= "</table><br><br>";}


//-------------------# End #------------------



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