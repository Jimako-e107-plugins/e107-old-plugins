<?php

	require_once( "../../class2.php");
	require_once(e_ADMIN."auth.php");

	/* Local Variables and Functions*/
	include( "local_variables.php");

	if ((ADMIN == TRUE)) { // If ADMIN
		switch ($action) {
			/***** Edit Link Request Options *****/
			case 'DispOptions': 
				include( "frm_options.php");
			break;
	
			/***** Update Link Request Options *****/
			case 'UpdateOptions': 
				include( "act_upd_options.php");
				include( "frm_options.php");
			break;
	
			/***** Default *****/
			default:
				include( "frm_options.php");
		}
	}
	
	if ( $form_text) {
		$ns -> tablerender( $form_title, $form_text);
	} else {
		$ns -> tablerender( "Link Request", "There are currently no options to configure.");
	}

	include(e_ADMIN."footer.php");
?>