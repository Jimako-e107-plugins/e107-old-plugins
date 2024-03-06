<?php
require_once("../../../class2.php");
require_once(e_ADMIN . "auth.php");
require_once(e_HANDLER . "userclass_class.php");
include_lan(e_PLUGIN . 'export_emails/languages/' . e_LANGUAGE . '.php');

if (!defined('e107_INIT')) { exit; }
if (!getperms("P")) { header("location:" . e_BASE . "index.php"); exit; }
if (!defined('ADMIN_WIDTH')) { define(ADMIN_WIDTH, "width:100%;"); }

$obj = new adminconfig;

class adminconfig {

	/**
	 *	adminconfig
	 *		Constructor
	 */

	function adminconfig() {
		switch ($_POST['action']) {
			case "update":
				$this -> Update($_POST['DataArray']);
				break;
			default:
				$this -> DoForm($this -> GetConfigs());
		}
	}

	/**
	 *	Update
	 *		Do update query
	 *	@param array $DataArray
	 *		Contains all datas for update
	 */

	function Update($DataArray) {
		if ($this -> CheckDataArray($DataArray)) {
			$UpdateQuery = new db;
			if (!is_object($tp)) { $tp = new e_parse; }
			if ($UpdateQuery -> db_Update("ee_config", "
												ee_export_type='" . (int)$DataArray['ee_export_type'] . "', 
												ee_csv_field_end='" . $tp -> toDB($DataArray['ee_csv_field_end']) . "', 
												ee_csv_field_close='" . $tp -> toDB($DataArray['ee_csv_field_close']) . "', 
												ee_csv_field_escape='" . $tp -> toDB($DataArray['ee_csv_field_escape']) . "', 
												ee_csv_add_un='" . (int)$DataArray['ee_csv_add_un'] . "' 
											WHERE ee_id='1'")) {
				$this -> DoForm($this -> GetConfigs(), $this -> _Message(EE_ADMIN_CONFIG_12, TRUE));
			} else {
				$this -> DoForm($this -> GetConfigs(), $this -> _Message(EE_ADMIN_CONFIG_10, FALSE));
			}
		} else {
			$this -> DoForm($this -> GetConfigs(), $this -> _Message(EE_ADMIN_CONFIG_11, FALSE));
		}
	}

	/**
	 *	DoForm
	 *		Create a form to edit
	 *	@param array $DataArray
	 *		Contains form datas for reedit
	 *	@param string $msg
	 *		Status message
	 */

	function DoForm($DataArray = array(), $msg = '') {
		include(e_PLUGIN . "export_emails/shortcodes/admin/admin_config_shortcodes.php");
		include(e_PLUGIN . "export_emails/templates/admin/admin_config_template.php");

		global $ns;

		$caption = EE_ADMIN_CONFIG_01;
		$text = '';

		$DataArray['Message'] = $msg;

		cachevars('AdminConfigDataArray', $DataArray);
		if (!is_object($tp)) { $tp = new e_parse; }
		$text .= $tp -> parseTemplate($ADMIN_CONFIG_TEMPLATE, FALSE, $admin_config_shortcodes);

		$ns -> tablerender($caption, $text);
	}

	/**
	 *	GetConfigs
	 *		Get Plugin configurations from DB
	 *	@return array
	 *		Contains plugin configurations
	 */

	function GetConfigs() {
		$sql = new db;
		return ($sql -> db_Fetch($sql -> db_Select("ee_config", "*", "ee_id='1' ")));
	}

	/**
	 *	_CheckFormDatas
	 *		Check form's datas
	 *	@param array $InputArray
	 *		Contains all items of form
	 *	@return boolean $OK
	 *		Form's datas are valid or not
	 */

	function CheckDataArray($InputArray = array(), $OK = TRUE) {
		(!is_numeric($InputArray['ee_export_type'])) ? $OK = FALSE : "";
		return $OK;
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

require_once(e_ADMIN . "footer.php");
?>
