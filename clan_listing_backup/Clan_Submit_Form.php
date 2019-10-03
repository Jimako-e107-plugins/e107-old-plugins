<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Clan Listing              #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

require_once("../../class2.php");
require_once(HEADERF);
  
include_lan(e_PLUGIN."clan_listing/languages/".e_LANGUAGE.".php");

$title .= "".CLANLIST_CSF."";

if(USER){
if ($pref['clanlist_enable_clansubmit'] == "1"){
//-------------------------# BB Code Support #----------------------------------------------

include(e_HANDLER."ren_help.php");

//------------------------------------------------------------------------------------------

//----------------------------------------------
if ($_POST['add_clan'] == '1') {
$newclanowner = $tp->toDB($_POST['clan_owner']);
$newclanname = $tp->toDB($_POST['clan_name']);
$newclantag = $tp->toDB($_POST['clan_tag']);
$newclanwebsite = $tp->toDB($_POST['clan_website']);
$newclantsip = $tp->toDB($_POST['clan_tsip']);
$newclantsport = $tp->toDB($_POST['clan_tsport']);
$newclanbanner = $tp->toDB($_POST['clan_banner']);
$newclangame = $tp->toDB($_POST['clan_game_banner']);
$newclancat = $_POST['clan_cat'];

$newpmfrom = $_POST['pm_from'];
$newpmto = $_POST['pm_to'];
$newpmsent = $_POST['pm_sent'];
$newpmread = $_POST['pm_read'];
$newpmsubject = $_POST['pm_subject'];
$newpmtext = $_POST['pm_text'];
$newpmsenddel = $_POST['pm_send_del'];
$newpmreaddel = $_POST['pm_read_del'];
$newpmatt = $_POST['pm_attachments'];
$newpmoption = $_POST['pm_option'];
$newpmsize = $_POST['pm_size'];

$reason = "";
$newok = "";
if (($newclanname == "") OR ($newclanwebsite == "")){
	$newok = "0";
	$reason = "".CLANLIST_CSF_ERR."";
} else {
	$newok = "1";
}
if (($newclancat == "")){
	$newok = "0";
	$reason = "No Category Selected";
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
$sql->db_Insert("clan_listing_submission", "NULL, '".$newclanowner."', '".$newclanname."', '".$newclantag."', '".$newclanwebsite."', '".$newclantsip."', '".$newclantsport."', '".$newclanbanner."', '".$newclangame."', '".$newclancat."'") or die(mysql_error());
$sql2->db_Insert("private_msg", "NULL, '".$newpmfrom."', '".$newpmto."', '".$newpmsent."', '".$newpmread."', '".$newpmsubject."', '".$newpmtext."', '".$newpmsenddel."', '".$newpmreaddel."', '".$newpmatt."', '".$newpmoption."', '".$newpmsize."'") or die(mysql_error());

$ns->tablerender("", "<center><b>".CLANLIST_CSF_CSB."</b></center>");
}
}
//-----------------------------------------------------------------------------------------------------------+
$text .= "<form method='POST' action='Clan_Submit_Form.php'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";


$sql->db_Select("clan_listing_cat", "*");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='clan_cat' value='".$option['clan_cat_id']."'>".$option['clan_cat_name']."</option>";}

$text .= "
        <tr>
        <td style='width:40%; text-align:left' class='forumheader3'>".CLANLIST_CSF_CN.":</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='clan_name' size='80'>
        <input type='hidden' name='clan_owner' value='".USERID."'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:left' class='forumheader3'>".CLANLIST_CSF_CT.":</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='clan_tag' size='40'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:left' class='forumheader3'>".CLANLIST_CSF_CW."</td>
        <td style='width:60%' class='forumheader3'>
	<input class='tbox' type='text' name='clan_website' size='80'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:left' class='forumheader3'>".CLANLIST_CSF_CTS.":</td>
        <td style='width:60%' class='forumheader3'>
	IP:<input class='tbox' type='text' name='clan_tsip' size='30'>PORT:<input class='tbox' type='text' name='clan_tsport' size='15'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:left' class='forumheader3'>".CLANLIST_CSF_CI.":</td>
        <td style='width:60%' class='forumheader3'>
	<textarea class='tbox' name='clan_banner' rows='15' cols='80' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>";

$text .= display_help('helpb', 'forum');

$text .= "</td></tr>
        <tr>
        <td style='width:40%; text-align:left' class='forumheader3'>".CLANLIST_CSF_CBC.":</td>
        <td style='width:60%' class='forumheader3'>
	        <textarea class='tbox' rows='10' cols='80' name='clan_game_banner'></textarea>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:left' class='forumheader3'>".CLANLIST_CSF_CC.":</td>
        <td style='width:60%' class='forumheader3'>
		<select name='clan_cat' size='1' class='tbox' style='width:100%'>
		".$options."
        </td>
        </tr>


";

//-----------------------# Auto PM Section #------------------------+

$subject = "".CLANLIST_APM_SUB."";

$message = "".CLANLIST_APM_MSA." [ <a href=".e_PLUGIN."clan_listing/admin_clan_submissions.php>".CLANLIST_APM_MSB."</a> ]";

$to = $pref['clanlist_pmuser'];
$from = "".USERID."";

$offset = +0;
$time = time()  + ($offset * 60 * 60);
$sent = $time;

$text .= "
        <tr>
        <td colspan=2>
        <input type='hidden' name='pm_from' value='".$from."'>
        <input type='hidden' name='pm_to' value='".$to."'>
        <input type='hidden' name='pm_sent' value='".$sent."'>
        <input type='hidden' name='pm_read' value='0'>
        <input type='hidden' name='pm_subject' value='".$subject."'>
        <input type='hidden' name='pm_text' value='".$message."'>
        <input type='hidden' name='pm_send_del' value='0'>
        <input type='hidden' name='pm_read_del' value='0'>
        <input type='hidden' name='pm_attachments' value=''>
        <input type='hidden' name='pm_option' value=''>
        <input type='hidden' name='pm_size' value='0'>
        </td>
        </tr>
";

//------------------------------------------------------------------+


$text .= "
        </td>
	</tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_clan' value='1'>
		<input class='button' type='submit' value='".CLANLIST_SC."'>
	</td>
        </tr>";



$text .= "</table>
</form>";


//-------------

$text .= "<br><a href='".e_PLUGIN."clan_listing/Clan_Categories.php'><center>[ ".CLANLIST_GB." ]</center></a><br>";
}
else
{
$text .= "Clan Submission Disabled.<br><a href='".e_PLUGIN."clan_listing/Clan_Categories.php'><center>[ ".CLANLIST_GB." ]</center></a><br>";
}
}
else
{
$text .= "<i>You Must Login or Register To Submit A Clan</i><br>
	<br><a href='".e_PLUGIN."clan_listing/Clan_Categories.php'><center>[ ".CLANLIST_GB." ]</center></a><br>
	";   }    
     
  $ns -> tablerender($title, $text);


  require_once(FOOTERF);



?>

