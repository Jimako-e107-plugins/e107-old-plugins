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

$pnews_archtitle .= "".$pref['pnews_archm_menutitle']."";

//------------------------------------------------


$pnews_archtext .= "<div style='width:100%; height:".$pref['pnews_archm_menuheight']."px; overflow:auto'><table style='width:100%' class=''>";

if ($pref['pnews_archm_newsstart'] == "1")
{$startpoint = $pref['pnews_newsm_newscount'];}
else
{$startpoint = "0";}

$sql->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_pnews order by news_date DESC limit ".$startpoint.",".$pref['pnews_archm_newscount'].";");
while($row = $sql->db_fetch()){
$newsid = $row['news_id'];
$newstitle = $row['news_title']; 
$newsimg = "<img src='".e_PLUGIN."aacgc_pnews/public/".$row['news_img']."' width='".$pref['pnews_archm_newsimgsize']."px', height='".$pref['pnews_archm_newsimgsize']."px' />";
$author = $row['news_author'];
$dformat = $pref['pnews_dateformat'];
$date = date($dformat, $row['news_date']);
$cat = $row['news_cat'];

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

$pnews_archtext .= "<tr>
	  <td style='width:0%' class='".$themeb."'><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'>".$newsimg."</a></td>
	  <td style='width:100%' class='".$themea."'><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'><font size='".$pref['pnews_archm_newstfsize']."'><b>".$newstitle."</b></font></a>
	  <br><div class='".$themeb."'><i>(".PNEWS_29." ".$authorname." ".PNEWS_33." ".$date.") (".$newscattitle.")</i> ".$pageviews." ".$comments."</div></td>
	  </tr>";}

$pnews_archtext .= "</table></div>";


//-------------------# End #------------------

$ns -> tablerender($pnews_archtitle, $pnews_archtext);

//-------------------------------------------------------------------------

?>