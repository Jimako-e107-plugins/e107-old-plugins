<?php

if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/help/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/help/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/help/English.php");
}


$eclassf_action = basename($_SERVER['PHP_SELF'], ".php");

$eclassf_text = "<table width='100%' class='fborder'>";
if ($eclassf_action=="admin_config?delparent") {
      $eclassf_text .= "<tr><td class='forumheader3'><b>" . FAQ_H17 . "</b></td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . FAQ_H72 . "</b><br />" . FAQ_H73 . "</td></tr>";

}
if ($eclassf_action == "admin_config")
{
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H2 . "</b></td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H3 . "</b><br />" . ECLASSF_H4 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H5 . "</b><br />" . ECLASSF_H6 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H7 . "</b><br />" . ECLASSF_H8 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H9 . "</b><br />" . ECLASSF_H10 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H11 . "</b><br />" . ECLASSF_H12 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H13 . "</b><br />" . ECLASSF_H14 . "</td></tr>";
$eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H29 . "</b><br />" . ECLASSF_H29a . "</td></tr>";
$eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H29b . "</b><br />" . ECLASSF_H29c . "</td></tr>";

    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H15 . "</b><br />" . ECLASSF_H16 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H17 . "</b><br />" . ECLASSF_H18 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H19 . "</b><br />" . ECLASSF_H20 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H21 . "</b><br />" . ECLASSF_H22 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H27 . "</b><br />" . ECLASSF_H28 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H25 . "</b><br />" . ECLASSF_H26 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H23 . "</b><br />" . ECLASSF_H24 . "</td></tr>";

    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H81 . "</b><br />" . ECLASSF_H82 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H83 . "</b><br />" . ECLASSF_H84 . "</td></tr>";

}

if ($eclassf_action == "admin_cat")
{
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H30 . "</b></td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H31 . "</b><br />" . ECLASSF_H32 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H33 . "</b><br />" . ECLASSF_H34 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H35 . "</b><br />" . ECLASSF_H36 . "</td></tr>";
}

if ($eclassf_action == "admin_sub")
{
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H40 . "</b></td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H41 . "</b><br />" . ECLASSF_H42 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H43 . "</b><br />" . ECLASSF_H44 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H45 . "</b><br />" . ECLASSF_H46 . "</td></tr>";
}

if ($eclassf_action == "admin_ad")
{
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H50 . "</b></td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H51 . "</b><br />" . ECLASSF_H52 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H53 . "</b><br />" . ECLASSF_H54 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H55 . "</b><br />" . ECLASSF_H56 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H57 . "</b><br />" . ECLASSF_H58 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H59 . "</b><br />" . ECLASSF_H60 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H61 . "</b><br />" . ECLASSF_H62 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H63 . "</b><br />" . ECLASSF_H64 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H65 . "</b><br />" . ECLASSF_H66 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H67 . "</b><br />" . ECLASSF_H68 . "</td></tr>";

}
if ($eclassf_action == "admin_submit")
{
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H70 . "</b></td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H71 . "</b><br />" . ECLASSF_H72 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H73 . "</b><br />" . ECLASSF_H74 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H75 . "</b><br />" . ECLASSF_H76 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H77 . "</b><br />" . ECLASSF_H78 . "</td></tr>";

}
if ($eclassf_action == "admin_purge")
{
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H90 . "</b></td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H91 . "</b><br />" . ECLASSF_H92 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H93 . "</b><br />" . ECLASSF_H94 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H95 . "</b><br />" . ECLASSF_H96 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H97 . "</b><br />" . ECLASSF_H98 . "</td></tr>";

}
if ($eclassf_action == "admin_imag")
{
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H100 . "</b></td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H101 . "</b><br />" . ECLASSF_H102 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H103 . "</b><br />" . ECLASSF_H104 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader3'><b>" . ECLASSF_H105 . "</b><br />" . ECLASSF_H106 . "</td></tr>";

}
$eclassf_text .= "</table>";
$ns->tablerender(ECLASSF_H1, $eclassf_text);

?>