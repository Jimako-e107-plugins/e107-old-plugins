<?php
/*
+---------------------------------------------------------------+
|  e107 website system   news_mobile.php
|                             
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/last_next_menu_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/last_next_menu_lan.php");
require_once(e_PLUGIN."sport_league_e107/functionen.php");
require_once("header.php");

require_once(e_HANDLER."news_class.php");
require_once(e_HANDLER."comment_class.php");
require_once(e_FILE.'shortcode/batch/news_shortcodes.php');
$ix = new news;
$nobody_regexp = "'(^|,)(".str_replace(",", "|", e_UC_NOBODY).")(,|$)'";


$MAX = 5;

$text="<tr>
			<td style='text-align:right;background:#b80000 url(images/navbar_bg.png) repeat-x;width:100%;height:100px;color:#ffffff;font-weight:bold;padding:15px;'>
				<div style='color:#fff;text-align:center;background: url(images/back2.png);width:274px;height:66px;'><a href='javascript:history.back()'>Zurück</a></div>
			</td>
		</tr>
		<tr>
			<td style='background:#101010 url(images/body_bg.png) repeat-x;width:100%;height:750px;text-align:center;vertical-align:top;color:#ffffff;padding:20px;'>";
			
			
			
if (file_exists("".THEME."news_slider_template.php"))
			{
			require_once("".THEME."news_slider_template.php");
			}
		else
			{
			require_once(e_PLUGIN."news_slider/news_slider_template.php");
			}


if($pref['news_slider_sticky']){$qry_ST=" AND a.news_sticky='1'";}else{$qry_ST="";}
$qry1="
   	SELECT a.*, ab.*, ac.* FROM ".MPREFIX."news AS a 
   	LEFT JOIN ".MPREFIX."news_category AS ab ON ab.category_id=a.news_category
   	LEFT JOIN ".MPREFIX."user AS ac ON ac.user_id=a.news_author
   	WHERE a.news_class REGEXP '".e_CLASS_REGEXP."' AND NOT (a.news_class REGEXP ".$nobody_regexp.")
   	AND a.news_body!=''".$qry_ST." ORDER BY news_id DESC LIMIT ".$MAX."
   			";	
		$sql->db_Select_gen($qry1);
    $count=0;
    while($row = $sql-> db_Fetch())
    	{
			$NEWS[$count]=$row;
			$count++;
			}
for($i=0; $i < $count ; $i++)
{
 if(is_file(e_BASE."e107_images/newspost_images/".$NEWS[$i]['news_thumbnail']))
		{
		$NEWS_IMG="<img style='float:left; margin:8px; width:190px;border:2px #999 solid;' src='".e_BASE."e107_images/newspost_images/".$NEWS[$i]['news_thumbnail']."' alt='".$NEWS[$i]['news_thumbnail']."'>";	
		}else{$NEWS_IMG="";}
	
	$text.="<div style='font-size:40px;color:#fff;text-align:left;'>";
	$text.="<div style='font-size:55px;color:#d00000;text-align:left;font-weight:bold;'>".$NEWS[$i]['news_title']."</div>";
	$text.=$NEWS_IMG;
	$text .= $tp->toHTML($NEWS[$i]['news_body'], TRUE);
	$text .=($NEWS[$i]['news_extended'])? "<a href='../../news.php?extend.".$NEWS[$i]['news_id']."'>weiter lesen...</a>" :"";
	$text.=	"</div><br/>";
}


	                                                                                                                                                                                                                                                                                   
$title = "<b>".LAN_LAST_NEXT_GAME_13."</b>";
/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text .=powered_by();
/// =========================================================================================
//$ns -> tablerender($title, $text);
echo $text;
require_once("footer.php");
//////////////////////////////////////
//////////////////////////////////////

?>