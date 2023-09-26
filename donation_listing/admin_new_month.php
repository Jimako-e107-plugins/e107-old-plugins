<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Donation Listing          #
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

//-----------------------------------------------------------------------------------------------------------+
if ($_POST['add_month'] == '1') {
$newmonth = $_POST['month_name'];
$newyear = $_POST['year'];
$reason = "";
$newok = "";

if (($newmonth == "")){
	$newok = "0";
	$reason = "No Month";
} else {
	$newok = "1";
}
if (($newyear == "")){
	$newok = "0";
	$reason = "No Year Selected";
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
$sql->db_Insert("donation_listing_month", "NULL, '".$newmonth."', '".$newyear."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Month Added</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_month.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:80%' class='fborder' cellspacing='0' cellpadding='0'>";



$sql->db_Select("donation_listing_year", "*");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='year' value='".$option['year_id']."'>".$option['year_name']."</option>";
}


$text .= "
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Month:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='month_name' size='50'>
        </td>
        </tr>";

$text .= "</div>
        </td>
	</tr>
	<tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Year:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='year' size='1' class='tbox' style='width:100%'>
		".$options."
        </td>
        </tr>
	
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_month' value='1'>
		<input class='button' type='submit' value='Add Month'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender("Donation Listing Month", $text);
	      require_once(e_ADMIN."footer.php");
?>
