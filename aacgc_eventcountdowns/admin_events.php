<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Event Countdowns          #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
#######################################
*/
global $tp;
require_once("../../class2.php");
if(!getperms("P")) {
echo "";
exit;}
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
include_lan(e_PLUGIN."aacgc_eventcountdowns/languages/".e_LANGUAGE.".php");
include(e_HANDLER."ren_help.php");
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}
if($pref['ecds_theme'] == "1"){
$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}
//-----------------------------------------------------------------------------------------------------------+
//---# New #
if ($_POST['add_event'] == '1') {
$offset = $pref['ecds_dateoffset'];
$settime = $_POST['ecds_date'] + ($offset * 60);
$fixeddate = $settime;
	
$newname = $tp->toDB($_POST['ecds_title']);
$newdetail = $tp->toDB($_POST['ecds_detail']);
$newdate = $tp->toDB($settime);
$newtzone = $tp->toDB($_POST['ecds_tzone']);

$sql->db_Insert("aacgc_eventcountdowns", "NULL, '".$newname."', '".$newdetail."', '".$newdate."', '".$newtzone."'") or die(mysql_error());
$ns->tablerender("", "<center><b>".ACR_05."</b></center>");
}
//---# Update #
if (isset($_POST['update_event'])) {

if($_POST['olddate'] == $_POST['ecds_date'])
{$fixeddate = $_POST['ecds_date'];}
else
{$offset = $pref['ecds_dateoffset'];
$settime = $_POST['ecds_date'] + ($offset * 60);
$fixeddate = $settime;}
	
$newname = $_POST['ecds_title'];
$newdetail = $_POST['ecds_detail'];
$newdate = $fixeddate;
$newtzone = $_POST['ecds_tzone'];

$message = ($sql->db_Update("aacgc_eventcountdowns", "ecds_title='".$tp->toDB($newname)."',ecds_detail='".$tp->toDB($newdetail)."',ecds_date='".$tp->toDB($newdate)."',ecds_tzone='".$tp->toDB($newtzone)."' WHERE ecds_id='".$_POST['id']."' ")) ? "".ACR_11."" : "".ACR_12."";
}
//---# Delete #
if (isset($_POST['main_delete'])) {
$delete_id = array_keys($_POST['main_delete']);
$sql2 = new db;
$sql2->db_Delete("aacgc_eventcountdowns", "ecds_id='".$delete_id[0]."'");
}
//-----------------------------------------------------------------------------------------------------------+
if (isset($message)) {$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");}
//-----------------------------------------------------------------------------------------------------------+
if ($action == ""){

$offset = $pref['ecds_dateoffset'];
$time = time()  + ($offset * 60);
$currentdate = $time;
	
$text .= "<form method='POST' action='admin_events.php'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td style='width:30%; text-align:right' class='forumheader3'>".ACR_06.":</td>
		<td colspan='2'  class='forumheader3'>
			<input class='tbox' type='text' size='75' name='ecds_title' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' /><br/>";
$text .= display_help('helpb', 'forum');
$text .= "
		</td>
	</tr>
	<tr>
        <td style='width:; text-align:right' class='forumheader3'>".ACR_28.":</td>
        <td style='width:' class='forumheader3'>
			<textarea class='tbox' name='ecds_detail' rows='10' cols='75' style='width:95%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "
		</td>
	</tr>	
    <tr>
		<td style='width:; text-align:right' class='forumheader3'>".ACR_07.":</td>
        <td style='width:' class='forumheader3'>";

$text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%s',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'ecds_date',
                 'value'       => $currentdate));

$text .= "</td>
    </tr>
	<tr>
		<td style='width:30%; text-align:right' class='forumheader3'>".ACR_08.":</td>
		<td colspan='2'  class='forumheader3'>
			<input class='tbox' type='text' size='15' name='ecds_tzone' />
		</td>
	</tr>
    <tr>
        <td colspan='2' style='text-align:center' class='forumheader'>
			<input type='hidden' name='add_event' value='1'>
			<input class='button' type='submit' value='".ACR_10."' style='width:150px'>
		</td>
    </tr>
</table>
</form>
";
//--------------------------------------------------------------------------------------------------------
$text .= $rs->form_open("post", e_SELF, "myform_".$row['ecds_id']."", "", "");
$text .= "<br/>
<table style='width:100%' class='' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='".$themea."'>".ACR_22."</td>
        <td style='width:25%' class='".$themea."'>".ACR_06."</td>
        <td style='width:50%' class='".$themea."'>".ACR_28."</td>
        <td style='width:25%' class='".$themea."'>".ACR_07."</td>
        <td style='width:0%' class='".$themea."'>".ACR_23."</td>
       </tr>";

        $sql->db_Select("aacgc_eventcountdowns", "*", "ORDER BY ecds_date ASC","");
        while($row = $sql->db_Fetch()){

$text .= "
        <tr>
        <td style='width:' class='".$themea."'>".$row['ecds_id']."</td>
        <td style='width:' class='".$themea."'>".$tp -> toHTML($row['ecds_title'], TRUE)."</td>
        <td style='width:' class='".$themea."'>".$tp -> toHTML($row['ecds_detail'], TRUE)."</td>
        <td style='width:' class='".$themea."'>".date($pref['ecds_dateformat'], $row['ecds_date'])." / ".$row['ecds_tzone']."</td>
        <td style='width:' class='".$themea."'>
		<a href='".e_SELF."?edit.{$row['ecds_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['ecds_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [{$row['ecds_id']}: {$row['ecds_title']} ]')\"/>	</td>
        </tr>";
}

$text .= "</table>";
$text .= $rs->form_close();
}
//------------------------------------------------------------------------------------------------------

if ($action == "edit"){
	
		$sql->db_Select("aacgc_eventcountdowns", "*", "ecds_id = '".$sub_action."'");
		$row = $sql->db_Fetch();

$text .= "
".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
<table style='width:100%' class='' cellspacing='0' cellpadding='0'>
	<tr>
    	<td style='width:30%; text-align:right' class='".$themea."'>".ACR_06.":</td>
        <td style='width:70%' class='forumheader3'>
			<input class='tbox' type='text' size='75' name='ecds_title' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' value='".$row['ecds_title']."' /><br/>";
$text .= display_help('helpb', 'forum');
$text .= "
		</td>
    </tr>
	<tr>
        <td style='width:; text-align:right' class='forumheader3'>".ACR_07.":</td>
        <td style='width:' class='forumheader3'>
			<textarea class='tbox' name='ecds_detail' rows='15' cols='75' style='width:95%' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>".$row['ecds_detail']."</textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "
		</td>
	</tr>	
    <tr>
		<td style='width:; text-align:right' class='forumheader3'>".ACR_07.":</td>
        <td style='width:' class='forumheader3'>";

$text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%s',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'ecds_date',
                 'value'       => $row['ecds_date']));

$text .= "<br/>".date($pref['ecds_dateformat'], $row['ecds_date'])."</td>
    </tr>
		<tr>
    	<td style='width:30%; text-align:right' class='".$themea."'>".ACR_06.":</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("ecds_tzone", 100, $row['ecds_tzone'], 500)."
        </td>
    </tr>
	
	
	<tr style='vertical-align:top'>
        <td colspan='3' style='text-align:center' class='".$themea."'>
        	".$rs->form_hidden("id", "".$row['ecds_id']."")."
			".$rs->form_hidden("olddate", "".$row['ecds_date']."")."
        	".$rs -> form_button("submit", "update_event", "".ACR_13."")."
        </td>
    </tr>
</table>
".$rs -> form_close()."
";

}
//-----------------------------------------------------------------------------------------------------------------------------
$ns -> tablerender("AACGC Event Countdowns (".ACR_04.")", $text);
require_once(e_ADMIN."footer.php");
?>