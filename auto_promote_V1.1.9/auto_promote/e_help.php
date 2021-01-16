<?php
/*
+---------------------------------------------------------------+
|	Auto Promote Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2009
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
}
include_lan(e_PLUGIN . "auto_promote/languages/admin/" . e_LANGUAGE . ".php");

$aprom_acn = basename($_SERVER['PHP_SELF'], ".php");
$aprom_htext = "<table width='97%' class='fborder'>";
if ($aprom_acn == "admin_config")
{
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C02 . "</b></td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C03 . "</b><br />" . APROM_HELP_C04 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C05 . "</b><br />" . APROM_HELP_C06 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C07 . "</b><br />" . APROM_HELP_C08 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C09 . "</b><br />" . APROM_HELP_C10 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C11 . "</b><br />" . APROM_HELP_C12 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C13 . "</b><br />" . APROM_HELP_C14 . "</td></tr>";
}
if ($aprom_acn == "admin_criteria")
{
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C16 . "</b></td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C17 . "</b><br />" . APROM_HELP_C18 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C19 . "</b><br />" . APROM_HELP_C20 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C21 . "</b><br />" . APROM_HELP_C22 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C23 . "</b><br />" . APROM_HELP_C24 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C25 . "</b><br />" . APROM_HELP_C26 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C27 . "</b><br />" . APROM_HELP_C28 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C29 . "</b><br />" . APROM_HELP_C30 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C31 . "</b><br />" . APROM_HELP_C32 . "</td></tr>";
}
if ($aprom_acn == "admin_promote")
{
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C34 . "</b></td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C35 . "</b><br />" . APROM_HELP_C36 . "</td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C37 . "</b><br />" . APROM_HELP_C38 . "</td></tr>";
}
if ($aprom_acn == "admin_readme")
{
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C40 . "</b></td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C41 . "</b><br />" . APROM_HELP_C42 . "</td></tr>";
}
if ($aprom_acn == "admin_vupdate")
{
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C44 . "</b></td></tr>";
    $aprom_htext .= "<tr><td class='forumheader3'><b>" . APROM_HELP_C45 . "</b><br />" . APROM_HELP_C46 . "</td></tr>";
}
$aprom_htext .= "</table>";
$ns->tablerender(APROM_HELP_C01, $aprom_htext, 'aprom_help');
