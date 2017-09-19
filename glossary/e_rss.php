<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * ©Andre DUCLOS 2006
 * http://www.shirka.org
 * duclos@shirka.org
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/e_rss.php,v $
 * $Revision: 1.2 $
 * $Date: 2006/06/27 14:55:36 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

//##### create feed for admin, return array $eplug_rss_feed --------------------------------
$feed['name']			= 'Glossary';
$feed['url']			= 'Glossary';	//the identifier for the rss feed url
$feed['topic_id']	= '';					//the topic_id, empty on default (to select a certain category)
$feed['path']			= 'glossary';	//this is the plugin path location
$feed['text']			= 'This is the rss feed for the glossary entries';
$feed['class']		= '0';
$feed['limit']		= '9';
$eplug_rss_feed[]	= $feed;
//##### ------------------------------------------------------------------------------------


//##### create rss data, return as array $eplug_rss_data -----------------------------------

include_once(e_PLUGIN.'glossary/glossary_class.php');
$gc = new glossary_class;
/*
// Remove UTF-8 BOM
if($buf = ob_get_contents())
{
	if(substr($buf, 0, 3) == sprintf( '%c%c%c', 239, 187, 191 ))
	{
		@ob_end_clean();
		ob_start();
	}
}
*/
$rss = array();
$sqlrss = new db;
if($items = $sqlrss -> db_Select('glossary', "*", "glo_approved = '1' ORDER BY glo_datestamp DESC LIMIT 0,".$this->limit ))
{
	$i=0;
	while($rowrss = $sqlrss -> db_Fetch())
	{
		list($uid, $author, $email) = $gc->getAuthor($row['glo_author']);
		$rss[$i]['author']				= $author;
		$rss[$i]['author_email']	= $email;
		$rss[$i]['link']					= $e107->base_path.$PLUGINS_DIRECTORY."glossary/glossaire.php#word_id_".$rowrss['glo_id'];
		$rss[$i]['linkid']				= $rowrss['glo_id'];
		$rss[$i]['title']					= $rowrss['glo_name'];
		$rss[$i]['description']		= $rowrss['glo_description'];
		$rss[$i]['category_name']	= '';
		$rss[$i]['category_link']	= '';
		$rss[$i]['datestamp']			= $rowrss['glo_datestamp'];
		$rss[$i]['enc_url']				= '';
		$rss[$i]['enc_leng']			= '';
		$rss[$i]['enc_type']			= '';
		$i++;
	}
}
$eplug_rss_data[] = $rss;
//##### ------------------------------------------------------------------------------------

?>