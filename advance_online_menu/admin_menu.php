<?php

$storedb = new db();
$storedb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);
$approvable = $storedb->db_Count("ss_products", "(*)", "WHERE product_approve='0'");

	$menutitle  = AO_NAME."..? ".AO_MENU;

	$butname[]  = "Preferences";
	$butlink[]  = "admin_config.php";
	$butid[]	 = "config";

	$butname[]  = "Readme";
	$butlink[]  = "admin_readme.php";
	$butid[]	 = "readme";

	global $pageid;
	for ($i=0; $i<count($butname); $i++) {
		$var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};

	show_admin_menu($menutitle, $pageid, $var);
	$storedb->db_Close();
?>