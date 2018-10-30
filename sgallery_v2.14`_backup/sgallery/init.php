<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Gallery Init : e107_plugins/sgallery/init.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 776 $
|        $Date: 2009-01-20 12:05:00 +0200 (Tue, 20 Jan 2009) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/ 
if (!defined('e107_INIT')) { exit; }
global $sql, $sgalobj, $PHPTHUMB_CONFIG;

if(!session_id())
	@session_start(); //without errors... 
	
//gallery defs --------------------------------------------------->
define("SGAL_PATH", e_PLUGIN.'sgallery/');
define("SGAL_PATH_ABS", e_PLUGIN_ABS.'sgallery/');

define("SGAL_IMAGES", SGAL_PATH.'images/');
define("SGAL_IMAGES_ABS", SGAL_PATH_ABS.'images/');

define("SGAL_LANPATH", SGAL_PATH.'languages/');
define("SGAL_LAN", SGAL_PATH.'languages/'.e_LANGUAGE);

define("SGAL_ALBUMPATH", SGAL_PATH.'pics/');
define("SGAL_ALBUMPATH_ABS", SGAL_PATH_ABS.'pics/');

define("SGAL_INCPATH", SGAL_PATH.'includes/');
define("SGAL_INCPATH_ABS", SGAL_PATH_ABS.'includes/');

define("SGAL_PUBLISH", SGAL_PATH.'publish_xp/');
define("SGAL_PUBLISH_ABS", SGAL_PATH_ABS.'publish_xp/');

define("SGAL_TMPL", SGAL_PATH.'templates/');

// gallery prefs --------------------------------------------------->
require_once(SGAL_INCPATH.'sgal_class.php');
$sgalobj = new clgallery();
$sgal_pref = $sgalobj -> getPref();

$THCONFIG_DEF = $sgalobj -> defThconfig();

//default thumb configuration array - picture list, sitewide
require_once(SGAL_INCPATH.'sgal_thumb_functions.php');
$THCONFIG_THDEF = setThVal();

//bigfix - missing vars in sgal menus ?!
define("SGAL_NOTEMP_REJ", '^[_]{2}');
define("SGAL_TEMPONLY_REJ", '^[^_]{2}');
define("SGAL_APPROVE_FMASK", '^[_]{2}(app_).*(.jpg|.jpeg|.gif|.png|.bmp|.JPG|.JPG|.GIF|.PNG|.BMP)$');
define("SGAL_PIC_FMASK",".jpg|.jpeg|.gif|.png|.bmp|.JPG|.JPEG|.GIF|.PNG|.BMP");
define("SGAL_UPFTYPES","jpg,jpeg,gif,png,bmp");
//sgal reject files
//$SGAL_NOTEMP_REJ = explode(',', SGAL_NOTEMP_REJ);
//$SGAL_TEMPONLY_REJ = explode(',', SGAL_TEMPONLY_REJ);
//$SGAL_PIC_FMASK = SGAL_PIC_FMASK;

if(!defined('UTF8')) {
    //check for utf-8 compat handler (yet in Bulgarian distribution only)
    if(is_file(e_HANDLER.'utf8/utf8.php'))
        require_once(e_HANDLER.'utf8/utf8.php');
    else {
        define('UTF8', false);
    }
}

//Multi language fix - used in some sql queries
define("SGAL_MTABLE", $sql -> db_IsLang('sgallery'));
define("SGAL_CTABLE", $sql -> db_IsLang('sgallery_cats'));
define("SGAL_STABLE", $sql -> db_IsLang('sgallery_submit'));

//cl gallery environment initialized
define("SGAL_INIT", TRUE);

//use proper utf8 truncate if possible
function sgal_utf8_html_truncate ($text, $len = 200, $more = "[more]", $exact = true)
{
	global $tp;
	if(method_exists($tp, 'ustrlen'))
	{
		return $tp->html_truncate($text, $len, $more, exact);
	}
	$rtext = strip_tags($text);   
	$pos = UTF8 ? utf8_strlen($rtext) : strlen($rtext);
	if($pos<=$len) return $text;
	
	$ret = UTF8 ? utf8_substr($rtext, 0, $len) : substr($rtext, 0, $len);
	$ret = $ret.$more;
	return $ret;
}
//size converter
function sgal_convsize($size, $noval_label='') {
    if(!$size) return $noval_label;
    $kb = 1024;
    $mb = 1024*$kb;
    $gb = 1024*$mb;

    if($size >= $gb) {
        return round(($size/$gb),2)." gb";
    }
    elseif($size >= $mb) {
        return round(($size/$mb),2)." mb";
    }
    elseif($size >= $kb) {
        return round(($size/$kb),2)." kb";
    }
    else {
        return $size." b";
    }
}
function sgal_dirsize($dirname, $fmask='', $omit='') {
    if (!is_dir($dirname) || !is_readable($dirname)) {
        return false;
    }
    if(!$omit) $omit = array();
    elseif(!is_array($omit)) $omit = array($omit);
    $dirname_stack[] = $dirname;
    $size = 0;

    do {
        $dirname = array_shift($dirname_stack);
        $handle = opendir($dirname);
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..' && is_readable($dirname . DIRECTORY_SEPARATOR . $file)) {
                if (is_dir($dirname . DIRECTORY_SEPARATOR . $file)) {
                    $dirname_stack[] = $dirname . DIRECTORY_SEPARATOR . $file;
                } elseif($fmask == '' || preg_match("#".$fmask."#", $file)) {
    				$rejected = FALSE;
                    foreach($omit as $rmask)
    				{
                        if(preg_match("#".$rmask."#", $file))
    					{
    						$rejected = TRUE;
    						break;
    					}
    				}
    				if($rejected == FALSE)
    				{
                        $size += filesize($dirname . DIRECTORY_SEPARATOR . $file);
                    }
                }
            }
        }
        closedir($handle);
    } while (count($dirname_stack) > 0);

    return $size;
}

function clSimpleParser($tmplstring, $vars = array(), $mode = 'return') {
	global $tp;

	foreach ($vars as $key => $value)
	{
		$key = '{'. strtoupper($key).'}';
		$tmplstring = str_replace($key, $value, $tmplstring);

	}

	if($mode == 'return') return $tmplstring;
	echo $tmplstring;
}
?>