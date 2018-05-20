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

$newstitlereplace = $tp->toDB($_POST['news_title']);
$string = substr($_POST['news_sum'], 0, $pref['pnews_sum_limit']);
$newssumreplace = $tp->toDB($string);
$newsdescreplace = $tp->toDB($_POST['news_desc']);

if ($_POST['news_date'] == "")
{$editdate = $_POST['news_dateold'];}
else
{$editdate = $_POST['news_date'];}

$message = ($sql->db_Update("aacgc_pnews", "news_title='".$newstitlereplace."', news_sum='".$newssumreplace."', news_desc='".$newsdescreplace."', news_img='".$_POST['news_img']."', news_cat='".$_POST['news_cat']."', news_author='".$_POST['news_author']."', news_date='".$editdate."' WHERE news_id='".$_POST['id']."' ")) ? "".APNEWS_59."" : "".APNEWS_60."";
}

if (isset($_POST['main_delete'])) {

        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    	$sql2->db_Delete("aacgc_pnews", "news_id='".$delete_id[0]."'");
	$sql3 = new db;
    	$sql3->db_Delete("aacgc_pnews_comments", "news_com_newsid='".$delete_id[0]."'");
	$sql4 = new db;
    	$sql4->db_Delete("aacgc_pnews_counter", "page='".$delete_id[0]."'");

$ns->tablerender("", "<div style='text-align:center'><b>".APNEWS_61."</b></div>");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['news_id']."", "", "");

        $text .= "
        <div style='text-align:center'>
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>".APNEWS_62."</td>
        <td style='width:25%' class='forumheader3'>".APNEWS_63."</td>
        <td style='width:0%' class='forumheader3'>".APNEWS_64."</td>
        <td style='width:75%' class='forumheader3'>".APNEWS_65."</td>
        <td style='width:0%' class='forumheader3'>".APNEWS_66."</td>
       </tr>";
        $sql->db_Select("aacgc_pnews", "*", "ORDER BY news_id ASC","");
        while($row = $sql->db_Fetch()){
	$sql2 = new db;
	$sql2->db_Select("user", "*", "WHERE user_id=".$row['news_author']."","");
	$row2 = $sql2->db_Fetch();
	$sql3 = new db;
	$sql3->db_Select("aacgc_pnews_cat", "*", "WHERE news_cat_id=".$row['news_cat']."","");
	$row3 = $sql3->db_Fetch();

	$author = $row2['user_name'];
	$dformat = $pref['pnews_dateformat'];
	$date = date($dformat, $row['news_date']);
	$newsimg = "<img src='".e_PLUGIN."aacgc_pnews/public/".$row['news_img']."' width='50px', height='50px' />";
	$charlimit = $pref['pnews_newsm_newsdesclimit'];

        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['news_id']."</td>
        <td style='width:' class='forumheader3'>".$row['news_title']."<br>--------<br>".$author."<br>--------<br>".$date."<br>--------<br>".$newsimg."</td>
        <td style='width:' class='forumheader3'>".$row3['news_cat_title']."</td>
        <td style='width:' class='forumheader3'>".$row['news_sum']."<br>--------<br>".substr($row['news_desc'], 0, $charlimit).".......</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['news_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['news_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".APNEWS_67." [ID: {$row['news_id']}], ".APNEWS_68.".')\"/>
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
                $sql->db_Select("aacgc_pnews", "*", "news_id = $id");
                $row = $sql->db_Fetch();
		$sql2 = new db;
		$sql2->db_Select("aacgc_pnews_cat", "*", "WHERE news_cat_id=".$row['news_cat']."", "");
		$row2 = $sql2->db_Fetch();
		$sql3 = new db;
		$sql3->db_Select("user", "*", "WHERE user_id=".$row['news_author']."", "");
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
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_69.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("news_title", 100, $row['news_title'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_70.":<br><i>".APNEWS_71." ".$pref['pnews_sum_limit']." ".APNEWS_72."</i></td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_textarea("news_sum", '100', '5', $row['news_sum'], "", "", "", "", "")."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_73.":</td>
        <td style='width:70%' class='forumheader3'>
	<textarea class='tbox' name='news_desc' rows='15' cols='75' style='width:95%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$row['news_desc']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "</td>
        </tr>";

        $rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'blank*');
        $iconpath = e_PLUGIN."aacgc_pnews/public/";
        $iconlist = $fl->get_files($iconpath,"",$rejectlist);

        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APNEWS_74.":<br><i>".APNEWS_75."</i></td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("news_img", 50, $row['news_img'], 100)."
        ".$rs -> form_button("button", '', "".APNEWS_76."", "onclick=\"expandit('plcico')\"")."
            <div id='plcico' style='{head}; display:none'>";
            foreach($iconlist as $icon){
$text .= "<a href=\"javascript:insertext('".$icon['fname']."','news_img','plcico')\"><img width='100px' src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
            }

        $text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_77.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='news_cat' size='1' class='tbox' style='width:25%'>
		<option name='news_cat' value='".$row2['news_cat_id']."'>".$row2['news_cat_title']."</option>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_78.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='news_author' size='1' class='tbox' style='width:25%'>
		<option name='news_author' value='".$row3['user_id']."'>".$row3['user_name']."</option>
		".$options3."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APNEWS_79.":</td>
        <td style='width:70%' class='forumheader3'>
	<input type='hidden' name='news_dateold' value='".$row['news_date']."'>";

$text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%s',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'news_date',
                 'value'       => $row['news_date']));

        $text .= "
        </td>
        </tr>
";



        $text .= "
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['news_id']."")."
        ".$rs -> form_button("submit", "update_news", "".APNEWS_80."")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("AACGC Public News (Edit Category)", $text);
	      require_once(e_ADMIN."footer.php");
}
?>


