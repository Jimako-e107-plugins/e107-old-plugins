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
$themeb = "indent";
$themec = "forumheader";}
else
{$themea = "";
$themeb = "";
$themec = "";}

include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");


//-------------------------# BB Code Support #----------------------------------------------
if ($pref['pnews_com_bbcode'] == "1"){
include(e_HANDLER."ren_help.php");
}
//-------------------# Title #--------------------

$title .= "".PNEWS_34."";

//------------------------------------------------

$sql ->db_Select("aacgc_pnews", "*", "news_id = '".intval($sub_action)."'");
$row = $sql ->db_Fetch();
$cat = $row['news_cat'];
//-------------------# Header / Intro #-----------

$text .= "<table style='width:100%' class='".$themea."'>
          <tr>
	  <td style='width:50%' class='".$themeb."'><center>[ <a href='".e_PLUGIN."aacgc_pnews/News.php?det.".$cat."'>".PNEWS_35."</a> ]</center></td>";


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

$newsid = $row['news_id'];
$newstitle = $row['news_title'];
$newssum = $row['news_sum'];
$newsdesc = $row['news_desc'];
$newsimg = "<img src='".e_PLUGIN."aacgc_pnews/public/".$row['news_img']."' width='".$pref['pnews_det_newsimgsize']."px' />";
$author = $row['news_author'];
$dformat = $pref['pnews_dateformat'];
$date = date($dformat, $row['news_date']);
$oid = "".USERID."";

//----# Counter #------------------------

$page = $newsid;
$count = "0";
$sql4 = new db;
$sql4->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_pnews_counter where page=".$page.";");
$row4 = $sql4->db_fetch();

if ($row4['page'] == ""){
$newcounter = '1';
$newcpage = $newsid;
$newvisitor = '0';
$sql->db_Insert("aacgc_pnews_counter", "NULL, '".$newcounter."', '".$newcpage."', '".$newvisitor."'") or die(mysql_error());}

$count = $row4['counter'];
$count = $count+1;
$sql->db_Update("aacgc_pnews_counter", "countid='".$row4['countid']."',counter='".$count."',visitor='0' WHERE page='".$page."'");

$pageviews = "<i>(".PNEWS_01.": ".$count.")</i>";

//---------------------------------------

$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select * from ".MPREFIX."user where user_id='".intval($author)."';");
$row2 = $sql2->db_fetch();
$authorname = $row2['user_name'];

$sql3 = new db;
$sql3->db_Select("user", "*", "WHERE user_id=".USERID."","");
$row3 = $sql3->db_Fetch();

$userc = @mysql_query("SELECT user_class FROM ".MPREFIX."user WHERE user_id='".USERID."'");
$userc = mysql_fetch_array($userc);
$break = explode(",", $userc['user_class']);

if (in_array($pref['pnews_moderators'], $break)){
$edit = "<a href='".e_PLUGIN."aacgc_pnews/Edit_News.php?det.".$newsid."'><img src='".e_PLUGIN."aacgc_pnews/images/edit_16.png' align='right' /></a>";}

if ($pref['pnews_enable_useredit'] == "1"){
if ($author == $oid){
$edit = "<a href='".e_PLUGIN."aacgc_pnews/Edit_News.php?det.".$newsid."'><img src='".e_PLUGIN."aacgc_pnews/images/edit_16.png' align='right' /></a>";}}


$text .= "<table style='width:100%' class=''>";

$text .= "<tr>
	  <td class='".$themea."'><center><font size='".$pref['pnews_det_newstfsize']."'><b>".$tp->toHTML($newstitle, TRUE)."</b></font></center></td>
	  </tr>
	  <tr>
	  <td class='".$themeb."'><center><a href='".e_PLUGIN."aacgc_pnews/public/".$row['news_img']."' target='_blank'>".$newsimg."</a><br>".PNEWS_36."</center></td>
	  </tr>
	  <tr>
	  <td class='".$themea."'>".$tp->toHTML($newssum, TRUE)."</td>
	  </tr>
	  <tr>
	  <td class='".$themea."'>".$tp->toHTML($newsdesc, TRUE)."</td>
	  </tr>
	  <tr>
	  <td class='".$themea."'><i>".PNEWS_29." ".$authorname." ".PNEWS_33." ".$date."</i> ".$pageviews." ".$edit."</td>
	  </tr>";


$text .= "</table>";



//--------------# Comments #---------------------------------------------

if ($pref['pnews_com_enable'] == "1"){


if ($_POST['add_comment'] == '1') {

if ($pref['pnews_com_bbcode'] == "1"){
$newscomreplace = substr($_POST['news_com_comment'], 0, $pref['pnews_com_limit']);}
else
{$string = substr($_POST['news_com_comment'], 0, $pref['pnews_com_limit']);
$newscomreplace = $tp->toDB($string);}

$com = $newscomreplace;
$news = $_POST['news_com_newsid'];
$author = $_POST['news_com_author'];
$date = $_POST['news_com_date'];

if ($com == "")
{$newok = "0";
$reason = "".PNEWS_37."";}
else
{$newok = "1";}

If ($newok == "1"){
$sql->db_Insert("aacgc_pnews_comments", "NULL, '".$com."', '".$news."', '".$author."', '".$date."'") or die(mysql_error());
$ns->tablerender("", "<center>".PNEWS_38."</center>");}

}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_pnews_comments", "news_com_id='".$delete_id[0]."'");
	
}

//----------------

$text .= "<br><br><br>
	  <form method='POST' action='News_Details.php?det.".$newsid."' enctype='multipart/form-data'>
	  <table style='width:100%' class='".$themea."'>
	  <tr>
	  <td class='".$themec."' colspan='2'>".PNEWS_39."</td>
	  </tr>";

$sql4 = new db;
$sql4 ->db_Select("aacgc_pnews_comments", "*", "WHERE news_com_newsid = '".intval($newsid)."'","");
while($row4 = $sql4 ->db_Fetch()){

$sql5 = new db;
$sql5->mySQLresult = @mysql_query("select * from ".MPREFIX."user where user_id='".intval($row4['news_com_author'])."';");
$row5 = $sql5->db_fetch();

$newscomauthor = $row5['user_name'];
$newscomdate = date('M d, Y h:i A', $row4['news_com_date']);
$newscomment = nl2br($tp -> toHTML($row4['news_com_comment'], TRUE,'no_hook,emotes_off'));

$userc = @mysql_query("SELECT user_class FROM ".MPREFIX."user WHERE user_id='".USERID."'");
$userc = mysql_fetch_array($userc);
$break = explode(",", $userc['user_class']);

if ((in_array($pref['pnews_userclass'], $break)) OR (ADMIN))
{$deletbutton = "<input type='image' title='Delete' name='main_delete[".$row4['news_com_id']."]' src='".e_PLUGIN."aacgc_pnews/images/Delete.png' onclick=\"return jsconfirm('".PNEWS_40." [ID: {$row4['news_com_id']} ]')\"/>";}


$text .= "<tr>
	  <td class='".$themea."' style='width:25%; text-align:left'>".$newscomauthor."<br><i>".$newscomdate."</i><br><br>".$deletbutton."</td>
	  <td class='".$themeb."' style='width:75%'>".$tp->toHTML($newscomment, TRUE)."</td>
	  </tr>";}


$text .= "</table><br><br>";

//----------------

if (USER){
if ($pref['pnews_com_bbcode'] == "0")
{$bbcodestatus = "".PNEWS_41."";}

$offset = +0;
$time = time()  + ($offset * 60 * 60);
$sent = $time;

$text .= "<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
          <tr>
          <td style='width:; text-align:center' class='".$themea."'>".PNEWS_42.":<br><i>".PNEWS_43." ".$pref['pnews_com_limit']." ".PNEWS_44."</i><br>".$bbcodestatus."</td>
	  </tr>
	  <tr>
          <td style='width:' class='".$themea."'>";

if ($pref['pnews_com_bbcode'] == "1"){
$text .= "<textarea class='tbox' name='news_com_comment' rows='15' cols='75' style='width:95%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";
$text .= display_help('helpb', 'forum');}
else
{$text .= "<textarea class='tbox' name='news_com_comment' rows='15' cols='75' style='width:95%'></textarea>";}

$text .= "</td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='news_com_newsid' value='".$newsid."'>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='news_com_author' value='".USERID."'>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='news_com_date' value='".$sent."'>
        </td>
        </tr>";

        $text .= " 		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader3'>
	<input type='hidden' name='add_comment' value='1'>
	<input class='button' type='submit' value='".PNEWS_45."'>
	</td>
        </tr>";


$text .= "</table></form>";}

}
//-----------------------------------------------------------------------





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