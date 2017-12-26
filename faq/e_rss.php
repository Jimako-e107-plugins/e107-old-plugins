<?php

if (!defined('e107_INIT'))
{
    exit;
}

require_once(e_PLUGIN . "faq/includes/faq_class.php");
if (!is_object($faq_obj))
{
    $faq_obj = new faq;
}
if (!is_object($faq_gen))
{
    $faq_gen = new convert;
}
global $e107;
// ##### e_rss.php ---------------------------------------------
// get all the categories
$feed['name'] = FAQLAN_RSS01;
$feed['url'] = "faq";
$feed['topic_id'] = '';
$feed['path'] = 'faq';
$feed['text'] = FAQLAN_RSS02 ;
$feed['class'] = '0';
$feed['limit'] = '9';
$eplug_rss_feed[] = $feed;
// ##### --------------------------------------------------------
// ##### create rss data, return as array $eplug_rss_data -------
$rss = array();
global $FAQ_PREF, $sql, $tp;
 // if ($faq_obj->articulate_reader)
{
    // get faqs which are approved and are visible to this class viz everybody
    $faq_args = "
    select s.*,c.faq_info_title from #faq as s
left join #faq_info as c on s.faq_parent=c.faq_info_id
where s.faq_approved>0 and find_in_set(faq_info_class,'" . USERCLASS_LIST . "')
order by s.faq_datestamp desc LIMIT 0," . $this->limit;

    if ($items = $sql->db_Select_gen($faq_args, false))
    {
        $i = 0;
        while ($rowrss = $sql->db_Fetch())
        {
            $rss[$i]['author'] = $tp->toRss(substr($rowrss['faq_author'], strpos($rowrss['faq_author'], ".") + 1), false);

            $rss[$i]['author_email'] = '';
            $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "faq/faq.php?0.cat." . $rowrss['faq_parent'] . "." . $rowrss['faq_id'] ;
            $rss[$i]['linkid'] = $tp->toRss($rowrss['faq_id'], false);
            $rss[$i]['title'] = $tp->toRss($rowrss['faq_question'], false);;
            $rss[$i]['description'] = $tp->toRss($rowrss['faq_answer'], false);

            $rss[$i]['category_name'] = $tp->toRss($rowrss['faq_info_title'], false);
            $rss[$i]['category_link'] = $e107->base_path . $PLUGINS_DIRECTORY . "faq/faq.php?0.cat." . $rowrss['faq_parent'] ;
            $rss[$i]['datestamp'] = $rowrss['faq_datestamp'];
            $rss[$i]['enc_url'] = "";
            $rss[$i]['enc_leng'] = "";
            $rss[$i]['enc_type'] = "";
            $i++;
        }
    }
    else
    {
        $rss[$i]['author'] = "" ;
        $rss[$i]['author_email'] = '';
        $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "faq/faq.php";
        $rss[$i]['linkid'] = '';
        $rss[$i]['title'] = "";
        $rss[$i]['description'] = "none";
        $rss[$i]['category_name'] = "";
        $rss[$i]['category_link'] = '';
        $rss[$i]['datestamp'] = "";
        $rss[$i]['enc_url'] = "";
        $rss[$i]['enc_leng'] = "";
        $rss[$i]['enc_type'] = "";
    }
}
$eplug_rss_data[] = $rss;

?>