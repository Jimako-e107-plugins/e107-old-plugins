<?php
/*
+---------------------------------------------------------------+
|        News Slider
|				 Autor ***RuSsE***
|				 http://www.e107.4xa.de e107-Temlates.de   
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
$news_slider_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);

/*

SC_BEGIN NEWS_BODY
global $NEWS_BEITRAG,$tp,$CHARS_BLOG;
$NEWS_BEITRAG['news_body'] = $tp -> toHTML($NEWS_BEITRAG['news_body'], TRUE, 'BODY, fromadmin', $NEWS_BEITRAG['news_author']);
$news_body = $tp->html_truncate($NEWS_BEITRAG['news_body'], $CHARS_BLOG, "... [<a href='".e_BASE."news.php?extend.".$NEWS_BEITRAG['news_id']."'><strong>weiter lesen >>> </strong></a>]");

return $news_body;
SC_END

SC_BEGIN NEWS_IMAG
$LOGO_SIZE="width=100px";
global $NEWS_BEITRAG,$tp;
return "<img border='0' src='".e_IMAGE."newspost_images/".$NEWS_BEITRAG['news_thumbnail']."'".$LOGO_SIZE.">";
SC_END

SC_BEGIN NEWS_TITEL
global $NEWS_BEITRAG,$tp;
return "<a href='".e_BASE."news.php?extend.".$NEWS_BEITRAG['news_id']."'>".$NEWS_BEITRAG['news_title']."</a>";
SC_END

SC_BEGIN NEWS_YEAR
global $NEWS_BEITRAG,$tp;
return strftime('%Y', $NEWS_BEITRAG['news_datestamp']);
SC_END

SC_BEGIN NEWS_DAY
global $NEWS_BEITRAG,$tp;
return strftime('%d', $NEWS_BEITRAG['news_datestamp']);
SC_END

SC_BEGIN NEWS_MON
global $NEWS_BEITRAG,$tp;
return strftime('%b', $NEWS_BEITRAG['news_datestamp']);
SC_END

SC_BEGIN NEWS_AUTHOR
global $NEWS_BEITRAG,$tp;
return "<a href='".e_BASE."user.php?id.".$NEWS_BEITRAG['news_author']."'>".$NEWS_BEITRAG['news_author_name']."</a>";
SC_END

SC_BEGIN NEWS_KAT
global $NEWS_BEITRAG,$tp;
return "<a href='".e_BASE."news.php?cat.".$NEWS_BEITRAG['news_kategorie']."'>".$NEWS_BEITRAG['news_kat_name']."</a>";
SC_END

SC_BEGIN NEWS_BULLET
global $tp;
if(file_exists(THEME."images/bullet.gif"))
{
	return "<img src='".THEME."/images/bullet.gif' style='border:0px;' title='' alt='' />";
}
SC_END

SC_BEGIN USER_LOGINNAME
global $NEWS_BEITRAG;
if(ADMIN && getperms("4")) {
	return $NEWS_BEITRAG['user_loginname'];
}
SC_END
*/
?>