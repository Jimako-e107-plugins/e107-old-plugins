<?php
if (!defined('e107_INIT'))
{
    exit;
}
global $pref;
if (!$pref['plug_installed']['faq'])
{
    return;
}
require_once("includes/faq_class.php");
global $faq_obj;
if (!is_object($faq_obj))
{
    $faq_obj = new FAQ;
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
    $qry = "find_in_set(faq_info_class,'" . USERCLASS_LIST . "') and faq_approved > 0 and faq_datestamp>" . $lvisit ;
}
else
{
    $qry = "find_in_set(faq_info_class,'" . USERCLASS_LIST . "') and faq_approved > 0 and faq_id>0 " ;
}

$bullet = $this->getBullet($arr[6], $mode);

$qry = "
	SELECT r.*, c.faq_info_title,c.faq_info_id
	FROM #faq AS r
	LEFT JOIN #faq_info AS c ON r.faq_parent = c.faq_info_id
	WHERE " . $qry . "
	ORDER BY r.faq_datestamp ASC LIMIT 0," . $arr[7];
if (!$eclassf_items = $sql->db_Select_gen($qry))
{
    $LIST_DATA = FAQLAN_95;
}
else
{
    while ($row = $sql->db_Fetch())
    {
        $tmp = explode(".", $row['faq_author'], 2);
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
        $rowheading = $this->parse_heading($tp->toHTML($row['faq_question'], false), $mode);
        $ICON = $bullet;
        $HEADING = "<a href='" . e_PLUGIN . "faq/faq.php?0.cat." . $row['faq_info_id'] . "." . $row['faq_id'] . "' title='" . $tp->toHTML($row['faq_question'], false) . "'>" . $rowheading . "</a>";
        $CATEGORY = $row['faq_info_title'];
        $DATE = ($arr[5] ? ($row['faq_datestamp'] ? $this->getListDate($row['faq_datestamp'], $mode) : "") : "");
        $INFO = "";
        $LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
    }
}

?>