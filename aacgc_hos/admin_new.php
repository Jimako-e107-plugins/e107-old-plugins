<?php

/*
#######################################
#     AACGC HOS                       #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
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
if ($_POST['add_hos'] == '1') {
$newname = $_POST['game_name'];
$newip = $_POST['ip'];
$newinfo = $_POST['info'];
$newreason = $_POST['reason'];
$newdate = $_POST['date'];
$newimg = $_POST['img_link'];
$newext = $_POST['ext_link'];

$reason = "";
$newok = "";

if (($newname == "")){
	$newok = "0";
	$reason = "No Game Name Entered";
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
$sql->db_Insert("aacgc_hos", "NULL, '".$newname."', '".$newip."', '".$newinfo."', '".$newreason."', '".$newdate."', '".$newimg."', '".$newext."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Successfully Added To Hall of Shame</b><br>[<a href='".e_PLUGIN."aacgc_hos/HOS.php'> Back To HOS </a>]</center>");

}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:80%' class='fborder' cellspacing='0' cellpadding='0'>";

$text .= "
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Game Name:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='game_name' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>IP:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='ip' size='50'>
        </td>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Extra Info:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='info' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Reason:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='reason' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Date:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='date' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Image Link:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='img_link' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>External Link:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='ext_link' size='50'>
        </td>
        </tr>
";


$text .= "</div>
        </td>
	</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_hos' value='1'>
		<input class='button' type='submit' value='Add To HOS'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender("AACGC Hall of Shame (Add to HOS)", $text);
	      require_once(e_ADMIN."footer.php");
?>

