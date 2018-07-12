<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
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
global $pref,$eclassf_obj,  $ECLASSF_PREF;
if (!isset($pref['plug_installed']['e_classifieds']))
{
    return;
}
e107_require_once(e_PLUGIN.'e_classifieds/includes/eclassifieds_class.php');

if (!is_object($eclassf_obj))
{
    $eclassf_obj = new classifieds;
}
$LIST_CAPTION = $arr[0];
$LIST_DISPLAYSTYLE = ($arr[2] ? '' : 'none');

$current = mktime(0, 0, 0, date('n', time()), date('j', time()), date('Y', time()));
if ($mode == 'new_page' || $mode == 'new_menu')
{
    $lvisit = $this->getlvisit();
    $qry = ' (eclassf_expires = 0 or eclassf_expires>'.time().') ' .
    ($ECLASSF_PREF['eclassf_approval'] == 1?' and eclassf_approved > 0':'') . ' and elcassf_posted>' . $lvisit ;
}
else
{
    $qry = '(elcassf_posted = 0  or elcassf_posted is null or elcassf_posted>'.$current.') and eclassf_id>0 ' .
    ($ECLASSF_PREF['eclassf_approval'] == 1?' and eclassf_approved > 0':'') . ' ';
}

$bullet = $this->getBullet($arr[6], $mode);
$qry = "
	SELECT r.*, c.eclassf_subname,c.eclassf_subid,c.eclassf_subname,d.eclassf_catid,d.eclassf_catname
	FROM #eclassf_ads AS r
	LEFT JOIN #eclassf_subcats AS c ON r.eclassf_category = c.eclassf_subid
    LEFT JOIN #eclassf_cats as d on d.eclassf_catid=c.eclassf_categoryid
	WHERE " . $qry . " and find_in_set(eclassf_catclass,'".USERCLASS_LIST."')
	ORDER BY r.elcassf_posted ASC LIMIT 0," . $arr[7];
if (!$eclassf_items = $sql->db_Select_gen($qry,false))
{
    $LIST_DATA = ECLASSF_76;
}
else
{
    while ($row = $sql->db_Fetch())
    {
        $tmp = explode('.', $row['eclassf_user']);
        if ($tmp[0] == '0')
        {
            $AUTHOR = $tmp[1];
        } elseif (is_numeric($tmp[0]) && $tmp[0] != "0")
        {
            $AUTHOR = (USER ? "<a href='" . e_BASE . "user.php?id." . $tmp[0] . "'>" . $tmp[1] . "</a>" : $tmp[1]);
        }
        else
        {
            $AUTHOR = '';
        }

        $rowheading = $this->parse_heading($row['eclassf_name'], $mode);
        $ICON = $bullet;
        $HEADING = "<a href='" . e_PLUGIN . "e_classifieds/classifieds.php?0.item." . $row['eclassf_catid'] . '.' . $row['eclassf_subid'] . "." . $row['eclassf_id'] . "' title='" . $row['eclassf_id'] . "'>" . $rowheading . "</a>";
        $CATEGORY = $row['eclassf_catname'] . " - " . $row['eclassf_subname'];
        $DATE = ($arr[5] ? ($row['elcassf_posted'] ? $this->getListDate($row['elcassf_posted'], $mode) : '') : '');
        $INFO = '';
        $LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
    }
}

?>