<?php 
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER . 'shortcode_handler.php');

global $tp;

$admin_config_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);

/*

SC_BEGIN ITEM_MESSAGE
	$DataArray = getcachedvars('AdminConfigDataArray');
	return $DataArray['Message'];
SC_END

SC_BEGIN ITEM_EXPORT_TYPE
	$DataArray = getcachedvars('AdminConfigDataArray');
	return '
	<select name="DataArray[ee_export_type]" class="tbox">
		<option value="1" ' . (((int)$DataArray['ee_export_type'] == 1)? 'selected="selected"' : '') . '>TXT ' . EE_ADMIN_CONFIG_02 . '</option>
		<option value="2" ' . (((int)$DataArray['ee_export_type'] == 2)? 'selected="selected"' : '') . '>CSV ' . EE_ADMIN_CONFIG_02 . '</option>
	</select>';
SC_END

SC_BEGIN ITEM_FIELD_END
	$DataArray = getcachedvars('AdminConfigDataArray');
	if (!is_object($tp)) { $tp = new e_parse; }
	return '<input type="text" name="DataArray[ee_csv_field_end]" value="' . $tp -> toForm($DataArray['ee_csv_field_end']) . '" class="tbox" size="5" />';
SC_END

SC_BEGIN ITEM_FIELD_CLOSE
	$DataArray = getcachedvars('AdminConfigDataArray');
	if (!is_object($tp)) { $tp = new e_parse; }
	return '<input type="text" name="DataArray[ee_csv_field_close]" value="' . $tp -> toForm($DataArray['ee_csv_field_close']) . '" class="tbox" size="5" />';
SC_END

SC_BEGIN ITEM_FIELD_ESCAPE
	$DataArray = getcachedvars('AdminConfigDataArray');
	if (!is_object($tp)) { $tp = new e_parse; }
	return '<input type="text" name="DataArray[ee_csv_field_escape]" value="' . $tp -> toForm($DataArray['ee_csv_field_escape']) . '" class="tbox" size="5" />';
SC_END

SC_BEGIN ITEM_ADD_USERNAME
	$DataArray = getcachedvars('AdminConfigDataArray');
	return '<input type="checkbox" name="DataArray[ee_csv_add_un]" value="1" class="tbox" ' . (((int)$DataArray['ee_csv_add_un'] == 1) ? 'checked' : '') . '>&nbsp;' . EE_ADMIN_CONFIG_15;
SC_END

*/
?>