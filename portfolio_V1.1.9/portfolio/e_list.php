<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
global $pref;
if (!$pref['plug_installed']['portfolio'])
{
    return;
}
require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
if (!is_object($portfolio_obj))
{
    $portfolio_obj = new portfolio;
}
$LIST_CAPTION = $arr[0];
$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");

$todayarray = getdate();
$current_day = $todayarray['mday'];
$current_month = $todayarray['mon'];
$current_year = $todayarray['year'];
$current = mktime(0, 0, 0, $current_month, $current_day, $current_year);

if ($mode == "new_page" || $mode == "new_menu")
{
    $lvisit = $this->getlvisit();
    $qry = " portfolio_person_created > " . $lvisit ;
}
else
{
    $qry = " portfolio_person_id > 0 " ;
}

$bullet = $this->getBullet($arr[6], $mode);

$qry = "
	SELECT portfolio_person_id,portfolio_person_name,portfolio_person_poster,portfolio_person_created
	FROM #portfolio_person
	WHERE " . $qry . "
	ORDER BY portfolio_person_created ASC LIMIT 0," . $arr[7];

if (!($eclassf_items = $sql->db_Select_gen($qry, false)) && !$portfolio_obj->portfolio_user)
{
    $LIST_DATA = PORTFOLIO_A2;
}
else
{
    while ($row = $sql->db_Fetch())
    {
        $tmp = explode(".", $row['portfolio_person_poster'], 2);
        if ($tmp[0] == "0")
        {
            $AUTHOR = $tmp[1];
        } elseif (is_numeric($tmp[0]) && $tmp[0] != "0")
        {
            $AUTHOR = (USER ? "<a href='" . e_BASE . "user.php?id." . $tmp[0] . "'>" . $tmp[1] . "</a>" : $tmp[1]);
        }
        else
        {
            $AUTHOR = "";
        }
        $rowheading = $this->parse_heading($tp->toHTML($row['portfolio_person_name'], false), $mode);
        $ICON = $bullet;
        $HEADING = "<a href='" . e_PLUGIN . "portfolio/portfolio.php?0.show." . $row['portfolio_person_id'] . "' title='" . $tp->toHTML($row['portfolio_person_name'], false) . "'>" . $rowheading . "</a>";
        $CATEGORY = "<a href='" . e_PLUGIN . "portfolio/portfolio.php' title='" . PORTFOLIO_A3 . "'>" . PORTFOLIO_A3 . "</a>";
        $DATE = ($arr[5] ? ($row['portfolio_person_created'] ? $this->getListDate($row['portfolio_person_created'], $mode) : "") : "");
        $INFO = "";
        $LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
    }
}

?>