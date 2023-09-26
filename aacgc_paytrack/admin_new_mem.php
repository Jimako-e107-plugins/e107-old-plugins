<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Payment Tracker           #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
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
$cal = new DHTML_Calendar(true);
function headerjs()
{
	global $cal;
	require_once(e_HANDLER."calendar/calendar_class.php");
	$cal = new DHTML_Calendar(true);
	return $cal->load_files();
}
include_lan(e_PLUGIN."aacgc_paytrack/languages/".e_LANGUAGE.".php");
//-----------------------------------------------------------------------------------------------------------+

if ($_POST['add_user'] == '1') {

if ($_POST['nodate'] == '1')
{$cdate = '';}
else
{$cdate = $_POST['user_cdate'] + ($pref['aacgcpt_toffset'] * 60 * 60);}
$ddate = $_POST['user_ddate'] + ($pref['aacgcpt_toffset'] * 60 * 60);

$newuser = $_POST['user_id'];
$newcamo = $_POST['user_camount'];
$newdamo = $_POST['user_damount'];
$newtamo = $_POST['user_tamount'];
$newcdate = $cdate;
$newddate = $ddate;
$newstatus = $_POST['user_status'];
$newcat = $_POST['user_cat'];

$sql->db_Insert("aacgc_paytrack_members", "NULL, '".$newuser."', '".$newcamo."', '".$newdamo."', '".$newtamo."', '".$newcdate."', '".$newddate."', '".$newstatus."', '".$newcat."'") or die(mysql_error());

$ns->tablerender("", "<center><b>".APT_86."</b></center>");}


//-----------------------------------------------------------------------------------------------------------+


$sql->db_Select("user", "user_id, user_name", "ORDER BY user_name ASC","");
while($row = $sql->db_Fetch()){
$usern = $row[user_name];
$userid = $row[user_id];
$options .= "<option name='user_id' value='".$userid."'>".$usern."</option>";}

$sql2 = new db;
$sql2->db_Select("aacgc_paytrack_cat", "*", "ORDER BY cat_id ASC","");
while($row2 = $sql2->db_Fetch()){
$catid = $row2['cat_id'];
$cattitle = $row2['cat_title'];
$options2 .= "<option name='user_cat' value='".$catid."'>".$cattitle."</option>";}

$offset = $pref['aacgcpt_toffset'];
$time = time()  + ($offset * 60 * 60);
$sent = $time;

$text = "<form method='POST' action='admin_new_mem.php'>
	<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
	<td style='width:30%; text-align:right' class='forumheader3'>".APT_80.":</td>
	<td style='width:70%' class='forumheader3'>
		<select name='user_id' size='1' class='tbox' style='width:75%'>
		".$options."
	</td>
        </tr>


	<tr>
	<td style='width:30%; text-align:right' class='forumheader3'>".APT_82.":</td>
	<td colspan='2'  class='forumheader3'>
		".$pref['aacgcpt_csymbol']."<input class='tbox' type='text' size='50' name='user_camount' />
	</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:right' class='forumheader3'>".APT_83.":</td>
	<td colspan='2'  class='forumheader3'>
		".$pref['aacgcpt_csymbol']."<input class='tbox' type='text' size='50' name='user_damount' />
	</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:right' class='forumheader3'>".APT_89.":</td>
	<td colspan='2'  class='forumheader3'>
		".$pref['aacgcpt_csymbol']."<input class='tbox' type='text' size='50' name='user_tamount' />
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
                 'value'       => ''));
					
$text .="<input type='checkbox' name='nodate' value='1' />".APT_97."</td>
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
                 'value'       => ''));
					
$text .="</td>
	</tr>


	<tr>
	<td style='width:30%; text-align:right' class='forumheader'>".APT_29.":</td>
	<td class='forumheader'>
		<select name='user_status' size='1' class='tbox' style='width:75%'>
		<option name='user_status' value='1'>".APT_32."</option>
		<option name='user_status' value='0'>".APT_33."</option>
	</td>
	</tr>






        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APT_28.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='user_cat' size='1' class='tbox' style='width:75%'>
		".$options2."
	</td>
	</tr>


		
        <tr>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_user' value='1'>
		<input class='button' type='submit' value='".APT_87."' style='width:150px'>
	</td>
        </tr>

        </table>
	</form>
        ";
	      $ns -> tablerender("AACGC Payment Tracker (".APT_88.")", $text);


//-----------------------------------------------------------------------------------------------------------------------------
	      require_once(e_ADMIN."footer.php");
?>