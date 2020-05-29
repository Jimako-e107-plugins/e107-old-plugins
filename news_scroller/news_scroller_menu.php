<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
|	News scroller
|   Parts based on scrolling banner menu  By BaD_DuD (Roger Wallin)
|	© nlstart
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit(); }
include_lan(e_PLUGIN.'news_scroller/languages/'.e_LANGUAGE.'.php');

if($pref['news_scroller_lodjs'] == "1")
{
	//Load js to header
	if (file_exists(e_PLUGIN."news_scroller/handler/scroll_main15.js"))
	{
		echo "<script type='text/javascript' src='".e_PLUGIN."news_scroller/handler/scroll_main15.js' language='JavaScript1.2'></script>";
	}
}

// Set amount of news items to show ----------------------------
$show = intval($pref['news_scroller_shows']);
$space = "&nbsp;";
$space_ant = $pref['news_scroller_space'];

for($r = 0; $r < $space_ant; $r++)
{
	$space .= $space;
}

require_once('handler/popup_handler.php');
$nobody_regexp = "'(^|,)(".str_replace(",", "|", e_UC_NOBODY).")(,|$)'";
$qry = "SELECT news_id, news_title,news_body,news_thumbnail FROM #news 
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
	// If we have some news_title to show
	if($news_title != "")
	{
		set_popup($scroll_tbl_id,$pref['news_scroller_advtxt']." ".$scroll_alt,$news_title);
		$url_lnk = "<a href='".e_BASE.$scroll_url."' onMouseOver=\"stm(Scroll_txt[".$news_title."],Scroll_Style[".$pref['news_scroller_sticky']."])\" onMouseOut=\"htm()\" alt=''>";
	}
	else
	{
		$url_lnk = "<a href='".e_BASE.$scroll_url."' alt=''>";
	}

	$hr = ''; // Set default without horizontal rule
	if(($pref['news_scroller_dir'] == "down") || ($pref['news_scroller_dir'] == "up"))
	{
		if($pref['news_scroller_hrline'] == "1")
		{	// With horizontal rule
			$hr = "<hr />";
		}
	}
	else
	{ //Disable center if scroll direction is left or right
		$pref['news_scroller_center'] = "0";
		$target = "target='".$scroll_target."'";
	}

	if($news_thumbnail)
	{
		// Fix: removed for IE presentation (and the variables were not set anyway): width='".$scroll_width."' height='".$scroll_height."' 
		$items[] = $url_lnk."<img src='".e_BASE.e_IMAGE."newspost_images/".$news_thumbnail."' ".$target." align='".$scroll_align."' border='0' alt='".$scroll_alt."' /><br />
				   ".$news_title."</a>".$space.$hr;
	}
	else
	{
		$items[] = $url_lnk.$news_title."</a>".$space.$hr;
	}
}

// Main routine ------------------------------------------------+ 
$text = "<marquee border='".$pref['news_scroller_border']."' style='font-family: ".$pref['news_scroller_font']."; font-weight: ".$pref['news_scroller_weigth']."' scrollamount='".$pref['news_scroller_speed']."' scrolldelay='".$pref['news_scroller_delay']."' direction='".$pref['news_scroller_dir']."' align='top' onMouseover='this.scrollAmount=".$pref['news_scroller_over']."' onMouseout='this.scrollAmount=".$pref['news_scroller_speed']."'>";
if($pref['news_scroller_rand'] == "1" && $show > "1")
{ // Display it random -------------------------------------------+
    if($pref['news_scroller_center'] == "1")
	{
		$Keys = array_rand($items, $show);
		for($K = 0; $K < $show; $K++)
		{
			$text .= "<div style='text-align:center;'>".$items[$Keys[$K]]."</div>";
		}
	}
	else
	{
		$Keys = array_rand($items, $show);
		for($K = 0; $K < $show; $K++)
		{
			$text .= "".$items[$Keys[$K]]."";
		}
    }
}
else
{ // Display it in order -----------------------------------------+         
	if($pref['news_scroller_center'] == "1")
	{
		for($K = 0; $K < $show; $K++)
		{
			$text .= "<div style='text-align:center;'>".$items[$K]."</div>";
		}
	}
	else
	{
		for($K = 0; $K < $show; $K++)
		{
			$text .= "".$items[$K]."<br />";
		}
	}
}
$text .= "</marquee>";
$ns -> tablerender($pref['news_scroller_title'],  $text);
?>