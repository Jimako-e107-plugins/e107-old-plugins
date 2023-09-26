<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Game List                 #
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

//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------
if ($_POST['add_cat'] == '1') {
$newcatname = $tp->toDB($_POST['cat_name']);
$newcattext = $tp->toDB($_POST['cat_text']);

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
$sql->db_Insert("aacgc_gamelist_cat", "NULL, '".$newcatname."','".$newcattext."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Category Added</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_cat.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

$text .= "
        <tr>
        <td style='width:20%; text-align:right' class='forumheader3'>Category Name:</td>
        <td style='width:80%' class='forumheader3'>
        <input class='tbox' type='text' name='cat_name' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:25%; text-align:right' class='forumheader3'>Category Detail:</td>
        <td style='width:75%' class='forumheader3'>
		<textarea class='tbox' rows='25' cols='100' name='cat_text' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";

        $text .= display_help('helpb', 'forum');

        $text .= "
        </td>
        </tr>";

$text .= "</div>
        </td>
	</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_cat' value='1'>
		<input class='button' type='submit' value='Add Category'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";


















        $text .= $rs->form_open("post", e_SELF, "myform_".$row['cat_id']."", "", "");
        $text .= "<br><br><br>
        <div style='text-align:center'>
        <table style='width:75%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>ID</td>
        <td style='width:25%' class='forumheader3'>Category Name</td>
        <td style='width:75%' class='forumheader3'>Category Detail</td>
       </tr>";
        $sql->db_Select("aacgc_gamelist_cat", "*", "ORDER BY cat_id ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['cat_id']."</td>
        <td style='width:' class='forumheader3'>".$row['cat_name']."</td>
        <td style='width:' class='forumheader3'>".$row['cat_text']."</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
















	      $ns -> tablerender("AACGC Game List (Create Category)", $text);
	      require_once(e_ADMIN."footer.php");
?>

