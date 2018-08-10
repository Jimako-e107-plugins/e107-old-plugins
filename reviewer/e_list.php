<?php
/*
+---------------------------------------------------------------+
|        Reviewer for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
global $pref;
if (!isset($pref['plug_installed']['reviewer']))
{
    return;
}
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");

if (!is_object($reviewer_obj))
{
    e107_require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
    $reviewer_obj = new reviewer;
}

$LIST_CAPTION = $arr[0];
$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");

if ($mode == "new_page" || $mode == "new_menu")
{
    $lvisit = $this->getlvisit();
    $qry = " reviewer_reviewer_posted>" . $lvisit ;
}
else
{
    $qry = "reviewer_reviewer_id > 0";
}

$bullet = $this->getBullet($arr[6], $mode);
$qry = "
	SELECT *
	FROM #reviewer_reviewer AS r
	LEFT JOIN #reviewer_items AS c ON r.reviewer_reviewer_itemid = c.reviewer_items_id
	WHERE " . $qry . " and reviewer_items_approved > 0
	ORDER BY r.reviewer_reviewer_posted DESC LIMIT 0," . $arr[7];

if (!$reviewer_items = $sql->db_Select_gen($qry))
{
    $LIST_DATA = REVIEWER_LIST01;
}
else
{
    while ($reviewer_row = $sql->db_Fetch())
    {
        $reviewer_tmp = explode(".", $reviewer_row['reviewer_reviewer_postername']);
        if ($reviewer_tmp[0] == "0")
        {
            $AUTHOR = $reviewer_tmp[1];
        } elseif (is_numeric($reviewer_tmp[0]) && $reviewer_tmp[0] != "0")
        {
            $AUTHOR = (USER ? "<a href='" . e_BASE . "user.php?id." . $reviewer_tmp[0] . "'>" . $tp->toHTML($reviewer_tmp[1], false) . "</a>" : $reviewer_tmp[1]);
        }
        else
        {
            $AUTHOR = "";
        }

        $reviewer_rowheading = $this->parse_heading($tp->toHTML($reviewer_row['reviewer_reviewer_review'], false), $mode);
        $ICON = $bullet;
        $HEADING = "<a href='" . e_PLUGIN . "reviewer/reviewer.php?0.view." . $reviewer_row['reviewer_reviewer_id'] . "' title='" . $tp->html_truncate($tp->toHTML($reviewer_row['reviewer_reviewer_review']),20,'') . "'>" . $reviewer_rowheading . "</a>";
        $CATEGORY = $tp->toHTML($reviewer_row['reviewer_items_name'], false);
        $DATE = ($arr[5] ? $this->getListDate($reviewer_row['reviewer_reviewer_posted'], $mode) : "");
        $INFO = "";
        $LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
    }
}

?>