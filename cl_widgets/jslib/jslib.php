<?php
/*	$Id: jslib.php 1136 2010-08-29 12:09:09Z secretr $ */
clw_cache_out();
//preparing for 0.8
$_E107['minimal'] = TRUE;
// v0.7.23+ fix
define('e_TOKEN_FREEZE', true);

require_once ("../../../class2.php");
ob_start();
ob_implicit_flush(0);
require_once (e_PLUGIN.'cl_widgets/widget.php');
$cl_widget = &clw_widget::getInstance();
$cl_widget->run_jslib(true);
clw_page_out();
exit();

/**
 * Output buffered output. 
 * This function requires e107 API
 * 
 */
function clw_page_out()
{
	global $pref;
	reset($_GET);
	$request = explode('-', key($_GET));
	$parms = '';
	$lmodified = 0;
	$disable_enc = false;
	if(isset($request[0]))
	{
		$lmodified = intval($request[0]);
		$parms .= $lmodified;
	}
	if(isset($request[1]) && 'nocompression' === $request[1])
	{
		$parms .= 'nc';
		$disable_enc = true;
	}
	$encoding = clw_browser_enc($disable_enc);
	$etag = md5($encoding.$parms);
	if(function_exists('date_default_timezone_set'))
	{
		date_default_timezone_set('UTC');
	}
	
	// send last modified date
	header('Cache-Control: must-revalidate');
	if($lmodified)
		header('Last-modified: '.gmdate("D, d M Y H:i:s", $lmodified).' GMT', true);
		
	// send content type
	header('Content-type: text/javascript', true);
	
	// Expire header - 1 year
	$time = time() + 365 * 86400;
	header('Expires: '.gmdate("D, d M Y H:i:s", $time).' GMT', true);
	header("Etag: ".$etag, true);
	
	$contents = ob_get_contents();
	ob_end_clean();
	if($encoding)
	{
		$gzdata = "\x1f\x8b\x08\x00\x00\x00\x00\x00";
		$size = strlen($contents);
		$crc = crc32($contents);
		$gzdata .= gzcompress($contents, 9);
		$gzdata = substr($gzdata, 0, strlen($gzdata) - 4);
		$gzdata .= pack("V", $crc).pack("V", $size);
		$gsize = strlen($gzdata);
		if($pref['cl_widget_cache'])
			clw_jslib_cache($gzdata, $encoding, $parms);
		header('Content-Encoding: '.$encoding);
		header('Content-Length: '.$gsize);
		header('X-Content-size: '.$size); // real content size (no compression)
		print($gzdata);
		//@file_put_contents('../cache/log', 'no cache used - '.$encoding."\n Old size - $size, New compressed size - $gsize\n", FILE_APPEND);
		exit();
	}
	else
	{
		clw_jslib_cache($contents, '', $parms);
		header('Content-Length: '.strlen($contents));
		print($contents);
		//@file_put_contents('../cache/log', 'no cache used - raw'."\n", FILE_APPEND);
		exit();
	}
}

/**
 * Output server cache if available. 
 * It checks browser cache additionally.
 * 
 */
function clw_cache_out()
{
	reset($_GET);
	$request = explode('-', key($_GET)); //$_SERVER['QUERY_STRING']
	$parms = '';
	$lmodified = 0;
	$disable_enc = false;
	if(isset($request[0]))
	{
		$parms .= intval($request[0]);
		$lmodified = intval($request[0]);
	}
	if(isset($request[1]) && 'nocompression' === $request[1])
	{
		$parms .= 'nc';
		$disable_enc = true;
	}
	$enc = clw_browser_enc($disable_enc);
	$f = clw_is_jslib_cache($enc, $parms);
	$etag = md5($enc.$parms);
	if(function_exists('date_default_timezone_set'))
	{
		date_default_timezone_set('UTC');
	}
	// check browser cache - if not modified - send 304 and exit
	if((isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $lmodified) && (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag))
	{
		header("HTTP/1.1 304 Not Modified", true);
		//header('X-HTTP-IF-NONE-MATCH: '.$etag);
		//@file_put_contents('../cache/log', 'Browser cache used before api!'."\n", FILE_APPEND);
		exit();
	}
	if($f && is_file($f) && is_readable($f))
	{
		// send last modified date
		header('Cache-Control: must-revalidate');
		if($lmodified)
			header('Last-modified: '.gmdate("D, d M Y H:i:s", $lmodified).' GMT', true);
			// send content type
		header('Content-type: text/javascript', true);
		// Expire header - 1 year
		$time = time() + 365 * 86400;
		header('Expires: '.gmdate("D, d M Y H:i:s", $time).' GMT', true);
		header("Etag: ".$etag, true);
		header('Content-Length: '.filesize($f));
		if($enc)
			header('Content-Encoding: '.$enc);
		echo @file_get_contents($f);
		//@file_put_contents('../cache/log', 'cache used - '.$f."\n", FILE_APPEND);
		exit();
	}
}

/**
 * Check jslib cache
 * @param string $enc supported browser/server compression
 * @param string $parms parameters
 * @return boolean
 */
function clw_is_jslib_cache($enc, $parms = '')
{
	$f = 'jslib.'.$enc.$parms.'.js';
	$path = '../cache/';
	$mAge = 24 * 60;
	if(is_file($path.$f) && is_readable($path.$f))
	{
		if((filemtime($path.$f) + ($mAge * 60)) < time())
		{
			unlink($path.$f);
			return false;
		}
		return $path.$f;
	}
	return false;
}

/**
 * Get supported browser/server compression
 * 
 * @param boolean $force_disable disble compression
 * @return string browser encoding (Content-Encoding header)
 */
function clw_browser_enc($force_disable = false)
{
	if($force_disable || headers_sent() || !function_exists('gzcompress') || ini_get("zlib.output_compression"))
	{
		$encoding = '';
	}
	elseif(strpos($_SERVER["HTTP_ACCEPT_ENCODING"], 'x-gzip') !== false)
	{
		$encoding = 'x-gzip';
	}
	elseif(strpos($_SERVER["HTTP_ACCEPT_ENCODING"], 'gzip') !== false)
	{
		$encoding = 'gzip';
	}
	else
	{
		$encoding = '';
	}
	return $encoding;
}

/**
 * Cache jslib - create jslib[encoding][parms].js
 * Temporary solution (maybe) while 0.8 is out
 * 
 * @param string $contents JS content
 * @param string $encoding supported compression method
 * @param string $parms additional parameters
 */
function clw_jslib_cache($contents, $encoding = '', $parms = '')
{
	$cacheDir = CLW_APP.'cache/';
	$cacheFile = $cacheDir.'jslib.'.$encoding.$parms.'.js';
	//TODO - log error
	if(!is_writable($cacheDir))
		return false;
	@file_put_contents($cacheFile, $contents);
	@chmod($cacheFile, 0777);
	@touch($cacheFile);
}
?>