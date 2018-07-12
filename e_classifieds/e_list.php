<?php
if (!defined('e107_INIT')) { exit; }
if (!$eclassif_install = $sql->db_Select("plugin", "*", "plugin_path = 'e_Classifieds' AND plugin_installflag = '1' "))
{
    return;
}
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/English.php");
}
$LIST_CAPTION = $arr[0];
$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");

#$todayarray = getdate();
#$current_day = $todayarray['mday'];
#$current_month = $todayarray['mon'];
#$current_year = $todayarray['year'];
$current = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));

if ($mode == "new_page" || $mode == "new_menu")
{
    $lvisit = $this->getlvisit();
    $qry = " (eclassf_cpdate = 0  or eclassf_cpdate is null or eclassf_cpdate>$current) ".
($pref['eclassf_approval']==1?" and eclassf_capproved > 0":"" )." and eclassf_ccdate>" . $lvisit ;
}
else
{
    $qry = "(eclassf_cpdate = 0  or eclassf_cpdate is null or eclassf_cpdate>$current) and eclassf_cid>0 ".
($pref['eclassf_approval']==1?" and eclassf_capproved > 0":"" )." ";
}

$bullet = $this->getBullet($arr[6], $mode);

$qry = "
	SELECT r.*, c.eclassf_subname,c.eclassf_subid,c.eclassf_subname,d.eclassf_catid,d.eclassf_catname
	FROM #eclassf_ads AS r
	LEFT JOIN #eclassf_subcats AS c ON r.eclassf_ccat = c.eclassf_subid
    LEFT JOIN #eclassf_cats as d on d.eclassf_catid=c.eclassf_ccatid
	WHERE " . $qry . "
	ORDER BY r.eclassf_last ASC LIMIT 0," . $arr[7];
if (!$eclassf_items = $sql->db_Select_gen($qry))
{
    $LIST_DATA = ECLASSF_76;
}
else
{
    while ($row = $sql->db_Fetch())
    {
        $tmp = explode(".", $row['eclassf_cuser']);
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

        $rowheading = $this->parse_heading($row['eclassf_cname'], $mode);
        $ICON = $bullet;
        $HEADING = "<a href='" . e_PLUGIN . "e_classifieds/classifieds.php?0.item." . $row['eclassf_catid'] . "." . $row['eclassf_subid'] . "." . $row['eclassf_cid'] . "' title='" . $row['eclassf_cname'] . "'>" . $rowheading . "</a>";
        $CATEGORY = $row['eclassf_catname']." - ".$row['eclassf_subname'];
        $DATE = ($arr[5] ? ($row['eclassf_ccdate'] ? $this->getListDate($row['eclassf_ccdate'], $mode) : "") : "");
        $INFO = "";
        $LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
    }
}

?>