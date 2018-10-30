<?php
//////////////////////////////////////////////////////////////
///  phpThumb() by James Heinrich <info@silisoftware.com>   //
//        available at http://phpthumb.sourceforge.net     ///
//////////////////////////////////////////////////////////////
//                                                          //
// phpThumb.demo.showpic.php                                //
// James Heinrich <info@silisoftware.com>                   //
// 23 Feb 2004                                              //
//                                                          //
// This code is useful for popup pictures (e.g. thumbnails  //
// you want to show larger, such as a larger version of a   //
// product photo for example) but you don't know the image  //
// dimensions before popping up. This script displays the   //
// image with no window border, and resizes the window to   //
// the size it needs to be (usually better to spawn it      //
// large (600x400 for example) and let it auto-resize it    //
// smaller), and if the image is larger than 90% of the     //
// current screen area the window respawns itself with      //
// scrollbars.                                              //
//                                                          //
// Usage:                                                   //
// window.open('showpic.php?src=big.jpg&title=Big+picture', //
//   'popupwindowname',                                     //
//   'width=600,height=400,menubar=no,toolbar=no')          //
//                                                          //
// See demo linked from http://phpthumb.sourceforge.net    ///
//////////////////////////////////////////////////////////////
header("Content-type: text/html; charset=UTF-8", true);
//e107 improved - SecretR
	$phpThumbLocation = './includes/sgal_thumb.php?';
//To DO - remove & from the URL string - XHTML compilance
//SecretR - w3c valid Get string
error_reporting(0);
ini_set('display_errors', '0');

$_SERVER['QUERY_STRING'] = str_replace('+', '&', $_SERVER['QUERY_STRING']);
$_SERVER['QUERY_STRING'] = urldecode($_SERVER['QUERY_STRING']);

if($_SERVER['QUERY_STRING']) {   
    parse_str($_SERVER['QUERY_STRING'], $_GET);

    $_SERVER['QUERY_STRING'] = str_replace('&amp;', '&', $_SERVER['QUERY_STRING']);
    $_GET['src'] = urldecode($_GET['src']);
    $_GET['title'] = urldecode($_GET['title']);
}

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<?php
	if (@$_GET['title']) {
		$ttl = htmlentities(str_replace('_', ' ', $_GET['title']),ENT_QUOTES, 'UTF-8');
        echo '<title>'.$ttl.'</title>';
	} else {
        $ttl = '';
    }
    unset($_GET['title']);
?>

	<script language="Javascript">
	<!--
	// http://www.xs4all.nl/~ppk/js/winprop.html
	function CrossBrowserResizeInnerWindowTo(newWidth, newHeight) {
		if (self.innerWidth) {
			frameWidth  = self.innerWidth;
			frameHeight = self.innerHeight;
		} else if (document.documentElement && document.documentElement.clientWidth) {
			frameWidth  = document.documentElement.clientWidth;
			frameHeight = document.documentElement.clientHeight;
		} else if (document.body) {
			frameWidth  = document.body.clientWidth;
			frameHeight = document.body.clientHeight;
		} else {
			return false;
		}
		if (document.layers) {
			newWidth  -= (parent.outerWidth - parent.innerWidth);
			newHeight -= (parent.outerHeight - parent.innerHeight);
		}

		// original code:
		//parent.window.resizeTo(newWidth, newHeight);
		// fixed code: James Heinrich, 20 Feb 2004
		parent.window.resizeBy(newWidth - frameWidth, newHeight - frameHeight);

		return true;
	}
	// -->
	</script>

	<script src="javascript_api.js"></script>

<?php
	function SafeStripSlashes($string) {
		return (get_magic_quotes_gpc() ? stripslashes($string) : $string);
	}

	$additionalparameters = array();
	foreach ($_GET as $key => $value) {
		if (is_array($value)) {
			foreach ($value as $key2 => $value2) {
				$additionalparameters[] = $key.'[]='.SafeStripSlashes($value2);
			}
		} else {
			$additionalparameters[] = $key.'='.SafeStripSlashes($value);
		}
	}
	$imagesrc = $phpThumbLocation.implode('&', $additionalparameters); 

	echo '<script language="Javascript">';
	echo 'var ns4;';
	echo 'var op5;';
	echo 'function setBrowserWindowSizeToImage() {';
	echo 	'if (!document.getElementById("imageimg")) { return false; }';
	echo	'sniffBrowsers();';
	echo 	'var imageW = getImageWidth("imageimg");';
	echo 	'var imageH = getImageHeight("imageimg");';
			// check for maximum dimensions to allow no-scrollbar window
	echo 	'if (((screen.width * 1.1) > imageW) || ((screen.height * 1.1) > imageH)) {'."\n";
				// screen is large enough to fit whole picture on screen with 10% margin
	echo 		'CrossBrowserResizeInnerWindowTo(imageW, imageH);'."\n";
	echo 	'} else {'."\n";
				// image is too large for screen: add scrollbars by putting the image inside an IFRAME
	echo 		'document.getElementById("showpicspan").innerHTML = "<iframe width=\"100%\" height=\"100%\" marginheight=\"0\" marginwidth=\"0\" frameborder=\"0\" scrolling=\"on\" src=\"'.$imagesrc.'\">Your browser does not support the IFRAME tag. Please use one that does (IE, Firefox, etc).<br><img src=\"'.$imagesrc.'\"></iframe>";';
	echo 	'}'."\n";
	echo '}';
	echo '</script>';
?>

</head>

<body style="margin: 0px;" onLoad="setBrowserWindowSizeToImage();"><div id="showpicspan"><?php

if (@$_GET['src']) {

	echo '<script language="Javascript">';
	echo 'document.writeln(\'<a href="#" onclick="self.close();" title="Close"><img src="'.$imagesrc.'" alt="'.$ttl.'" border="0" id="imageimg" hspace="0" hspace="0" style="padding: 0px; margin: 0px;"></a>\');';
	echo '</script>';

} else {

	echo '<pre>';
	echo 'Wrong query!';
	echo '</pre>';

}

?></div></body>
</html>