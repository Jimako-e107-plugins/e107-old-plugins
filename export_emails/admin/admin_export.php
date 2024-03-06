<?php
require_once("../../../class2.php");

if ($_POST['action'] != "Export_CSV" AND $_POST['action'] != "Export_TXT") {
	require_once(e_ADMIN . "auth.php");
	require_once(e_HANDLER . "userclass_class.php");
	include_lan(e_PLUGIN . 'export_emails/languages/' . e_LANGUAGE . '.php');

	if (!defined('ADMIN_WIDTH')) { define(ADMIN_WIDTH, "width:100%;"); }
}

if (!defined('e107_INIT')) { exit; }
if (!getperms("P")) { header("location:" . e_BASE . "index.php"); exit; }

$obj = new AdminExport;

class AdminExport {

	/**
	 *	AdminExport
	 *		Constructor
	 */

	function AdminExport() {
		switch ($_POST['action']) {
			case "Export_TXT":
				$this -> ExportEmailsToTXT($this -> GetConfigs());
				break;
			case "Export_CSV":
				$this -> ExportEmailsToCSV($this -> GetConfigs());
				break;
			default:
				$this -> ConfirmExport($this -> GetConfigs());
		}
	}

	/**
	 *	ConfirmExport
	 *		Create a xonfirmation form
	 */

	function ConfirmExport($DataArray = array()) {
		include(e_PLUGIN . "export_emails/shortcodes/admin/admin_export_shortcodes.php");
		include(e_PLUGIN . "export_emails/templates/admin/admin_export_template.php");

		global $ns;

		$caption = EE_ADMIN_CONFIRMATION_01;
		$text = '';

		$DataArray['Message'] = $this -> _Message(EE_ADMIN_CONFIRMATION_02, FALSE);

		cachevars('AdminConfirmationDataArray', $DataArray);
		if (!is_object($tp)) { $tp = new e_parse; }
		$text .= $tp -> parseTemplate($ADMIN_CONFIRMATION_TEMPLATE, FALSE, $admin_confirmation_shortcodes);

		$ns -> tablerender($caption, $text);
	}

	/**
	 *	ExportEmailsToTXT
	 *		Create a file and write content into it
	 *	@param array PlugConfs
	 *		Contains plugin's configurations
	 */

	function ExportEmailsToTXT($PlugConfs = array()) {
		$filename = date("y-m-d_H-i-s");
		$Emails = new db;
		$Emails -> db_Select("user", "user_email", "user_id > 0");
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment;filename=' . $filename . '.txt');
		$File = fopen(e_PLUGIN . "export_emails/temp/" . $filename . ".txt", "a+");

		while ($Email = $Emails -> db_Fetch()) {
			if (!is_object($tp)) { $tp = new e_parse; }
			$node = $tp -> toText($Email['user_email']) . "\r\n";
			fwrite($File, $node);
		}
		
		fclose($File);
		readfile("../temp/" . $filename . ".txt");
		unlink("../temp/" . $filename . ".txt");
	}

	/**
	 *	ExportEmailsToCSV
	 *		Create a file and write content into it
	 *	@param array PlugConfs
	 *		Contains plugin's configurations
	 */

	function ExportEmailsToCSV($PlugConfs = array()) {
		$filename = date("y-m-d_H-i-s");
		$Emails = new db;
		$Emails -> db_Select("user", "user_email, user_name", "user_id > 0");
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment;filename=' . $filename . '.csv');
		$File = fopen(e_PLUGIN . "export_emails/temp/" . $filename . ".csv", "a+");

		if (!is_object($tp)) { $tp = new e_parse; }

		$close = $tp -> toForm($PlugConfs['ee_csv_field_close']);
		$end = $tp -> toForm($PlugConfs['ee_csv_field_end']);
		$escape = $tp -> toForm($PlugConfs['ee_csv_field_escape']);

		$content = $close . "user_emails" . $close;

		if ((int)$PlugConfs['ee_csv_add_un'] == 1) {
			$content .= $end . $close . "user_name" . $close . "\r\n";
		} else {
			$content .= "\r\n";
		}

		fwrite($File, html_entity_decode($content));

		while ($Email = $Emails -> db_Fetch()) {
			$node_a = $Email['user_email'];
			$node_a = str_replace($close, $escape, $node_a);
			$node_a = str_replace(html_entity_decode($close), $escape, $node_a);

			$content = $close . $node_a . $close;

			if ((int)$PlugConfs['ee_csv_add_un'] == 1) {
				$node_b = $Email['user_name'];
				$node_b = str_replace($close, $escape, $node_b);
				$node_b = str_replace(html_entity_decode($close), $escape, $node_b);
				$content .= $end . $close . $node_b . $close . "\r\n";
			} else {
				$content .= "\r\n";
			}

			fwrite($File, html_entity_decode($content));
		}
		
		fclose($File);
		readfile("../temp/" . $filename . ".csv");
		unlink("../temp/" . $filename . ".csv");
	}

	/**
	 *	GetConfigs
	 *		Get Plugin configurations from DB
	 */

	function GetConfigs() {
		$sql = new db;
		return ($sql -> db_Fetch($sql -> db_Select("ee_config", "*", "ee_id='1' ")));
	}

	/**
	 *	_message
	 *		Create a status message with different colors
	 *	@param string $MsgText
	 *		Contains the current status message
	 *	@param boolean $Prop
	 *		If TRUE, the message is green... if FALSE it's red
	 *	@return string
	 *		Formatted status message
	 */

	function _Message($MsgText, $Prop) {
		switch ($Prop) {
			case TRUE:
				return '<div class="export-emails-status-msg-true">' . $MsgText . '</div>';
				break;
			case FALSE:
				return '<div class="export-emails-status-msg-false">' . $MsgText . '</div>';
				break;
		}
	}

}

if ($_POST['action'] != "Export_CSV" AND $_POST['action'] != "Export_TXT") {
	require_once(e_ADMIN . "footer.php");
}
?>
