<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system
|        Thumb functions: e107_plugins/sgallery/includes/ajax_thumb_functions.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

if(!function_exists('phpThumbURL')) {
    require_once(SGAL_INCPATH.'phpThumb.config.php');
}

/**
* @return full url to the thumb.php
* @desc TO DO
*/

function showThumb($imgdir, $cfgarr='', $mod = 'gallery', $scrpath='')
{
    global $PHPTHUMB_CONFIG;

    $imgdir = trim($imgdir);
    if(!$scrpath) $scrpath = SGAL_INCPATH_ABS;
    if (preg_match("#\.php\?.*#",$imgdir)) {
        return '';
    }

	if(empty($cfgarr)) $cfgarr = array();
	$cfg = is_array($cfgarr) ? setThQuery(setThVal($cfgarr, basename($imgdir))) : $cfgarr;

	if($mod == 'gallery') {
	   //relativen pyt ot thumb.php do snimkata !
	   $thRelPath = '../pics/'.$imgdir;
	} elseif($mod == 'relative') {
	   //used with absolute relative path created with makeURL
	   $img = $imgdir{0}=='/' ? substr($imgdir,1) : $imgdir;
       $thRelPath = '../../../'.$img; //path to e107 root + absolute path to the image
    } else {
        //any other case including 'url'
         $thRelPath = $imgdir;
    }

    //fix TODO - remove $scrpath parameter
    $scrpath = SGAL_INCPATH_ABS;
	return $scrpath.phpThumbURL('src='.$thRelPath.$cfg);
}

/**
* @return full url to the showthumb.php
* @desc TO DO
*/
function showJsThumb($imgdir, $ttl='', $mod = 'gallery')
{
    global $tp, $PHPTHUMB_CONFIG;
    $imgdir = trim($imgdir);
    if(!$scrpath) $scrpath = SGAL_INCPATH;
    if (preg_match("#\.php#",$imgdir)) {
        return '';
    }

	if($mod == 'gallery') {
	   //relativen pyt ot thumb.php do snimkata !
	   $thRelPath = '../pics/'.$imgdir;
	} elseif($mod == 'relative') {
	   //used with absolute relative path created with makeURL
	   $img = $imgdir{0}=='/' ? substr($imgdir,1) : $imgdir;
       $thRelPath = '../../../'.$img;//path to e107 root + absolute path to the image
    } else {
        //any other case including 'url'
         $thRelPath = $imgdir;
    }

    if($ttl) {
        //$ttl = str_replace("'", "", $ttl);
        $ttl = '+title='.str_replace(' ', '_',$ttl);
    }
    if($mod == 'url') return SGAL_PATH_ABS.phpJsThumbURL('src='.$thRelPath.'+cache_force_passthru=1').$ttl;
	return SGAL_PATH_ABS.phpJsThumbURL('src='.$thRelPath).$ttl;
}

/**
* @return full url to the image
* @desc used with the thumb.bb
*/
function makeURL($imgdir)
{
    global $tp,$IMAGES_DIRECTORY,$FILES_DIRECTORY,$THEMES_DIRECTORY,$ADMIN_DIRECTORY,$PLUGINS_DIRECTORY,$e107;
    $imgdir = trim($imgdir);

    //to constant
    /*$search = array(e_IMAGE, e_FILE, e_ADMIN, e_THEME, e_PLUGIN);
    $replace = array('{e_IMAGE}', '{e_FILE}', '{e_ADMIN}', '{e_THEME}', '{e_PLUGIN}');
    $imgdir = str_replace($search, $replace, $imgdir);*/
    $imgdir = $tp->createConstants($imgdir,1);


    //create absolute path
    /*$search = array('{e_IMAGE}', '{e_FILE}', '{e_ADMIN}', '{e_THEME}', '{e_PLUGIN}');
    $replace = array($e107->http.$IMAGES_DIRECTORY, $e107->http.$FILES_DIRECTORY, $e107->http.$ADMIN_DIRECTORY, $e107->http.$THEMES_DIRECTORY, $e107->http.$PLUGINS_DIRECTORY);
    $imgdir = str_replace($search, $replace, $imgdir);*/
    //$imgdir = $imgdir{0}=='/' ? substr($imgdir,1) : $imgdir;
    $imgdir = $tp->replaceConstants($imgdir,TRUE);
	return $imgdir;
}

/**
* @return string
* @desc creates valid XHTML GET string to be used from showThumb()
*/
function setThQuery($cfgarr = array())
{
   if(empty($cfgarr) || !is_array($cfgarr))
		return '';

   $tmp = '';

   //parameters
   foreach ($cfgarr as $key => $value) {
	   if($key == 'fltr') {
			//value is array
			foreach ($value as $parm) {
				$tmp .= "+fltr[]={$parm}";
			}
	   } else {
			$tmp .= "+{$key}={$value}";
	   }
   }

   return $tmp;
}

/**
* @return config array
* @desc set config values
* @access public
*/
function setThVal($cfgarr='', $fname = '')
{
    global $sgal_pref;
    $ret = array();
    $ret['q'] = varsettrue($cfgarr['q'], 80);

    if(varset($cfgarr['far'],$sgal_pref['sgal_far'])) {
        $ret['far'] = varset($cfgarr['far'], $sgal_pref['sgal_far']); //Force Aspect Ratio
        $ret['w'] =  varsettrue($cfgarr['w'], $sgal_pref['sgal_thumb_w']); //exact width - landscape
        $ret['h'] = varsettrue($cfgarr['h'], $sgal_pref['sgal_thumb_h']); //exact height - landscape
    } else {
        $ret['wp'] = varsettrue($cfgarr['h'], $sgal_pref['sgal_thumb_h']); //max width - portrait
        $ret['wl'] = varsettrue($cfgarr['w'], $sgal_pref['sgal_thumb_w']); //max width - landscape
        $ret['hp'] = varsettrue($cfgarr['w'], $sgal_pref['sgal_thumb_w']); //max height - portrait
        $ret['hl'] = varsettrue($cfgarr['h'], $sgal_pref['sgal_thumb_h']); //max height - landscape
    }
    $ret['iar'] = 0; //to do - pref ??? - Ignore Aspect Ratio
    $ret['bg'] = varsettrue($cfgarr['bg'], $sgal_pref['sgal_bg']); //background color

	if(!isset($cfgarr['f']) || empty($cfgarr['f']))
	{
		$fext = strtolower(substr(strrchr($fname, "."), 1));
		switch ($fext)
		{
			case 'gif':
			case 'png':
				$ret['f'] = $fext;
			break;

			default:
				$ret['f'] = 'jpeg';
			break;
		}

	}

    return $ret;
}
?>