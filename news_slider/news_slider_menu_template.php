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

if (!isset($NSL_MENU_TEMPLATE)){
	
$NSL_MENU_TEMPLATE = "<table cellspacing='0' cellpadding='0' width='100%' height='100%'>
<tr>
<td class='".$pref['news_slider_class']."' style='width='100%;height:100%;text-center:left;vertical-align:top;padding:0px;'>
<table cellspacing='0' cellpadding='0' width='100%' height='100%'>
	<tr>
		<td class='' colspan='2' style='font-size:130%'>{NEWS_TITEL}</td>
	</tr>
		<td class='' colspan='2' style='text-align:left;vertical-align:top;font-size:90%'>
		&nbsp;{NEWS_KAT}&nbsp;&nbsp;|&nbsp;&nbsp;".Autor.":&nbsp;{NEWS_AUTHOR} am:{NEWS_MON}.{NEWS_MON}.{NEWS_YEAR}
		</td>
	</tr>
	<tr>
		<td class='' style='text-align:left;vertical-align:top;padding:5px;'>{NEWS_IMAG}</td>
		<td class='' style='text-align:left;vertical-align:top;padding:5px;'>{NEWS_BODY}{EXTENDED}</td>
	</tr>
</table></td>
	</tr>
</table>
";
//$NSL_TEMPLATE.=$tp->toHTML($NEWS['news_body'][$i], TRUE);
$NSL_MENU_TEMPLATE.=	"<br/>";
}

$NSL_SHORT_TEMPLATE ="<tr><td class='' style='text-align:left;'><b>{NEWS_BULLET} {NEWS_TITEL}</b> <font style='font-size:80%;font-style:italic;'>(from: {NEWS_AUTHOR} am: {NEWS_DAY}.{NEWS_MON}.{NEWS_YEAR} in: {NEWS_KAT})</font></td></tr>";

?>