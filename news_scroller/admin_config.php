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
$eplug_admin = true;
require_once('../../class2.php');
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }

//For admin menu and v0.7
$pageid = "news_scroller_config";  // unique name that matches the one used in admin_menu.php.
$eplug_css="";

require_once(e_ADMIN."auth.php");
// Set languages ---------------------------------------------+
include_lan(e_PLUGIN.'news_scroller/languages/'.e_LANGUAGE.'.php');

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
	$pref['news_scroller_title']	= $title;
	$pref['news_scroller_urlsize']	= $urlsize;
	$pref['news_scroller_font']		= $font;
	$pref['news_scroller_weight']	= $weight;
	$pref['news_scroller_speed']	= $speed;
	$pref['news_scroller_delay'] 	= $delay;
	$pref['news_scroller_over'] 	= $mover;
	$pref['news_scroller_border']	= $border;
	$pref['news_scroller_dir']		= $direct;
	$pref['news_scroller_rand']		= $random;
	$pref['news_scroller_shows']	= $amount;
	$pref['news_scroller_hrline']	= $hrline;       
	$pref['news_scroller_center']	= $center;
	$pref['news_scroller_text']		= $txtsize;
	$pref['news_scroller_space']	= $spssize; 
	save_prefs();
	$message = SCR_01;
}

// Main --------------------------------------------------+
if($message)
{
	$ns -> tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

// Main settings -----------------------------------------+    $pref['news_scroller_lodjs']
$text = "
	<div style='text-align:center'>
	".$rs -> form_open("post", e_SELF, "stylecss", "", "enctype='multipart/form-data'")."
	<table style='width:94%' class='fborder'>
		<tr>
			<td colspan='2' class='forumheader'>
				".SCR_02."
			</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_53."<br /><span class='smalltext'>".SCR_54."</span></td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("title", 50, $pref['news_scroller_title'], 255)."</td>
		</tr>      
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_71."<br /><span class='smalltext'>".SCR_72."</span></td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("urlsize", 4, $pref['news_scroller_urlsize'], 4)."</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_10."<br /><span class='smalltext'>".SCR_11."</span></td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("font", 20, $pref['news_scroller_font'], 20)."</td>
		</tr>      
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_45."<br /><span class='smalltext'>".SCR_46."</span></td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("weight", 20, $pref['news_scroller_weight'], 20)."</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_14."<br /><span class='smalltext'>".SCR_15."</span></td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("speed", 2, $pref['news_scroller_speed'], 2)."</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_16."<br /><span class='smalltext'>".SCR_17."</span></td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("delay", 2, $pref['news_scroller_delay'], 2)."</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_18."</td>
			<td style='width:60%' class='forumheader3'>".
				$rs -> form_select_open(mover).
				$rs -> form_option(SCR_92, (($pref['news_scroller_over'] == 0)?"1":""), $form_value = "0").
				$rs -> form_option(SCR_93, (($pref['news_scroller_over'] == 1)?"1":""), $form_value = "1").
				$rs -> form_select_close().
			"</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_20."</td>
			<td style='width:60%' class='forumheader3'>".
				$rs -> form_select_open(border).
				$rs -> form_option(SCR_94, (($pref['news_scroller_border'] == 0)?"1":""), $form_value = "0").
				$rs -> form_option(SCR_95, (($pref['news_scroller_border'] == 1)?"1":""), $form_value = "1").
				$rs -> form_select_close().
			"</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_22."</td>
			<td style='width:60%' class='forumheader3'>".
				$rs -> form_select_open(direct).
				$rs -> form_option(SCR_96, (($pref['news_scroller_dir'] == 'up')?"1":""), $form_value = "up").
				$rs -> form_option(SCR_97, (($pref['news_scroller_dir'] == 'down')?"1":""), $form_value = "down").
				$rs -> form_option(SCR_97, (($pref['news_scroller_dir'] == 'left')?"1":""), $form_value = "left").
				$rs -> form_option(SCR_98, (($pref['news_scroller_dir'] == 'right')?"1":""), $form_value = "right").
				$rs -> form_select_close().
			"</td>			
		</tr>        
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_24."</td>
			<td style='width:60%' class='forumheader3'>".
				$rs -> form_select_open(random).
				$rs -> form_option(SCR_99, (($pref['news_scroller_rand'] == 0)?"1":""), $form_value = "0").
				$rs -> form_option(SCR_100, (($pref['news_scroller_rand'] == 1)?"1":""), $form_value = "1").
				$rs -> form_select_close().
			"</td>
			
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_26."<br /><span class='smalltext'>".SCR_27."</span></td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("amount", 5, $pref['news_scroller_shows'], 5)."</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_63."</td>
			<td style='width:60%' class='forumheader3'>".
				$rs -> form_select_open(hrline).
				$rs -> form_option(SCR_101, (($pref['news_scroller_hrline'] == 0)?"1":""), $form_value = "0").
				$rs -> form_option(SCR_102, (($pref['news_scroller_hrline'] == 1)?"1":""), $form_value = "1").
				$rs -> form_select_close().
			"</td>			
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_73."</td>
			<td style='width:60%' class='forumheader3'>".
				$rs -> form_select_open(center).
				$rs -> form_option(SCR_101, (($pref['news_scroller_center'] == 0)?"1":""), $form_value = "0").
				$rs -> form_option(SCR_102, (($pref['news_scroller_center'] == 1)?"1":""), $form_value = "1").
				$rs -> form_select_close().
			"</td>			
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_88."<!--<br /><span class='smalltext'>".SCR_89."</span>--></td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("txtsize", 2, $pref['news_scroller_text'], 3)."</td>   
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>".SCR_90."<br /><span class='smalltext'>".SCR_91."</span></td>
			<td style='width:60%' class='forumheader3'>".$rs -> form_text("spssize", 2, $pref['news_scroller_space'], 3)."</td>
		</tr>
		<tr style='vertical-align:top'>
			<td colspan='2' style='text-align:center' class='forumheader'>
			<input class='button' style='cursor:hand; cursor:pointer' type='submit' name='updatemain' value='".SCR_28."' />
			</td>
		</tr>
	</table>
	<br />
	</div>
	<br />
	".$rs -> form_close()."";

$ns -> tablerender("<div style='text-align:center'>".SCR_02."</div>", $text);
require_once(e_ADMIN.'footer.php');
?>