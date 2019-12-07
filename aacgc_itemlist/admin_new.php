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
if ($_POST['add_item'] == '1') {
$newitemcat = $_POST['item_cat'];
$newitemsubcat = $_POST['item_subcat'];
$newitemname = $_POST['item_name'];
$newitemimg = $_POST['item_image'];
$newitemdetail = $_POST['item_details'];
$newitemlink = $_POST['item_link'];
$newitemprice = $_POST['item_price'];

$reason = "";
$newok = "";

if (($newitemname == "") OR ($newitemdetail == "")){
	$newok = "0";
	$reason = "No Item Name or Item Detail";
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
$sql->db_Insert("aacgc_itemlist", "NULL, '".$newitemcat."', '".$newitemsubcat."', '".$newitemname."', '".$newitemimg."', '".$newitemdetail."', '".$newitemlink."', '".$newitemprice."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Item Added</b></center>");
}
}
//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>";


$sql->db_Select("aacgc_itemlist_cat", "*");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='item_cat' value='".$option['item_cat_id']."'>".$option['item_cat_name']."</option>";}

$sql2->db_Select("aacgc_itemlist_subcat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option2 = $sql2->db_Fetch();
$options2 .= "<option name='item_subcat' value='".$option2['item_subcat_id']."'>".$option2['item_subcat_name']."</option>";}

$text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3' rowspan=3>Category (and/or) Sub-Category:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='item_cat' size='1' class='tbox' style='width:100%'>
                <option name='item_cat' value=''>Select Category</option>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:70%' class='forumheader3'>
        (And/OR)
        </td>
        </tr>

        <tr>
        <td style='width:70%' class='forumheader3'>
		<select name='item_subcat' size='1' class='tbox' style='width:100%'>
                <option name='item_subcat' value=''>Select Sub-Category</option>
		".$options2."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Item Name:</td>
        <td style='width:' class='forumheader3'>
        <input class='tbox' type='text' name='item_name' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Item Image Path:</td>
        <td style='width:' class='forumheader3'>
        <input class='tbox' type='text' name='item_image' size='100'>(optional)
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Item Details:</td>
        <td style='width:' class='forumheader3'>
	        <textarea class='tbox' rows='15' cols='100' name='item_details'></textarea>
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Item External Link:</td>
        <td style='width:' class='forumheader3'>
        <input class='tbox' type='text' name='item_link' size='100'>(optional)
        </td>
        </tr>

        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Item Price:</td>
        <td style='width:' class='forumheader3'>
        <input class='tbox' type='text' name='item_price' size='25'>(optional)
        </td>
        </tr>




";
        $text .= "</div>
        </td>
		</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_item' value='1'>
		<input class='button' type='submit' value='Add Item'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender("AACGC Item List (new item)", $text);
	      require_once(e_ADMIN."footer.php");
?>

