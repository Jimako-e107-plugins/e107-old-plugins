<?php

/*
#######################################
#     e107 website system plguin      #
#     Product Listing                 #
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
if ($_POST['add_subcat'] == '1') {
$newsubcatname = $_POST['product_subcat_name'];
$newcatname = $_POST['product_cat'];
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
$sql->db_Insert("product_listing_subcat", "NULL, '".$newsubcatname."','".$newcatname."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Sub-Category Added</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_subcat.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:80%' class='fborder' cellspacing='0' cellpadding='0'>";



$sql->db_Select("product_listing_cat", "*");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='product_cat' value='".$option['product_cat_id']."'>".$option['product_cat_name']."</option>";
}


$text .= "
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Sub-Category Name:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='product_subcat_name' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Category:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='product_cat' size='1' class='tbox' style='width:100%'>
		".$options."
        </td>
        </tr>";



$text .= "</div>
        </td>
	</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_subcat' value='1'>
		<input class='button' type='submit' value='Add Sub-Category'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender("Product Listing (Create Sub-Category)", $text);
	      require_once(e_ADMIN."footer.php");
?>


