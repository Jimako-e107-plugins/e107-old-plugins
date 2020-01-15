<?php

// incude e107 class file, it's required
require_once("../../class2.php");


// check if user is admin, if not redirect to home page
if (!getperms("P")) {
	header("location:".e_HTTP."index.php");
	exit;
}

// include language file
include_lan(e_PLUGIN."roster/languages/admin/".e_LANGUAGE.".php");

// include admin header
require_once(e_ADMIN."auth.php");

//admin html file
require_once("html/admin/roster_adminmain.php");
$html = new adminmain_html;

$text = $html->main_header();
$text .= $html->main_body();
$text .= $html->main_footer();

// output the text
$ns->tablerender(roster_LAN_ADMIN_MAIN_MENU_TITLE, $text);

require_once(e_ADMIN."footer.php");

?>

