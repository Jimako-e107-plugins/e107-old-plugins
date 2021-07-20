<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Donation Listing          #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

require_once("../../class2.php");
require_once(e_HANDLER."userclass_class.php");


if(!getperms("P")){
header("location:".e_BASE."index.php");
exit;
}

require_once(e_ADMIN."auth.php");
//-------------------------------------------------------------------------------------------------------------------

$title = "<B>AACGC Donation Listing (Main)<B></center>";

//-------------------------------------------------------------------------------------------------------------------


$text .= "<center><font color='000000' size='4'><u>Options</u></font><br/>";

$text .= "<br>";

$text .= "<a href='admin_config.php'><font size='2'>Settings</font></a><br>";

$text .= "<br>";

$text .= "<a href='admin_new_donator.php'><font size='2'>Add New Donator</font></a><br>";
$text .= "<a href='admin_new_month.php'><font size='2'>Add New Month</font></a><br/>";
$text .= "<a href='admin_new_year.php'><font size='2'>Add New Year</font></a><br>";

$text .= "<br>";


$text .= "<a href='admin_edit_donator.php'><font size='2'>Edit Donator</font></a><br>";
$text .= "<a href='admin_edit_month.php'><font size='2'>Edit Month</font></a><br>";
$text .= "<a href='admin_edit_year.php'><font size='2'>Edit Year</font></a><br>";


$text .= "<br><br><br>";

$text .= "<a href='http://www.aacgc.com/SSGC/e107_plugins/faq/faq.php' target='_blank'><font size='1'>AACGC FAQs</font></a><br/>";

$text .= "<br>";

$text .= "<a href='http://www.aacgc.com/SSGC/e107_plugins/helpdesk3_menu/helpdesk.php' target='_blank'><font size='1'>AACGC HelpDesk</font></a><br/>";

$text .= "<br/>";



$ns -> tablerender($title, $text);

//-----------------------------------------------------------------------------------------------------------------------------------------








require_once(e_ADMIN."footer.php");
?>


