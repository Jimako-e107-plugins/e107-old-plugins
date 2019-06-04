<?php

require_once("../../class2.php");

$auth = false;

if($pref['ticker']['admin_class'] != "0") {

	$sql->db_select_gen("SELECT userclass_name FROM `".MPREFIX."userclass_classes` WHERE `".MPREFIX."userclass_classes`.`userclass_id` = '".$pref['bot_control_class']."'");
	$row = $sql->db_select();
	
	$class = $row[1];

	if(check_class($class)) {

		$auth = true;

	} else {

		$auth = false;

	}

} elseif($pref['ticker']['admin_class'] == "0" OR !isset($pref['ticker']['admin_class'])) {

	if(ADMIN && getperms("P")) {

		$auth = true;

	} else {

		$auth = false;

	}

}

?>