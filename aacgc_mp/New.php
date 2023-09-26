<?php

/*
#######################################
#     AACGC Meeting Planner           #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
require_once(HEADERF);
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
require_once(e_HANDLER."calendar/calendar_class.php");

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


include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");

if ( check_class($pref['aacgcmp_addclass']) OR (ADMIN) ){

//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//-----------------------------------------------------------------------------------------------------------+

if ($_POST['add_meet'] == '1') {

$sdate = $_POST['meet_sdate'] + ($pref['aacgcmp_toffset'] * 60 * 60);
$edate = $_POST['meet_edate'] + ($pref['aacgcmp_toffset'] * 60 * 60);

$newmeetingtitle = $tp->toDB($_POST['meet_title']);
$newmeetingdet = $tp->toDB($_POST['meet_det']);
$newmeetingsubj = $tp->toDB($_POST['meet_subj']);
$newmeetingsdate = $tp->toDB($sdate);
$newmeetingedate = $tp->toDB($edate);
$newmeetingstatus = $tp->toDB($_POST['meet_status']);
$newmeetingrepeat = $tp->toDB($_POST['meet_repeat']);
$newmeetingclass = $tp->toDB($_POST['meet_class']);
$newmeetingcat = $tp->toDB($_POST['meet_cat']);

$reason = "";
$newok = "";
//Added Notify Trigger$edata_ec = array("meet_det" => $newmeetingdet, "meet_subj" => $newmeetingsubj, "meet_title" => $newmeetingtitle);$e_event -> trigger("ecalnew", $edata_ec);
if (($newmeetingtitle == "") OR ($newmeetingdet == "")){
	$newok = "0";
	$reason = "".AMP_01."";
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
	$ns->tablerender("", $newtext);}

If ($newok == "1"){
$sql->db_Insert("aacgc_mp_meetings", "NULL, '".$newmeetingtitle."', '".$newmeetingdet."', '".$newmeetingsubj."', '".$newmeetingsdate."', '".$newmeetingedate."', '".$newmeetingstatus."', '".$newmeetingrepeat."', '".$newmeetingclass."', '".$newmeetingcat."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Meeting Added</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+
$text .= "<a href='".e_PLUGIN."aacgc_mp/Planner.php'><img src='".e_PLUGIN."aacgc_mp/images/back.png' alt='".AMP_65."' /></a><br>
<form method='POST' action='New.php'>
<center>
<table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>";

$offset = $pref['aacgcmp_toffset'];
$time = time()  + ($offset * 60 * 60);
$sent = $time;

$text .= "
        <tr>
        <td style='width:25%; text-align:right' class='forumheader3'>".AMP_02.":</td>
        <td style='width:75%' class='forumheader3'>
        <input class='tbox' type='text' name='meet_title' size='94'>
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AMP_03.":</td>
        <td style='width:' class='forumheader3' colspan=2>
		<textarea class='tbox' rows='25' cols='68' name='meet_det' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";

        $text .= display_help('helpb', 'forum');

        $text .= "</td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AMP_04.":</td>
        <td style='width:' class='forumheader3'>
        <input class='tbox' type='text' name='meet_subj' size='94'>
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AMP_05.":</td>
	<td style='width:' class='forumheader3'>";

	$text .= $cal->make_input_field(
           array('firstDay'       => 0, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,				 				 'singleClick'    => false,
                 'ifFormat'       => '%s',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'meet_sdate',
                 'value'       => $sent));
					
	$text .="</td>";

$text .="</tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".AMP_06.":</td>
	<td style='width:' class='forumheader3'>";

	$text .= $cal->make_input_field(
           array('firstDay'       => 0, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,				 				 'singleClick'    => false,
                 'ifFormat'       => '%s',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'meet_edate',
                 'value'       => $sent));
					
	$text .="</td>";

$text .="</tr>
	 <tr>
	 <td style='width:; text-align:right' class='forumheader3'>".AMP_07.":</td>
         <td style='width:; text-align:leftt' class='forumheader3'>
                <select name='meet_status' size='1' class='tbox' style='width:50%'>
                <option name='meet_status' value='1'>".AMP_48."</option>
                <option name='meet_status' value='0'>".AMP_49."</option>
        </td>
	</tr>
	 <tr>
	 <td style='width:; text-align:right' class='forumheader3'>".AMP_08.":</td>
         <td style='width:' class='forumheader3'>
                <select name='meet_repeat' size='1' class='tbox' style='width:50%'>
                <option name='meet_repeat' value='0'>".AMP_45."</option>
                <option name='meet_repeat' value='1'>".AMP_46." (".AMP_89.":".$pref['aacgcmp_hoursperweek'].")</option>
                <option name='meet_repeat' value='2'>".AMP_47." (".AMP_89.":".$pref['aacgcmp_hourspermonth'].")</option>
        </td>
	</tr>
	<tr>
        <td style='width:; text-align:right' class='forumheader3'>".AMP_09.":</td>
        <td style='width:70%' class='forumheader3'>";
$text .= "<select name='meet_class' size='1' class='tbox' style='width:50%'>
	  <option name='meet_class' value='none'>".AMP_11."</option>
	  <option name='meet_class' value='members'>".AMP_12."</option>
";

	  $sql->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
          while($row = $sql->db_Fetch()){

$text .= "<option name='meet_class' value='".$row['userclass_id']."'>".$row['userclass_name']."</option>";}



$text .= "</td>
	  </tr>";


$sql = new db;
$sql->db_Select("aacgc_mp_cat", "*");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='meet_cat' value='".$option['cat_id']."'>".$option['cat_title']."</option>";}


$text .= "<tr>
        <td style='width:; text-align:right' class='forumheader3'>".AMP_28.":</td>
        <td style='width:' class='forumheader3' colspan=2>
		<select name='meet_cat' size='1' class='tbox' style='width:50%'>
		".$options."
        </td>
        </tr>



        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_meet' value='1'>
		<input class='button' type='submit' value='".AMP_10."'>
	</td>
        </tr>
</table>
</form>";}

else

{$text .= "<i>".MP_19."!</i>";}

	      

$ns -> tablerender("".AMP_13."", $text);

require_once(FOOTERF);

?>

