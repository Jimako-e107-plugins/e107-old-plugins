//USAGE [thumb=width,height,C|image_title|image_group|image_float]absolute_image_path[/thumb]
global $sgal_pref, $pref, $tp, $PHPTHUMB_CONFIG, $THCONFIG_THDEF, $IMAGES_DIRECTORY, $FILES_DIRECTORY, $e107;
//quick fix for rss page - TO DO convert to URL (http://...)
if(e_PAGE == 'rss.php') {
    return '';
}

$code_text = trim($code_text);
//no image path or bad guy
if(!$code_text || preg_match("#\.php#",$code_text)) {
    return '';
}
if(!defined('SGAL_PATH')) {
    require_once(e_PLUGIN.'sgallery/init.php');
}
include_lan(SGAL_LAN.'.php');
if(!function_exists('showThumb')) {
    require_once(SGAL_INCPATH."sgal_thumb_functions.php"); //show thumbs
}
$mod = 'relative';
$bbthumb = '';
$alt = '';
$cfgarr = array();
//http path is not allowed (yet - should be $sgal_pref)
$code_text = str_replace(SITEURL, '{e_BASE}',$code_text); //site link
if(strpos($code_text, 'http://') !== false) {
    $mod = 'url';
    
    if($sgal_pref['sgal_bballow_external']) { //TO DO
        $mod_url = true;
        $thcode_text = makeURL($code_text);
        $thcode_text = $tp -> toAttribute($thcode_text);
    } else {
        $mod_url = false;
        $bbthumb = SGAL_BBTHUMB_1;
        $thcode_text = $tp -> toAttribute($code_text);
    }
    
    
}
if($mod == 'relative') {
    if(e_HTTP && e_HTTP != '/' && strpos($code_text, e_HTTP) === 0) $code_text = str_replace(e_HTTP, '{e_BASE}', $code_text);
    $thcode_text = makeURL($code_text);
    $thcode_text = $tp -> toAttribute($thcode_text);
} 

$parm_array = array();
$parm_array = explode("|",$parm);
$parm_array[0] = varsettrue($parm_array[0], '');
$parm_array[1] = varsettrue($parm_array[1], '');
$parm_array[2] = varsettrue($parm_array[2], '');
$parm_array[3] = varsettrue($parm_array[3], '');
$parm_array[4] = varsettrue($parm_array[4], '');
if($mod == 'relative' || $mod_url) {
    $cfg = '';
    if($parm_array[0]) {
        $parm_array[0] = strtolower($parm_array[0]);
        $wh = explode(',', $parm_array[0]);
        $wh[0] = varsettrue($wh[0], 0);
        $wh[1] = varsettrue($wh[1], 0);
        $wh[2] = varset($wh[2], '');
        if( (!$wh[0] && !$wh[1]) || !is_numeric($wh[0]) || !is_numeric($wh[1])) {
            $cfgarr['w'] = $cfgarr['h'] = 0;
        } else {
            $cfgarr['w'] = intval($wh[0]);
            $cfgarr['h'] = intval($wh[1]);
        }
        $cfgarr['far'] = $wh[2] ? strtoupper($wh[2]) : $sgal_pref['sgal_far'];
    }

    //thumb HTML src
    $alt = SGAL_LAN_12;
	
	//New - lightview like options
	
	$tmp = explode('::', $parm_array[1]);
	if(varset($tmp[2])) {
		parse_str($tmp[2], $tmpopt);
		$style =  $parm_array[3] ? "float: ".$parm_array[3]."; ".varset($tmpopt['image_style']).";" : varset($tmpopt['image_style']);
	} else {
		$style =  $parm_array[3] ? "float: ".$parm_array[3]."; " : '';
	}
	
	$style =  $style ? " style='{$style}'" : '';
    $bbthumb = "<img src='".showThumb($thcode_text, $cfgarr, $mod)."' alt='{$alt}'{$style} />"; //temporrary fix
}

$widget = false;
if(array_key_exists('cl_widgets', $pref['plug_installed']) && class_exists('clw_widget')) {
    $cl_widget = &clw_widget::getInstance();
    if(clw_widget::isInstalled('shadowbox'))
    {
        $widget = $cl_widget->checkWidget('shadowbox');
        $_wbb = 'shadowbox';
    }
    elseif(clw_widget::isInstalled('lightview'))
    {
        $widget = $cl_widget->checkWidget('lightview');
        $_wbb = 'lightview';
    }
}

if($widget) {
    //create lightview bbcode
    $lvcode = "[{$_wbb}={$code_text}|{$parm_array[1]}|{$parm_array[2]}|{$parm_array[3]}]{$bbthumb}[/{$_wbb}]";
    
    if (!is_object($tp->e_bb)) {
    	require_once(e_HANDLER.'bbcode_handler.php');
    	$tp->e_bb = new e_bbcode;
    } 
    $imagelink = $tp->e_bb->parseBBCodes($lvcode, '');
    return $imagelink;
}

//use sgalSmartOpen to open self-resize popup
$pre = $parm_array[3] ? "<div style='float: ".strtolower($parm_array[3])."'>" : '';
$pst = $pre ? "</div>" : '';
if($mod == 'relative') {
    $alt = SGAL_LAN_12;
    $bbthumb = "{$pre}<a href='{$code_text}' onclick=\"sgalSmartOpen('".showJsThumb($thcode_text, $alt, $mod)."'); return false;\" title='".$alt."'>{$bbthumb}</a>{$pst}";
} else {
    $bbthumb = "{$pre}<a href='{$thcode_text}' target='_blank'>{$bbthumb}</a>{$pst}";
}
return $bbthumb;