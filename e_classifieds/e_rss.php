<?php
// *
// e_rss for e_Classifieds
// *
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/English.php");
}
if (!defined('e107_INIT'))
{
    exit;
}
// ##### e_rss.php ---------------------------------------------
// get all the categories
$feed['name'] = ECLASSF_RSS_1;
$feed['url'] = 'classifieds';
$feed['topic_id'] = '';
$feed['path'] = 'e_classifieds';
$feed['text'] = ECLASSF_RSS_2 ;
$feed['class'] = '0';
$feed['limit'] = '9';
$eplug_rss_feed[] = $feed;
# where find_in_set(eclassf_catclass,'".USERCLASS_LIST."')
$eclassf_args = "select s.*,c.eclassf_catname from #eclassf_subcats as s
left join #eclassf_cats as c on s.eclassf_ccatid=c.eclassf_catid

order by c.eclassf_catname, s.eclassf_subname";

if ($sql->db_Select_gen($eclassf_args))
{
    while ($rowrss = $sql->db_Fetch())
    {
        $feed['name'] = ECLASSF_RSS_1 . " &gt; " . $rowrss['eclassf_catname'] . " &gt; " . $rowrss['eclassf_subname'];
        $feed['url'] = 'classifieds';
        $feed['topic_id'] = $rowrss['eclassf_subid'];
        $feed['path'] = 'e_classifieds';
        $feed['text'] = ECLASSF_RSS_2 . ECLASSF_RSS_7 . $rowrss['eclassf_catname'];
        $feed['class'] = '0';
        $feed['limit'] = '9';
        $eplug_rss_feed[] = $feed;
    }
}
// ##### --------------------------------------------------------
// ##### create rss data, return as array $eplug_rss_data -------
$rss = array();
global $pref;

if (check_class($pref['eclassf_read']))
{
    if ($this->topicid > 0)
    {
        $eclassf_cat = " and eclassf_ccat = " . $this->topicid . " ";
    }
// get unexpired adds which are approved and are visible to this class
    $eclassf_args = "
		select a.eclassf_cname,a.eclassf_price,a.eclassf_cuser,a.eclassf_cdetails,a.eclassf_cid,c.eclassf_catname,s.eclassf_subname,s.eclassf_ccatid,s.eclassf_subid from #eclassf_ads as a
		left join #eclassf_subcats as s
		on s.eclassf_subid = a.eclassf_ccat
		left join #eclassf_cats as c
		on s.eclassf_ccatid = c.eclassf_catid
		where find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "') $eclassf_cat
		and eclassf_capproved > 0
		and (eclassf_cpdate>'".time()."' or eclassf_cpdate=0)
		order by eclassf_cpdate desc
		LIMIT 0," . $this->limit;

    if ($items = $sql->db_Select_gen($eclassf_args))
    {
        $i = 0;
        while ($rowrss = $sql->db_Fetch())
        {
            $rss[$i]['author'] = substr($rowrss['eclassf_cuser'], strpos($rowrss['eclassf_cuser'], ".")+1) ;
            $rss[$i]['author_email'] = '';
            $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "e_classifieds/classifieds.php?0.item." . $rowrss['eclassf_ccatid'] . "." . $rowrss['eclassf_subid'] . "." . $rowrss['eclassf_cid'] ;
            $rss[$i]['linkid'] = $rowrss['eclassf_cid'];
            $rss[$i]['title'] = $rowrss['eclassf_cname'];
            $rss[$i]['description'] = $rowrss['eclassf_cdetails'];
            if ($this->topicid > 0)
            {
                $rss[$i]['category_name'] = $rowrss['eclassf_catname'] . "aa &gt; " . $rowrss['eclassf_subname'];
                $rss[$i]['category_link'] = $e107->base_path . $PLUGINS_DIRECTORY . "e_classifieds/classifieds.php?0.list." . $rowrss['eclassf_ccatid'] . "." . $rowrss['eclassf_subid'] . "." . $rowrss['eclassf_cid'] ;
            }
            else
            {
                $rss[$i]['category_name'] = "";
                $rss[$i]['category_link'] = "";
            }
            $rss[$i]['datestamp'] = $rowrss['eclassf_cpdate'];
            $rss[$i]['enc_url'] = "";
            $rss[$i]['enc_leng'] = "";
            $rss[$i]['enc_type'] = "";
            $i++;
        }
    }
    else
    {
        $rss[$i]['author'] =  substr($rowrss['eclassf_cuser'], strpos($rowrss['eclassf_cuser'], ".")+1);
        $rss[$i]['author_email'] = '';
        $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "e_classifieds/classifieds.php";
        $rss[$i]['linkid'] = '';
        $rss[$i]['title'] = ECLASSF_RSS_5;
        $rss[$i]['description'] = ECLASSF_RSS_6;
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
    $rss[$i]['author'] =  substr($rowrss['eclassf_cuser'], strpos($rowrss['eclassf_cuser'], ".")+1);
    $rss[$i]['author_email'] = '';
    $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "e_classifieds/classifieds.php";
    $rss[$i]['linkid'] = '';
    $rss[$i]['title'] = ECLASSF_RSS_3;
    $rss[$i]['description'] = ECLASSF_RSS_4;
    $rss[$i]['category_name'] = "";
    $rss[$i]['category_link'] = '';
    $rss[$i]['datestamp'] = "";
    $rss[$i]['enc_url'] = "";
    $rss[$i]['enc_leng'] = "";
    $rss[$i]['enc_type'] = "";
}

$eplug_rss_data[] = $rss;

?>