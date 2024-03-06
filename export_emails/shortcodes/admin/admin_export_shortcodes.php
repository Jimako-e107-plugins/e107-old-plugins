<?php 
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER . 'shortcode_handler.php');

global $tp;

$admin_confirmation_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);

/*

SC_BEGIN ITEM_MESSAGE
	$DataArray = getcachedvars('AdminConfirmationDataArray');
	return $DataArray['Message'];
SC_END

SC_BEGIN ITEM_EXPORT_TYPE
	$DataArray = getcachedvars('AdminConfirmationDataArray');
	if ((int)$DataArray['ee_export_type'] == 1) {
		return EE_ADMIN_CONFIRMATION_05;
	} else {
		return EE_ADMIN_CONFIRMATION_06;
	}
SC_END

SC_BEGIN ITEM_EXPORT_ACTION
	$DataArray = getcachedvars('AdminConfirmationDataArray');
	return '<input type="hidden" name="action" value="' . (((int)$DataArray['ee_export_type'] == 1) ? 'Export_TXT' : 'Export_CSV') . '" />';
SC_END

*/
?>