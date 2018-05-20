<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Public News               #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
require_once(HEADERF);
include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");

if ($pref['pnews_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "forumheader3";
$themeb = "indent";}

$title .= "".PNEWS_46."";

if ($pref['pnews_enable_submit'] == "1"){
if(USER){
if ( (check_class($pref['pnews_userclass'])) OR ($pref['pnews_userclass'] == "members") ){



//-------------------------# BB Code Support #----------------------------------------------
if ($pref['pnews_enable_bbcode'] == "1"){
include(e_HANDLER."ren_help.php");
}

if ( check_class($pref['pnews_autoapprove_userclass']) ){

//------------------------------# Auto Approve #----------------------------------------------------------------------
if ($_POST['add_news'] == '1') {

if ($_FILES['news_sub_img']['name'] == "")
{$newimgname = "noimage.png";}
else
{$offset = $pref['pnews_dateoffset'];
$imgnametime = time()  + ($offset * 60 * 60);
$ctime = $imgnametime;
$newimgname = $ctime.$_FILES['news_sub_img']['name'];}

$newstitlereplace = $tp->toDB($_POST['news_sub_title']);
$string = substr($_POST['news_sub_sum'], 0, $pref['pnews_sum_limit']);
$newssumreplace = $tp->toDB($string);
$newsdescreplace = $tp->toDB($_POST['news_sub_desc']);

$newstitle = $newstitlereplace;
$newssum = $newssumreplace;
$newsdesc = $newsdescreplace;
$newsimg = $newimgname;
$newscat = intval($_POST['news_sub_cat']);
$newsauthor = intval($_POST['news_sub_author']);
$newsdate = intval($_POST['news_sub_date']);

$allowed[] = 'gif'; 
$allowed[] = 'jpg'; 
$allowed[] = 'jpeg';
$allowed[] = 'png';
$allowed[] = 'bmp';
$allowed[] = '';
$filename = $_FILES['news_sub_img']['name']; 
$filesize = $_FILES['news_sub_img']['size'];
$filesizemax = $pref['pnews_filesize'];

$ext = substr($filename, strrpos($filename, '.')+1 , 3); 
$ext = strtolower($ext); 

$reason = "";
$newok = "";

if ($newstitle == "")
{$newok = "0";
$reason = "".PNEWS_47."";}
elseif ($newsdesc == "")
{$newok = "0";
$reason = "".PNEWS_48."";}
elseif (!in_array($ext, $allowed))
{$newok = "0";
$reason = "".PNEWS_49."";} 
elseif ($filesize > $filesizemax)
{$newok = "0";
$reason = "".PNEWS_50."";}
else
{$newok = "1";}

If ($newok == "0")
{$newtext = "<center><b><br><br> ".$reason."</center></b>";
$ns->tablerender("", $newtext);}

If ($newok == "1"){

$sql->db_Insert("aacgc_pnews", "NULL, '".$newstitle."', '".$newssum."', '".$newsdesc."', '".$newsimg."', '".$newscat."', '".$newsauthor."', '".$newsdate."'") or die(mysql_error());

$uploaddir = e_PLUGIN."aacgc_pnews/public/";
$uploadfile = $uploaddir . basename($newimgname);
if (move_uploaded_file($_FILES['news_sub_img']['tmp_name'], $uploadfile))
{$filestat = "".PNEWS_51."";} 


$ns->tablerender("", "<center><b>".PNEWS_52."</b><br>".$filestat."</center>");}

}
}
else
{
//--------------------------------# Require Approval #--------------------------------------------------------------------

if ($_POST['add_news'] == '1') {

if ($_FILES['news_sub_img']['name'] == "")
{$newimgname = "noimage.png";}
else
{$offset = $pref['pnews_dateoffset'];
$imgnametime = time()  + ($offset * 60 * 60);
$ctime = $imgnametime;
$newimgname = $ctime.$_FILES['news_sub_img']['name'];}

$string = substr($_POST['news_sub_sum'], 0, $pref['pnews_sum_limit']);
$newssumreplace = $tp->toDB($string);

$newstitle = $tp->toDB($_POST['news_sub_title']);
$newssum = $newssumreplace;
$newsdesc = $tp->toDB($_POST['news_sub_desc']);
$newsimg = $newimgname;
$newscat = intval($_POST['news_sub_cat']);
$newsauthor = intval($_POST['news_sub_author']);
$newsdate = intval($_POST['news_sub_date']);

if ($pref['pnews_enable_pmnote'] == "1"){
$newpmfrom = $_POST['pm_from'];
$newpmto = $_POST['pm_to'];
$newpmsent = $_POST['pm_sent'];
$newpmread = $_POST['pm_read'];
$newpmsubject = $_POST['pm_subject'];
$newpmtext = $_POST['pm_text'];
$newpmsenddel = $_POST['pm_send_del'];
$newpmreaddel = $_POST['pm_read_del'];
$newpmatt = $_POST['pm_attachments'];
$newpmoption = $_POST['pm_option'];
$newpmsize = $_POST['pm_size'];}

$allowed[] = 'gif'; 
$allowed[] = 'jpg';
$allowed[] = 'jpeg'; 
$allowed[] = 'png';
$allowed[] = 'bmp'; 
$allowed[] = '';

$filename = $_FILES['news_sub_img']['name']; 
$filesize = $_FILES['news_sub_img']['size'];
$filesizemax = $pref['pnews_filesize'];

$ext = substr($filename, strrpos($filename, '.')+1 , 3); 
$ext = strtolower($ext); 

$reason = "";
$newok = "";

if ($newstitle == "")
{$newok = "0";
$reason = "".PNEWS_47."";}
elseif ($newsdesc == "")
{$newok = "0";
$reason = "".PNEWS_48."";}
elseif (!in_array($ext, $allowed))
{$newok = "0";
$reason = "".PNEWS_49."";} 
elseif ($filesize > $filesizemax)
{$newok = "0";
$reason = "".PNEWS_50."";}
else
{$newok = "1";}

If ($newok == "0")
{$newtext = "<center><b><br><br> ".$reason."</center></b>";
$ns->tablerender("", $newtext);}

If ($newok == "1"){

$sql->db_Insert("aacgc_pnews_submitted", "NULL, '".$newstitle."', '".$newssum."', '".$newsdesc."', '".$newsimg."', '".$newscat."', '".$newsauthor."', '".$newsdate."'") or die(mysql_error());
if ($pref['pnews_enable_pmnote'] == "1"){
$sql2->db_Insert("private_msg", "NULL, '".$newpmfrom."', '".$newpmto."', '".$newpmsent."', '".$newpmread."', '".$newpmsubject."', '".$newpmtext."', '".$newpmsenddel."', '".$newpmreaddel."', '".$newpmatt."', '".$newpmoption."', '".$newpmsize."'") or die(mysql_error());
}

$uploaddir = e_PLUGIN."aacgc_pnews/public/";
$uploadfile = $uploaddir . basename($newimgname);

if (move_uploaded_file($_FILES['news_sub_img']['tmp_name'], $uploadfile))
{$filestat = "".PNEWS_51."";} 


$ns->tablerender("", "<center><b>".PNEWS_53."</b><br>".$filestat."</center>");}

}}
//-----------------------------------------------------------------------------------------------------------+


$sql->db_Select("aacgc_pnews_cat", "*", "");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='news_sub_cat' value='".$option['news_cat_id']."'>".$option['news_cat_title']."</option>";}


$offset = $pref['pnews_dateoffset'];
$time = time()  + ($offset * 60 * 60);
$sent = $time;

//-------------------# Header / Intro #-----------

$text .= "<br><table style='width:100%' class='".$themea."'>
          <tr>
          <td class=''><center>".PNEWS_54."</center></td>
          </tr>
          </table><br>";

//------------------------------------------------------------------------------------------------------------


$text .= "<form method='POST' action='Submit_News.php' enctype='multipart/form-data'>

	<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".PNEWS_09.":</td>
        <td style='width:70%' class='forumheader3'>
        <input class='tbox' type='text' name='news_sub_title' size='80'>
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".PNEWS_10.":<br><i>".PNEWS_11." ".$pref['pnews_sum_limit']." ".PNEWS_12."</i></td>
        <td style='width:' class='forumheader3'>
	<textarea class='tbox' name='news_sub_sum' rows='5' cols='80' style='width:95%'></textarea>
	</td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".PNEWS_13."</i></td>
        <td style='width:' class='forumheader3'>";

if ($pref['pnews_enable_bbcode'] == "1"){
$text .= "<textarea class='tbox' name='news_sub_desc' rows='30' cols='75' style='width:95%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";
$text .= display_help('helpb', 'forum');}
else
{$text .= "<textarea class='tbox' name='news_sub_desc' rows='30' cols='75' style='width:95%'></textarea>";}

$text .= "</td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".PNEWS_55."</td>
        <td style='width:' class='forumheader3'>
	<input type='file' name='news_sub_img'>
	<br><i>".PNEWS_15." ".$pref['pnews_filesize']."B (1,000B = 1KB)</i><br>".PNEWS_16."
	</td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".PNEWS_17.":</td>
        <td style='width:' class='forumheader3'>
	<select name='news_sub_cat' size='1' class='tbox' style='width:50%'>
	".$options."
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='news_sub_author' value='".USERID."'>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='news_sub_date' value='".$sent."'>
        </td>
        </tr>";


        $text .= " 		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader3'>
	<input type='hidden' name='add_news' value='1'>
	<input class='button' type='submit' value='".PNEWS_27."'>
	</td>
        </tr>";



//-----------------------# Auto PM Section #------------------------+
if ($pref['pnews_enable_pmnote'] == "1"){
$subject = "".PNEWS_57."";

$message = "".PNEWS_57." [ <a href=".e_PLUGIN."aacgc_pnews/admin_subnews.php>".PNEWS_58."</a> ]";

$to = $pref['pnews_pmuser'];
$from = "".USERID."";

$text .= "
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_from' value='".$from."'>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_to' value='".$to."'>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_sent' value='".$sent."'>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_read' value='0'>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_subject' value='".$subject."'>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_text' value='".$message."'>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_send_del' value='0'>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_read_del' value='0'>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_attachments' value=''>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_option' value=''>
        </td>
        </tr>
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_size' value='0'>
        </td>
        </tr>
";
}
//------------------------------------------------------------------+


$text .= "</table></form>";}}}

//-------------

else

{$text .= "<i>".PNEWS_59."</i>";} 
   
  
$ns -> tablerender($title, $text);

require_once(FOOTERF);

?>
