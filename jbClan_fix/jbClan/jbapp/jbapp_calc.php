<?php
/*
+--------------------------------------------------------------------------------+
|   jbApp - by Jesse Burns aka jburns131 aka Jakle (jburns131@jbwebware.com)
|
|   Plugin Support Site: www.jbwebware.com
|
|   A plugin designed for the e107 Website System
|   http://e107.org
|
|   For more plugins visit:
|   http://plugins.e107.org
|   http://www.e107coders.org
|
|   Released under the terms and conditions of the
|   GNU General Public License (http://gnu.org).
|
+--------------------------------------------------------------------------------+
*/

if(file_exists(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php")){
    include_lan(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php");
}

require_once("includes/config.constants.php");

$sql->db_Select(DB_TABLE_APP_INFO);
while ($row = $sql->db_Fetch()) {
    $organization_email = $row['organization_email'];
}

$sql->db_Select(DB_TABLE_ROSTER_PREFERENCES);
while ($row = $sql->db_Fetch()) {
    $organization_name = $row['organization_name'];
}

require_once(e_HANDLER."mail.php");

$send_to = $organization_email;
$subject = LAN_JBAPP_CALC_EMAIL_SUBJECT;
$message = LAN_JBAPP_CALC_EMAIL_TITLE."\n\n";


$message .= LAN_JBAPP_CALC_DOB.": ".
             $_POST['15_month']."/".
             $_POST['15_day']."/".
             $_POST['15_year']."\n\n";

foreach($_POST as $key=>$val) {
	if(!is_numeric($key)) {
		//Don't do anything
	} else {
		$sql->db_Select(DB_TABLE_ROSTER_CUSTOM_ATTRIBUTE_ENTRIES, "*", "attribute_id = ".intval($key));
		while ($row = $sql->db_Fetch()) {
			if ($row['attribute_id'] == 34) {
				$message .= $row['attribute_name']." $organization_name: $val\n\n";
			} else {
				$message .= $row['attribute_name'].": $val\n\n";
			}
		}
    }
}

sendemail($send_to, $subject, $message);

?>
