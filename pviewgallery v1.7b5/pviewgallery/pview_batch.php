<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        http://e107.org
|
|        PView Gallery by R.F. Carter
|        ronald.fuchs@hhweb.de
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);

// Include plugin language file, check first for site's preferred language
if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
}
else
{
include_once(e_PLUGIN . "pviewgallery/languages/German.php");
} 
// Include pview.class
require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;

// Permission!
if (!$PView -> getPermission("config","permBatch","")){
	$ns->tablerender(LAN_ACTION_41, LAN_IMAGE_36);
	require_once(FOOTERF);
	exit;
}

$batchUpload = 1;
define("PV_UPLOADPATH",e_PLUGIN."pviewgallery/batch_upload");
global $tp;

// Include pview_actions for supported functions
include_once(e_PLUGIN."pviewgallery/pview_actions.php");

// save procedure
if ($_POST['pv_action'] == "batchupload"){
	// upload Image
	// conv for files with special characters (άφί)
	$uploadResult = uploadImage(iconv("UTF-8","ISO-8859-1",$_POST['pv_batch_image']), "batch");
	// check Result
	if ($uploadResult) {
		$out_HTML.= getFeedback($uploadResult);
		$ns -> tablerender($PView -> getPView_config("pview_name"), $out_HTML);
	}
	
}
// count images in batch dir
$handle = opendir(PV_UPLOADPATH);

if (file_exists(PV_UPLOADPATH."/tmp_batch.jpg")){
	unlink(PV_UPLOADPATH."/tmp_batch.jpg");
}

$filelist = array();
while ($file = readdir($handle)) {
	
	if ($file != "." && $file != ".." && $file != "/") {
		$tmpData = getimagesize(PV_UPLOADPATH."/".$file);
		if ($tmpData[2] == "1" OR $tmpData[2] == "2" OR $tmpData[2] == "3"){
			array_push($filelist, $file);
		}
		
	}
}
closedir($handle);



// cancel if no images in batch dir
if (!count($filelist)){

	$outBatch = "<p>".LAN_ACTION_42."</p><p>";
	if (isset($_POST['pv_albumSelect'])){
		$batchAlbum = explode(",",$_POST['pv_albumSelect']);
		$outBatch.= "<a href='pviewgallery.php?album=".$batchAlbum[1]."'>".LAN_ACTION_7."</a><br />";
	}

	$outBatch.= "<a href='pviewgallery.php'>".LAN_ACTION_8."</a></p>";	 
	$ns->tablerender(LAN_ACTION_41, $outBatch);
	require_once(FOOTERF);
	exit;
}
// select current batch-image and call getForm_image()

$callValues['permView'] = "ALL"; // default
$callValues['batch'] = "1"; // prevent DELETE button
getTempImage(PV_UPLOADPATH."/".$filelist[0]); // create thumb for preview
$callValues['batch_image'] = PV_UPLOADPATH."/".$filelist[0]; // current batch image
if ($PView -> getPView_config("batch_use_filename")){
	$callValues['name'] = substr(htmlentities($filelist[0]),0, -4); // Filename as Imagename
}
if (!$catId = array_search($_POST['pv_cat'],$PView -> getCatArray())) {
	$catId = 0;
}
$callValues['cat'] = $catId; // last selected cat

// status

$outBatch = "<p>".LAN_ACTION_43.count($filelist)."</p>";
$outBatch.= "<p>".LAN_ACTION_44."</p><p>";
if (isset($_POST['pv_albumSelect'])){
	$batchAlbum = explode(",",$_POST['pv_albumSelect']);
	$outBatch.= "<a href='pviewgallery.php?album=".$batchAlbum[1]."'>".LAN_ACTION_7."</a><br />";
}
$outBatch.= "<a href='pviewgallery.php'>".LAN_ACTION_8."</a></p>";
$ns->tablerender(LAN_ACTION_41, $outBatch);


// edit form for datainput
$outBatch = getForm_image($callValues);

$ns->tablerender(LAN_ACTION_45.": ".htmlentities($filelist[0]), $outBatch);
require_once(FOOTERF);


function getTempImage($orig_file){
// create temporary thumb image to preview current batch image
	$ImageData = getimagesize($orig_file);
	$ImageRatio = $ImageData[0] / $ImageData[1];
	$new_height = 100;
	$new_width = round($new_height*$ImageRatio);
	$new_file = dirname($orig_file)."/tmp_batch.jpg";
	
	if ($ImageData[2] == "1") { // gif
		$original = ImageCreateFromGIF($orig_file);
		$resize = ImageCreateTrueColor($new_width, $new_height );
		imagecopyresampled($resize, $original, 0, 0, 0, 0, $new_width , $new_height, $ImageData[0], $ImageData[1]);
		imagejpeg($resize, $new_file);
	}
	if ($ImageData[2] == "2") { // jpg
		$original = ImageCreateFromJPEG($orig_file);
		$resize = ImageCreateTrueColor($new_width, $new_height );
		imagecopyresampled($resize, $original, 0, 0, 0, 0, $new_width , $new_height, $ImageData[0], $ImageData[1]);
		imagejpeg($resize, $new_file,85);
	}
	if ($ImageData[2] == "3") { // png
		$original = ImageCreateFromPNG($orig_file);
		$resize = ImageCreateTrueColor($new_width, $new_height );
		imagecopyresampled($resize, $original, 0, 0, 0, 0, $new_width , $new_height, $ImageData[0], $ImageData[1]);
		imagejpeg($resize, $new_file);		
	}
}
?>