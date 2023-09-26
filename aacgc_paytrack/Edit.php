<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Payment Tracker           #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

global $tp;

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

require_once(e_HANDLER."calendar/calendar_class.php");
$cal = new DHTML_Calendar(true);
function headerjs()
{
	global $cal;
	require_once(e_HANDLER."calendar/calendar_class.php");
	$cal = new DHTML_Calendar(true);
	return $cal->load_files();
}

include_lan(e_PLUGIN."aacgc_paytrack/languages/".e_LANGUAGE.".php");

if ( check_class($pref['aacgcpt_addclass']) OR (ADMIN) ){

//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------

if (isset($_POST['update_user'])) {

        $message = ($sql->db_Update("aacgc_paytrack_members", "
	user_id='".$_POST['user_id']."',
	user_camount='".$_POST['user_camount']."',
	user_damount='".$_POST['user_damount']."',
	user_tamount='".$_POST['user_tamount']."',
	user_cdate='".$_POST['user_cdate']."',
	user_ddate='".$_POST['user_ddate']."',
	user_status='".$_POST['user_status']."',
	user_cat='".$_POST['user_cat']."' 
	WHERE pay_id='".$_POST['id']."' ")) ? "".APT_24."" : "".APT_25."";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    	$sql2->db_Delete("aacgc_paytrack_members", "pay_id='".$delete_id[0]."'");
	
$ns->tablerender("", "<div style='text-align:center'><a href='".e_PLUGIN."aacgc_paytrack/PayTrack.php'><img src='".e_PLUGIN."aacgc_paytrack/images/back.png' align='left' alt='".APT_65."' /></a><b>".APT_69."</b></div>");

require_once(FOOTERF);
}

if (isset($message)) {
$ns->tablerender("", "<div style='text-align:center'><a href='".e_PLUGIN."aacgc_paytrack/PayTrack.php'><img src='".e_PLUGIN."aacgc_paytrack/images/back.png' align='left' alt='".APT_65."' /></a><b>".$message."</b></div>");

require_once(FOOTERF);
}

//-------------------------------------------------------------------------------------------

if ($action == "del") {

$text .= $rs->form_open("post", e_SELF, "myform_editmem", "", "");
$text .= "<a href='".e_PLUGIN."aacgc_paytrack/PayTrack.php'><img src='".e_PLUGIN."aacgc_paytrack/images/back.png' align='left' alt='".APT_65."' /></a>
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
	<td style='width:0%' class='forumheader3'>".APT_79."</td>
	<td style='width:25%' class='forumheader3'>".PT_01."</td>
	<td style='width:25%' class='forumheader3'>".APT_28."</td>
	<td style='width:0%' class='forumheader3'>".PT_02."</td>
	<td style='width:0%' class='forumheader3'>".PT_03."</td>
	<td style='width:0%' class='forumheader3'>".PT_04."</td>
	<td style='width:25%' class='forumheader3'>".PT_05."</td>
	<td style='width:25%' class='forumheader3'>".PT_06."</td>
	<td style='width:0%' class='forumheader3'>".PT_07."</td>
	<td style='width:0%' class='forumheader3'>".APT_67."</td>
	</tr>

";

	$dformat = $pref['aacgcpt_dformat'];
	$offset = $pref['aacgcpt_toffset'];
	$time = time()  + ($offset * 60 * 60);
	$currtime = $time;

        $sql->db_Select("aacgc_paytrack_members", "*", "ORDER BY pay_id ASC","");
        while($row = $sql->db_Fetch()){

        $sql2 = new db;
        $sql2->db_Select("user", "*", "user_id='".$row['user_id']."'");
        $row2 = $sql2->db_Fetch();

        $sql3 = new db;
	$sql3 ->db_Select("aacgc_paytrack_cat", "*", "cat_id='".$row['user_cat']."'");
	$row3 = $sql3 ->db_Fetch();
	$cattitle = $row3['cat_title'];

	$pid = $row['pay_id'];
	$puserid = $row2['user_id'];
	$pusername = $row2['user_name']; 
	$pcamo = $row['user_camount'];
	$pdamo = $row['user_damount']; 
	$ptamo = $row['user_tamount'];
	$pstat = $row['user_status'];

	if($row['user_cdate'] == "")
	{$pcdate = "";}
	else
	{$pcdate = date($dformat, $row['user_cdate']);}

	if($row['user_ddate'] == "")
	{$pddate = "";}
	else
	{$pddate = date($dformat, $row['user_ddate']);}


	if($pstat == "1"){$status = "<img src='".e_PLUGIN."aacgc_paytrack/images/payed.png'/>";}
	if($pstat == "0"){$status = "<img src='".e_PLUGIN."aacgc_paytrack/images/unpayed.png'/>";}

$text .= "
        <tr>
	<td style='width:' class='forumheader3'>".$pid."</td>
	<td style='width:' class='forumheader3'>".$pusername."</td>
	<td style='width:' class='forumheader3'>".$cattitle."</td>
	<td style='width:' class='forumheader3'>".$pref['aacgcpt_csymbol']."".$pcamo."</td>
	<td style='width:' class='forumheader3'>".$pref['aacgcpt_csymbol']."".$pdamo."</td>
	<td style='width:' class='forumheader3'>".$pref['aacgcpt_csymbol']."".$ptamo."</td>
	<td style='width:' class='forumheader3'>".$pcdate."</td>
	<td style='width:' class='forumheader3'>".$pddate."</td>
	<td style='width:' class='forumheader3'><center>".$status."</center></td>
        <td style='width:' class='forumheader3'>";
        
$text .= "<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['pay_id']."]' src='".e_PLUGIN."aacgc_paytrack/images/del.png' onclick=\"return jsconfirm('".APT_68." [ID: {$row['pay_id']} ]')\"/>
        </td>
        </tr>";
		}
$text .= "</table>";

$text .= $rs->form_close();
	     
	$ns -> tablerender("".APT_17."", $text);

require_once(FOOTERF);

}



//-----------------------------------------------------------------------------------------------------------+

        $sql->db_Select("aacgc_paytrack_members", "*", "pay_id='".$id."'");
        $row = $sql->db_Fetch();

        $sql2 = new db;
        $sql2->db_Select("user", "*", "user_id='".$row['user_id']."'");
        $row2 = $sql2->db_Fetch();

        $sql3 = new db;
        $sql3->db_Select("aacgc_paytrack_cat", "*", "cat_id='".$row['user_cat']."'");
        $row3 = $sql3->db_Fetch();

	$sql4 = new db;
	$sql4->db_Select("aacgc_paytrack_cat", "*");
	$rows = $sql4->db_Rows();
	for ($i=0; $i < $rows; $i++) {
	$option = $sql4->db_Fetch();
	$catid = $option['cat_id'];
	$cattitle = $option['cat_title'];
	$options .= "<option name='user_cat' value='".$catid."'>".$cattitle."</option>";}

	$stat = $row['user_status'];
	if($stat == "1"){$stats = "".APT_32."";}
	if($stat == "0"){$stats = "".APT_33."";}

        $width = "width:100%";


$text .= "<a href='".e_PLUGIN."aacgc_paytrack/PayTrack.php'><img src='".e_PLUGIN."aacgc_paytrack/images/back.png' align='left' alt='".APT_65."' /></a><br>
	<div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APT_80.":</td>
        <td style='width:70%' class='forumheader3'>
        ".$rs->form_hidden("user_id", "".$row['user_id']."")." ".$row2['user_name']."
        </td>
        </tr>
        </tr>


	<tr>
	<td style='width:; text-align:right' class='forumheader3'>".APT_82.":</td>
	<td colspan='2'  class='forumheader3'>
            ".$pref['aacgcpt_csymbol']."".$rs -> form_text("user_camount", 50, $row['user_camount'], 500)."
	</td>
	</tr>
	<tr>
	<td style='width:; text-align:right' class='forumheader3'>".APT_83.":</td>
	<td colspan='2'  class='forumheader3'>
            ".$pref['aacgcpt_csymbol']."".$rs -> form_text("user_damount", 50, $row['user_damount'], 500)."
	</td>
	</tr>
	<tr>
	<td style='width:; text-align:right' class='forumheader3'>".APT_89.":</td>
	<td colspan='2'  class='forumheader3'>
            ".$pref['aacgcpt_csymbol']."".$rs -> form_text("user_tamount", 50, $row['user_tamount'], 500)."
	</td>
	</tr>


        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APT_26.":</td>
	<td style='width:' class='forumheader3'>";

	$text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%s',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'user_cdate',
                 'value'       => $row['user_cdate']));
					
$text .="</td>
	</tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APT_27.":</td>
	<td style='width:' class='forumheader3'>";

	$text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%s',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'user_ddate',
                 'value'       => $row['user_ddate']));
					
$text .="</td>
	</tr>


	<tr>
	<td style='width:; text-align:right' class='forumheader'>".APT_29.":</td>
	<td class='forumheader'>
		<select name='user_status' size='1' class='tbox' style='width:75%'>
		<option name='user_status' value='".$stat."'>".$stats."</option>
		<option name='user_status' value='1'>".APT_32."</option>
		<option name='user_status' value='0'>".APT_33."</option>
	</td>
	</tr>






        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APT_28.":</td>
        <td style='width:' class='forumheader3'>
		<select name='user_cat' size='1' class='tbox' style='width:75%'>
		<option name='user_cat' value='".$row['user_cat']."'>".$row3['cat_title']."</option>
		".$options."
	</td>
	</tr>
";



        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['pay_id']."")."
        ".$rs -> form_button("submit", "update_user", "".APT_85."")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";

}

else

{$text .= "<i>".PT_19."</i>";}

//-----------------------------------------------------------------------------------------------------------+

$ns -> tablerender("".APT_78."", $text);
require_once(FOOTERF);


?>

