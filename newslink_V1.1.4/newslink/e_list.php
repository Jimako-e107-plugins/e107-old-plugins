<?php
global $pref;
if (!isset($pref['plug_installed']['newslink']))
{
    print "NI";
    return;
}
require_once(e_PLUGIN . "newslink/includes/newslink_class.php");

$LIST_CAPTION = $arr[0];
$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");

if ($mode == "new_page" || $mode == "new_menu")
{
    $lvisit = $this->getlvisit();
    $qry = " newslink_posted>" . $lvisit ;
}
else
{
    $qry = "newslink_id>0";
}

$bullet = $this->getBullet($arr[6], $mode);
$qry = "
	SELECT r.*, c.newslink_category_name
	FROM #newslink_newslink AS r
	LEFT JOIN #newslink_category AS c ON r.newslink_category = c.newslink_category_id
	WHERE " . $qry . " and find_in_set(newslink_category_read,'" . USERCLASS_LIST . "') and newslink_approved>0
	ORDER BY r.newslink_posted DESC LIMIT 0," . $arr[7];

if (!$newslink_items = $sql->db_Select_gen($qry))
{
    $LIST_DATA = NEWSLINK_92;
}
else
{
    while ($newslink_row = $sql->db_Fetch())
    {
        extract($newslink_row);
        $newslink_tmp = explode(".", $newslink_row['newslink_author'], 2);
        if ($newslink_tmp[0] == "0")
        {
            $AUTHOR = $newslink_tmp[1];
        } elseif (is_numeric($newslink_tmp[0]) && $newslink_tmp[0] != "0")
        {
            $AUTHOR = (USER ? "<a href='" . e_BASE . "user.php?id." . $newslink_tmp[0] . "'>" . $newslink_tmp[1] . "</a>" : $newslink_tmp[1]);
        }
        else
        {
            $AUTHOR = "";
        }

        $newslink_rowheading = $this->parse_heading($newslink_row['newslink_name'], $mode);
        $ICON = $bullet;
        if (substr($newslink_link, 0, 4) != "http")
        {
            $newslink_link = "http://" . $newslink_link;
        }
        $newslink_linkurl = "<a href='" . $tp->toFORM($newslink_link) . "' rel='external'>" . $tp->toFORM($newslink_name) . "</a>";

        $HEADING = $newslink_linkurl;
        $CATEGORY = $newslink_row['newslink_category_name'];
        $DATE = ($arr[5] ? $this->getListDate($newslink_row['newslink_posted'], $mode) : "");
        $INFO = "";
        $LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
    }
}

?>