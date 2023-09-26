<?php

/*
#######################################
#     AACGC Event Listing             #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
require_once(HEADERF);
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");

if(USER){
if ( check_class($pref['el_autoaddclass']) ){

$rs = new form;
$fl = new e_file;

//-----------------------------------------------------------------------------------------------------------+
if ($_POST['add_event'] == '1') {
$neweventname = $_POST['event_name'];
$neweventhost = $_POST['event_host'];
$neweventloc = $_POST['event_location'];
$neweventcost = $_POST['event_cost'];
$neweventdate = $_POST['event_date'];
$neweventdetail = $_POST['event_details'];
$neweventlink = $_POST['event_link'];
$neweventlinktext = $_POST['event_linktext'];
$neweventopen = $_POST['event_open'];

$reason = "";
$newok = "";

if (($neweventname == "")){
	$newok = "0";
	$reason = "No Name For Event";
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
$sql->db_Insert("aacgc_event_listing", "NULL, '".$neweventname."', '".$neweventhost."', '".$neweventloc."', '".$neweventcost."', '".$neweventdate."', '".$neweventdetail."', '".$neweventlink."', '".$neweventlinktext."', '".$neweventopen."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Event Added</b><br>[<a href='".e_PLUGIN."aacgc_event_listing/Events.php'> Back To Events List </a>]</center>");

}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='New_Event.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:80%' class='fborder' cellspacing='0' cellpadding='0'>";

$text .= "
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Name:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='event_name' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Host:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='event_host' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Location:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='event_location' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Cost:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='event_cost' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Date:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='event_date' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Details:</td>
        <td style='width:60%' class='forumheader3'>
        <textarea class='tbox' rows='5' cols='50' name='event_details'></textarea>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Link:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='event_link' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Link Text:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='event_linktext' size='50'>
        </td>
        </tr>
	<tr>
		<td style='width:30%' class='forumheader3'>Allow User Submissions:</td>
                <td style='width:' class=''>
                <select name='event_open' size='1' class='tbox' style='width:50%'>
                <option name='event_open' value='".$row['event_open']."'>".$row['event_open']."</option>
                <option name='event_open' value='Yes'>Yes</option>
                <option name='event_open' value='No'>No</option>
                </td>
	<tr>
";

$text .= "</div>
        </td>
	</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_event' value='1'>
		<input class='button' type='submit' value='Add Event'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
}}
else
{$text .= "<center><br><br><b><i>You Are Not Allowed To View This Page</i></b><br><br></center>";}

  $ns -> tablerender("AACGC Event Listing (Add Event)", $text);
  require_once(FOOTERF);

?>


