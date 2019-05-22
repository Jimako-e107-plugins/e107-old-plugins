<?php
	/* Reset all variables used to create the display */

	// Retreive query string variables
	if(e_QUERY){
		$tmp = explode(".", e_QUERY);
		$action = $tmp[0];
		$id = $tmp[1];
		$id2 = $tmp[2];
		unset($tmp);
	} elseif ($_POST['frmaction']) {
		$action = $_POST['frmaction'];
	} else {
		$action = 'DispContactForm';
	}/* EndIf */

?>
