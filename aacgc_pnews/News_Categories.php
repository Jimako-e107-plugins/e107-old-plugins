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

//------------------------------------------------


//-------------------# Header / Intro #-----------

$text .= "<table style='width:100%' class='".$themea."'>
	  <tr>
          <td class='' colspan=3><center><font size='".$pref['pnews_cat_headerfsize']."'><b>".$pref['pnews_cat_header']."</b></font></center></td>
          </tr><tr>
          <td class='' colspan=3><center><font size='".$pref['pnews_cat_introfsize']."'>".$pref['pnews_cat_intro']."</font></center><br><br></td>
          </tr>";

if ($pref['pnews_enable_submit'] == "1"){
if (USER){

if ($pref['pnews_userclass'] == "members")
{$text .= "<tr><td class='".$themeb."'><center><a href='".e_PLUGIN."aacgc_pnews/Submit_News.php'>[ ".PNEWS_27." ]</a></center></td></tr>";}
else
{if ( check_class($pref['pnews_userclass']) ){
$text .= "<tr><td class='".$themeb."'><center><a href='".e_PLUGIN."aacgc_pnews/Submit_News.php'>[ ".PNEWS_27." ]</a></center></td></tr>";}}

}}

$text .= "</table>
	  <br><br>";


//-----------------------------------------------------------


$text .= "<center><table style='width:100%' class=''>";

$sql ->db_Select("aacgc_pnews_cat", "*", "ORDER BY news_cat_title ASC","");
while($row = $sql ->db_Fetch()){
$newscatid = $row['news_cat_id'];
$newscattitle = $row['news_cat_title'];
$newscatdesc = $row['news_cat_desc'];

$text .= "<tr>
	  <td style='width:100%' class='".$themea."'>
	  <a href='".e_PLUGIN."aacgc_pnews/News.php?det.".$newscatid."'><font size='".$pref['pnews_cat_catfsize']."'><b>".$newscattitle."</b></font></a><br>".$newscatdesc."
	  </tr>";

if ($pref['pnews_shownewssec'] == "1")
{$text .= "<tr>
	  <td style='width:100%' class='".$themeb."'><div style='width:100%; height:".$pref['pnews_cat_newssecheight']."px; overflow:auto'>
	  <table style='width:100%'>";

$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_pnews where news_cat=".intval($newscatid)." order by news_date DESC limit 0,".$pref['pnews_cat_newscount'].";");
while($news = $sql2->db_fetch()){

if ($pref['pnews_cat_newsimgratio'] == "width")
{$height = "height='".$pref['pnews_cat_newsimgsize']."px'";}
if ($pref['pnews_cat_newsimgratio'] == "auto")
{$height = "";}

$newsid = $news['news_id'];
$newstitle = $news['news_title']; 
$newsimg = "<img src='".e_PLUGIN."aacgc_pnews/public/".$news['news_img']."' width='".$pref['pnews_cat_newsimgsize']."px', ".$height." />";
$newssum = $news['news_sum'];
$charlimit = $pref['pnews_cat_newsdesclimit'];
$newsdesc = substr($news['news_desc'], 0, $charlimit); 
$author = $news['news_author'];
$dformat = $pref['pnews_dateformat'];
$date = date($dformat, $news['news_date']);


if ($pref['pnews_cat_infochoice'] == "desc")
{$newsinfo = $newsdesc;}
if ($pref['pnews_cat_infochoice'] == "summary")
{$newsinfo = $newssum;}
if ($pref['pnews_showemptysum'] == "1"){
if ($newsinfo == "")
{$newsinfoshow = $newsdesc;}
else
{$newsinfoshow = $newsinfo;}}
else
{$newsinfoshow = $newsinfo;}


$sql3 = new db;
$sql3->mySQLresult = @mysql_query("select * from ".MPREFIX."user where user_id=".intval($author).";");
$row3 = $sql3->db_fetch();
$authorname = $row3['user_name'];

$text .= "<tr>
	  <td colspan='2' class='".$themea."'><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'><font size='".$pref['pnews_cat_newstfsize']."'><b>".$newstitle."</b></font></a></td>
	  </tr>
	  <tr>
	  <td style='width:0%' class='".$themeb."'><a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'>".$newsimg."</a></td>
	  <td style='width:100%' class='".$themea."'>".$tp -> toHTML($newsinfoshow, TRUE)." <a href='".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$newsid."'>".PNEWS_28."</a>
	  <br><br><div class='".$themeb."' style=''><i>".PNEWS_29." ".$authorname." ".PNEWS_33." ".$date."</i></div></td>
	  </tr>";}

$text .= "</table></div></td></tr>";}}


$text .= "</table></center>";


//-------------------# End #------------------



//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_pnews/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+

$ns -> tablerender($title, $text);

//-------------------------------------------------------------------------

require_once(FOOTERF);

?>