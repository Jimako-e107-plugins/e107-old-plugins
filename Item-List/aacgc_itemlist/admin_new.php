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
$newitemcat = intval($_POST['item_cat']);
$newitemsubcat = intval($_POST['item_subcat']);
$newitemname = $tp->toDB($_POST['item_name']);
$newitemimg = $tp->toDB($_POST['item_image']);
$newitemdetail = $tp->toDB($_POST['item_details']);
$newitemlink = $tp->toDB($_POST['item_link']);
$newitemprice = $tp->toDB($_POST['item_price']);
$newitemicon = $tp->toDB($_POST['item_icon']);

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
$sql->db_Insert("aacgc_itemlist", "NULL, '".$newitemcat."', '".$newitemsubcat."', '".$newitemname."', '".$newitemimg."', '".$newitemdetail."', 
'".$newitemlink."', '".$newitemprice."', '".$newitemicon."'") or die(mysql_error());
$ns->tablerender("", "<center><b>".LAN_AIL_ITEM_01."</b></center>");
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
        <td style='width:30%; text-align:right' class='forumheader3' rowspan=3>".LAN_AIL_ITEM_02.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='item_cat' size='1' class='tbox' style='width:100%'>
                <option name='item_cat' value=''>".LAN_AIL_ITEM_03."</option>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:70%' class='forumheader3'>  ".LAN_AIL_ITEM_04."  </td>
        </tr>

        <tr>
        <td style='width:70%' class='forumheader3'>
		<select name='item_subcat' size='1' class='tbox' style='width:100%'>
                <option name='item_subcat' value=''>".LAN_AIL_ITEM_05."</option>
		".$options2."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".LAN_AIL_ITEM_06.":</td>
        <td style='width:' class='forumheader3'>
        <input class='tbox' type='text' name='item_name' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".LAN_AIL_ITEM_07.":</td>
        <td style='width:70%' class='forumheader3'>          		 
		<div ><br />      
        ";
    $parms  = 'name=item_image';
		$parms .= '&path='.e_IMAGE.'images/';
		$parms .= '&default='.$_POST['item_image'];
		$parms .= '&width=100px';
		$parms .= '&height=100px';
		$parms .= '&multiple=FALSE';
		$parms .= '&label=-- '.LAN_AIL_NEWS_48.' --';
		$parms .= '&subdirs=1';

    $text .= $tp->parseTemplate("{IMAGESELECTOR={$parms}}");
            
    $text .=   "  </div>
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".LAN_AIL_ITEM_08.":</td>
        <td style='width:' class='forumheader3'>
	        <textarea class='tbox' rows='15' cols='100' name='item_details'></textarea>
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".LAN_AIL_ITEM_10.":</td>
        <td style='width:' class='forumheader3'>
        <input class='tbox' type='text' name='item_link' size='100'>".LAN_AIL_OPTIONAL."</td>
        </tr>
 
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".LAN_AIL_ITEM_11.":</td>
        <td style='width:' class='forumheader3'>
        <input class='tbox' type='text' name='item_price' size='25'>".LAN_AIL_OPTIONAL."</td>
        </tr>  
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".LAN_AIL_ITEM_09.":</td>
        <td style='width:' class='forumheader3'>
        <input class='tbox' type='text' name='item_icon' size='25'>".LAN_AIL_OPTIONAL."</td>
        </tr>
         </div>
        </td>
		</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_item' value='1'>
		<input class='button' type='submit' value='".LAN_AIL_ITEM_12."'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender(LAN_AIL_ITEM_00, $text);
	      require_once(e_ADMIN."footer.php");
?>

