<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Item List                 #
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
if ($_POST['add_cat'] == '1') {
$newcatname = $_POST['item_cat_name'];
$newcatdet = $_POST['item_cat_details'];
$reason = "";
$newok = "";

if (($newcatname == "")){
	$newok = "0";
	$reason = "No Name";
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
$sql->db_Insert("aacgc_itemlist_cat", "NULL, '".$newcatname."','".$newcatdet."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Category Added</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_cat.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>";

$text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Category Name:</td>
        <td style='width:70%' class='forumheader3'>
        <input class='tbox' type='text' name='item_cat_name' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Category Details:</td>
        <td style='width:70%' class='forumheader3'>
	<textarea class='tbox' rows='10' cols='100' name='item_cat_details'></textarea>
        </td>
        </tr>
";

$text .= "</div>
        </td>
	</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_cat' value='1'>
		<input class='button' type='submit' value='Create Category'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender("AACGC Item List (create category)", $text);
	      require_once(e_ADMIN."footer.php");
?>

