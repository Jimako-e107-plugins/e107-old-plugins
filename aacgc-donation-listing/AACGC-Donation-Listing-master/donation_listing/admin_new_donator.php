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
if ($_POST['add_donator'] == '1') {
$newuser = $_POST['user_id'];
$newamount = $_POST['user_amount'];
$newday = $_POST['user_day'];
$newyear = $_POST['year'];
$newmonth = $_POST['month'];
$reason = "";
$newok = "";
if (($newuser == "") OR ($newamount == "")){
	$newok = "0";
	$reason = "No name or amount";
} else {
	$newok = "1";
}
if (($newyear == "") OR ($newmonth == "")){
	$newok = "0";
	$reason = "No Year/Month Selected";
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
$sql->db_Insert("donation_listing", "NULL, '".$newuser."', '".$newamount."', '".$newday."', '".$newyear."', '".$newmonth."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Donator Added</b></center>");
}
}
//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_donator.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:80%' class='fborder' cellspacing='0' cellpadding='0'>";

$sql->db_Select("user", "user_id, user_name", "ORDER BY user_name ASC","");
while($row = $sql->db_Fetch()){
$usern = $row[user_name];
$userid = $row[user_id];
$user .= "<option name='user' value='".$userid."'>".$usern."</option>";}

$sql2 = new db;
$sql2->db_Select("donation_listing_month", "*");
$rows2 = $sql->db_Rows();
for ($i=0; $i < $rows2; $i++) {
$option2 = $sql2->db_Fetch();
$options2 .= "<option name='month' value='".$option2['month_id']."'>".$option2['month_name']."</option>";}

$sql3 = new db;
$sql3->db_Select("donation_listing_year", "*");
$rows3 = $sql3->db_Rows();
for ($i=0; $i < $rows3; $i++) {
$option3 = $sql3->db_Fetch();
$options3 .= "<option name='year' value='".$option3['year_id']."'>".$option3['year_name']."</option>";}


$text .= "
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>User:</td>
        <td style='width:70%' class='forumheader3'>
	<select name='user_id' size='1' class='tbox' style='width:100%'>
	".$user."
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Month:</td>
        <td style='width:70%' class='forumheader3'>
        <select name='month' size='1' class='tbox' style='width:100%'>
	".$options2."
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Year:</td>
        <td style='width:70%' class='forumheader3'>
        <select name='year' size='1' class='tbox' style='width:100%'>
	".$options3."
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Day Of The Month:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='user_day' size='20'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Amount:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='user_amount' size='30'>
        </td>
        </tr>

";
        $text .= "</div>
        </td>
		</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_donator' value='1'>
		<input class='button' type='submit' value='Add Donator'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender("Donation Listing (Add Donator)", $text);
	      require_once(e_ADMIN."footer.php");
?>
