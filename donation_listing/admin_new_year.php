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
if ($_POST['add_year'] == '1') {
$newyear = $_POST['year_name'];
$reason = "";
$newok = "";

if (($newyear == "")){
	$newok = "0";
	$reason = "No Year";
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
$sql->db_Insert("donation_listing_year", "NULL, '".$newyear."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Year Added</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_year.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:80%' class='fborder' cellspacing='0' cellpadding='0'>";

$text .= "
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Year:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='year_name' size='50'>
        </td>
        </tr>";

$text .= "</div>
        </td>
	</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_year' value='1'>
		<input class='button' type='submit' value='Add Year'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender("Donation Listing Year", $text);
	      require_once(e_ADMIN."footer.php");
?>

