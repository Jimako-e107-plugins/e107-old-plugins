<?php
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "phonedir/languages/help/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "phonedir/languages/help/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "phonedir/languages/help/English.php");
}
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
}
$action = basename($_SERVER['PHP_SELF'], ".php");
$text = "<table width='97%' class='fborder'>";
if ($action == "admin_config")
{
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_16 . "</b></td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_2 . "</b><br />" . PDIR_HELP_3 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_4 . "</b><br />" . PDIR_HELP_5 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_6 . "</b><br />" . PDIR_HELP_7 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_8 . "</b><br />" . PDIR_HELP_9 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_10 . "</b><br />" . PDIR_HELP_11 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_12 . "</b><br />" . PDIR_HELP_13 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_14 . "</b><br />" . PDIR_HELP_15 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_150 . "</b><br />" . PDIR_HELP_151 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_152 . "</b><br />" . PDIR_HELP_153 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_154 . "</b><br />" . PDIR_HELP_155 . "</td></tr>";
}
if ($action == "admin_editcat")
{
    if (isset($_POST['submits']))
    {
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_20 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_21 . "</b><br />" . PDIR_HELP_22 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_23 . "</b><br />" . PDIR_HELP_24 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_25 . "</b><br />" . PDIR_HELP_26 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_27 . "</b><br />" . PDIR_HELP_28 . "</td></tr>";
    }
    else
    {
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_20 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'>" . PDIR_HELP_29 . "</td></tr>";
    }
}
if ($action == "admin_edituser")
{
    if (isset($_POST['submits']))
    {
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_30 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_31 . "</b><br />" . PDIR_HELP_32 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_33 . "</b><br />" . PDIR_HELP_34 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_35 . "</b><br />" . PDIR_HELP_36 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_37 . "</b><br />" . PDIR_HELP_38 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_39 . "</b><br />" . PDIR_HELP_40 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_51 . "</b><br />" . PDIR_HELP_52 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_49 . "</b><br />" . PDIR_HELP_50 . "</td></tr>";

        if ($pref['phonedir_usesite'] > 0)
        {
            $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_41 . "</b><br />" . PDIR_HELP_42 . "</td></tr>";
        }
        if ($pref['phonedir_usedept'] > 0)
        {
            $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_43 . "</b><br />" . PDIR_HELP_44 . "</td></tr>";
        }
        if ($pref['phonedir_usejob'] > 0)
        {
            $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_45 . "</b><br />" . PDIR_HELP_46 . "</td></tr>";
        }
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_53 . "</b><br />" . PDIR_HELP_54 . "</td></tr>";

        if ($pref['phonedir_useoffice'] > 0)
        {
            $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_47 . "</b><br />" . PDIR_HELP_48 . "</td></tr>";
        }
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_55 . "</b><br />" . PDIR_HELP_56 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_57 . "</b><br />" . PDIR_HELP_58 . "</td></tr>";
    }
    else
    {
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_30 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'>" . PDIR_HELP_59 . "</td></tr>";
    }
}
if ($action == "admin_editsite")
{
    if (isset($_POST['submits']))
    {
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_60 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_61 . "</b><br />" . PDIR_HELP_62 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_63 . "</b><br />" . PDIR_HELP_64 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_65 . "</b><br />" . PDIR_HELP_66 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_67 . "</b><br />" . PDIR_HELP_68 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_69 . "</b><br />" . PDIR_HELP_70 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_71 . "</b><br />" . PDIR_HELP_72 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_73 . "</b><br />" . PDIR_HELP_74 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_75 . "</b><br />" . PDIR_HELP_76 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_77 . "</b><br />" . PDIR_HELP_78 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_79 . "</b><br />" . PDIR_HELP_80 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_81 . "</b><br />" . PDIR_HELP_82 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_83 . "</b><br />" . PDIR_HELP_84 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_85 . "</b><br />" . PDIR_HELP_86 . "</td></tr>";
    }
    else
    {
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_60 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'>" . PDIR_HELP_87 . "</td></tr>";
    }
}
if ($action == "admin_editdept")
{
    if (isset($_POST['submits']))
    {
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_100 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_101 . "</b><br />" . PDIR_HELP_102 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_103 . "</b><br />" . PDIR_HELP_104 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_105 . "</b><br />" . PDIR_HELP_106 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_107 . "</b><br />" . PDIR_HELP_108 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_109 . "</b><br />" . PDIR_HELP_110 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_111 . "</b><br />" . PDIR_HELP_112 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_113 . "</b><br />" . PDIR_HELP_114 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_115 . "</b><br />" . PDIR_HELP_116 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_117 . "</b><br />" . PDIR_HELP_118 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_119 . "</b><br />" . PDIR_HELP_120 . "</td></tr>";
    }
    else
    {
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_100 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'>" . PDIR_HELP_121 . "</td></tr>";
    }
}
if ($action == "admin_editjobs")
{
    if (isset($_POST['submits']))
    {
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_130 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_131 . "</b><br />" . PDIR_HELP_132 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_133 . "</b><br />" . PDIR_HELP_134 . "</td></tr>";
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_135 . "</b><br />" . PDIR_HELP_136 . "</td></tr>";
    }
    else
    {
        $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_130 . "</b></td></tr>";
        $text .= "<tr><td class='forumheader3'>" . PDIR_HELP_137 . "</td></tr>";
    }
}
if ($action == "admin_catorder")
{
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_140 . "</b></td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_141 . "</b><br /><br />" . PDIR_HELP_142 . "<br /><br />";
    $text .= PDIR_HELP_143 . "<br /><br />" . PDIR_HELP_144 . "</td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_145 . "</b><br />" . PDIR_HELP_146 . "</td></tr>";
}
if ($action == "admin_imag")
{
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_160 . "</b></td></tr>";
    $text .= "<tr><td class='forumheader3'><b>" . PDIR_HELP_161 . "</b><br /><br />" . PDIR_HELP_162 . "</td></tr>";
}
$text .= "</table>";
$ns->tablerender(PDIR_HELP_1, $text);

?>