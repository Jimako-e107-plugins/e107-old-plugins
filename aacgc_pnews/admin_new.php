<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Public News               #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

require_once("../../class2.php");

if(!getperms("P")) {
echo "";
exit;
}

require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;

require_once(e_HANDLER."calendar/calendar_class.php");
$cal = new DHTML_Calendar(true);
function headerjs()
{
	global $cal;
	require_once(e_HANDLER."calendar/calendar_class.php");
	$cal = new DHTML_Calendar(true);
	return $cal->load_files();
}

include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");

//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//-----------------------------------------------------------------------------------------------------------+
if ($_POST['add_news'] == '1') {

if ($_FILES['news_img']['name'] == "")
{$newimgname = "noimage.png";}
else
{$offset = $pref['pnews_dateoffset'];
$imgnametime = time()  + ($offset * 60 * 60);
$ctime = $imgnametime;
$newimgname = $ctime.$_FILES['news_img']['name'];}

$newstitlereplace = $tp->toDB($_POST['news_title']);
$string = substr($_POST['news_sum'], 0, $pref['pnews_sum_limit']);
$newssumreplace = $tp->toDB($string);
$newsdescreplace = $tp->toDB($_POST['news_desc']);


$newstitle = $newstitlereplace;
$newssum = $newssumreplace;
$newsdesc = $newsdescreplace;
$newsimg = $newimgname;
$newscat = $_POST['news_cat'];
$newsauthor = $_POST['news_author'];
$newsdate = $_POST['news_date'];

$allowed[] = 'gif'; 
$allowed[] = 'jpg'; 
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
$reason = "".APNEWS_91."";}
elseif ($newsdesc == "")
{$newok = "0";
$reason = "".APNEWS_92."";}
elseif (!in_array($ext, $allowed))
{$newok = "0";
$reason = "".APNEWS_93."";} 
elseif ($filesize > $filesizemax)
{$newok = "0";
$reason = "".APNEWS_94."";}
else
{$newok = "1";}

If ($newok == "0")
{$newtext = "<center><b><br><br> ".$reason."</center></b>";
$ns->tablerender("", $newtext);}


If ($newok == "1"){
$sql->db_Insert("aacgc_pnews", "NULL, '".$newstitle."', '".$newssum."', '".$newsdesc."', '".$newsimg."', '".$newscat."', '".$newsauthor."', '".$newsdate."'") or die(mysql_error());

$uploaddir = e_PLUGIN."aacgc_pnews/public/";
$uploadfile = $uploaddir . basename($newimgname);

if (move_uploaded_file($_FILES['news_img']['tmp_name'], $uploadfile)) {
$filestat = "".APNEWS_95."";} 


$ns->tablerender("", "<center><b>".APNEWS_96."</b><br>".$filestat."</center>");
}}

//-----------------------------------------------------------------------------------------------------------+

$sql->db_Select("aacgc_pnews_cat", "*", "");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='news_cat' value='".$option['news_cat_id']."'>".$option['news_cat_title']."</option>";}

$sql2 = new db;
$sql2->db_Select("user", "*", "");
$rows2 = $sql2->db_Rows();
for ($i=0; $i < $rows2; $i++) {
$option2 = $sql2->db_Fetch();
$options2 .= "<option name='news_author' value='".$option2['user_id']."'>".$option2['user_name']."</option>";}

$offset = $pref['pnews_dateoffset'];
$time = time()  + ($offset * 60 * 60);
$sent = $time;


$text .= "<form method='POST' action='admin_new.php' enctype='multipart/form-data'>

	<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_69.":</td>
        <td style='width:70%' class='forumheader3'>
        <input class='tbox' type='text' name='news_title' size='75'>
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APNEWS_70.":<br><i>".APNEWS_71." ".$pref['pnews_sum_limit']." ".APNEWS_72."<br></i></td>
        <td style='width:' class='forumheader3'>
	<textarea class='tbox' name='news_sum' rows='5' cols='75' style='width:95%'></textarea>
	</td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APNEWS_73.":</td>
        <td style='width:' class='forumheader3'>
	<textarea class='tbox' name='news_desc' rows='15' cols='75' style='width:95%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "</td>
	</td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APNEWS_74."</td>
        <td style='width:' class='forumheader3'>
	<input type='file' name='news_img'>
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APNEWS_77.":</td>
        <td style='width:' class='forumheader3'>
	<select name='news_cat' size='1' class='tbox' style='width:50%'>
	".$options."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APNEWS_78.":</td>
        <td style='width:' class='forumheader3'>
	<select name='news_author' size='1' class='tbox' style='width:50%'>
	".$options2."
        </td>
        </tr>
        <tr>
	<td style='width:; text-align:right' class='forumheader3'>".APNEWS_79.":</td>
        <td style='width:' class='forumheader3'>";

$text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%s',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'news_date',
                 'value'       => $sent));

        $text .= "</td>
        </tr>";


        $text .= " 		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader3'>
	<input type='hidden' name='add_news' value='1'>
	<input class='button' type='submit' value='".APNEWS_97."'>
	</td>
        </tr>
	</table>";

//-----------------------------------


$text .="</form>";



	      $ns -> tablerender("AACGC Public News (Create News)", $text);
	      require_once(e_ADMIN."footer.php");
?>

