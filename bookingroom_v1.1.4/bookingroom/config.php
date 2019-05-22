<?php
//***************************************************************
//*
//*		Title		:	Room Booking System
//*
//*		Author		:	Barry Keal
//*
//*		Date		:	12 March 2004
//*
//*		Version		:	1.01
//*
//*		Description	: 	Room Booking System
//*
//*		Revisions	:
//*
//***************************************************************
//**************************************************************************
//*
//*  Room Bookings configuration for e107 v6xx
//*  Modified from the original MRBS .sourceforge.net
//*
//**************************************************************************
require_once("../../class2.php");
if(e_LANGUAGE != "English"){
	include_once(e_PLUGIN."bookingroom/languages/admin/".e_LANGUAGE.".php");
}
else
{
	include_once(e_PLUGIN."bookingroom/languages/admin/English.php");
}
if(!getperms("P")){ header("location:".e_HTTP."index.php"); exit; }
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");

// If updating then update prefs and tell user
if(e_QUERY=="update"){
	// Update prefs
	$pref['mrbs_adminclass']=$_REQUEST['mrbs_adminclass'];
	$pref['mrbs_viewclass']=$_REQUEST['mrbs_viewclass'];
	$pref['mrbs_bookclass']=$_REQUEST['mrbs_bookclass'];
	$pref['mrbs_frameheight']=$_REQUEST['mrbs_frameheight'];
	$pref['mrbs_sendconfirm']=$_REQUEST['mrbs_sendconfirm'];
	$pref['mrbs_resolution']=$_REQUEST['mrbs_resolution'];
	$pref['mrbs_morningstarts']=$_REQUEST['mrbs_morningstarts'];
	$pref['mrbs_eveningends']=$_REQUEST['mrbs_eveningends'];
	$pref['mrbs_eveningends_minutes']=$_REQUEST['mrbs_eveningends_minutes'];
	$pref['mrbs_weekstarts']=$_REQUEST['mrbs_weekstarts'];
	$pref['mrbs_dateformat']=$_REQUEST['mrbs_dateformat'];
	$pref['mrbs_twentyfourhour_format']=$_REQUEST['mrbs_twentyfourhour_format'];
	$pref['mrbs_max_rep_entrys']=$_REQUEST['mrbs_max_rep_entrys'];
	$pref['mrbs_default_report_days']=$_REQUEST['mrbs_default_report_days'];
	$pref['mrbs_refresh_rate']=$_REQUEST['mrbs_refresh_rate'];
	$pref['mrbs_area_list_format']=$_REQUEST['mrbs_area_list_format'];
	$pref['mrbs_monthly_view_brief_description']=$_REQUEST['mrbs_monthly_view_brief_description'];
	$pref['mrbs_view_week_number']=$_REQUEST['mrbs_view_week_number'];
	$pref['mrbs_typeA']=$_REQUEST['mrbs_typeA'];
	$pref['mrbs_typeB']=$_REQUEST['mrbs_typeB'];
	$pref['mrbs_typeC']=$_REQUEST['mrbs_typeC'];
	$pref['mrbs_typeD']=$_REQUEST['mrbs_typeD'];
	$pref['mrbs_typeE']=$_REQUEST['mrbs_typeE'];
	$pref['mrbs_typeF']=$_REQUEST['mrbs_typeF'];
	$pref['mrbs_typeG']=$_REQUEST['mrbs_typeG'];
	$pref['mrbs_typeH']=$_REQUEST['mrbs_typeH'];
	$pref['mrbs_typeI']=$_REQUEST['mrbs_typeI'];
	$pref['mrbs_typeJ']=$_REQUEST['mrbs_typeJ'];
	$pref['mrbs_userdef1']=$_REQUEST['mrbs_userdef1'];
	$pref['mrbs_userdef2']=$_REQUEST['mrbs_userdef2'];
	$pref['mrbs_userdef3']=$_REQUEST['mrbs_userdef3'];
	$pref['mrbs_userdef4']=$_REQUEST['mrbs_userdef4'];
	$pref['mrbs_userdef5']=$_REQUEST['mrbs_userdef5'];

	save_prefs();

	$hdu_text .= "<table width = '95%' class = 'fborder'>
	<tr><td class = 'forumborder3'>".MRBS_A49."</td></tr></table>";
}
#else
{
	// Display config options form
	$hdu_caption = MRBP_A2;
	$hdu_text .= "<form method='post' action='".e_SELF."?update' name='roomconf'>
	<table style='width: 90%; border: 0;' cellspacing='10' >";

	//Rooms Admin class
	$hdu_text .= "
	<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A3."</td>
	<td style='width:70%' class='forumheader3'>".r_userclass("mrbs_adminclass",$pref['mrbs_adminclass'])."
	</td>
	</tr>";

	//Rooms booking class
	$hdu_text .= "
	<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A4."</td>
	<td style='width:70%' class='forumheader3'>".r_userclass("mrbs_bookclass",$pref['mrbs_bookclass'])."
	</td>
	</tr>";

	//Rooms view class
	$hdu_text .= "
	<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A5."</td>
	<td style='width:70%' class='forumheader3'>".r_userclass("mrbs_viewclass",$pref['mrbs_viewclass'])."
	</td>
	</tr>";

	// iFrame height
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A50."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '10' class = 'tbox' name = 'mrbs_frameheight' value ='".$pref['mrbs_frameheight']."'
	</td>
	</tr>";
	// Send confirmation email to user
	$hdu_text .= "
	<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A6."</td>
	<td style='width:30%' class='forumheader3'>
	<input type='checkbox' class = 'tbox' name = 'mrbs_sendconfirm' value ='1'".
	($pref['mrbs_sendconfirm'] == 1 ?" checked " : "").">
	</td>
	</tr>";

	// Resolution
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A7."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '10' class = 'tbox' name = 'mrbs_resolution' value ='".$pref['mrbs_resolution']."'
	</td>
	</tr>";
	//Morning starts
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A8."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '7' class = 'tbox' name = 'mrbs_morningstarts' value ='".$pref['mrbs_morningstarts']."'
	</td>
	</tr>";
	//Evening ends
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A9."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '7' class = 'tbox' name = 'mrbs_eveningends' value ='".$pref['mrbs_eveningends']."'
	</td>
	</tr>";

	//Evening ends minutes
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A10."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '7' class = 'tbox' name = 'mrbs_eveningends_minutes' value ='".$pref['mrbs_eveningends_minutes']."'
	</td>
	</tr>";
	//Week starts
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A11."</td>
	<td style='width:30%' class='forumheader3'><select name = 'mrbs_weekstarts' class = 'tbox'>
	<option value = '0'".($pref['mrbs_weekstarts'] == 0 ? " selected " : "").">".MRBS_A12."</option>
	<option value = '1'".($pref['mrbs_weekstarts'] == 1 ? " selected " : "").">".MRBS_A13."</option>
	<option value = '2'".($pref['mrbs_weekstarts'] == 2 ? " selected " : "").">".MRBS_A14."</option>
	<option value = '3'".($pref['mrbs_weekstarts'] == 3 ? " selected " : "").">".MRBS_A15."</option>
	<option value = '4'".($pref['mrbs_weekstarts'] == 4 ? " selected " : "").">".MRBS_A16."</option>
	<option value = '5'".($pref['mrbs_weekstarts'] == 5 ? " selected " : "").">".MRBS_A17."</option>
	<option value = '6'".($pref['mrbs_weekstarts'] == 6 ? " selected " : "").">".MRBS_A18."</option>
	</select>
	</td>
	</tr>";

	//Date format
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A19."</td>
	<td style='width:30%' class='forumheader3'>
	<select class='tbox' name = 'mrbs_dateformat'>
	<option value = '0'".($pref['mrbs_dateformat'] == 0 ?" selected" : "").">Xxx 99</option>
	<option value = '1'".($pref['mrbs_dateformat'] == 1 ?" selected" : "").">99 Xxx</option>
	</select>
	</td>
	</tr>";
	//24 hour format
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A20."</td>
	<td style='width:30%' class='forumheader3'>
	<select class='tbox' name = 'mrbs_twentyfourhour_format'>
	<option value = '0'".($pref['mrbs_twentyfourhour_format'] == 0 ?" selected" : "").">12 hr</option>
	<option value = '1'".($pref['mrbs_twentyfourhour_format'] == 1 ?" selected" : "").">24 hr</option>
	</select>
	</td>
	</tr>";

	//max repeating entries
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A21."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '10' class = 'tbox' name = 'mrbs_max_rep_entrys' value ='".$pref['mrbs_max_rep_entrys']."'
	</td>
	</tr>";

	//default report days
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A22."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '7' class = 'tbox' name = 'mrbs_default_report_days' value ='".$pref['mrbs_default_report_days']."'
	</td>
	</tr>";
	//Refresh rate
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A23."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '7' class = 'tbox' name = 'mrbs_refresh_rate' value ='".$pref['mrbs_refresh_rate']."'
	</td>
	</tr>";

	//Area list format
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A26."</td>
	<td style='width:30%' class='forumheader3'>
	<select class='tbox' name = 'mrbs_area_list_format'>
	<option value = 'list'".($pref['mrbs_area_list_format'] == "list" ?" selected" : "").">".MRBS_A24."</option>
	<option value = 'select'".($pref['mrbs_area_list_format'] == "select" ?" selected" : "").">".MRBS_A25."</option>
	</select>
	</td>
	</tr>";

	//monthly view format
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A27."</td>
	<td style='width:30%' class='forumheader3'>
	<select class='tbox' name = 'mrbs_monthly_view_brief_description'>
	<option value = '1'".($pref['mrbs_monthly_view_brief_description'] == 1 ?" selected" : "").">".MRBS_A28."</option>
	<option value = '0'".($pref['mrbs_monthly_view_brief_description'] == 0 ?" selected" : "").">".MRBS_A29."</option>
	</select>
	</td>
	</tr>";

	//Week number
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A30."</td>
	<td style='width:30%' class='forumheader3'>
		<select class='tbox' name = 'mrbs_view_week_number'>
	<option value = '0'".($pref['mrbs_view_week_number'] == 0 ?" selected" : "").">".MRBS_A31."</option>
	<option value = '1'".($pref['mrbs_view_week_number'] == 1 ?" selected" : "").">".MRBS_A32."</option>
	</select>
	</td>
	</tr>";


	//typeA
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A33."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_typeA' value ='".$pref['mrbs_typeA']."'
	</td>
	</tr>";
	//Week number
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A34."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_typeB' value ='".$pref['mrbs_typeB']."'
	</td>
	</tr>";
	//Week number
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A35."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_typeC' value ='".$pref['mrbs_typeC']."'
	</td>
	</tr>";
	//Week number
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A36."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_typeD' value ='".$pref['mrbs_typeD']."'
	</td>
	</tr>";
	//Week number
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A37."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_typeE' value ='".$pref['mrbs_typeE']."'
	</td>
	</tr>";
	//Week number
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A38."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_typeF' value ='".$pref['mrbs_typeF']."'
	</td>
	</tr>";
	//Week number
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A39."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_typeG' value ='".$pref['mrbs_typeG']."'
	</td>
	</tr>";
	//Week number
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A40."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_typeH' value ='".$pref['mrbs_typeH']."'
	</td>
	</tr>";
	//Week number
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A41."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_typeI' value ='".$pref['mrbs_typeI']."'
	</td>
	</tr>";
	//Week number
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A42."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_typeJ' value ='".$pref['mrbs_typeJ']."'
	</td>
	</tr>";
	//User defined
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A43."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_userdef1' value ='".$pref['mrbs_userdef1']."'
	</td>
	</tr>";
		//User defined
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A44."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_userdef2' value ='".$pref['mrbs_userdef2']."'
	</td>
	</tr>";
		//User defined
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A45."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_userdef3' value ='".$pref['mrbs_userdef3']."'
	</td>
	</tr>";
		//User defined
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A46."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_userdef4' value ='".$pref['mrbs_userdef4']."'
	</td>
	</tr>";
		//User defined
	$hdu_text .= "<tr>
	<td style='width:30%' class='forumheader3'>".MRBS_A47."</td>
	<td style='width:30%' class='forumheader3'><input type='text' size = '30' class = 'tbox' name = 'mrbs_userdef5' value ='".$pref['mrbs_userdef5']."'
	</td>
	</tr>";



	// Submit button
	$hdu_text .= "
	<tr>
	<td colspan='2' style='text-align: center;'><input type='submit' name='update' value='".MRBS_A48."' class='button' />\n
	</td>
	</tr>";

	$hdu_text .= "</table></form>";
}

$ns->tablerender(MRBS_A1,$hdu_text);

require_once(e_ADMIN."footer.php");

?>