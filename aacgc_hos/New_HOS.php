<?php

/*
#######################################
#     AACGC HOS                       #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
require_once(HEADERF);
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;

if(USER){
if ( check_class($pref['hos_addclass']) OR (ADMIN) ){
//-----------------------------------------------------------------------------------------------------------+
if ($_POST['add_hos'] == '1') {
$newname = $tp->toDB($_POST['game_name']);
$newip = $tp->toDB($_POST['ip']);
$newinfo = $tp->toDB($_POST['info']);
$newreason = $tp->toDB($_POST['reason']);
$newdate = $tp->toDB($_POST['date']);
$newimg = $tp->toDB($_POST['img_link']);
$newlink = $tp->toDB($_POST['ext_link']);

$reason = "";
$newok = "";

if (($newname == "")){
	$newok = "0";
	$reason = "No Game Name Entered";
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
$sql->db_Insert("aacgc_hos", "NULL, '".$newname."', '".$newip."', '".$newinfo."', '".$newreason."', '".$newdate."', '".$newimg."', '".$newlink."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Successfully Added To Hall of Shame</b><br>[<a href='".e_PLUGIN."aacgc_hos/HOS.php'> Back To HOS </a>]</center>");

}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='New_HOS.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:80%' class='fborder' cellspacing='0' cellpadding='0'>";

$text .= "
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Game Name:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='game_name' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>IP:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='ip' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Extra Info:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='info' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Reason:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='reason' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Date:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='date' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>Image Link:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='img_link' size='50'>
        </td>
        </tr>
        <tr>
        <td style='width:40%; text-align:right' class='forumheader3'>External Link:</td>
        <td style='width:60%' class='forumheader3'>
        <input class='tbox' type='text' name='ext_link' size='50'>
        </td>
        </tr>
";

$text .= "</div>
        </td>
	</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_hos' value='1'>
		<input class='button' type='submit' value='Add To HOS'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
}}
else
{$text .= "<i>You do not have permission to view this page!</i>";}

$text .= "<br>   
          <center>
          <br><br>
          [<a href='".e_PLUGIN."aacgc_hos/HOS.php'> Back To HOS </a>]
          </center>
          <br>";



	      $ns -> tablerender("AACGC Hall of Shame (Add to HOS)", $text);
  require_once(FOOTERF);
?>


