<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Public News               #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/
global $tp;
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
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $id = $tmp[1];
        unset($tmp);
}
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
if (isset($_POST['update_news'])) {
$newstitle = $tp->toDB($_POST['news_title']);
$newssum = $tp->toDB($_POST['news_sum']);
$newsdesc = $tp->toDB($_POST['news_desc']);
$newsimg = $_POST['news_img'];
$newscat = $_POST['news_cat'];
$newsauthor = $_POST['news_author'];
$newsdate = $_POST['news_date'];

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

$reason = "";
$newok = "";
if (($newstitle == "") OR ($newsdesc == "")){
	$newok = "0";
	$reason = "".APNEWS_101."";
} else {
	$newok = "1";
}
if (($newscat == "")){
	$newok = "0";
	$reason = "".APNEWS_102."";
} else {
	$newok = "1";
}

If ($newok == "0"){
 	$newtext = "
 	<center>
	<b><br><br> ".$reason."
	</center>
 	</b>
	";
	$ns->tablerender("", $newtext);
}
If ($newok == "1"){
$sql->db_Insert("aacgc_pnews", "NULL, '".$newstitle."', '".$newssum."', '".$newsdesc."', '".$newsimg."', '".$newscat."', '".$newsauthor."', '".$newsdate."'") or die(mysql_error());
$ns->tablerender("", "<center><b>News Added</b></center>");

$sql2->db_Insert("private_msg", "NULL, '".$newpmfrom."', '".$newpmto."', '".$newpmsent."', '".$newpmread."', '".$newpmsubject."', '".$newpmtext."', '".$newpmsenddel."', '".$newpmreaddel."', '".$newpmatt."', '".$newpmoption."', '".$newpmsize."'") or die(mysql_error());


}}

if (isset($_POST['main_delete'])) {
    $delete_id = array_keys($_POST['main_delete']);
    $sql2 = new db;
    $sql2->db_Delete("aacgc_pnews_submitted", "news_sub_id='".$delete_id[0]."'");

	$ns->tablerender("", "<div style='text-align:center'><b>".APNEWS_103."</b></div>");
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {




        $text .= $rs->form_open("post", e_SELF, "myform_".$row['news_sub_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:' class='forumheader3'>".APNEWS_62."</td>
        <td style='width:25%' class='forumheader3'>".APNEWS_104."</td>
        <td style='width:25%' class='forumheader3'>".APNEWS_105."</td>
        <td style='width:25%' class='forumheader3'>".APNEWS_77."</td>
        <td style='width:25%' class='forumheader3'>".APNEWS_106."</td>
        <td style='width:' class='forumheader3'>".APNEWS_66."</td>
       </tr>";

        $sql->db_Select("aacgc_pnews_submitted", "*", "ORDER BY news_sub_id ASC","");
        while($row = $sql->db_Fetch()){

        $sql2 = new db;
        $sql2->db_Select("aacgc_pnews_cat", "*", "WHERE news_cat_id='".$row['news_sub_cat']."'", "");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("user", "*", "WHERE user_id='".$row['news_sub_author']."'", "");
        $row3 = $sql3->db_Fetch();

	if ($row['news_sub_img'] == "")
	{$newsimg = "<img src='".e_PLUGIN."aacgc_pnews/images/noimage.png' width='100px', height='100px' />";}
	else
	{$newsimg = "<img src='".e_PLUGIN."aacgc_pnews/public/".$row['news_sub_img']."' width='100px', height='100px' />";}

	$dformat = $pref['pnews_dateformat'];
	$date = date($dformat, $row['news_sub_date']);

        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['news_sub_id']."</td>
        <td style='width:25%' class='forumheader3'>".$row['news_sub_title']."<br><br>".$newsimg."</td>
        <td style='width:25%' class='forumheader3'>".$row['news_sub_sum']."<br>--------<br>".$tp -> toHTML($row['news_sub_desc'], TRUE,'no_hook,emotes_off')."</td>
        <td style='width:25%' class='forumheader3'>".$row2['news_cat_title']."</td>
        <td style='width:25%' class='forumheader3'>".$row3['user_name']."<br>".$date."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['news_sub_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['news_sub_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['news_sub_id']} ]')\"/>
		</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+

//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit")
{
                $sql->db_Select("aacgc_pnews_submitted", "*", "news_sub_id = $id");
                $row = $sql->db_Fetch();
$sql2 = new db;
$sql2->db_Select("aacgc_pnews_cat", "*", "WHERE news_cat_id=".$row['news_sub_cat']."", "");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$options .= "<option name='news_cat' value='".$option['news_cat_id']."'>".$option['news_cat_title']."</option>";}

$sql3 = new db;
$sql3->db_Select("user", "*", "WHERE user_id=".$row['news_sub_author']."", "");
$rows3 = $sql3->db_Rows();
for ($i=0; $i < $rows3; $i++) {
$option2 = $sql3->db_Fetch();
$options3 .= "<option name='news_author' value='".$option2['user_id']."'>".$option2['user_name']."</option>";}



        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
	<td colspan='2' class='fcaption'><center>".APNEWS_107."</center></td>
	</tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_69.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("news_title", 100, $row['news_sub_title'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_77.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='news_cat' size='1' class='tbox' style='width:25%'>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_70.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_textarea("news_sum", '100', '5', $row['news_sub_sum'], "", "", "", "", "")."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_73.":</td>
        <td style='width:70%' class='forumheader3'>
	<textarea class='tbox' name='news_desc' rows='15' cols='75' style='width:95%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$row['news_sub_desc']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "
        </td>
        </tr>";

        $rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'blank*');
        $iconpath = e_PLUGIN."aacgc_pnews/public/";
        $iconlist = $fl->get_files($iconpath,"",$rejectlist);

        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APNEWS_74.":<br><i>".APNEWS_75."</i></td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("news_img", 50, $row['news_sub_img'], 100)."
        ".$rs -> form_button("button", '', "".APNEWS_76."", "onclick=\"expandit('plcico')\"")."
            <div id='plcico' style='{head}; display:none'>";
            foreach($iconlist as $icon){
$text .= "<a href=\"javascript:insertext('".$icon['fname']."','news_img','plcico')\"><img width='100px' src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
            }


        $text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_78.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='news_author' size='1' class='tbox' style='width:25%'>
		".$options3."
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
                 'value'       => date('M d, Y h:i a', $row['news_sub_date'])));

$text .= " ".APNEWS_108."</td>
        </tr>";




$text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
	<input type='hidden' name='main_delete[".$row['news_sub_id']."]' />
	".$rs->form_hidden("id", "".$row['_id']."")."
        ".$rs -> form_button("submit", "update_news", "".APNEWS_109."")."
        </td>
        </tr>";



//-----------------------# Auto PM Section #------------------------+

$subject = "".APNEWS_110."";

$message = "".APNEWS_111." [ <a href=".e_PLUGIN."aacgc_pnews/News_Categories.php>".APNEWS_112."</a> ]";

$to = "".$row['news_sub_author']."";
$from = "1";

$offset = $pref['pnews_dateoffset'];
$time = time()  + ($offset * 60 * 60);
$sent = $time;

$text .= "
        <tr>
        <td colspan=2>
        ".$rs->form_hidden("pm_from", "".$from."")."
        </td>
        </tr>
        <tr>
        <td colspan=2>
        ".$rs->form_hidden("pm_to", "".$to."")."
        </td>
        </tr>
        <tr>
        <td colspan=2>
        ".$rs->form_hidden("pm_sent", "".$sent."")."
        </td>
        </tr>
        <tr>
        <td colspan=2>
        ".$rs->form_hidden("pm_read", "0")."
        </td>
        </tr>
        <tr>
        <td colspan=2>
        ".$rs->form_hidden("pm_subject", "".$subject."")."
        </td>
        </tr>
        <tr>
        <td colspan=2>
        ".$rs->form_hidden("pm_text", "".$message."")."
        </td>
        </tr>
        <tr>
        <td colspan=2>
        ".$rs->form_hidden("pm_send_del", "0")."
        </td>
        </tr>
        <tr>
        <td colspan=2>
        ".$rs->form_hidden("pm_read_del", "0")."
        </td>
        </tr>
        <tr>
        <td colspan=2>
        ".$rs->form_hidden("pm_attchments", "")."
        </td>
        </tr>
        <tr>
        <td colspan=2>
        ".$rs->form_hidden("pm_option", "")."
        </td>
        </tr>
        <tr>
        <td colspan=2>
        ".$rs->form_hidden("pm_size", "0")."
        </td>
        </tr>
";



//------------------------------------------------------------------+


$text .= "</table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
?>


