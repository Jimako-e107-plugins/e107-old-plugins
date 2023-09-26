<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Payment Tracker           #
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

include_lan(e_PLUGIN."aacgc_paytrack/languages/".e_LANGUAGE.".php");

//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//-----------------------------------------------------------------------------------------------------------+

if ($_POST['add_cat'] == '1') {
$newcattitle = $tp->toDB($_POST['cat_title']);
$newcatdet = $tp->toDB($_POST['cat_det']);
$newcatorder = $tp->toDB($_POST['cat_order']);


$reason = "";
$newok = "";

if (($newcattitle == "") OR ($newcatdet == "")){
	$newok = "0";
	$reason = "".APT_01."";
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
$sql->db_Insert("aacgc_paytrack_cat", "NULL, '".$newcattitle."','".$newcatdet."','".$newcatorder."'") or die(mysql_error());
$ns->tablerender("", "<center><b>".APT_34."</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_cat.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

$sql->db_Select("aacgc_paytrack_cat", "*");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$n++;
$options .= "<option name='cat_order' value='".$n."'>".$n."</option>";}
$next = $n + 1;

$text .= "
        <tr>
        <td style='width:20%; text-align:right' class='forumheader3'>".APT_35.":</td>
        <td style='width:80%' class='forumheader3'>
        <input class='tbox' type='text' name='cat_title' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".APT_36.":</td>
        <td style='width:' class='forumheader3' colspan=2>
		<textarea class='tbox' rows='25' cols='100' name='cat_det' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";

        $text .= display_help('helpb', 'forum');

        $text .= "</td>
        </tr>
	<tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".APT_37.":</td>
        <td style='width:70%' class='forumheader3'>
	<select name='cat_order' size='1' class='tbox' style='width:20%'>
	<option name='cat_order' value='0'>0</option>
        ".$options."
	<option name='cat_order' value='".$next."'>".$next."</option>
        </td>
        </tr>
";

$text .= "</div>
        </td>
	</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_cat' value='1'>
		<input class='button' type='submit' value='".APT_38."'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";



//---------------------------------------------------------------------------------------------------+



        $text .= "<br><br><br>
        <div style='text-align:center'>
        <table style='width:75%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>".APT_39."</td>
        <td style='width:25%' class='forumheader3'>".APT_35."</td>
        <td style='width:75%' class='forumheader3'>".APT_36."</td>
        <td style='width:0%' class='forumheader3'>".APT_37."</td>
       </tr>";
        $sql->db_Select("aacgc_paytrack_cat", "*", "ORDER BY cat_order ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['cat_id']."</td>
        <td style='width:' class='forumheader3'>".$row['cat_title']."</td>
        <td style='width:' class='forumheader3'>".$row['cat_det']."</td>
        <td style='width:' class='forumheader3'>".$row['cat_order']."</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";




	      $ns -> tablerender("AACGC Payment Tracker (".APT_40.")", $text);
	      require_once(e_ADMIN."footer.php");
?>

