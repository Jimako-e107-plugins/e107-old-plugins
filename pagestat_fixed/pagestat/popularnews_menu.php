<?php
/**
 * Copyright (C) 2008-2011 e107 Inc (e107.org), Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
 * $Id$
 * 
 * Popular news menu
 */
if (!defined('e107_INIT')) { exit; }

e107::plugLan('news');

require_once(e_HANDLER."news_class.php");

unset($text);
$ix = new news;

if(is_string($parm))
{
	parse_str($parm, $parms);
}
else
{
	$parms = $parm;
}

if(isset($parms['caption'][e_LANGUAGE]))
{
	$parms['caption'] = $parms['caption'][e_LANGUAGE];
}
else $parms['caption'] = LAN_PST25;

 
if(vartrue($parms['count'])) $limit = '0, '.intval($parms['count']);
else $limit = '0, 6'; 
	
$template = e107::getTemplate('pagestat');
 
$tp = e107::getParser(); 
/* TODO add menu config */

/* to save time */
$where = "WHERE item_type ='news' ORDER BY cnt DESC LIMIT 0, 6 " ;	 
$allRows = $sql->retrieve('pagestat', '*', $where, true);
 	
if($allRows = $sql->retrieve('pagestat', '*', $where, true))
{ 
	$text .= $tp->parseTemplate($template['popularnews_menu']['start'], true);
	foreach($allRows as $pgrow)
	{
	   /* news */
		$id_field = 'n.news_id';
		$return_fields = 'n.*, c.category_name';
		$time=time();
		
		
		$where = $id_field." = ".$pgrow['item_id']." AND (news_start < ".$time.") AND (news_end=0 OR news_end > ".$time.") AND news_class IN (".USERCLASS_LIST.")";
		$order = "news_datestamp DESC";
		$table = "news AS n LEFT JOIN #news_category AS c ON n.news_category = c.category_id";
	
	
	  $sql_query = "SELECT  ".$return_fields."
	                FROM   #".$table."
	                WHERE   ".$where." AND ".$id_field." = ".$pgrow['item_id'];     //echo "<p>$sql_query<p>";
	                
	  $itemrow = $sql->retrieve($sql_query, true);
		$itemrow = $itemrow[0];    
    $text .= $ix->render_newsitem($itemrow, 'return', '', $template['popularnews_menu']['item'], $param);
 
		
	}	
	$text .= $tp->parseTemplate($template['popularnews_menu']['end'], true);
		
	/* caption */
	$var = array(
					'CAPTION' 		=> $parms['caption']
					); 				
	$caption = $tp->simpleParse($template['popularnews_menu']['caption'],$var);	

	$ns->tablerender($caption, $text, 'popularnews');
}

 


 
 