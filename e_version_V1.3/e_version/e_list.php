<?php
/*
+---------------------------------------------------------------+
|        e_Version for e107 v7xx - by Father Barry
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
include_lan(e_PLUGIN . "e_version/languages/" . e_LANGUAGE . ".php");
global $pref;
if(!isset($pref['plug_installed']['e_version']))
{
    return;
}
if (check_class($pref['eversion_read']))
{
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
        $qry = "eversion_date > " . $lvisit ;
    }
    else
    {
        $qry = "eversion_id > 0 " ;
    }

    $bullet = $this->getBullet($arr[6], $mode);

    $qry = "
	SELECT *
	FROM #eversion
	WHERE " . $qry . "
	ORDER BY eversion_date DESC LIMIT 0," . $arr[7];
    if (!$eclassf_items = $sql->db_Select_gen($qry,false))
    {
        $LIST_DATA = EVERSION_26;
    }
    else
    {
        while ($row = $sql->db_Fetch())
        {
            $evrsn_vern = EVERSION_7 . " " . $row['eversion_major'] . "." . $row['eversion_minor'] . "." . $row['eversion_beta'] . " " . ($row['eversion_beta'] > 0?"(beta)":"");
            $AUTHOR = $row['eversion_author'];
            $rowheading = $this->parse_heading($row['eversion_title'], $mode);
            $ICON = $bullet;
            $HEADING = "<a href='" . e_PLUGIN . "e_version/e_version.php?0.view." . $row['eversion_id'] . "'>" . $row['eversion_title'] . "</a> " . $evrsn_vern;
            $CATEGORY = "";
            $DATE = ($arr[5] ? ($row['eversion_date'] ? $this->getListDate($row['eversion_date'], $mode) : "") : "");
            $INFO = "";
            $LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
        }
    }
}

?>