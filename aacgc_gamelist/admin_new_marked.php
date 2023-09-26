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

//-----------------------------------------------------------------------------------------------------------+
if ($_POST['add_game'] == '1') {
$newgame = $_POST['game'];
$newmark = $_POST['mark'];


$reason = "";
$newok = "";
if (($newgame == "")){
	$newok = "0";
	$reason = "No Game Chosen";
} else {
	$newok = "1";
}
if (($newmark == "") OR ($newok == "0")){
		If ($newmark == "") {
		$reason .= "No Mark Selected";	
		}
	$newok = "0";
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
$sql->db_Insert("aacgc_gamelist_markedgames", "NULL, '".$newgame."', '".$newmark."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Game Marked</b></center>");
}
}
//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_marked.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

$sql2 = new db;
$sql2->db_Select("aacgc_gamelist_marks", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$options .= "<option name='mark' value='".$option['mark_id']."'>".$option['mark_name']."</option>";}

$sql3 = new db;
$sql3->db_Select("aacgc_gamelist", "*", "ORDER BY game_name ASC", "");
$rows = $sql3->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option3 = $sql3->db_Fetch();
$options3 .= "<option name='game' value='".$option3['game_id']."'>".$option3['game_name']."</option>";}


        $text .= "
        <tr>
        <td style='width:25%; text-align:right' class='forumheader3'>Game:</td>
        <td style='width:' class='forumheader3'>
		<select name='game' size='1' class='tbox' style='width:50%'>
		".$options3."
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>Mark:</td>
        <td style='width:' class='forumheader3'>
		<select name='mark' size='1' class='tbox' style='width:50%'>
		".$options."
        </td>
        </tr>


        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_game' value='1'>
		<input class='button' type='submit' value='Mark Game'>
		</td>
        </tr>



</table>
</div>
<br>
</form>";
	      $ns -> tablerender("AACGC Game List (Mark Game)", $text);
	      require_once(e_ADMIN."footer.php");
?>


