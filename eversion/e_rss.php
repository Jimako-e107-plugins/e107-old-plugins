<?php

if (!defined('e107_INIT'))
{
    exit;
}
e107::lan('eversion',true); 
global $pref, $tp;
// ##### e_rss.php ---------------------------------------------
// get all the categories
$feed['name'] = EVERSION_RSS01;
$feed['url'] = 'eversion';
$feed['topic_id'] = '';
$feed['path'] = 'eversion';
$feed['text'] = EVERSION_RSS02 ;
$feed['class'] = '0';
$feed['limit'] = '9';
$eplug_rss_feed[] = $feed;
// ##### --------------------------------------------------------
// ##### create rss data, return as array $eplug_rss_data -------
$rss = array();

if (check_class($pref['eversion_read']))
{

    $i = 0;
    // get versions which are visible to this class

    $evrsn_sql = new DB;
    if ($evrsn_sql->db_Select_gen("select * from #eversion where eversion_id > 0 order by eversion_date LIMIT 0," . $this->limit, false))
    {

        $evrsn_row = $evrsn_sql->db_Fetch();
        $evrsn_vers = EVERSION_RSS03 . " " . $evrsn_row['eversion_major'] . "." . $evrsn_row['eversion_minor'] . ($evrsn_row['eversion_beta'] >0?".".$evrsn_row['eversion_beta']:"")." " . EVERSION_RSS04;
        if ($evrsn_row['eversion_beta']>0) {
        	$evrsn_vers .=" ".EVERSION_RSS08;
        }
        $evrsn_conv=new convert;
        $releasedate=$evrsn_conv->convert_date($evrsn_row['eversion_date'],"long");
        $evrsn_vers .= "  ".EVERSION_RSS09." ".$releasedate;
		$rss[$i]['author'] = $evrsn_row['eversion_author'];
        $rss[$i]['author_email'] = '';
        $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "eversion/eversion.php?0.view." . $evrsn_row['eversion_id'];
        $rss[$i]['linkid'] = $evrsn_row['eversion_id'];
        $rss[$i]['title'] = EVERSION_RSS07 . " " . $evrsn_row['eversion_title'];
        $rss[$i]['description'] = $tp->toRss($evrsn_vers);
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
    $rss[$i]['author'] = "";
    $rss[$i]['author_email'] = '';
    $rss[$i]['link'] = "";
    $rss[$i]['linkid'] = '';
    $rss[$i]['title'] = EVERSION_RSS05;
    $rss[$i]['description'] = EVERSION_RSS05;
    $rss[$i]['category_name'] = "";
    $rss[$i]['category_link'] = '';
    $rss[$i]['datestamp'] = "";
    $rss[$i]['enc_url'] = "";
    $rss[$i]['enc_leng'] = "";
    $rss[$i]['enc_type'] = "";
}

$eplug_rss_data[] = $rss;

?>