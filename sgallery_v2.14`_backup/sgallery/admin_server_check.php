<?php
//////////////////////////////////////////////////////////////
///  phpThumb() by James Heinrich <info@silisoftware.com>   //
//        available at http://phpthumb.sourceforge.net     ///
//////////////////////////////////////////////////////////////
///                                                         //
// phpThumb.demo.check.php                                  //
// James Heinrich <info@silisoftware.com>                   //
//                                                          //
// Configuration analyzer for phpThumb settings and server  //
// settings that may affect phpThumb performance            //
// Live demo is at http://phpthumb.sourceforge.net/demo/    //
//                                                          //
//////////////////////////////////////////////////////////////

//e107 ported - secretr - experimental version 
if (!defined('e107_INIT')) { exit; }

//not authorized
if(!ADMIN) { header("location:".e_BASE."index.php"); exit; } 
//main admin only!!!
if(!getperms('0')){ 'Please login as Main Admin!'; exit; } 

$ServerInfo['gd_string']  = 'unknown';
$ServerInfo['gd_numeric'] = 0;

include_once(SGAL_INCPATH.'phpthumb.functions.php');
include_once(SGAL_INCPATH.'phpthumb.class.php');


$phpThumb = new phpThumb();
include_once(SGAL_INCPATH.'phpThumb.config.php');

foreach ($PHPTHUMB_CONFIG as $key => $value) {
	$keyname = 'config_'.$key;
	$phpThumb->setParameter($keyname, $value);
}


$ServerInfo['gd_string']  = phpthumb_functions::gd_version(true);
$ServerInfo['gd_numeric'] = phpthumb_functions::gd_version(false);
$ServerInfo['im_version'] = $phpThumb->ImageMagickVersion();
$gd_info                  = gd_info();

?>
This script analyzes your settings (phpThumb.config.php and server/PHP) for <a href="http://phpthumb.sourceforge.net"><b>phpThumb()</b></a> <em>(English only)</em><br>
<br>
<table class="fborder">
	<tr><th colspan="8">&lt;-- bad . . . . . good --&gt;</th></tr>
	<tr>
		<td bgcolor="red">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td bgcolor="orange">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td bgcolor="yellow">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td bgcolor="olive">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td bgcolor="darkgreen">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td bgcolor="green">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td bgcolor="lightgreen">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td bgcolor="lime">&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>
</table>
<br />
<table class="fborder" cellspacing="0" cellpadding="2">
<tr bgcolor="#EEEEEE"><th class="fcaption">Setting</th><th class="fcaption" colspan="2">Value</th><th class="fcaption">Comments</th></tr>
<?php

$versions['raw'] = array(
	'latest' => phpthumb_functions::SafeURLread('http://phpthumb.sourceforge.net/?latestversion=1', $dummy),
	'this'   => $phpThumb->phpthumb_version,
);
foreach ($versions['raw'] as $key => $value) {
	preg_match('#^([0-9\.]+)\-?(([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2}))?#i', $value, $matches);
	@list($huge, $major, $minor) = @explode('.', @$matches[1]);
	@list($year, $month, $day, $hour, $min) = @$matches[3];
	$versions['base'][$key]  = $matches[1];
	$versions['huge'][$key]  = $huge;
	$versions['major'][$key] = $major;
	$versions['minor'][$key] = $minor;
	$versions['stamp'][$key] = $matches[2];
	$versions['year'][$key]  = $year;
	$versions['month'][$key] = $month;
	$versions['day'][$key]   = $day;
	$versions['hour'][$key]  = $hour;
	$versions['min'][$key]   = $min;
	$versions['date'][$key]  = @mktime($hour, $min, 0, $month, $day, $year);
}

$downloadlatest = 'Download the latest version from <a href="http://phpthumb.sourceforge.net">http://phpthumb.sourceforge.net</a>';
echo '<tr><th class="forumheader3" nowrap><strong>Latest phpThumb version:</strong></th><th class="forumheader3" colspan="2"><strong>'.$versions['raw']['latest'].'</strong></th><td class="forumheader3">'.$downloadlatest.'</td></tr>';
echo '<tr><th class="forumheader3" nowrap><strong>This phpThumb version:</strong></th><th class="forumheader3" colspan="2" style="font-weight: bold; background-color:';

if (!$versions['base']['latest']) {
	// failed to get latest version number
	echo 'white';
	$message = 'Latest version unknown.<br>'.$downloadlatest;
} elseif (phpthumb_functions::version_compare_replacement($versions['base']['this'], $versions['base']['latest'], '>')) {
	// new than latest, must be beta version
	echo 'lightblue';
	$message = 'This must be a pre-release beta version. Please report bugs to <a href="mailto:info@silisoftware.com">info@silisoftware.com</a>';
} elseif (($versions['base']['latest'] == $versions['base']['this']) && ($versions['stamp']['this'] > $versions['stamp']['latest'])) {
	// new than latest, must be beta version
	echo 'lightblue';
	$message = 'You must be using a pre-release beta version. Please report bugs to <a href="mailto:info@silisoftware.com">info@silisoftware.com</a>';
} elseif ($versions['base']['latest'] == $versions['base']['this']) {
	// latest version
	echo 'lime';
	$message = 'You are using the latest released version.';
} elseif ($versions['huge']['latest'].$versions['major']['latest'] == $versions['huge']['this'].$versions['major']['this']) {
	echo 'olive';
	$message = 'One (or more) minor version(s) have been released since this version.<br>'.$downloadlatest;
} elseif (floatval($versions['huge']['latest'].str_pad($versions['major']['latest'], 2, '0', STR_PAD_LEFT)) < floatval($versions['huge']['this'].str_pad($t_major, 2, '0', STR_PAD_LEFT))) {
	echo 'yellow';
	$message = 'One (or more) major version(s) have been released since this version, you really should upgrade.<br>'.$downloadlatest;
} else {
	echo 'orange';
	$message = 'Fundamental changes have been made since this version.<br>'.$downloadlatest;
}
echo '"><strong>'.$phpThumb->phpthumb_version.'</strong>';
echo '</th><td class="forumheader3">'.$message.'.<br></td></tr>';


echo '<tr><th class="forumheader3"><strong>phpThumb.config.php:</strong></th><th class="forumheader3" colspan="2" style="background-color:';
if (file_exists(SGAL_INCPATH.'phpThumb.config.php') && !file_exists(SGAL_INCPATH.'phpThumb.config.php.default')) {
	echo 'lime"><strong>"phpThumb.config.php" exists</strong>';// and "phpThumb.config.php.default" does not
/*} elseif (file_exists('../phpThumb.config.php') && file_exists('../phpThumb.config.php.default')) {
	echo 'yellow">"phpThumb.config.php" and "phpThumb.config.php.default" both exist';
} elseif (!file_exists('../phpThumb.config.php') && file_exists('../phpThumb.config.php.default')) {
	echo 'yellow">rename "phpThumb.config.php.default" to "phpThumb.config.php"';*/
} else {
	echo 'yellow"><strong>"phpThumb.config.php" not found</strong> ';//(nor "phpThumb.config.php")
}
echo '</th><td class="forumheader3" >phpThumb configuration file</td></tr>';
//echo '</th><td>"phpThumb.config.php.default" that comes in the distribution must be renamed to "phpThumb.config.php" before phpThumb.php can be used. Avoid having both files present to minimize confusion.</td></tr>';


echo '<tr><th class="forumheader3"><strong>cache directory:</strong></th><th class="forumheader3" style="font-weight: bold; padding: 0px; background-color: lime" colspan="2">';
$orig_config_cache_directory = $phpThumb->config_cache_directory;
$phpThumb->setCacheDirectory();
echo '<div style="background-color: '.(     is_dir($phpThumb->config_cache_directory) ? 'lime; margin: 0px; padding: 5px; height: 100%">exists' : 'red; margin: 0px; padding: 5px; height: 100%">does NOT exist').'</div>';
echo '<div style="background-color: '.(is_readable($phpThumb->config_cache_directory) ? 'lime; margin: 0px; padding: 5px; height: 100%">readable' : 'red; margin: 0px; padding: 5px; height: 100%">NOT readable').'</div>';
echo '<div style="background-color: '.(is_writable($phpThumb->config_cache_directory) ? 'lime; margin: 0px; padding: 5px; height: 100%">writable' : 'red; margin: 0px; padding: 5px; height: 100%">NOT writable').'</div>';
echo '</th><td class="forumheader3">Original: "'.htmlentities($orig_config_cache_directory).'"<br>Resolved: "'.htmlentities($phpThumb->config_cache_directory).'"<br>Must exist and be both readable and writable by PHP.</td></tr>';


echo '<tr><th class="forumheader3"><strong>temp directory:</strong></th><th class="forumheader3" style="font-weight: bold; padding: 0px;background-color: lime" colspan="2">';
$orig_config_temp_directory = $phpThumb->config_temp_directory;
$phpThumb->phpThumb_tempnam();
echo '<div style="background-color: '.(     is_dir($phpThumb->config_temp_directory) ? 'lime; margin: 0px; padding: 5px; height: 100%">exists' : 'red; margin: 0px; padding: 5px; height: 100%">does NOT exist').'</div>';
echo '<div style="background-color: '.(is_readable($phpThumb->config_temp_directory) ? 'lime; margin: 0px; padding: 5px; height: 100%">readable' : 'red; margin: 0px; padding: 5px; height: 100%">NOT readable').'</div>';
echo '<div style="background-color: '.(is_writable($phpThumb->config_temp_directory) ? 'lime; margin: 0px; padding: 5px; height: 100%">writable' : 'red; margin: 0px; padding: 5px; height: 100%">NOT writable').'</div>';
echo '</th><td class="forumheader3">Original: "'.htmlentities($orig_config_temp_directory).'"<br>Resolved: "'.htmlentities($phpThumb->config_temp_directory).'"<br>Must exist and be both readable and writable by PHP.</td></tr>';


echo '<tr><th class="forumheader3"><strong>PHP version:</strong></th><th class="forumheader3" colspan="2" style="background-color:';
if (phpthumb_functions::version_compare_replacement(phpversion(), '5.0.0', '>=')) {
	echo 'lime';
} elseif (phpthumb_functions::version_compare_replacement(phpversion(), '4.4.2', '=')) {
	echo 'darkgreen';
} elseif (phpthumb_functions::version_compare_replacement(phpversion(), '4.3.3', '>=')) {
	echo 'lightgreen';
} elseif (phpthumb_functions::version_compare_replacement(phpversion(), '4.2.0', '>=')) {
	echo 'green';
} elseif (phpthumb_functions::version_compare_replacement(phpversion(), '4.1.0', '>=')) {
	echo 'yellow';
} elseif (phpthumb_functions::version_compare_replacement(phpversion(), '4.0.6', '>=')) {
	echo 'orange';
} else {
	echo 'red';
}
echo '"><strong>'.phpversion().'</strong>';
echo '</th><td class="forumheader3">PHP5 is ideal (support for numerous built-in filters which are much faster than my code).<br>PHP v4.4.2 contains a bug in fopen over HTTP (phpThumb has a workaround)<br>PHP v4.3.2+ supports ImageSaveAlpha which is required for proper PNG/ICO output.<br>ImageRotate requires PHP v4.3.0+ (but buggy before v4.3.3).<br>EXIF thumbnail extraction requires PHP v4.2.0+.<br>Most things will work back to PHP v4.1.0, and mostly (perhaps buggy) back to v4.0.6, but no guarantees for any version older than that.</td></tr>';


echo '<tr><th class="forumheader3"><strong>GD version:</strong></th><th class="forumheader3" colspan="2" style="background-color:';
if ($ServerInfo['gd_numeric'] >= 2) {
	if (preg_match('#bundled#i', @$ServerInfo['gd_string'])) {
		echo 'lime';
	} else {
		echo 'yellow';
	}
} elseif ($ServerInfo['im_version']) {
	echo 'orange';
} else {
	echo 'red';
}
echo '"><strong>'.@$ServerInfo['gd_string'].'</strong>';
echo '</th><td class="forumheader3">GD2-bundled version is ideal.<br>GD2 (non-bundled) is second choice, but there are a number of bugs in the non-bundled version. ImageRotate is only available in the bundled version of GD2.<br>GD1 will also (mostly) work, at much-reduced image quality and several features disabled. phpThumb can perform most operations with ImageMagick only, even if GD is not available.</td></tr>';


echo '<tr><th class="forumheader3"><strong>ImageMagick version:</strong></th><th class="forumheader3" colspan="2" style="font-weight: bold; background-color:';
if (preg_match('# ([0-9]+)/([0-9]+)/([0-9]+) #', $ServerInfo['im_version'], $matches)) {
	list($dummy, $m, $d, $y) = $matches;
	if ($y < 70) {
		$y += 2000;
	} elseif ($y < 100) {
		$y += 1900;
	}
	$IMreleaseDate = mktime(12, 0, 0, $m, $d, $y);
	$IMversionAge = (time() - $IMreleaseDate) / 86400;
}
if ($ServerInfo['im_version']) {
	if ($IMversionAge < (365 * 1)) {
		echo 'lime';
	} elseif ($IMversionAge < (365 * 2)) {
		echo 'lightgreen';
	} elseif ($IMversionAge < (365 * 3)) {
		echo 'green';
	} elseif ($IMversionAge < (365 * 4)) {
		echo 'darkgreen';
	} else {
		echo 'olive';
	}
} elseif (@$ServerInfo['gd_string']) {
	echo 'orange';
} else {
	echo 'red';
}
echo '">"'.$phpThumb->ImageMagickCommandlineBase().'"<br>'.($ServerInfo['im_version'] ? $ServerInfo['im_version'] : 'n/a').(@$IMversionAge ? '<br><br>This version of ImageMagick is '.number_format($IMversionAge / 365, 2).' years old<br>(see www.imagemagick.org for new versions)' : '');
echo '</th><td class="forumheader3">ImageMagick is faster than GD, can process larger images without PHP memory_limit issues, can resize animated GIFs. phpThumb can perform most operations with ImageMagick only, even if GD is not available.</td></tr>';


echo '<tr><th class="forumheader3"><strong>ImageMagick features:</strong></th><th class="forumheader3" style="font-weight: bold" colspan="2">|';
$GDfeatures['red']    = array('help', 'thumbnail', 'resize', 'crop', 'repage', 'coalesce', 'gravity', 'background', 'interlace', 'flatten', 'border', 'bordercolor', 'dither', 'quality');
$GDfeatures['orange'] = array('version', 'blur', 'colorize', 'colors', 'colorspace', 'contrast', 'contrast-stretch', 'edge', 'emboss', 'fill', 'flip', 'flop', 'gamma', 'gaussian', 'level', 'modulate', 'monochrome', 'negate', 'normalize', 'sepia-tone', 'threshold', 'unsharp');
foreach ($GDfeatures as $missingcolor => $features) {
	foreach ($features as $dummy => $feature) {
		echo '| <span style="background-color: '.($phpThumb->ImageMagickSwitchAvailable($feature) ? 'lime' : $missingcolor).';">'.htmlentities($feature).'</span> |';
	}
}
echo '|</th><td class="forumheader3">All of these parameters may be called by phpThumb, depending on parameters used.  Green means the feature is available; red means a critical feature is missing; orange means an optional filter/feature is missing.</td></tr>';


echo '<tr><th class="forumheader3"><strong>ImageMagick formats:</strong></th><th class="forumheader3" colspan="2" style="text-align: center"><textarea rows="10" cols="50" wrap="off">';
echo htmlentities($phpThumb->ImageMagickFormatsList());
echo '</textarea></th><td class="forumheader3">ImageMagick can only read/write formats as listed here. You may need to recompile ImageMagick if you need to use a format not listed</td></tr>';


echo '<tr><th class="forumheader3"><strong>GD features:</strong></th><th class="forumheader3" style="background-color: lime; padding: 0px; font-weight: bold" colspan="2">';
$GDfeatures['red']    = array('JPG Support', 'PNG Support');
$GDfeatures['orange'] = array('GIF Read Support', 'GIF Create Support', 'FreeType Support');
if(!isset($gd_info['JPG Support']))
{
	$gd_info['JPG Support'] = $gd_info['JPEG Support'];
}
foreach ($GDfeatures as $missingcolor => $features) {
	foreach ($features as $dummy => $feature) {
		echo '<div style="background-color: '.($gd_info[$feature] ? 'lime; margin: 0px; padding: 5px;' : $missingcolor).'; margin: 0px; padding: 5px;">'.htmlentities($feature).'</div>';
	}
}
echo '</th><td class="forumheader3">PNG support is required for watermarks, overlays, calls to ImageMagick and other internal operations.<br>JPG support is obviously quite useful, but ImageMagick can substitute<br>GIF read support can be bypassed with ImageMagick and/or internal GIF routines.<br>GIF create support can be bypassed with ImageMagick (if no filters are applied)<br>FreeType support is needed for TTF overlays.</td></tr>';


echo '<tr><th class="forumheader3"><strong>GD extension "EXIF"</strong></th><th class="forumheader3" colspan="2" style="font-weight: bold; background-color:';
if (extension_loaded('exif')) {
	echo 'lime';
} elseif (@$ServerInfo['gd_string']) {
	echo 'orange';
}
echo '">'.(extension_loaded('exif') ? 'TRUE' : 'FALSE');
echo '</th><td class="forumheader3">EXIF extension required for auto-rotate images. Also required to extract EXIF thumbnail to use as source if source image is too large for PHP memory_limit and ImageMagick is unavailable.</td></tr>';


echo '<tr><th class="forumheader3"><strong>php_sapi_name()</strong></th><th class="forumheader3" colspan="2" style="font-weight: bold; background-color:';
$php_sapi_name = strtolower(function_exists('php_sapi_name') ? php_sapi_name() : '');
if (!$php_sapi_name) {
	echo 'red';
} elseif ($php_sapi_name == 'cgi-fcgi') {
	echo 'orange';
} elseif ($php_sapi_name == 'cgi') {
	echo 'yellow';
} elseif ($php_sapi_name == 'apache') {
	echo 'lime';
} else {
	echo 'green';
}
echo '">'.$php_sapi_name.'</th>';
echo '<td class="forumheader3">SAPI mode preferred to CGI mode. FCGI mode has unconfirmed strange behavior (notably more than one space in "wmt" filter text causes errors). If not working in "apache" (SAPI) mode, <i>apache_lookup_uri()</i> will not work.</td></tr>';


echo '<tr><th class="forumheader3"><strong>Server Software</strong></th><th class="forumheader3" colspan="2" style="font-weight: bold; background-color:';
$server_software = getenv('SERVER_SOFTWARE');
if (!$server_software) {
	echo 'red';
} elseif (preg_match('#^Apache/([0-9\.]+)#i', $server_software, $matches)) {
	if (phpthumb_functions::version_compare_replacement($matches[1], '2.0.0', '>=')) {
		echo 'lightgreen';
	} else {
		echo 'lime';
	}
} else {
	echo 'darkgreen';
}
echo '">'.$server_software.'</th>';
echo '<td class="forumheader3">Apache v1.x has the fewest compatability problems. IIS has numerous annoyances. Apache v2.x is broken when lookup up <i>/~user/filename.jpg</i> style relative filenames using <i>apache_lookup_uri()</i>.</td></tr>';


echo '<tr><th class="forumheader3">curl_version:</th><th class="forumheader3" colspan="2" style="font-weight: bold; background-color:';
$curl_version = (function_exists('curl_version') ? curl_version() : '');
if (is_array($curl_version)) {
	$curl_version = @$curl_version['version'];
}
if ($curl_version) {
	echo 'lime';
} else {
	echo 'yellow';
}
echo '">'.$curl_version.'</th>';
echo '<td class="forumheader3">Best if available. HTTP source images will be unavailable if CURL unavailable and <i>allow_url_fopen</i> is also disabled.</td></tr>';

echo '<tr><th colspan="4">&nbsp;</th></tr>';
echo '<tr><th class="fcaption">function_exists:</th><th class="fcaption" colspan="2">Value</th><th class="fcaption">Comments</th></tr>';

$FunctionsExist = array(
	'ImageRotate'           => array('orange',     'required for "ra" and "ar" filters.'),
	'exif_read_data'        => array('yellow',     'required for "ar" filter.'),
	'exif_thumbnail'        => array('yellow',     'required to extract EXIF thumbnails.'),
	'memory_get_usage'      => array('lightgreen', 'mostly used for troubleshooting.'),
	'version_compare'       => array('darkgreen',  'available in PHP v4.1.0+, internal workaround available'),
	'file_get_contents'     => array('darkgreen',  'available in PHP v4.3.0+, internal workaround available'),
	'file_put_contents'     => array('darkgreen',  'available in PHP v5.0.0+, internal workaround available'),
	'is_executable'         => array('yellow',     'available in PHP3, except only PHP5 for Windows. poor internal workaround available'),
	'gd_info'               => array('olive',      'available in PHP v4.3.0+ (with bundled GD2), internal workaround available'),
	'ImageTypes'            => array('red',        'required for GD image output.'),
	'ImageCreateFromJPEG'   => array('orange',     'required for JPEG source images using GD.'),
	'ImageCreateFromGIF'    => array('yellow',     'useful for GIF source images using GD.'),
	'ImageCreateFromPNG'    => array('orange',     'required for PNG source images using GD and other source image formats using ImageMagick.'),
	'ImageCreateFromWBMP'   => array('yellow',     'required for WBMP source images using GD.'),
	'ImageCreateFromString' => array('orange',     'required for HTTP and non-file image sources.'),
	'ImageCreateTrueColor'  => array('orange',     'required for all non-ImageMagick filters.'),
	'ImageIsTrueColor'      => array('olive',      'available in PHP v4.3.2+ with GD v2.0.1+'),
	'ImageFilter'           => array('yellow',     'PHP5 only. Required for some filters (but most can use ImageMagick instead)'),
);
foreach ($FunctionsExist as $function => $details) {
	list($color, $description) = $details;
	echo '<tr><th class="forumheader3"><strong>'.$function.'</strong></th><th class="forumheader3" colspan="2" style="font-weight: bold; background-color:';
	if (function_exists(strtolower($function))) {
		echo 'lime">TRUE';
	} else {
		echo $color.'">FALSE';
	}
	echo '</th><td class="forumheader3">'.$description.'</td></tr>';
}


echo '<tr><th colspan="4">&nbsp;</th></tr>';
echo '<tr class="forumheader3"><th class="fcaption">Setting</th><th class="fcaption">Master Value</th><th class="fcaption">Local Value</th><th class="fcaption">Comments</th></tr>';


$SettingFeatures = array(
	'magic_quotes_runtime' => array('red',    'lime',   'This setting is evil. Turn it off.'),
	'magic_quotes_gpc'     => array('yellow', 'lime',   'This setting is bad. Turn it off, if possible. phpThumb will attempt to work around it if it is enabled.'),
	'safe_mode'            => array('orange', 'lime',   'Best if off. Calls to ImageMagick will be disabled if on (limiting max image resolution, no animated GIF resize). Temp files may be disabled. Features will be limited. If disabled in Master but enabled in Local, edit httpd.conf and set (php_admin_value safe_mode "Off") between <VirtualHost> tags'),
	'allow_url_fopen'      => array('lime',   'yellow', 'Best if on. HTTP source images will be unavailable if disabled and CURL is unavailable.'),
);

foreach ($SettingFeatures as $feature => $FeaturesDetails) {
	list($color_true, $color_false, $reason) = $FeaturesDetails;
	echo '<tr><th class="forumheader3"><strong>'.$feature.':</strong></th>';
	echo '<th class="forumheader3" style="font-weight: bold; background-color:'.(@get_cfg_var($feature) ? $color_true : $color_false).'">'.$phpThumb->phpThumbDebugVarDump((bool) @get_cfg_var($feature)).'</th>';
	echo '<th class="forumheader3" style="font-weight: bold; background-color:'.(@ini_get($feature)     ? $color_true : $color_false).'">'.$phpThumb->phpThumbDebugVarDump((bool) @ini_get($feature)).'</th>';
	echo '<td class="forumheader3">'.htmlentities($reason).'</td></tr>';
}

$MissingFunctionSeverity = array(
	'shell_exec' => 'red',
	'system'     => 'red',
	'passthru'   => 'red',
	'exec'       => 'red',
	'curl_exec'  => 'orange',
);
$DisabledFunctions[0] = explode(',', @get_cfg_var('disable_functions'));
$DisabledFunctions[1] = explode(',',     @ini_get('disable_functions'));
echo '<tr><th class="forumheader3"><strong>disable_functions:</strong></th>';
for ($i = 0; $i <= 1; $i++) {
	//echo '<th bgcolor="'.(count($DisabledFunctions[$i]) ? 'yellow' : 'lime').'">';
	echo '<th class="forumheader3">';
	$disabled_functions = '';
	foreach ($DisabledFunctions[$i] as $key => $value) {
		if (@$MissingFunctionSeverity[$value]) {
			$DisabledFunctions[$i][$key] = '<span style="background-color: '.$MissingFunctionSeverity[$value].';">'.$value.'</span>';
		}
	}
	echo implode(', ', $DisabledFunctions[$i]);
	echo '</th>';
}
echo '<td class="forumheader3">Best if nothing disabled. Calls to ImageMagick will be prevented if exec+system+shell_exec+passthru are disabled.</td></tr>';


echo '<tr><th class="forumheader3"><strong>memory_limit:</strong></th><th class="forumheader3" style="font-weight: bold; background-color:';
$memory_limit = @get_cfg_var('memory_limit');
if (!$memory_limit) {
	echo 'lime';
} elseif ($memory_limit >= 32) {
	echo 'lime';
} elseif ($memory_limit >= 24) {
	echo 'lightgreen';
} elseif ($memory_limit >= 16) {
	echo 'green';
} elseif ($memory_limit >= 12) {
	echo 'darkgreen';
} elseif ($memory_limit >= 8) {
	echo 'olive';
} elseif ($memory_limit >= 4) {
	echo 'yellow';
} elseif ($memory_limit >= 2) {
	echo 'orange';
} else {
	echo 'red';
}
echo '">'.($memory_limit ? $memory_limit : '<i>unlimited</i>').'</th><th class="forumheader3" style="font-weight: bold; background-color:';
$memory_limit = @ini_get('memory_limit');
if (!$memory_limit) {
	echo 'lime';
} elseif ($memory_limit >= 32) {
	echo 'lime';
} elseif ($memory_limit >= 24) {
	echo 'lightgreen';
} elseif ($memory_limit >= 16) {
	echo 'green';
} elseif ($memory_limit >= 12) {
	echo 'darkgreen';
} elseif ($memory_limit >= 8) {
	echo 'olive';
} elseif ($memory_limit >= 4) {
	echo 'yellow';
} elseif ($memory_limit >= 2) {
	echo 'orange';
} else {
	echo 'red';
}
echo '">'.($memory_limit ? $memory_limit : '<i>unlimited</i>').'</th>';
echo '<td class="forumheader3">The higher the better. Divide by 5 to get maximum megapixels of source image that can be thumbnailed (without ImageMagick).'.($memory_limit ? ' Your setting ('.$memory_limit.') allows images up to approximately '.number_format($memory_limit / 5, 1).' megapixels' : '').'</td></tr>
</table>';


?>