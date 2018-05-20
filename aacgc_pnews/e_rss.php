<?php

/*
##########################
# AACGC Public News      #
# M@CH!N3                #
# www.aacgc.com          #
# admin@aacgc.com        #
##########################
*/

include_lan(e_PLUGIN . "aacgc_pnews/languages/" . e_LANGUAGE . ".php");

if (!defined('e107_INIT'))
{
    exit;
}

global $pref, $tp;

// ##### e_rss.php ---------------------------------------------
// ##### get all the categories --------------------------------

$feed['name'] = PNEWS_60;
$feed['url'] = 'pnews';
$feed['topic_id'] = '';
$feed['path'] = 'aacgc_pnews';
$feed['text'] = PNEWS_61;
$feed['class'] = '0';
$feed['limit'] = '9';
$eplug_rss_feed[] = $feed;

// ##### --------------------------------------------------------
// ##### create rss data, return as array $eplug_rss_data -------

$rss = array();
$i = 0;



    $evrsn_sql = new DB;

    if ($evrsn_sql->db_Select_gen("select * from #aacgc_pnews where news_id > 0 order by news_date DESC LIMIT 0," . $this->limit, false))
    {
        while ($evrsn_row = $evrsn_sql->db_Fetch())
        {
            
            $evrsn_conv = new convert;
            $releasedate = $evrsn_conv->convert_date($evrsn_row['news_date'], "short");
            $rss[$i]['author'] = $evrsn_row['news_author'];
            $rss[$i]['author_email'] = '';
            $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "aacgc_pnews/News_Details.php?det.".$evrsn_row['news_id'];
            $rss[$i]['linkid'] = $evrsn_row['eversion_id'];
            $rss[$i]['title'] = $evrsn_row['news_title'];
            $rss[$i]['description'] = $tp->toRss($evrsn_row['news_desc']);
            $rss[$i]['category_name'] = "";
            $rss[$i]['category_link'] = '';
            $rss[$i]['datestamp'] = $evrsn_row['news_date'];
            $rss[$i]['enc_url'] = "";
            $rss[$i]['enc_leng'] = "";
            $rss[$i]['enc_type'] = "";
        $i++;
		}
    }


$eplug_rss_data[] = $rss;

?>