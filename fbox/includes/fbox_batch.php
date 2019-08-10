<?php
//$Id: fbox_batch.php 670 2007-11-16 11:41:18Z secretr $
global $pref, $tp;
//e107 init & permission check
if (!defined('e107_INIT') || !check_class($pref['fbox_permission'])) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
$fbox_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);
/*
SC_BEGIN FBOX_TITLE
global $tp;
$fbox_item = getcachedvars('fbox_cdata');
return $tp -> toHTML($fbox_item['fbox_title'], FALSE, 'TITLE');
SC_END

SC_BEGIN FBOX_TITLE_NAV
global $tp;
$fbox_item = getcachedvars('fbox_cdata');
return $tp -> toHTML($fbox_item['fbox_title'], FALSE, 'TITLE');
SC_END

SC_BEGIN FBOX_TEXT
global $tp;
$fbox_item = getcachedvars('fbox_cdata');
return $tp -> toHTML($fbox_item['fbox_text'], TRUE, 'DESCRIPTION');
SC_END

SC_BEGIN FBOX_IMGPATH
global $tp;
$fbox_item = getcachedvars('fbox_cdata'); 
return $fbox_item['fbox_image'] ? $tp -> replaceConstants($fbox_item['fbox_image'], 'full') : '';
SC_END

SC_BEGIN FBOX_IMG
global $tp, $fbox_shortcodes;
$fbox_item = getcachedvars('fbox_cdata');
return $fbox_item['fbox_image'] ? "<img src='".$tp -> parseTemplate('{FBOX_IMGPATH}', false, $fbox_shortcodes)."' class='fbox-image' alt='' />" : '';
SC_END

SC_BEGIN FBOX_ID
$fbox_item = getcachedvars('fbox_cdata');
return $fbox_item['fbox_id'];
SC_END

SC_BEGIN FBOX_NUM
$fbox_item = getcachedvars('fbox_cdata'); 
return $fbox_item['fbox_num'];
SC_END

SC_BEGIN FBOX_NAVCLASS
$fbox_item = getcachedvars('fbox_cdata');
if(getcachedvars('fbox_active_item') == $fbox_item['fbox_id'])
    return 'fbox-nav-active';
else 
    return 'fbox-nav';
SC_END

SC_BEGIN FBOX_AJAXURL
$fbox_item = getcachedvars('fbox_cdata');
parse_str($fbox_item['fbox_parms'], $tmp);
$tmp1=array();
$tmp['get_one'] = 1;
$tmp['navigation'] = 0;
foreach ($tmp as $key=>$value) {
	$tmp1[] = "$key=$value";
}
return $fbox_item['fbox_id'].'.'.urlencode(implode('+', $tmp1));
SC_END
*/
?>