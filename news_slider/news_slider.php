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

require_once("../../class2.php");
require_once(HEADERF);
require_once(e_HANDLER."news_class.php");
require_once(e_HANDLER."comment_class.php");
require_once(e_FILE.'shortcode/batch/news_shortcodes.php');
$ix = new news;
$nobody_regexp = "'(^|,)(".str_replace(",", "|", e_UC_NOBODY).")(,|$)'";

$lan_file = e_PLUGIN."news_slider/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."news_slider/languages/German.php");
@include_once(e_THEME."4xa_027/languages/".e_LANGUAGE.".php");

$MAX = $pref['news_slider_count'];
$ZEIT = $pref['news_slider_time']*1000;
$CHARS_BLOG = $pref['news_slider_chars'];
if (file_exists("".THEME."news_slider_template.php"))
			{
			require_once("".THEME."news_slider_template.php");
			}
		else
			{
			require_once(e_PLUGIN."news_slider/news_slider_template.php");
			}
require_once(e_PLUGIN."news_slider/news_slider_shortcodes.php");
//require_once(e_FILE."shortcode/batch/news_shortcodes.php");
$text="
<link rel=\"stylesheet\" type=\"text/css\" href=\"contentslider.css\" />
<script type=\"text/javascript\" src=\"contentslider.js\">
</script>
<!--Inner content DIVs should always carry \"contentdiv\" CSS class-->
<!--Pagination DIV should always carry \"paginate-SLIDERID\" CSS class-->
<div id=\"slider1\" class=\"sliderwrapper\">";



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
	$text.="<div class=\"contentdiv\">";
	$text .= rendernews($NEWS[$i]);
	$text.=	"<br/>
	</div>";
}
$text.="
</div>
<div id=\"paginate-slider1\" class=\"pagination\">

</div>

<script type=\"text/javascript\">

featuredcontentslider.init({
	id: \"slider1\",  //id of main slider DIV
	contentsource: [\"inline\", \"\"],  //Valid values: [\"inline\", \"\"] or [\"ajax\", \"path_to_file\"]
	toc: \"#increment\",  //Valid values: \"#increment\", \"markup\", [\"label1\", \"label2\", etc]
	nextprev: [\"<<\", \">>\"],  //labels for \"prev\" and \"next\" links. Set to \"\" to hide.
	revealtype: \"click\", //Behavior of pagination links to reveal the slides: \"click\" or \"mouseover\"
	enablefade: [true, 0.05],  //[true/false, fadedegree]
	autorotate: [true, ".$ZEIT."],  //[true/false, pausetime]
	onChange: function(previndex, curindex){  //event handler fired whenever script changes slide
		//previndex holds index of last slide viewed b4 current (1=1st slide, 2nd=2nd etc)
		//curindex holds index of currently shown slide (1=1st slide, 2nd=2nd etc)
	}
})
</script>";

if($pref['news_slider_news_list']=='1')
	{
	if(!$pref['news_slider_news_list2'])
	{$MAX2=$pref['news_slider_news_list_count']+$MAX;}
	else{$MAX2=$pref['news_slider_news_list_count'];}
	
	$qry1="
   	SELECT a.*, ab.*, ac.* FROM ".MPREFIX."news AS a 
   	LEFT JOIN ".MPREFIX."news_category AS ab ON ab.category_id=a.news_category
   	LEFT JOIN ".MPREFIX."user AS ac ON ac.user_id=a.news_author
   	WHERE a.news_body!='' ORDER BY news_id DESC LIMIT ".$MAX2."
   			";	
		$sql->db_Select_gen($qry1);
    $count2=0;
    while($row = $sql-> db_Fetch())
    	{
			$NEWS[$count2]['news_id']=$row['news_id'];
			$NEWS[$count2]['news_title']=$row['news_title'];
			$NEWS[$count2]['news_body']=$row['news_body'];
			$NEWS[$count2]['news_thumbnail']=$row['news_thumbnail'];
			$NEWS[$count2]['news_datestamp']=$row['news_datestamp'];
			$NEWS[$count2]['news_author']=$row['news_author'];
			$NEWS[$count2]['news_author_name']=$row['user_name'];
			$NEWS[$count2]['news_kategorie']=$row['news_category'];
			$NEWS[$count2]['news_kat_name']=$row['category_name'];
			$NEWS[$count2]['news_kat_ico']=$row['category_icon'];
			$count2++;
			}	
$text .="<div style='text-align:center'><br/><font style='font-size:150%;'>".NEWSSLIDER_LAN_6."</font><br/><br/></div>";
$text .="<table cellspacing='0' cellpadding='0' width='100%'>";
if(!$pref['news_slider_news_list2']){$ANFANG=$count;}else{$ANFANG=0;}
	for($i=$ANFANG; $i < $count2 ; $i++)
	{
		$text .=rendernewslist($NEWS[$i]);
	}
	$text .="</table><br/>";
}
////////////////////////////////////////
$ns->tablerender(NEWSSLIDER_LAN_7, $text);
////////////////////////////////////////
if($pref['news_slider_kategorien_show']=='1')
{
$text3 = $tp->toHTML("{NEWS_CATEGORIES}", TRUE, 'parse_sc,nobreak,emotes_off,no_make_clickable');
$ns->tablerender(NEWSSLIDER_LAN_8, $text3, 'news_cat');
}
if ($pref['news_slider_kategorien_show_nfp_display'] && isset($pref['nfp_display']) && $pref['nfp_display'] == 2) {
		require_once(e_PLUGIN."newforumposts_main/newforumposts_main.php");
}

/// Respektiere fremde Arbeit und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
echo "<div style='text-align:center;font-size:70%;'>::".NEWSSLIDER_LAN_2." v".NEWSSLIDER_LAN_1." powered by <a href='http://www.e107.4xa.de'>e107-Templates</a>::</div>";
require_once(FOOTERF);
////////////////////////////////////////
function rendernews($N_BEITRAG)
	{
	global $NEWS_BEITRAG,$ix;
	global $tp, $sql, $news_slider_shortcodes, $NSL_TEMPLATE, $NEWSSTYLE;	
	$news_item =	$N_BEITRAG;
	///return $tp->parseTemplate($NEWSSTYLE, true, $news_slider_shortcodes);
	
	return $ix->render_newsitem($news_item, 'return', '', $NEWSLISTSTYLE, $param);
	}
///////////////////////////////////////
function rendernewslist($N_BEITRAG)
	{
	global $NEWS_BEITRAG;
	global $tp, $sql, $news_slider_shortcodes, $NSL_SHORT_TEMPLATE, $NEWSSTYLE;	
	$NEWS_BEITRAG =	$N_BEITRAG;
	return $tp->parseTemplate($NSL_SHORT_TEMPLATE, true, $news_slider_shortcodes);
	}
?>
