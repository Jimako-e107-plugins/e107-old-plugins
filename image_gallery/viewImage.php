<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/viewImage.php
|
| Revision: 0.9.6.5
| Date: 2008/02/15
| Author: Krassswr
|
|	krassswr@abv.bg
|
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
/*
	All images in the gallery can be stored outside the
	webroot directory to prevent direct linking.
	To display the image we must provide the image type
	and the image name
*/
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}

if (!isset($_GET['type']) || !isset($_GET['name'])) {
	exit;
}

// type can be album or gallery image
$type = $_GET['type'];

// this is the image name
$name = $_GET['name'];
//add ie stupid
$ingal = 0;
if (isset($_GET['ingal']))
{
    $ingal = (INT)$_GET['ingal'];
}
//end ie stupid
if ($type == 'album') {
    $filePath = $pref['img_ALBUM_IMG_DIR'] . $name;
} else if ($type == 'glimage') {
    $filePath = $pref['img_GALLERY_IMG_DIR'] . $name;
} else if ($type == 'glthumbnail') {
    $filePath = $pref['img_GALLERY_IMG_DIR'] . 'thumbnail/' . $name;
} else {
	// invalid image type
	exit;
}


if ($ingal==0)
{
// the the browser know the file size
header("Content-length: " . filesize($filePath));

// the image content type is image/[file extension]
header("Content-type: image/" . substr($name, strpos($name, '.') + 1));

// read the image file from the server and send it to the browser
readfile($filePath);
}
else{
//fix IE stupidness

$t1 = $_SERVER["SCRIPT_NAME"];
    $t1 = ereg_replace("viewImage.php", '', "$t1");
    echo "<?xml version='1.0' encoding='utf-8' ?>
    <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">
    <html xmlns='http://www.w3.org/1999/xhtml' xml:lang=\"bg\">
    <head>
    <title>Image Gallery</title>
    </head>
    <body>
    <p><img src=\"".$t1."images/gallery/".$name."\" alt=\"".$name."\"/></p>
    </body>
    </html>";
//end ie stupidness
}
?>