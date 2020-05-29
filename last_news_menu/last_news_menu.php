<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
| 4xA-LNM (Last- News- Menu) version 0.5.1 from ***RuSsE*** http://www.e107.4xa.de
|	released 18.07.2011
|	sorce: ../../last_news_menu/last_news_menu.php
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit(); }
include_lan(e_PLUGIN.'last_news_menu/languages/'.e_LANGUAGE.'.php');

global $tp;
$show = intval($pref['last_news_count']);
$show= intval($pref['last_news_show']);
$chars= intval($pref['last_news_chars']);
$cols=intval($pref['last_news_cols']);
$nobody_regexp = "'(^|,)(".str_replace(",", "|", e_UC_NOBODY).")(,|$)'";
$qry = "SELECT news_id, news_title,news_body,news_thumbnail,news_author,news_datestamp  FROM #news 
		WHERE news_render_type = 0 
		AND news_class REGEXP '".e_CLASS_REGEXP."' AND NOT (news_class REGEXP ".$nobody_regexp.")
		AND news_start < ".time()." AND (news_end=0 || news_end>".time().")  
		ORDER BY news_id DESC 
		LIMIT 0,".$show;
$sql->db_Select_gen($qry);
while($row = $sql -> db_Fetch())
{
  extract($row);
	$scroll_url= "news.php?item.".$news_id;
	$scroll_alt= $news_title;
	$url_lnk = "<a href='".e_BASE.$scroll_url."' alt=''>";
	$news_body = $tp->toHTML($news_body, TRUE);
  $news_body = $tp->html_truncate($news_body, $chars, " <a href='".e_BASE."news.php?extend.".$news_id."'><strong>...<br/>[".e4xA_LNM_015."]</strong></a>");		

	if($news_thumbnail)
	{
	$items[] = "<div class='newsimg'><img src='".e_BASE.e_IMAGE."newspost_images/".$news_thumbnail."' alt='".$scroll_alt."' width='60' style='float:left;' /></div>
				   <div class='newscaption' style='font-size:110%;'>&nbsp;".$url_lnk.$news_title."</a></div><div class='newsdata'>".strftime("%a. %d.%b.%Y (%H:%M)",$news_datestamp)."</div>".$news_body."<br/>";
	}
	else
	{
	$items[] = $url_lnk.$news_title."<br/></a>".$news_body."<br/>";
	}
}
$Breite=100 / $cols;

$DD=0;
$text = "";
		$Keys = array_rand($items, $show);		
		$text .= "<table cellspacing='0' cellpadding='0' width='100%' border='0'>
								<tr>";		
		for($K = 0; $K < $show; $K++)
		{
		$DD++;
		$text .= "<td style='padding:5px;vertical-align:top;width:".$Breite."%;text-align:left;'><div class='newscontent'>".$items[$Keys[$K]]."</div></td>";
		if($DD==$cols)
				{
				$text .= "</tr><tr>";
				$DD=0;
				}
		}
		$text .= "</tr></table>";		
$text .= "<div style='text-align:center;'><a href='".e_BASE."news.php' title='alle News lesen'>".e4xA_LNM_016."</a></div>";
$text .= "<br/><div style='text-align:center;font-size:60%'>.:: powered by <a href='http://www.e107.4xa.de' title='besuche mich!'>4xA-LNM</a> v.".e4xA_LNM_VERS." ::.<br/></div>";
$ns -> tablerender("Letzte News",$text);
?>