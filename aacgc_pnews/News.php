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

require_once("../../class2.php");
require_once(HEADERF);

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}

if ($pref['pnews_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}


include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");

//-------------------# Title #--------------------

$title .= "".PNEWS_25."";


//-------------------# Header / Intro #-----------

$text .= "<table style='width:100%' class='".$themea."'>
          <tr>
	  <td style='width:50%' class='".$themeb."'><center>[ <a href='".e_PLUGIN."aacgc_pnews/News_Categories.php'>".PNEWS_26."</a> ]</center></td>";

if ($pref['pnews_enable_submit'] == "1"){
if (USER){

if ($pref['pnews_userclass'] == "members")
{$text .= "<td style='width:50%' class='".$themeb."'><center><a href='".e_PLUGIN."aacgc_pnews/Submit_News.php'>[ ".PNEWS_27." ]</a></center></td>";}
else
{if ( check_class($pref['pnews_userclass']) ){
$text .= "<td style='width:50%' class='".$themeb."'><center><a href='".e_PLUGIN."aacgc_pnews/Submit_News.php'>[ ".PNEWS_27." ]</a></center></td>";}}

}}

$text .= "</tr>
          </table>
	  <br><br>";


//-----------------------------------------------------------

//--------------# Multipage Script #---------------------------
if ($pref['pnews_newsperpage'] != '') 
{$rowsPerPage = $pref['pnews_newsperpage'];} 
else 
{$rowsPerPage = "5";}

if(isset($_GET['rowspp']))
{$rowsPerPage = intval($_GET['rowspp']);}

$pageNum = 1;
if(isset($_GET['page']))
{$pageNum = intval($_GET['page']);}

$offset = ($pageNum - 1) * $rowsPerPage;


$query = @mysql_query("SELECT news_id FROM ".MPREFIX."aacgc_pnews WHERE news_cat='".intval($sub_action)."'");
$numrows = mysql_num_rows($query);

if(isset($_POST['page'])) 
{$rowsPerPage = intval($_POST['page']);}

$maxPage = ceil($numrows/$rowsPerPage);
$self = $_SERVER['PHP_SELF'];
$nav  = '';

for($page = 1; $page <= $maxPage; $page++) {
if ($page == $pageNum) 
{$nav .= " $page ";} 
else 
{$nav .= " <a href=\"$self?page=".$page."&rowspp=".$rowsPerPage."&det.".$sub_action."\">$page</a> ";}}

if ($pageNum > 1) 
{$page  = $pageNum - 1;
$prev  = " <a href=\"$self?page=$page&rowspp=$rowsPerPage&det.$sub_action\">".PNEWS_30."</a> ";} 
else 
{$prev  = "";}

if ($pageNum < $maxPage) 
{$page = $pageNum + 1;
$next = " <a href=\"$self?page=$page&rowspp=$rowsPerPage&det.$sub_action\">".PNEWS_31."</a> ";} 
else 
{$next = "";}

//---------------------------------------------------------------

if ($pref['pnews_newsperpage'] == "") 
{$limit = "LIMIT ".$offset.",".$rowsPerPage."";} 
else 
{$limit = "LIMIT ".$offset.",".$rowsPerPage."";}

$sql ->db_Select("aacgc_pnews_cat", "*", "news_cat_id = '".intval($sub_action)."'");
$row = $sql ->db_Fetch();
$newscatid = $row['news_cat_id'];
$newscattitle = $row['news_cat_title'];
$newscatdesc = $row['news_cat_desc'];

$text .= "<table style='width:100%' class=''>";

$text .= "<tr>
	  <td style='width:100%' class='".$themea."'><center>
	  <a href='".e_PLUGIN."aacgc_pnews/News.php?det.".$newscatid."'><font size='".$pref['pnews_news_catfsize']."'><b>".$newscattitle."</b></font></a><br>".$newscatdesc."
	  </center></td></tr><tr><td>";


$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_pnews where news_cat=".intval($newscatid)." ORDER BY news_date DESC $limit;");
while($news = $sql2->db_fetch()){

if ($pref['pnews_news_newsimgratio'] == "width")
{$height = "height='".$pref['pnews_news_newsimgsize']."px'";}
if ($pref['pnews_news_newsimgratio'] == "auto")
{$height = "";}

$newsid = $news['news_id'];
$newstitle = $news['news_title']; 
$newsimg = "<img src='".e_PLUGIN."aacgc_pnews/public/".$news['news_img']."' width='".$pref['pnews_news_newsimgsize']."px', ".$height." />";
$charlimit = $pref['pnews_news_newsdesclimit'];
$newsdesc = substr($news['news_desc'], 0, $charlimit); 
$author = $news['news_author'];
$dformat = $pref['pnews_dateformat'];
$date = date($dformat, $news['news_date']);
$newssum = $news['news_sum'];

$sql3 = new db;
$sql3->mySQLresult = @mysql_query("select * from ".MPREFIX."user where user_id=".intval($author).";");
$row3 = $sql3->db_fetch();
$authorname = $row3['user_name'];

if ($pref['pnews_news_infochoice'] == "desc")
{$newsinfo = $newsdesc;}
if ($pref['pnews_news_infochoice'] == "summary")
{$newsinfo = $newssum;}
if ($pref['pnews_showemptysum'] == "1"){
if ($newsinfo == "")
{$newsinfoshow = $newsdesc;}
else
{$newsinfoshow = $newsinfo;}}
else
{$newsinfoshow = $newsinfo;}

$page = $newsid;
$sql4 = new db;
$sql4->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_pnews_counter where page=".intval($page).";");
$row4 = $sql4->db_fetch();
if ($row4['counter'] == "")
{$count = "0";}
else
{$count = $row4['counter'];}
$pageviews = "<i>(".PNEWS_01.": ".$count.")</i>";

if ($pref['pnews_com_enable'] == "1"){
$sql5 = new db;
$sql5->mySQLresult = @mysql_query("select *, count(news_com_id) as coms from ".MPREFIX."aacgc_pnews_comments where news_com_newsid=".intval($newsid).";");
$row5 = $sql5->db_fetch();
$comments = "<i>(".PNEWS_32.": ".$row5['coms'].")</i>";}


$text .= "<table style='width:100%' class='".$themea."'>
	  <tr>
	  <td colspan='2' class='".$themea."'><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'><font size='".$pref['pnews_news_newstfsize']."'><b>".$newstitle."</b></font></a></td>
	  </tr>
	  <tr>
	  <td style='width:0%' class='".$themeb."'><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'>".$newsimg."</a></td>
	  <td style='width:100%' class='".$themeb."'>".$tp -> toHTML($newsinfoshow, TRUE)." <a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'>".PNEWS_28."</a>
	  <br><br><div class='".$themeb."' style=''><i>".PNEWS_29." ".$authorname." ".PNEWS_33." ".$date."</i> ".$pageviews." ".$comments."</div></td>
	  </tr>
	  </table>";}


$text .= "</td></tr></table><br><br>";



//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_pnews/plugin.php');
$copyright .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+

$ns -> tablerender($title, $text."<br><br>".$prev.$nav.$next.$copyright);

//-------------------------------------------------------------------------

require_once(FOOTERF);

?>