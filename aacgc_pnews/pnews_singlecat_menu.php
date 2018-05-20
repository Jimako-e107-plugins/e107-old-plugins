<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Public News               #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

global $tp;

if ($pref['pnews_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}


include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");

//-------------------# Title #--------------------

$pnews_scatmtitle .= "".$pref['pnews_scatm_menutitle']."";

//------------------------------------------------

$sql ->db_Select("aacgc_pnews_cat", "*", "news_cat_id='".intval($pref['pnews_scatm_catchoice'])."'");
$row = $sql ->db_Fetch();
$newscatid = $row['news_cat_id'];
$newscattitle = $row['news_cat_title'];
$newscatdesc = $row['news_cat_desc'];

$pnews_scatmtext .= "
	<table style='width:100%' class=''>
	<tr>
	<td style='width:100%; text-align:center' class='".$themea."' colspan='2'>
	<a href='".e_PLUGIN."aacgc_pnews/News.php?det.".$newscatid."'><font size='".$pref['pnews_scatm_catfsize']."'><b>".$newscattitle."</b></font></a><br>".$newscatdesc."
	</tr>
	</table><br>";

$pnews_scatmtext .= "<div style='width:100%; height:".$pref['pnews_scatm_menuheight']."px; overflow:auto'>";

if ($pref['pnews_scatm_newsimgratio'] == "width")
{$height = "height='".$pref['pnews_scatm_newsimgsize']."px'";}
if ($pref['pnews_scatm_newsimgratio'] == "auto")
{$height = "";}

$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_pnews where news_cat='".intval($newscatid)."' order by news_date DESC limit 0,".$pref['pnews_scatm_newscount'].";");
while($row2 = $sql2->db_fetch()){

$newsid = $row2['news_id'];
$newstitle = $row2['news_title'];
$newsimg = "<img src='".e_PLUGIN."aacgc_pnews/public/".$row2['news_img']."' width='".$pref['pnews_scatm_newsimgsize']."px', ".$height." />";
$author = $row2['news_author'];
$dformat = $pref['pnews_dateformat'];
$date = date($dformat, $row2['news_date']);
$cat = $row2['news_cat'];
$charlimit = $pref['pnews_scatm_newsdesclimit'];
$newsdesc = substr($row2['news_desc'], 0, $charlimit);
$newssum = $row2['news_sum'];

$sql3 = new db;
$sql3->mySQLresult = @mysql_query("select * from ".MPREFIX."user where user_id='".intval($author)."';");
$row3 = $sql3->db_fetch();
$authorname = $row3['user_name'];

if ($pref['pnews_scatm_infochoice'] == "desc")
{$newsinfo = $newsdesc;}
if ($pref['pnews_scatm_infochoice'] == "summary")
{$newsinfo = $newssum;}
if ($pref['pnews_showemptysum'] == "1"){
if ($newsinfo == "")
{$newsinfoshow = $newsdesc;}
else
{$newsinfoshow = $newsinfo;}}
else
{$newsinfoshow = $newsinfo;}

$pnews_scatmtext .= "
<table style='width:100%' class='".$themea."'>
<tr>
<td style='width:100%' class=''><center><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'><font size='".$pref['pnews_scatm_newstfsize']."'><b>".$newstitle."</b></font></center></a>
</tr>
<tr>
<td class='".$themeb."'><center><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'>".$newsimg."</a></center></td>
</tr>
<tr>
<td class=''>".nl2br($tp -> toHTML($newsinfoshow, TRUE,'no_hook,emotes_off'))." <a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'>".PNEWS_28."</a></td>
</tr>
<tr>
<td class='".$themeb."'><i>".PNEWS_29." ".$authorname." ".PNEWS_33." ".$date."</i></td>
</tr>
</table><br>";}


$pnews_scatmtext .= "</div>";


//-------------------# End #------------------

$ns -> tablerender($pnews_scatmtitle, $pnews_scatmtext);

//-------------------------------------------------------------------------

?>