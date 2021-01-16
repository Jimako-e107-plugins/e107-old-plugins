<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) {
    exit;
}
global $pref;
if (!$pref['plug_installed']['cpage']) {
    return;
}

global $cpage_obj,$PLUGINS_DIRECTORY;
if (!is_object($cpage_obj)) {
    require_once("includes/cpage_class.php");
    $cpage_obj = new cpage;
}
$LIST_CAPTION = $arr[0];
$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");

$todayarray = getdate();
$current_day = $todayarray['mday'];
$current_month = $todayarray['mon'];
$current_year = $todayarray['year'];
$current = mktime(0, 0, 0, $current_month, $current_day, $current_year);

if ($mode == "new_page" || $mode == "new_menu") {
    $lvisit = $this->getlvisit();
    $qry = "find_in_set(cpage_class,'" . USERCLASS_LIST . "') and  cpage_datestamp >" . $lvisit ;
} else {
    $qry = "find_in_set(cpage_class,'" . USERCLASS_LIST . "') and  cpage_id>0 " ;
}

$bullet = $this->getBullet($arr[6], $mode);

$qry = "select * from #cpage_page left join #user on substring_index(cpage_author,'.',1) = user_id
	WHERE " . $qry . "
	ORDER BY cpage_datestamp ASC LIMIT 0," . $arr[7];
if (!$eclassf_items = $sql->db_Select_gen($qry, false)) {
    $LIST_DATA = CPAGE_MENU_MV07;
} else {
    while ($row = $sql->db_Fetch()) {
        if ($row['cpage_showauthor_flag'] == 1) {
            $tmp = explode(".", $row['cpage_author'], 2);
            if (!empty($row['user_name'])) {
                $uname = $row['user_name'];
            } else {
                if ($tmp[0] == "0") {
                    $uname = '';
                } else {
                    $uname = $tmp[1];
                }
            }
            $AUTHOR = (USER ? "<a href='" . e_BASE . "user.php?id." . $tmp[0] . "'>" . $uname . "</a>" : $uname);
        } else {
            $AUTHOR = '';
        }

        $rowheading = $this->parse_heading($tp->toHTML($row['cpage_title'], false), $mode);
        $ICON = $bullet;
        $HEADING = "<a href='" . SITEURL.$PLUGINS_DIRECTORY . "cpage/".$cpage_obj->make_url($row['cpage_link'], $row['cpage_id'] ,0,$row['cpage_title'])."'>" . $rowheading . "</a>";
        $CATEGORY = '';
        if ($row['cpage_showdate_flag'] == 1) {
            $DATE = $this->getListDate($row['cpage_datestamp'], $mode);
        }else {
            $DATE = '';
        }
        $INFO = "";
        $LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
    }
}

?>