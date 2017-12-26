<?php
/*
+---------------------------------------------------------------+
|     /help.php
|     For the FAQ Plugin
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "faq/languages/help/" . e_LANGUAGE . ".php");
$faq_qry = explode(".", e_QUERY);
$faq_qry = "?" . $faq_qry[0];
$faq_haction = basename($_SERVER['PHP_SELF'], ".php") . $faq_qry;
// print $faq_action;
$faq_text = "<table width='100%' class='fborder'>";
switch ($faq_haction)
{
    case "admin_config?delparent" :
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H17 . "</b></td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H72 . "</b><br />" . FAQ_H73 . "</td></tr>";
        break;
    case "admin_config.php?mvdn.category" :
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H124 . "</b></td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H124 . "</b><br />" . FAQ_H125 . "</td></tr>";
        break;
    case "admin_config.php?edit.entries?" :
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H124 . "</b></td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H124 . "</b><br />" . FAQ_H125 . "</td></tr>";
        break;
    case "admin_config?" :
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H17 . "</b></td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H18 . "</b><br />" . FAQ_H19 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H20 . "</b><br />" . FAQ_H21 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H22 . "</b><br />" . FAQ_H23 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H24 . "</b><br />" . FAQ_H25 . "</td></tr>";
        break;
    case "admin_config?info" :
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H26 . "</b></td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H27 . "</b><br />" . FAQ_H28 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H29 . "</b><br />" . FAQ_H30 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H31 . "</b><br />" . FAQ_H32 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H33 . "</b><br />" . FAQ_H34 . "</td></tr>";
        break;
    case "admin_config?edit" :
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H39 . "</b></td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H40 . "</b><br />" . FAQ_H41 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H42 . "</b><br />" . FAQ_H43 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H44 . "</b><br />" . FAQ_H45 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H46 . "</b><br />" . FAQ_H47 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H48 . "</b><br />" . FAQ_H49 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H114 . "</b><br />" . FAQ_H115 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H116 . "</b><br />" . FAQ_H117 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H118 . "</b><br />" . FAQ_H119 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H120 . "</b><br />" . FAQ_H121 . "</td></tr>";
        break;
    case "admin_config?sub" :
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H58 . "</b></td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H50 . "</b><br />" . FAQ_H51 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H52 . "</b><br />" . FAQ_H53 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H54 . "</b><br />" . FAQ_H55 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H56 . "</b><br />" . FAQ_H57 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H102 . "</b><br />" . FAQ_H103 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H104 . "</b><br />" . FAQ_H105 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H106 . "</b><br />" . FAQ_H107 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H108 . "</b><br />" . FAQ_H109 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H110 . "</b><br />" . FAQ_H111 . "</td></tr>";
        break;
    case "admin_config?add" :
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H59 . "</b></td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H60 . "</b><br />" . FAQ_H61 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H62 . "</b><br />" . FAQ_H63 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H64 . "</b><br />" . FAQ_H65 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H66 . "</b><br />" . FAQ_H67 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H112 . "</b><br />" . FAQ_H113 . "</td></tr>";
        break;
    case "admin_settings?" :
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H1 . "</b></td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H92 . "</b><br />" . FAQ_H93 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H68 . "</b><br />" . FAQ_H69 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H2 . "</b><br />" . FAQ_H3 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H4 . "</b><br />" . FAQ_H5 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H6 . "</b><br />" . FAQ_H7 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H8 . "</b><br />" . FAQ_H9 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H80 . "</b><br />" . FAQ_H81 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H96 . "</b><br />" . FAQ_H97 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H94 . "</b><br />" . FAQ_H95 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H70 . "</b><br />" . FAQ_H71 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H98 . "</b><br />" . FAQ_H99 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H84 . "</b><br />" . FAQ_H85 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H82 . "</b><br />" . FAQ_H83 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H88 . "</b><br />" . FAQ_H89 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H90 . "</b><br />" . FAQ_H91 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H78 . "</b><br />" . FAQ_H79 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H74 . "</b><br />" . FAQ_H75 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H76 . "</b><br />" . FAQ_H77 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H100 . "</b><br />" . FAQ_H101 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H86 . "</b><br />" . FAQ_H87 . "</td></tr>";
        break;
    case "admin_approve?" :

        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H11 . "</b></td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H12 . "</b><br />" . FAQ_H13 . "</td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H14 . "</b><br />" . FAQ_H15 . "</td></tr>";
        break;
    case "admin_readme?" :
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H126 . "</b></td></tr>";
        $faq_text .= "<tr><td class='forumheader3'><b>" . FAQ_H126 . "</b><br />" . FAQ_H127 . "</td></tr>";
        break;
    default:
     $faq_text .= "<tr><td class='forumheader3'><b>&nbsp;</b></td></tr>";
}
$faq_text .= "</table>";
$ns->tablerender(FAQ_H10, $faq_text);
?>