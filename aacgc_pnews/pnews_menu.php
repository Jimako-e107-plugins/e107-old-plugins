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

$pnews_newstitle .= "".$pref['pnews_newsm_menutitle']."";

//------------------------------------------------
if ($pref['pnews_newsm_newsimgratio'] == "width")
{$height = "height='".$pref['pnews_newsm_newsimgsize']."px'";}
if ($pref['pnews_newsm_newsimgratio'] == "auto")
{$height = "";}


$pnews_newstext .= "<div style='width:100%; height:".$pref['pnews_newsm_menuheight']."px; overflow:auto'>";

$sql->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_pnews order by news_date DESC limit 0,".$pref['pnews_newsm_newscount'].";");
while($row = $sql->db_fetch()){
$newsid = $row['news_id'];
$newstitle = $row['news_title'];
$newsimg = "<img src='".e_PLUGIN."aacgc_pnews/public/".$row['news_img']."' width='".$pref['pnews_newsm_newsimgsize']."px', ".$height." />";
$author = $row['news_author'];
$dformat = $pref['pnews_dateformat'];
$date = date($dformat, $row['news_date']);
$cat = $row['news_cat'];
$charlimit = $pref['pnews_newsm_newsdesclimit'];
$newsdesc = substr($row['news_desc'], 0, $charlimit);
$newssum = $row['news_sum'];

$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select * from ".MPREFIX."user where user_id='".intval($author)."';");
$row2 = $sql2->db_fetch();
$authorname = $row2['user_name'];

$sql3 = new db;
$sql3 ->db_Select("aacgc_pnews_cat", "*", "news_cat_id='".intval($cat)."'");
$row3 = $sql3 ->db_Fetch();
$newscatid = $row3['news_cat_id'];
$newscattitle = $row3['news_cat_title'];

$page = $newsid;
$sql4 = new db;
$sql4->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_pnews_counter where page='".intval($page)."';");
$row4 = $sql4->db_fetch();
if ($row4['counter'] == "")
{$count = "0";}
else
{$count = $row4['counter'];}
$pageviews = "<i>(".PNEWS_01.": ".$count.")</i>";

if ($pref['pnews_com_enable'] == "1"){
$sql5 = new db;
$sql5->mySQLresult = @mysql_query("select *, count(news_com_id) as coms from ".MPREFIX."aacgc_pnews_comments where news_com_newsid='".intval($newsid)."';");
$row5 = $sql5->db_fetch();
$comments = "<i>(".PNEWS_32.": ".$row5['coms'].")</i>";}


if ($pref['pnews_newsm_infochoice'] == "desc")
{$newsinfo = $newsdesc;}
if ($pref['pnews_newsm_infochoice'] == "summary")
{$newsinfo = $newssum;}
if ($pref['pnews_showemptysum'] == "1"){
if ($newsinfo == "")
{$newsinfoshow = $newsdesc;}
else
{$newsinfoshow = $newsinfo;}}
else
{$newsinfoshow = $newsinfo;}

$pnews_newstext .= "
<table style='width:95%' class='".$themea."'>
<tr>
<td style='width:100%' class=''><center><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'><font size='".$pref['pnews_newsm_newstfsize']."'><b>".$newstitle."</b></font></center></a>
</tr>
<tr>
<td class='".$themeb."'><center><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'>".$newsimg."</a></center></td>
</tr>
<tr>
<td class=''>".$tp -> toHTML($newsinfoshow, TRUE)." <a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'>".PNEWS_28."</a></td>
</tr>
<tr>
<td class='".$themeb."'><i>".PNEWS_29." ".$authorname." ".PNEWS_33." ".$date." (".$newscattitle.")</i> ".$pageviews." ".$comments."</td>
</tr>
</table><br>";}

$pnews_newstext .= "</div>";


//-------------------# End #------------------

$ns -> tablerender($pnews_newstitle, $pnews_newstext);

//-------------------------------------------------------------------------

?>