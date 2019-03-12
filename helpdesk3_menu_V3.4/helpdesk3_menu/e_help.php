<?php
include_lan(e_PLUGIN . "helpdesk3_menu/languages/admin/" . e_LANGUAGE . "_helpdesk_admin.php");

$action = basename($_SERVER['PHP_SELF'], ".php");
$text = "<table width='100%' class='fborder'>";
if ($action == "admin_config")
{
    $text .= "<tr><td class='forumheader3'><b>" . HDU_A401 . "</b></td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . HDU_A402 . "</b><br />" . HDU_A403 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . HDU_A404 . "</b><br />" . HDU_A405 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . HDU_A406 . "</b><br />" . HDU_A407 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . HDU_A408 . "</b><br />" . HDU_A409 . "</td></tr>";
}
if ($action == "admin_res")
{
    if (isset($_POST['submits']))
    {
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A440 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A441 . "</b><br />" . HDU_A442 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A443 . "</b><br />" . HDU_A444 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A446 . "</b><br />" . HDU_A447 . "</td></tr>";
    }
    else
    {
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A440 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'>" . HDU_A445 . "</td></tr>";
    }
}
if ($action == "admin_fixes")
{
    if (isset($_POST['submits']))
    {
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A430 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A431 . "</b><br />" . HDU_A432 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A433 . "</b><br />" . HDU_A434 . "</td></tr>";
    }
    else
    {
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A430 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'>" . HDU_A435 . "</td></tr>";
    }
}

if ($action == "admin_cat")
{
    if (isset($_POST['submits']))
    {
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A420 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A421 . "</b><br />" . HDU_A422 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A423 . "</b><br />" . HDU_A424 . "</td></tr>";
    }
    else
    {
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A420 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'>" . HDU_A425 . "</td></tr>";
    }
}
if ($action == "admin_desk")
{
    if (isset($_POST['submits']))
    {
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A460 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A461 . "</b><br />" . HDU_A462 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A463 . "</b><br />" . HDU_A464 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A466 . "</b><br />" . HDU_A467 . "</td></tr>";
    }
    else
    {
        $text .= "<tr><td class='forumheader3'><b>" . HDU_A460 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'>" . HDU_A465 . "</td></tr>";
    }
}
if ($action == "admin_mail")
{
    $text .= "<tr><td class='forumheader3'><b>" . HDU_A450 . "</b></td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . HDU_A451 . "</b><br />" . HDU_A452 . "</td></tr>";
}
if ($action == "admin_colour")
{
    $text .= "<tr><td class='forumheader3'><b>" . HDU_A456 . "</b></td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . HDU_A457 . "</b><br />" . HDU_A458 . "</td></tr>";
}
if ($action == "admin_readme")
{
    $text .= "<tr><td class='forumheader3'>Read Me&nbsp;</td></tr>";
    // $text .= "<tr><td class='forumheader3'>&nbsp;</td></tr>";
}
$text .= "</table>";
$ns->tablerender(HDU_A400, $text);

?>