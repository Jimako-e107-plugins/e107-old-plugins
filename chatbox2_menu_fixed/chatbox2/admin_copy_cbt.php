<?php
/*
################################################################
#
#	CHATBOX II
#
#		Billy Smith
#		http://www.vitalogix.com
#		chicks_hate_me@hotmail.com
#
#	Designed for use with the e107 website system.
#		http://e107.org
#
#	Released under the terms and conditions of the GNU GPL.
#		GNU General Public License (http://gnu.org)
#
#	Leave Acknowledgements in ALL Distributions and derivatives.
#
################################################################
*/
require_once("../../class2.php");

if(!getperms("P")) { header("location:".e_BASE."index.php"); exit; }

require_once(e_ADMIN."auth.php");
//require_once(e_HANDLER."userclass_class.php");

// ###########################
// INITIALIZATION
// ###########################
if (file_exists(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE.".php")) {
	include_once(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE.".php");
} else {
	include_once(e_PLUGIN."chatbox2/languages/English/English.php");
}

if (file_exists(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php")) {
	include_once(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php");
} else {
	include_once(e_PLUGIN."chatbox2/languages/English/English_config.php");
}

$text = "
		<form id='chatbox2' method='post' action='".e_SELF."'>
		<br />
";

if($_POST['submit'] == CB2_L4){

	$qry = "INSERT INTO ".$mySQLprefix."chatbox2
		(cb2_id, cb2_nick, cb2_message, cb2_datestamp, cb2_blocked, cb2_ip)
		SELECT
		cb_id, cb_nick, cb_message, cb_datestamp, cb_blocked, cb_ip
		FROM
		".$mySQLprefix."chatbox
	";

	$text .= $sql -> db_Select_gen($qry) ? "Transfer Completed...." : CB2_L31;

	$text .= "
		<br /><br />
	";


}else{

	$text .= "
		This utility will copy the entries already in Chatbox over the new Chatbox II
		<br /><br />
		You should do this IMMEDIATELY AFTER the Chatbox II is installed but BEFORE any entries are put into the ChatBox II Table.
		<br /><br />
		To do this copy, click the 'Submit' button.
		<br /><br />
		<input id='submit' name='submit' class='button' type='submit' value='".CB2_L4."'/>
	";
}

//if($_POST['CREATE'] == "YES"){
//// CREATE AND COPY CHATBOX TABLE TO CHATBOX II
//	$qry = "CREATE TABLE ".$mySQLprefix."chatbox2 SELECT * FROM ".$mySQLprefix."chatbox";
//	$cb2_emessage = ($sql -> db_Select_gen($qry)) ? NULL : CB2_L31;
//}

// //ALTER FIELD NAMES
//	$qry = "ALTER TABLE ".$mySQLprefix."chatbox2
//		CHANGE COLUMN cb_id cb2_id INTEGER,
//		CHANGE COLUMN cb_nick cb2_nick varchar(30) NOT NULL default '',
//		CHANGE COLUMN cb_message cb2_message text NOT NULL,
//		CHANGE COLUMN cb_datestamp cb2_datestamp int(10) unsigned NOT NULL default '0',
//		CHANGE COLUMN cb_blocked cb2_blocked tinyint(3) unsigned NOT NULL default '0',
//		CHANGE COLUMN cb_ip cb2_ip varchar(15) NOT NULL default ''
//	";
//	$sql -> db_Select_gen($qry);
//
//	// ADD FONT COLOR FIELD
//	$qry = "ALTER TABLE ".$mySQLprefix."chatbox4 ADD cb2_color varchar(6) NOT NULL default '' AFTER cb2_message";
//	$sql -> db_Select_gen($qry);
//


	$text .= "
		<input id='reset' name='reset' class='button' type='submit' value='".CB2_L5."'/>
		</form>
		<br /><br />
	";


$ns -> tablerender("Copy Database", $text);
require_once(e_ADMIN."footer.php");
?>


