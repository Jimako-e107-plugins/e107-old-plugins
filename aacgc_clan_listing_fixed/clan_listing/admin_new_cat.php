<?php

/*
##########################
# AACGC Clan Listing     #
# M@CH!N3                #
# www.aacgc.com          #
# admin@aacgc.com        #
##########################
*/

require_once("../../class2.php");
include_lan(e_PLUGIN."clan_listing/languages/".e_LANGUAGE.".php");

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
$newclanname = $tp->toDB($_POST['clan_cat_name']);
$newclanicon = $tp->toDB($_POST['clan_cat_icon']);
$newclanorder = $tp->toDB($_POST['clan_cat_order']);
$reason = "";
$newok = "";

if (($newclanname == "")){
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
$sql->db_Insert("clan_listing_cat", "NULL, '".$newclanname."','".$newclanicon."','".$newclanorder."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Category Added</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_cat.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

$sql->db_Select("clan_listing_cat", "*");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$n++;
$options .= "<option name='clan_cat_order' value='".$n."'>".$n."</option>";}
$next = $n + 1;


$text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".ACLANLIST_CATN.":</td>
        <td style='width:70%' class='forumheader3'>
        <input class='tbox' type='text' name='clan_cat_name' size='100'>
        </td>
        </tr>";

        $rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'blank*');
        $iconpath = e_PLUGIN."clan_listing/icons";
        $iconlist = $fl->get_files($iconpath,"",$rejectlist);

        $text .= "
        <tr>
        <td style='width:; text-align:right' class='forumheader3'>".ACLANLIST_ICO.":</td>
        <td style='width:' class='forumheader3' colspan=2>
        ".$rs -> form_text("clan_cat_icon", 50, $row['clan_cat_icon'], 100)."
        ".$rs -> form_button("button", '', "Show Icons", "onclick=\"expandit('plcico')\"")." [<a href='http://www.aacgc.com/SSGC/download.php?view.330' target='_blank'> Download Icon Pack </a>] (400+ Icons)
            <div id='plcico' style='{head}; display:none'>";
            foreach($iconlist as $icon){
            $text .= "<a href=\"javascript:insertext('".$icon['fname']."','clan_cat_icon','plcico')\"><img width='100px' src='".$icon['path'].$icon['fname']."' style='border:0' alt='' /></a> ";
            }



$text .= "</div>
        </td>
	</tr>
	<tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".ACLANLIST_CATODR.":</td>
        <td style='width:70%' class='forumheader3'>
	<select name='clan_cat_order' size='1' class='tbox' style='width:20%'>
	<option name='clan_cat_order' value='0'>0</option>
        ".$options."
	<option name='clan_cat_order' value='".$next."'>".$next."</option>
        </td>
        </tr>	
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_cat' value='1'>
		<input class='button' type='submit' value='".ACLANLIST_ADDCAT."'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender("AACGC Clan Listing (Create Category)", $text);
	      require_once(e_ADMIN."footer.php");
?>

