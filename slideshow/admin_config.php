<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
|	Slideshow plugin
|	© nlstart
+---------------------------------------------------------------+
*/
$eplug_admin = true;
require_once('../../class2.php');
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }

//For admin menu and v0.7
$pageid = "admin_config";  // unique name that matches the one used in admin_menu.php.
$eplug_css="";

require_once(e_ADMIN."auth.php");

// Set languages ---------------------------------------------+
include_lan(e_PLUGIN.'slideshow/languages/'.e_LANGUAGE.'.php');

require_once(e_HANDLER."form_handler.php");
$rs = new form;
$aj = new textparse;

require_once(e_HANDLER."upload_handler.php");

// Go back to Main
if(IsSet($_POST['back']))
{
   header("location:".e_SELF);
   exit();
}
      
// Update settings ----------------------------------------+
if(IsSet($_POST['updatemain']))
{
	extract($_POST);
	$pref['slideshow_news_title']		= $slideshow_news_title;
	$pref['slideshow_download_title']	= $slideshow_download_title;
	$pref['slideshow_easyshop_title']	= $slideshow_easyshop_title;
	$pref['slideshow_show_title']		= $slideshow_show_title;
	$pref['slideshow_shows']			= $slideshow_shows;
	$pref['slideshow_summary']  		= $slideshow_summary;
	$pref['slideshow_delay'] 	 		= $slideshow_delay;
	$pref['slideshow_width'] 			= $slideshow_width;
	$pref['slideshow_height'] 			= $slideshow_height;
	$pref['slideshow_border'] 			= $slideshow_border;
	$pref['slideshow_border_color'] 	= $slideshow_border_color;
	$pref['slideshow_background'] 		= $slideshow_background;
	$pref['slideshow_align'] 			= $slideshow_align;
	save_prefs();
	$message = SS_CONF_01;
}
/*
	$pref['slideshow_timed'] 	 		= $slideshow_timed;
	$pref['slideshow_arrows'] 	 		= $slideshow_arrows;
	$pref['slideshow_carousel'] 		= $slideshow_carousel;
	$pref['slideshow_infopane'] 		= $slideshow_infopane;
	$pref['slideshow_carousel_tab_txt']	= $slideshow_carousel_tab_txt;
	$pref['slideshow_transition'] 		= $slideshow_transition; // [NOT SUPPORTED!]
*/

// Main --------------------------------------------------+
if($message)
{
	$ns -> tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

// Main settings -----------------------------------------+    $pref['slideshow_lodjs']
$text = "
	<div style='text-align:center'>
	".$rs -> form_open("post", e_SELF, "stylecss", "", "enctype='multipart/form-data'")."
	<table style='width:94%' class='fborder'>
		<tr>
			<td colspan='2' class='forumheader'>
				".SS_CONF_02."
			</td>
		</tr>";
	if (file_exists(e_PLUGIN.'slideshow/slideshow_news_menu.php'))
	{
		$text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_03."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_news_title", 50, $pref['slideshow_news_title'], 255)."</td>
		</tr> ";
	}
	if (file_exists(e_PLUGIN.'slideshow/slideshow_download_menu.php'))
	{
		$text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_04."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_download_title", 50, $pref['slideshow_download_title'], 255)."</td>
		</tr> ";
	}
	if (file_exists(e_PLUGIN.'slideshow/slideshow_easyshop_menu.php'))
	{
		$text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_05."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_easyshop_title", 50, $pref['slideshow_easyshop_title'], 255)."</td>
		</tr> ";
	}
	if (file_exists(e_PLUGIN.'slideshow/slideshow_show_menu.php'))
	{
		$text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_08."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_show_title", 50, $pref['slideshow_show_title'], 255)."</td>
		</tr> ";
	}
		
$text .= "		
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_06."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_shows", 5, $pref['slideshow_shows'], 5)."</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_07."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_summary", 5, $pref['slideshow_summary'], 5)."</td>
		</tr>";

/*		
$text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_08."</td>
			<td style='width:60%' class='forumheader3'>".
				$rs -> form_select_open(slideshow_timed).
				$rs -> form_option(SS_CONF_09, (($pref['slideshow_timed'] == 0)?"1":""), $form_value = "0").
				$rs -> form_option(SS_CONF_10, (($pref['slideshow_timed'] == 1)?"1":""), $form_value = "1").
				$rs -> form_select_close().
			"</td>
		</tr>";
*/
$text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_11."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_delay", 5, $pref['slideshow_delay'], 5)."</td>
		</tr>";
		
/*
$text .= "		
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_12."</td>
			<td style='width:60%' class='forumheader3'>".
				$rs -> form_select_open(slideshow_arrows).
				$rs -> form_option(SS_CONF_13, (($pref['slideshow_arrows'] == 0)?"1":""), $form_value = "0").
				$rs -> form_option(SS_CONF_14, (($pref['slideshow_arrows'] == 1)?"1":""), $form_value = "1").
				$rs -> form_select_close().
			"</td>
		</tr>";

	if ($pref['plug_installed']['lightbox'])
	{	// Set slidecarousel to hide always when Lightbox plugin is present
		$text .= "<input type='hidden' name='slideshow_carousel' value='1' />";
	}
	else
	{
		$text .= "		
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_15."</td>
			<td style='width:60%' class='forumheader3'>".
				$rs -> form_select_open(slideshow_carousel).
				$rs -> form_option(SS_CONF_13, (($pref['slideshow_carousel'] == 0)?"1":""), $form_value = "0").
				$rs -> form_option(SS_CONF_14, (($pref['slideshow_carousel'] == 1)?"1":""), $form_value = "1").
				$rs -> form_select_close().
			"</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_17."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_carousel_tab_txt", 50, $pref['slideshow_carousel_tab_txt'], 255)."</td>
		</tr>";
	}

	$text .= "		
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_16."</td>
			<td style='width:60%' class='forumheader3'>".
				$rs -> form_select_open(slideshow_infopane).
				$rs -> form_option(SS_CONF_13, (($pref['slideshow_infopane'] == 0)?"1":""), $form_value = "0").
				$rs -> form_option(SS_CONF_14, (($pref['slideshow_infopane'] == 1)?"1":""), $form_value = "1").
				$rs -> form_select_close().
			"</td>
		</tr>";

	$text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_18."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_width", 5, $pref['slideshow_width'], 5)."</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_19."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_height", 5, $pref['slideshow_height'], 5)."</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_20."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_border", 5, $pref['slideshow_border'], 5)."</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_21."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_border_color", 10, $pref['slideshow_border_color'], 10)."</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_22."</td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("slideshow_background", 10, $pref['slideshow_background'], 10)."</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SS_CONF_23."</td>
			<td style='width:60%' class='forumheader3'>".
				$rs -> form_select_open(slideshow_align).
				$rs -> form_option(SS_CONF_24, (($pref['slideshow_align'] == 0)?"1":""), $form_value = "0").
				$rs -> form_option(SS_CONF_25, (($pref['slideshow_align'] == 1)?"1":""), $form_value = "1").
				$rs -> form_select_close().
			"</td>
		</tr>";		
*/

	$text .= "		
		<tr style='vertical-align:top'>
			<td colspan='2' style='text-align:center' class='forumheader'>
			<input class='button' style='cursor:hand; cursor:pointer' type='submit' name='updatemain' value='".SS_CONF_26."' />
			</td>
		</tr>
	</table>
	<br />
	</div>
	<br />
	".$rs -> form_close();
	
$ns -> tablerender("<div style='text-align:center'>".SS_CONF_02."</div>", $text);
require_once(e_ADMIN.'footer.php');
?>