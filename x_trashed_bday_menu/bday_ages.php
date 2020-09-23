<?php
/*
+---------------------------------------------------------------+
|        Birthday Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
// ***************************************************************
// *
// *		Plugin		:	Birthday Menu (e107 v7)
// *
// ***************************************************************
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "bday_menu/languages/" . e_LANGUAGE . "_birthday_mnu.php");
require_once(e_HANDLER . "userclass_class.php");
require_once(HEADERF);
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%;");
}
if (!check_class($pref['bday_demographic']))
{
    $bday_atext = BDAY_LAN_10;
}
else
{
    if (file_exists(THEME . 'bday_age_template.php'))
    {
        define('BDAY_ATEMPLATE', THEME . 'bday_age_template.php');
    }
    else
    {
        define('BDAY_ATEMPLATE', e_PLUGIN . 'bday_menu/templates/bday_age_template.php');
    }
    require_once(BDAY_ATEMPLATE);
    if (!isset($bday_shortcodes))
    {
        require_once(e_PLUGIN . 'bday_menu/includes/bday_shortcodes.php');
    }
    $sql->db_Select_gen('select count(user_extended_id) as bday_noentry  from #user_extended left join #user  on user_extended_id = user_id where user_birthday="0000-00-00" and user_id>0', false);
    extract($sql->db_Fetch());
    // print $bday_noentry;
    // create an array of age ranges
    $bday_result = array_fill(0, 12, 0);
    $sql->db_Select_gen("SELECT
left(right(concat('00',extract(YEAR FROM from_days(datediff(curdate(), user_birthday) ) ) ),2),1) AS age,
count(extract(YEAR FROM from_days(datediff(curdate(), user_birthday)))) AS total_age
FROM #user_extended left join #user on user_extended_id = user_id where user_id>0 GROUP BY age ;", false);
    while ($bday_row = $sql->db_Fetch())
    {
        if (!is_null($bday_row['age']))
        {
            $bday_result[$bday_row['age']] = $bday_row['total_age'];
        }
    }
    // print_a($bday_result);
    $bday_total = array_sum($bday_result);
    // print $bday_total;
    $bday_atext .= $tp->parsetemplate($BDAY_MENU_A_HEADER, true, $bday_shortcodes);

    foreach($bday_result as $key => $value)
    {
        $bday_anal = intval(($value * 10) / $bday_total);
        $bday_percent = intval(($value * 100) / $bday_total);
        $bday_range = $key . "0 - " . ($key) . "9";
        $bday_total_range = $value;
        $bday_bar = "<img src='" . e_PLUGIN . "bday_menu/images/box{$bday_anal}.png' style='border:0px;' alt='{$bday_percent}%' title='{$bday_percent}%' />";

        $bday_atext .= $tp->parsetemplate($BDAY_MENU_A_DETAIL, true, $bday_shortcodes);
    }

    $bday_atext .= $tp->parsetemplate($BDAY_MENU_A_FOOTER, true, $bday_shortcodes);
}

$ns->tablerender(BDAY_LAN_11, $bday_atext, 'bday_age');
require_once(FOOTERF);
