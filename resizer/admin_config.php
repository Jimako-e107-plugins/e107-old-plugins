<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Plugin Admin File: e107_plugins/resizer/admin_config.php
|        Email: support@naja7host.com
|        $Author: Mohamed Anouar Achoukhy $
+----------------------------------------------------------------------------------------------------+
*/
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; } 

$lan_file = e_PLUGIN."resizer/languages/admin/".e_LANGUAGE.".php";
include_lan($lan_file); 

//$qs = e_QUERY ? explode('.', e_QUERY) : array('', '');
$pageid = !e_QUERY ? 'config' : e_QUERY;
//$csslist = '';


require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php");


//Actions
if(isset($_POST['update_prefs'])) {
	$pref['ncode_imageresizer_enabled']  = !$_POST['ncode_imageresizer_enabled'] ? '0' : '1';
	$pref['ncode_imageresizer_maxwidth']  = !$_POST['ncode_imageresizer_maxwidth'] ? '500' : intval($_POST['ncode_imageresizer_maxwidth']);
	$pref['ncode_imageresizer_maxheight']  = !$_POST['ncode_imageresizer_maxheight'] ? '' : intval($_POST['ncode_imageresizer_maxheight']);
	$pref['ncode_imageresizer_resizemode'] = $_POST['ncode_imageresizer_resizemode']  ;
	save_prefs();
	show_message(IM_LAN_20, LAN_UPDATED);
	$_SESSION['sessmsg'] = array(IM_LAN_20, LAN_UPDATED);
	session_write_close();
	header("Location: ".e_SELF);
	exit;
	}
	

//session msgs - after-redirect messages
if(isset($_SESSION['sessmsg'])) {
  show_message($_SESSION['sessmsg'][0], $_SESSION['sessmsg'][1]);
  unset($_SESSION['sessmsg']);
}

//Show Admin pages
if($pageid == 'help') {
	header("Location:".e_PLUGIN."resize/admin_readme.php"); 

} elseif($pageid == 'config') {   
	$ns->tablerender(IM_LAN_1, show_options());
} else {
    $_SESSION['sessmsg'] = array(IM_LAN_22, LAN_ERROR);
    session_write_close();
    header("Location:".e_PLUGIN."resize/admin_config.php?config"); 
    exit;
}

require_once(e_ADMIN."footer.php"); 
exit;

function show_options()
{
	global $pref;
	// echo $pref['ncode_imageresizer_enabled'] ;
	$txt = "
	". form::form_open("post", e_SELF) ."
	<table class='fborder' style='width:95%'>
	<tr>
		<td class='fcaption' colspan='2' style='text-align:center'>".IM_LAN_18."</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:75%'>".IM_LAN_19."</td>
		<td class='forumheader3' style='width:25%'>
            <label for='ncode_imageresizer_enabled1'>".LAN_ENABLED."</label>
            ".form::form_radio('ncode_imageresizer_enabled', '1', $pref['ncode_imageresizer_enabled'])."
            <label for='ncode_imageresizer_enabled0'>".LAN_DISABLED."</label>
            ".form::form_radio('ncode_imageresizer_enabled', '0', !$pref['ncode_imageresizer_enabled'])."
        </td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:75%'>".IM_LAN_8 ."<br />". IM_LAN_9 ."</td>
		<td class='forumheader3' style='width:25%'><input class='tbox' name='ncode_imageresizer_maxwidth' size='3' maxlength='3' type='text' value='".varsettrue($_POST['ncode_imageresizer_maxwidth'], $pref['ncode_imageresizer_maxwidth'])."' /> px</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:75%'>".IM_LAN_10 ."<br />". IM_LAN_11 ."</td>
		<td class='forumheader3' style='width:25%'><input class='tbox' name='ncode_imageresizer_maxheight' size='4' maxlength='4' type='text' value='".varsettrue($_POST['ncode_imageresizer_maxheight'], $pref['ncode_imageresizer_maxheight'])."' /> px</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:75%'>". IM_LAN_16 ."</td>
		<td class='forumheader3' style='width:25%'>
            ".form::form_select_open('ncode_imageresizer_resizemode')."
			".form::form_option(IM_LAN_12, ($pref['ncode_imageresizer_resizemode'] == 'none') , 'none')."
			".form::form_option(IM_LAN_13, ($pref['ncode_imageresizer_resizemode'] == 'enlarge'), 'enlarge')."
			".form::form_option(IM_LAN_14, ($pref['ncode_imageresizer_resizemode'] == 'samewindow'), 'samewindow')."
			".form::form_option(IM_LAN_14A, ($pref['ncode_imageresizer_resizemode'] == 'newwindow'), 'newwindow')."
			".form::form_option(IM_LAN_15A, ($pref['ncode_imageresizer_resizemode'] == 'fancybox'), 'fancybox')."
			".form::form_option(IM_LAN_15, ($pref['ncode_imageresizer_resizemode'] == 'tinybox'), 'tinybox')."
			".form::form_option(IM_LAN_15B, ($pref['ncode_imageresizer_resizemode'] == 'tinybox2'), 'tinybox2')."
			".form::form_select_close()."
        </td>
	</tr>
	<tr>
		<td class='forumheader' colspan='2' style='text-align:left; vertical-align: top;'>
            <input type='submit' class='button' name='update_prefs' value='".LAN_SAVE."' />
        </td>
	</tr>
	</table>
	" . form::form_close() ."
	";
	return $txt;
}
function show_message($message, $caption='', $error=false) {
	global $ns;
	$ns->tablerender($caption, "<div style='text-align:center; font-weight: bold'>".($error ? "<span style='color: #000000'>".$message."</span>" : $message)."</div>");
}
?>