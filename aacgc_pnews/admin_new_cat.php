<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Public News               #
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

include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");

//-----------------------------------------------------------------------------------------------------------+
if ($_POST['add_cat'] == '1') {
$newcatname = $_POST['news_cat_title'];
$newcattext = $_POST['news_cat_desc'];

$reason = "";
$newok = "";

if (($newcatname == "")){
	$newok = "0";
	$reason = "".APNEWS_81."";
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
$sql->db_Insert("aacgc_pnews_cat", "NULL, '".$newcatname."','".$newcattext."'") or die(mysql_error());
$ns->tablerender("", "<center><b>".APNEWS_99."</b></center>");
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
        <td style='width:20%; text-align:right' class='forumheader3'>".APNEWS_81.":</td>
        <td style='width:80%' class='forumheader3'>
        <input class='tbox' type='text' name='news_cat_title' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:25%; text-align:right' class='forumheader3'>".APNEWS_82.":</td>
        <td style='width:75%' class='forumheader3'>
	        <textarea class='tbox' rows='10' cols='100' name='news_cat_desc'></textarea>
        </td>
        </tr>";

$text .= "</div>
        </td>
	</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_cat' value='1'>
		<input class='button' type='submit' value='".APNEWS_100."'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";


















        $text .= $rs->form_open("post", e_SELF, "myform_".$row['news_cat_id']."", "", "");
        $text .= "<br><br><br>
        <div style='text-align:center'>
        <table style='width:75%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>".APNEWS_62."</td>
        <td style='width:25%' class='forumheader3'>".APNEWS_81."</td>
        <td style='width:75%' class='forumheader3'>".APNEWS_82."</td>
       </tr>";
        $sql->db_Select("aacgc_pnews_cat", "*", "ORDER BY news_cat_id ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['news_cat_id']."</td>
        <td style='width:' class='forumheader3'>".$row['news_cat_title']."</td>
        <td style='width:' class='forumheader3'>".$row['news_cat_desc']."</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
















	      $ns -> tablerender("AACGC Public News (Create Category)", $text);
	      require_once(e_ADMIN."footer.php");
?>

