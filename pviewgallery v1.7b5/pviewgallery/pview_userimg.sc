//<?php
// Include plugin language file, check first for site's preferred language
if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
	include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
}
else {
	include_once(e_PLUGIN . "pviewgallery/languages/German.php");
}
require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;

if ($PView -> getPView_config("img_Link_profileImg_extJS")) {
	$script = $PView -> getPView_config("img_Link_extJS");
} else {
	$script = "noscript";
}

$pv_query = array();
$pv_query = explode(".",e_QUERY);
if ($pv_query[0] == "id") {
	$pv_uid = $pv_query[1];
} else {
	return "";
}
if (!$PView -> getUserImageCount($pv_uid)) {return "";}

// prepare imagedata
global $sql;
$pv_Images = array();
if ($PView -> getPView_config("profile_ImgOrder") == "RAND") {
	$pv_arg = "WHERE uploaderUserId='".$pv_uid."' ORDER BY RAND()";
	$pv_Caption = LAN_PVIEW_SC_5;
} else {
	$pv_arg = "WHERE uploaderUserId='".$pv_uid."' ORDER BY uploadDate DESC";
	$pv_Caption = LAN_PVIEW_SC_6;
}

$sql->db_Select("pview_image","*",$pv_arg,"nowhere");
while ($pv_Image = $sql -> db_Fetch()) {
	// PERMISSION!!!
	if ($PView -> getPermission("image",$pv_Image['imageId'],"View")){
		array_push ($pv_Images, $pv_Image);			
	}
}
$pv_ImgCols = $PView -> getPView_config("profile_ImgCols");
$pv_ImgCount = $PView -> getPView_config("profile_ImgCount");
$pv_currCount = 0;
$pv_colCount = "";
$pv_colwidth = floor(100/$pv_ImgCols);
$pview_userimg = "<table class='fborder' style='margin-top:20px;".USER_WIDTH."'>";
$pview_userimg.= "<tr><td colspan=".$pv_ImgCols." class='fcaption'>".$pv_Caption.LAN_PVIEW_SC_4."</td></tr><tr>";
foreach ($pv_Images as $dataset) {
	if ($pv_colCount == $pv_ImgCols) {
		$pview_userimg.= "</tr><tr>";
		$pv_colCount = 0;
	}
	if ($pv_currCount < $pv_ImgCount) {
		$pv_thumb = $PView -> getThumbPath($dataset['imageId']);
        $resize = $PView -> getResizePath($dataset['imageId']);
		
		switch ($script) {
					case "noscript":
					// image will open in pviewgallery
					$profileLink = "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?image=".$dataset['imageId']."'>";
					break;
					case "lightbox":
					// image will open in lightbox group	
					$profileLink = "<a href='".$resize."' rel='lightbox[pview_profile_Img]' title='".$dataset['name']."'>";
					break;
					case "shadowbox":
					// image will open in shadowbox group	
					$profileLink = "<a href='".$resize."' rel='shadowbox[pview_profile_Img]' title='".$dataset['name']."'>";
					break;
					case "highslide":
					// image will open in highslide group
					if ($PView->getPView_config("img_Link_extJS_pview"))	{
						$profileLink = "<a href='".$resize."' class='highslide' onclick=\"return hs.expand(this,pview_profile_Img)\" title='".$dataset['name']."'>";
					} else {
						// ehighslide plugin compatible
						$profileLink = "<a href='".$resize."' class='highslide' onclick='return hs.expand(this)' title='".$dataset['name']."'>";
					}
					break;																	
					
		}
		
		$pview_userimg.= "<td style='vertical-align:top;width:".$pv_colwidth."%; border: #b7b5b5 1px solid; padding:5px; text-align: center;'>".$profileLink."<img src='".$pv_thumb."' title='".$dataset['name']."'></a></td>";
		$pv_colCount++;
	}
	$pv_currCount++;
}
// fill row with empty cells
while ($pv_colCount < $pv_ImgCols) {
	$pview_userimg.= "<td style='width:".$colwidth."%;'>&nbsp;</td>";
	$pv_colCount++;
}
$pview_userimg.= "</table>";
return $pview_userimg;

//?>