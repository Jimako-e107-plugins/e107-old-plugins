<?php
if (!defined('e107_INIT'))
{
    exit;
}
if (!$cwriter_install = e107::getDB()->db_Select("plugin", "*", "plugin_path = 'creative_writer' AND plugin_installflag = '1' "))
{
    return;
}

$LIST_CAPTION = $arr[0];
$LIST_DISPLAYSTYLE = ($arr[2] ? "" : "none");

if ($mode == "new_page" || $mode == "new_menu")
{
    $lvisit = $this->getlvisit();
    $qry = " cw_book_approved = 1  and cw_book_visible=1  and cw_chapter_lastupdate>" . $lvisit ;
}
else
{
    $qry = "cw_book_approved = 1  and cw_book_visible=1 ";
}

$bullet = $this->getBullet($arr[6], $mode);
if (check_class($pref['cwriter_read']))
{
    $qry = "
	SELECT *
	FROM #cw_chapters
	left join #cw_book on cw_chapter_book=cw_book_id
	LEFT JOIN #cw_category  ON cw_category_id=cw_book_category
    LEFT JOIN #cw_genre on cw_genre_id=cw_book_genre
	WHERE " . $qry . "
	ORDER BY cw_chapter_lastupdate ASC LIMIT 0," . $arr[7];
    if (!$cwriter_items = $sql->db_Select_gen($qry, false))
    {
        $LIST_DATA = CWRITER_A75;
    }
    else
    {
        while ($row = $sql->db_Fetch())
        {
            $tmp = explode(".", $row['cw_book_author']);
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

            $rowheading = $this->parse_heading($row['cw_chapter_title'] . " (" . $row['cw_chapter_number'] . ")", $mode);
            $ICON = $bullet;
            $HEADING = "<a href='" . e_PLUGIN . "creative_writer/cwriter.php?0.chapter." . $row['cw_book_id'] . "." . $row['cw_chapter_id'] . "' title='" . $row['cw_chapter_title'] . "'>" . $rowheading . "</a>";
            $CATEGORY = CWRITER_A76 . ":" . $row['cw_book_title'] . " - " . $row['cw_category_name'] . " - " . $row['cw_genre_name'];
            $DATE = ($arr[5] ? ($row['cw_book_lastupdate'] ? $this->getListDate($row['cw_book_lastupdate'], $mode) : "") : "");
            $INFO = "";
            $LIST_DATA[$mode][] = array($ICON, $HEADING, $AUTHOR, $CATEGORY, $DATE, $INFO);
        }
    }
}

?>