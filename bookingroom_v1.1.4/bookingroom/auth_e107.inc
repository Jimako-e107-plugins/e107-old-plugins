<?php

function authValidateUser($user, $pass)
{
	return 1;
}

function authGetUserLevel($user, $lev1_admin){
	global $pref;
	require_once(e_HANDLER."userclass_class.php");
	$retval = -1;
	if (check_class($pref['mrbs_viewclass']) || ADMIN)
		$retval = 0;
	if (check_class($pref['mrbs_bookclass']) || ADMIN)
		$retval = 1;
	if (check_class($pref['mrbs_adminclass']) || ADMIN)
		$retval = 2;

	return $retval;
}
?>