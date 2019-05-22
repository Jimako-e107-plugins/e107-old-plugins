<?php
	include("../../class2.php");
	require_once("languages/".e_LANGUAGE.".php");

	/* Local Variables */
	include("local_variables.php");

	require_once(HEADERF);

//	$ns -> tablerender( "cu_class", $pref['cu_class']);

	$valid_user = check_class($pref['sc_class']); 
	if (($valid_user) or (ADMIN == TRUE)) { // If Valid User or ADMIN
		switch ($action) {
			case 'DispContactForm': 
				include( "frm_linkrequest.php");
			break;
			case 'SendMail':
				include( "act_sendmail.php");
			break;
		}
		$ns -> tablerender( "Link Request", $form_text);
	} 
	else // No Access
	{
		$text = "You are not authorized to use the Link Request form.<p></p>";
		$ns -> tablerender("Link Request", $text); 
	}

	require_once(FOOTERF); 

?>