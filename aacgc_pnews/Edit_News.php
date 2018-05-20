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
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $id = $tmp[1];
        unset($tmp);
}


include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");

$title .= "".PNEWS_02."";
if (USER){
if ($pref['pnews_enable_useredit'] == "1"){
//-------------------------# BB Code Support #----------------------------------------------
if ($pref['pnews_enable_bbcode'] == "1"){
include(e_HANDLER."ren_help.php");
}
//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_news'])) {


$newstitlereplace = $tp->toDB($_POST['news_title']);
$string = substr($_POST['news_sum'], 0, $pref['pnews_sum_limit']);
$newssumreplace = $tp->toDB($string);
$newsdescreplace = $tp->toDB($_POST['news_desc']);

if ($_FILES['news_img']['name'] == "")
{$newok = "1";
$file = $_POST['news_oldimg'];}
else
{$offset = $pref['pnews_dateoffset'];
$imgnametime = time()  + ($offset * 60 * 60);
$ctime = $imgnametime;
$newimgname = $ctime.$_FILES['news_img']['name'];
$file = $newimgname;

$allowed[] = 'gif'; 
$allowed[] = 'jpg'; 
$allowed[] = 'png';
$allowed[] = 'bmp'; 
$filename = $_FILES['news_img']['name']; 
$filesize = $_FILES['news_img']['size'];
$filesizemax = $pref['pnews_filesize'];
$ext = substr($filename, strrpos($filename, '.')+1 , 3); 
$ext = strtolower($ext); 

$reason = "";
$newok = "";

if (!in_array($ext, $allowed))
{$newok = "0";
$reason = "".PNEWS_03."";} 
elseif ($filesize > $filesizemax)
{$newok = "0";
$reason = "".PNEWS_04."";}
else
{$newok = "1";}}

If ($newok == "0")
{$newtext = "<center><b><br><br> ".$reason."</center></b>";
$ns->tablerender("", $newtext);}

If ($newok == "1"){

$message =
($sql->db_Update("aacgc_pnews", "
	news_title='".$newstitlereplace."', 
	news_sum='".$newssumreplace."',
	news_desc='".$newsdescreplace."', 
	news_img='".$file."', 
	news_cat='".$_POST['news_cat']."', 
	news_author='".$_POST['news_author']."', 
	news_date='".$_POST['news_date']."' 
	WHERE news_id='".intval($_POST['id'])."'
 ")) ? "".PNEWS_23."" : "".PNEWS_24."";

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
$newpmsize = $_POST['pm_size'];

$sql2->db_Insert("private_msg", "NULL, '".$newpmfrom."', '".$newpmto."', '".$newpmsent."', '".$newpmread."', '".$newpmsubject."', '".$newpmtext."', '".$newpmsenddel."', '".$newpmreaddel."', '".$newpmatt."', '".$newpmoption."', '".$newpmsize."'") or die(mysql_error());
}

$uploaddir = e_PLUGIN."aacgc_pnews/public/";
$uploadfile = $uploaddir . basename($file);

if (move_uploaded_file($_FILES['news_img']['tmp_name'], $uploadfile)) {
$filestat = "".PNEWS_05."";} 
else 
{$filestat = "".PNEWS_06."";}

}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_pnews", "news_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b><br>".$filestat."<br>".PNEWS_07."</div><br><center>[ <a href='".e_PLUGIN."aacgc_pnews/News_Categories.php'>".PNEWS_08."</a> ]</center>");
}
}
//-----------------------------------------------------------------------------------------------------------+

if ($action == "det")
{
                $sql->db_Select("aacgc_pnews", "*", "news_id = '".intval($id)."'");
                $row = $sql->db_Fetch();
		$sql2 = new db;
		$sql2->db_Select("aacgc_pnews_cat", "*", "WHERE news_cat_id=".intval($row['news_cat'])."", "");
		$row2 = $sql2->db_Fetch();
		$sql3 = new db;
		$sql3->db_Select("user", "*", "WHERE user_id=".intval($row['news_author'])."", "");
		$row3 = $sql3->db_Fetch();

$sql4 = new db;
$sql4->db_Select("aacgc_pnews_cat", "*", "ORDER BY news_cat_title ASC", "");
$rows = $sql4->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql4->db_Fetch();
$options .= "<option name='news_cat' value='".$option['news_cat_id']."'>".$option['news_cat_title']."</option>";}

$sql5 = new db;
$sql5->db_Select("user", "*", "ORDER BY user_name ASC", "");
$rows5 = $sql5->db_Rows();
for ($i=0; $i < $rows5; $i++) {
$option2 = $sql5->db_Fetch();
$options3 .= "<option name='news_author' value='".$option2['user_id']."'>".$option2['user_name']."</option>";}

$offset = $pref['pnews_dateoffset'];
$time = time()  + ($offset * 60 * 60);
$sent = $time;

        $width = "width:100%";
        $text .= "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".PNEWS_09.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("news_title", 80, $row['news_title'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".PNEWS_10.":<br><i>".PNEWS_11." ".$pref['pnews_sum_limit']." ".PNEWS_12."</i></td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_textarea("news_sum", '80', '5', $row['news_sum'], "", "", "", "", "")."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".PNEWS_13."</td>
        <td style='width:70%' class='forumheader3'>";
if ($pref['pnews_enable_bbcode'] == "1"){
$text .= "<textarea class='tbox' name='news_desc' rows='30' cols='75' style='width:95%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$row['news_desc']."</textarea>";
$text .= display_help('helpb', 'forum');}
else
{$text .= "<textarea class='tbox' name='news_desc' rows='30' cols='75' style='width:95%'></textarea>";}

$text .= "</td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".PNEWS_14."</td>
        <td style='width:' class='forumheader3'>
	<input type='hidden' name='news_oldimg' value='".$row['news_img']."'>
	<input type='file' name='news_img'>
	<br><i>".PNEWS_15.": ".$pref['pnews_filesize']."B (1,000B = 1KB)</i><br>".PNEWS_16."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".PNEWS_17.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='news_cat' size='1' class='tbox' style='width:25%'>
		<option name='news_cat' value='".$row2['news_cat_id']."'>".$row2['news_cat_title']."</option>
		".$options."
        </td>
        </tr>";


$userc = @mysql_query("SELECT user_class FROM ".MPREFIX."user WHERE user_id='".USERID."'");
$userc = mysql_fetch_array($userc);
$break = explode(",", $userc['user_class']);

if (in_array($pref['pnews_moderators'], $break)){

$text .= "<tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".PNEWS_18.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='news_author' size='1' class='tbox' style='width:25%'>
		<option name='news_author' value='".$row3['user_id']."'>".$row3['user_name']."</option>
		".$options3."
        </td>
        </tr>";}
else
{$text .= "<tr>
        <td colspan='2' style='width:70%' class=''>
	<input type='hidden' name='news_author' value='".USERID."'>
        </td>
        </tr>";}



$text .= "<tr>
        <td style='width:30%; text-align:right' class='forumheader3'></td>
        <td style='width:70%' class='forumheader3'>
            <input type='hidden' name='news_date' value='".$row['news_date']."'>
        </td>
        </tr>
";

        $text .= "
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['news_id']."")."
        ".$rs -> form_button("submit", "update_news", "".PNEWS_19."")."
        </td>
        </tr>";



//-----------------------# Auto PM Section #------------------------+
if ($pref['pnews_enable_pmnote'] == "1"){
$subject = "".PNEWS_20."";

$message = "".PNEWS_21." [ <a href=".e_PLUGIN."aacgc_pnews/News_Details.php?det.".$row['news_id'].">".PNEWS_22."</a> ]";

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



$text .= "</table>".$rs -> form_close()."";}}
//-------------

 
$ns -> tablerender($title, $text);}

require_once(FOOTERF);

?>
