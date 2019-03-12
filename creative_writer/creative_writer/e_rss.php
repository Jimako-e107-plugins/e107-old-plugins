<?php
// *
// e_rss for Creative Writer
// *
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
global $pref,$tp;
// ##### e_rss.php ---------------------------------------------
// get all the categories
$feed['name'] = CWRITER_A1;
$feed['url'] = 'creative_writer';
$feed['topic_id'] = '';
$feed['path'] = 'creative_writer';
$feed['text'] = CWRITER_A78 ;
$feed['class'] = '0';
$feed['limit'] = '9';
$eplug_rss_feed[] = $feed;

// ##### --------------------------------------------------------
// ##### create rss data, return as array $eplug_rss_data -------
$rss = array();


if (check_class($pref['cwriter_read']))
{
// get bugs which are visible to this class
    $cwriter_args = "
		select *
		from #cw_chapters as a
		left join #cw_book as b on cw_chapter_book=cw_book_id
		left join #cw_category as c on cw_category_id=cw_book_category
		left join #cw_genre as g on cw_book_genre=cw_genre_id
		where find_in_set(cw_category_class,'" . USERCLASS_LIST . "')
		and cw_book_visible>0
		and cw_book_approved > 0
		order by cw_book_lastupdate desc
		LIMIT 0," . $this->limit;

    if ($items = $sql->db_Select_gen($cwriter_args))
    {
        $i = 0;
        while ($rowrss = $sql->db_Fetch())
        {
            $tmp = explode(".", $rowrss['cw_book_author']);
            $rss[$i]['author'] = "" . $tmp[1] ;
            $rss[$i]['author_email'] = '';
            $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "creative_writer/cwriter.php?0.chapter." .$rowrss['cw_chapter_book'].".". $rowrss['cw_chapter_id'] ;
            $rss[$i]['linkid'] = $tp->toRss($rowrss['cw_chapter_id'],true);
            $rss[$i]['title'] = $tp->toRss($rowrss['cw_chapter_title'],true);
            $rss[$i]['description'] = "";

                $rss[$i]['category_name'] = $tp->toRss($rowrss['cw_category_name'],true) ;
                $rss[$i]['category_link'] = $e107->base_path . $PLUGINS_DIRECTORY . "creative_writer/cwriter.php?0.precis." . $rowrss['cw_category_id']   ;

            $rss[$i]['datestamp'] = $rowrss['cw_chapter_lastupdate'];
            $rss[$i]['enc_url'] = "";
            $rss[$i]['enc_leng'] = "";
            $rss[$i]['enc_type'] = "";
            $i++;
        }
    }
    else
    {
        $rss[$i]['author'] = "" . $tmp[1];
        $rss[$i]['author_email'] = '';
        $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "creative_writer/cwriter.php";
        $rss[$i]['linkid'] = '';
        $rss[$i]['title'] = CWRITER_A77;
        $rss[$i]['description'] = "";
        $rss[$i]['category_name'] = "";
        $rss[$i]['category_link'] = '';
        $rss[$i]['datestamp'] = "";
        $rss[$i]['enc_url'] = "";
        $rss[$i]['enc_leng'] = "";
        $rss[$i]['enc_type'] = "";
    }
}
else
{
    $rss[$i]['author'] = "" . $tmp[1];
    $rss[$i]['author_email'] = '';
    $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "creative_writer/cwriter.php";
    $rss[$i]['linkid'] = '';
    $rss[$i]['title'] = CWRITER_A77;
    $rss[$i]['description'] = "";
    $rss[$i]['category_name'] = "";
    $rss[$i]['category_link'] = '';
    $rss[$i]['datestamp'] = "";
    $rss[$i]['enc_url'] = "";
    $rss[$i]['enc_leng'] = "";
    $rss[$i]['enc_type'] = "";
}

$eplug_rss_data[] = $rss;

?>