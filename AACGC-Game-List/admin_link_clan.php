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
if ($_POST['link_clan'] == '1') {
$newgame = $_POST['game'];
$newclan = $_POST['clancat'];


$reason = "";
$newok = "";
if (($newgame == "")){
	$newok = "0";
	$reason = "No Game Chosen";
} else {
	$newok = "1";
}
if (($newclan == "") OR ($newok == "0")){
		If ($newclan == "") {
		$reason .= "No Clan Category Selected";	
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
$sql->db_Insert("aacgc_gamelist_clanlist", "NULL, '".$newgame."', '".$newclan."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Game Linked With Clan Category</b></center>");
}
}
//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_link_clan.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

$sql2 = new db;
$sql2->db_Select("clan_listing_cat", "*", "ORDER BY clan_cat_name ASC", "");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$options .= "<option name='clancat' value='".$option['clan_cat_id']."'>".$option['clan_cat_name']."</option>";}

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
        <td style='width:; text-align:right' class='forumheader3'>Clan Category:</td>
        <td style='width:' class='forumheader3'>
		<select name='clancat' size='1' class='tbox' style='width:50%'>
		".$options."
        </td>
        </tr>


        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='link_clan' value='1'>
		<input class='button' type='submit' value='Link Game With Clan Category'>
		</td>
        </tr>



</table>
</div>
<br>
</form>";




//-----------------------------------------------------------------------------------------------------------+

if (isset($_POST['main_delete'])) {
    $delete_id = array_keys($_POST['main_delete']);
    $sql2 = new db;
    $sql2->db_Delete("aacgc_gamelist_clanlist", "link_id='".$delete_id[0]."'");}

if (isset($message)) {$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");}


if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['link_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>Link ID</td>
        <td style='width:25%' class='forumheader3'>Game Name</td>
        <td style='width:75%' class='forumheader3'>Clan Category</td>
        <td style='width:0%' class='forumheader3'>Options</td>
       </tr>";

        $sql->db_Select("aacgc_gamelist_clanlist", "*", "ORDER BY link_id ASC","");
        while($row = $sql->db_Fetch()){

        $sql2 = new db;
        $sql2->db_Select("clan_listing_cat", "*", "WHERE clan_cat_id=".$row['clancat']."","");
        $row2 = $sql2->db_Fetch();

        $sql3 = new db;
        $sql3->db_Select("aacgc_gamelist", "*", "WHERE game_id=".$row['game']."","");
        $row3 = $sql3->db_Fetch();

        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['link_id']."</td>
        <td style='width:' class='forumheader3'>".$row3['game_name']."</td>
        <td style='width:' class='forumheader3'>".$row2['clan_cat_name']."</td>
        <td style='width:' class='forumheader3'>";


        $text .= "
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['link_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['link_id']} ]')\"/>
		</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();

}
//-----------------------------------------------------------------------------------------------------------+



	      $ns -> tablerender("AACGC Game List (Link Game With Clan Category)", $text);
	      require_once(e_ADMIN."footer.php");
?>



