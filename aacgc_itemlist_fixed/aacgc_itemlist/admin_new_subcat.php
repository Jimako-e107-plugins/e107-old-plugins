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
if ($_POST['add_subcat'] == '1') {
$newsubcat = intval($_POST['item_subcat_cat']);
$newcatname = $tp->toDB($_POST['item_subcat_name']);
$newcatdet = $tp->toDB($_POST['item_subcat_details']);
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
$sql->db_Insert("aacgc_itemlist_subcat", "NULL, '".$newsubcat."','".$newcatname."','".$newcatdet."'") or die(mysql_error());
$ns->tablerender("", "<center><b>".LAN_AIL_SUBCAT_01."</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_subcat.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>";

$sql->db_Select("aacgc_itemlist_cat", "*");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='item_subcat_cat' value='".$option['item_cat_id']."'>".$option['item_cat_name']."</option>";}


$text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".LAN_AIL_SUBCAT_02.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='item_subcat_cat' size='1' class='tbox' style='width:100%'>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".LAN_AIL_SUBCAT_03.":</td>
        <td style='width:70%' class='forumheader3'>
        <input class='tbox' type='text' name='item_subcat_name' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".LAN_AIL_SUBCAT_04.":</td>
        <td style='width:70%' class='forumheader3'>
	<textarea class='tbox' rows='10' cols='100' name='item_subcat_details'></textarea>
        </td>
        </tr>
";

$text .= "</div>
        </td>
	</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_subcat' value='1'>
		<input class='button' type='submit' value='".LAN_AIL_SUBCAT_05."'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";

	      $ns -> tablerender(LAN_AIL_SUBCAT_00, $text);
	      require_once(e_ADMIN."footer.php");
?>


