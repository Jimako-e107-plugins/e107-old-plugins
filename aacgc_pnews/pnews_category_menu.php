<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Public News               #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


if ($pref['pnews_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");


//-------------------# Title #--------------------

$pnews_catmtitle .= "".$pref['pnews_catm_menutitle']."";

//------------------------------------------------

$pnews_catmtext .= "<div style='width:100%; height:".$pref['pnews_catm_menuheight']."px; overflow:auto'><table style='width:100%' class=''>";

$sql ->db_Select("aacgc_pnews_cat", "*", "ORDER BY news_cat_title ASC","");
while($row = $sql ->db_Fetch()){
$newscatid = $row['news_cat_id'];
$newscattitle = $row['news_cat_title'];
$newscatdesc = $row['news_cat_desc'];

$pnews_catmtext .= "<tr>
	  <td style='width:100%' class='".$themea."' colspan='2'>
	  <a href='".e_PLUGIN."aacgc_pnews/News.php?det.".$newscatid."'><font size='".$pref['pnews_catm_catfsize']."'><b>".$newscattitle."</b></font></a><br>".$newscatdesc."
	  </tr>";

if ($pref['pnews_catm_shownews'] == "1")
{$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_pnews where news_cat='".intval($newscatid)."' order by news_date DESC limit 0,".$pref['pnews_catm_newscount'].";");
while($news = $sql2->db_fetch()){

if ($pref['pnews_catm_newsimgratio'] == "width")
{$height = "height='".$pref['pnews_catm_newsimgsize']."px'";}
if ($pref['pnews_catm_newsimgratio'] == "auto")
{$height = "";}

$newsid = $news['news_id'];
$newstitle = $news['news_title']; 
$newsimg = "<img src='".e_PLUGIN."aacgc_pnews/public/".$news['news_img']."' width='".$pref['pnews_catm_newsimgsize']."px', ".$height." />";

$pnews_catmtext .= "
	  <tr>
	  <td style='width:0%' class='".$themeb."'><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'>".$newsimg."</a></td>
	  <td style='width:100%' class='".$themea."'><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'><font size='".$pref['pnews_catm_newstfsize']."'><b>".$newstitle."</b></font></a></td>
	  </tr>";}

}}

$pnews_catmtext .= "</table></div>";


//-------------------# End #------------------

$ns -> tablerender($pnews_catmtitle, $pnews_catmtext);

//-------------------------------------------------------------------------

?>