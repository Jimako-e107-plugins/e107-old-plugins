<?php
require_once('../../../class2.php');

// Members only  ------------------------>
if(!USER) {
    header("Location: ".e_PLUGIN."sgallery/publish_xp/membersonly.php");
	exit;
}

require_once(e_PLUGIN.'sgallery/init.php');

include_lan(SGAL_LAN.'_publishxp.php');
include_lan(SGAL_LAN.'_manager.php'); //LANMNG used only - TO DO - move them into separate lan file
include_lan(SGAL_LAN.'.php');

require_once(SGAL_INCPATH.'sgal_publish_class.php');
$sgalpbl = new sgal_publish_class($sgalobj);

//Download reg file
if(strpos(e_QUERY,'download_reg') !== FALSE) { 
    $sgalpbl->generateReg(str_replace('download_reg.', '', e_QUERY));
    exit;
}

if(!check_class($sgal_pref['sgal_upload_publishxp']) || !check_class($pref['sgal_active'])) {
	require_once(SGAL_PUBLISH.'h.php');
	echo $sgalpbl -> publish_msg(SGAL_LANPBL_16);
	require_once(SGAL_PUBLISH.'f.php');
	exit;
}

// Start Session if not already started
if ($pref['user_tracking'] != "session") {
	session_start();
}

//user limits
if(!$sgal_shortcodes)
	require_once(SGAL_INCPATH."sgal_batch.php");
	
$tp->parseTemplate('{SGAL_USER_MYSTATS}', FALSE, $sgal_shortcodes); 

$tstats = getcachedvars('sgal_useritem');
$tmp = getcachedvars('sgal_useritem_'.USERID);
$alstats = $tmp[$id];
unset($tmp);

if(!ADMIN) {
    //override sgal prefs - user albums as module on top of Gallery API
    $tmppref = array();
    $tmppref['sgal_restrict_size'] = $sgal_pref['sgal_usermod_urestrict'];
    $tmppref['sgal_restrict_w'] = $sgal_pref['sgal_usermod_urestrict_w'] ? $sgal_pref['sgal_usermod_urestrict_w'] : 640;
    $tmppref['sgal_restrict_h'] = $sgal_pref['sgal_usermod_urestrict_h'] ? $sgal_pref['sgal_usermod_urestrict_h'] : 480;
    $tmp = $sgal_pref['sgal_usermod_rmethods'] ? explode(',', $sgal_pref['sgal_usermod_rmethods']) : array();
    $tmppref['sgal_allow_uresize'] = in_array('uresize', $tmp) ? '1' : '0';
    $tmppref['sgal_allow_autoresize'] = in_array('autoresize', $tmp) ? '1' : '0';

    $sgal_pref = $sgalobj->setExtConfig($tmppref, 'SgalleryUserPrefs');
	
}

//handle events/render
$action = array();
$action['render'] = varsettrue($_GET['gaction'], 'albums');

//album_create_submit
if(!empty($_POST) && isset($_POST['event'])) {
	$tmp =  array_keys($_POST['event']);
	$action['event'] = varset($tmp[0], '');
}

$sgalpbl -> handleRequest($action, 'event');


	//Output - header
	require_once(SGAL_PUBLISH.'h.php');
	
	//sysmsg
    if(isset($_SESSION['sessmsg'])) {
      $sgalpbl -> publish_msg($_SESSION['sessmsg']);
      unset($_SESSION['sessmsg']);
    }
	
	//handle render
	echo '<div style="float: right;">'.$tp -> parseTemplate('{SGAL_LANGUAGELINKS}', true).'</div>';
	echo '<div style="clear: both; text-align: center; padding-top: 10px">'.$sgalpbl -> handleRequest($action, 'render').'</div>';
	/*
	if($action == 'albums') {
		//print_a($_POST);
		//print_a($_GET);
		echo $sgalpbl->render_albums();
	}
	
	elseif($action == 'album_create') {
		echo $sgalpbl->render_album_create();
	}*/
	
	//Output - footer
	require_once(SGAL_PUBLISH.'f.php');
?>