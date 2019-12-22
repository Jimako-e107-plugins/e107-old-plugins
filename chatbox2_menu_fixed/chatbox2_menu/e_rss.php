<?php

if (!defined('e107_INIT')) { exit; }

//##### create feed for admin, return array $eplug_rss_feed --------------------------------
$feed['name']		= 'Chatbox2';
$feed['url']		= 'chatbox2';			//the identifier for the rss feed url
$feed['topic_id']	= '';					//the topic_id, empty on default (to select a certain category)
$feed['path']		= 'chatbox2_menu';		//this is the plugin path location
$feed['text']		= 'this is the rss feed for the chatbox2 entries';
$feed['class']		= '0';
$feed['limit']		= '9';

// ------------------------------------------------------------------------------------


//##### create rss data, return as array $eplug_rss_data -----------------------------------
$rss = array();
if($items = $sql -> db_Select('chatbox2', "*", "cb2_blocked=0 ORDER BY cb2_datestamp DESC LIMIT 0,".$this -> limit)){
	$i=0;
	while($rowrss = $sql -> db_Fetch()){
		$tmp						= explode(".", $rowrss['cb2_nick']);
		$rss[$i]['author']			= $tmp[1];
		$rss[$i]['author_email']	= '';
		$rss[$i]['link']			= $e107->base_path.$PLUGINS_DIRECTORY."chatbox2_menu/chat2.php?".$rowrss['cb2_id'];
		$rss[$i]['linkid']			= $rowrss['cb2_id'];
		$rss[$i]['title']			= '';
		$rss[$i]['description']		= $rowrss['cb2_message'];
		$rss[$i]['category_name']	= '';
		$rss[$i]['category_link']	= '';
		$rss[$i]['datestamp']		= $rowrss['cb2_datestamp'];
		$rss[$i]['enc_url']			= "";
		$rss[$i]['enc_leng']		= "";
		$rss[$i]['enc_type']		= "";
		$i++;
	}
}


//##### ------------------------------------------------------------------------------------

$eplug_rss_data[] = $rss;
$eplug_rss_feed[] = $feed;
?>