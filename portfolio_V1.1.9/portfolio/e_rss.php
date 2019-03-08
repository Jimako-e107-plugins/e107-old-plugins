<?php
/*
+---------------------------------------------------------------+
|	Portfolio Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}

global $pref,$portfolio_obj;
require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
if (!is_object($portfolio_obj))
{
    $portfolio_obj = new portfolio;
}
global $tp;
// ##### e_rss.php ---------------------------------------------
$feed['name'] = PORTFOLIO_RSS_01;
$feed['url'] = 'portfolio';
$feed['topic_id'] = '';
$feed['path'] = 'portfolio';
$feed['text'] = PORTFOLIO_RSS_02 ;
$feed['class'] = '0';
$feed['limit'] = '9';
$eplug_rss_feed[] = $feed;
// ##### --------------------------------------------------------
// ##### create rss data, return as array $eplug_rss_data -------
$rss = array();


if ($portfolio_obj->portfolio_user)
{
    // getportfolio biographies
        $portfolio_args = "
		select  portfolio_person_id,portfolio_person_name,portfolio_person_biography,portfolio_person_created
		from #portfolio_person
		order by portfolio_person_created desc
		LIMIT 0," . $this->limit;
    if ($items = $sql->db_Select_gen($portfolio_args,false))
    {
        $i = 0;
        // found some so return the rss data
        while ($rowrss = $sql->db_Fetch())
        {
            $tmp = explode(".", $rowrss['portfolio_person_name'], 2);
            $rss[$i]['author'] = "" . $tmp[1] ;
            $rss[$i]['author_email'] = '';
            $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "portfolio/portfolio.php?0.show." . $rowrss['portfolio_person_id'];
            $rss[$i]['linkid'] = $rowrss['portfolio_person_id'];
            $rss[$i]['title'] = $rowrss['portfolio_person_name'];
            $rss[$i]['description'] = $tp->html_truncate($rowrss['portfolio_person_biography'],100," [...]");

            $rss[$i]['category_name'] = "";
            $rss[$i]['category_link'] = "";
            $rss[$i]['datestamp'] =$rowrss['portfolio_person_created'];
            $rss[$i]['enc_url'] = "";
            $rss[$i]['enc_leng'] = "";
            $rss[$i]['enc_type'] = "";
            $i++;
        }
    }
    else
    {
        // return no postings found to be displed
        $rss[$i]['author'] = "" . $tmp[1];
        $rss[$i]['author_email'] = '';
        $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "portfolio/portfolio.php";
        $rss[$i]['linkid'] = '';
        $rss[$i]['title'] = "";
        $rss[$i]['description'] = "";
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