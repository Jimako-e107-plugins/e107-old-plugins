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

if ($PView -> getPView_config("img_Link_profileCom_extJS")) {
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
if (!$PView -> getUserCommCount($pv_uid)) {return "";}

// prepare commentdata
global $sql;
global $tp;
$pv_commentArray = array();

$sql->db_Select("pview_comment", "*", "WHERE commente107userId=".$pv_uid." ORDER BY commentDate DESC", "nowhere");
while ($pv_comment = $sql -> db_Fetch()) {
	if ($PView->getPermission("image",$pv_comment['commentImageId'],"View")) {
		array_push($pv_commentArray,$pv_comment);
	}
}
$pv_ImgCols = $PView -> getPView_config("profile_CommCols");
$pv_ImgCount = $PView -> getPView_config("profile_CommCount");
$pv_currCount = 0;
$pv_colCount = "";
$pv_colwidth = floor(100/$pv_ImgCols);
$pview_usercomm = "<table class='fborder' style='margin-top:20px;".USER_WIDTH."'>";
$pview_usercomm.= "<tr><td colspan=".$pv_ImgCols." class='fcaption'>".LAN_PVIEW_SC_7.LAN_PVIEW_SC_4."</td></tr><tr>";
foreach ($pv_commentArray as $dataset) {
	if ($pv_colCount == $pv_ImgCols) {
		$pview_usercomm.= "</tr><tr>";
		$pv_colCount = 0;
	}
	if ($pv_currCount < $pv_ImgCount) {
		$pv_thumb = $PView -> getThumbPath($dataset['commentImageId']);
        $resize = $PView -> getResizePath($dataset['commentImageId']);
		$name = $PView -> getImageName($dataset['commentImageId']);
		switch ($script) {
					case "noscript":
					// image will open in pviewgallery
					$profileLink = "<a href='".e_PLUGIN."pviewgallery/pviewgallery.php?image=".$dataset['commentImageId']."'>";
					break;
					case "lightbox":
					// image will open in lightbox group	
					$profileLink = "<a href='".$resize."' rel='lightbox[pview_profile_Comm]' title='".$name."'>";
					break;
					case "shadowbox":
					// image will open in shadowbox group	
					$profileLink = "<a href='".$resize."' rel='shadowbox[pview_profile_Comm]' title='".$name."'>";
					break;
					case "highslide":
					// image will open in highslide group
					if ($PView->getPView_config("img_Link_extJS_pview"))	{
						$profileLink = "<a href='".$resize."' class='highslide' onclick=\"return hs.expand(this,pview_profile_Comm)\" title='".$name."'>";
					} else {
						// ehighslide plugin compatible
						$profileLink = "<a href='".$resize."' class='highslide' onclick='return hs.expand(this)' title='".$name."'>";
					}
					break;																	
					
		}	
	
		// Preview text without html format (delete also [html] tags if WYSIWYG is used for write comment)	
		$pv_preview_Text = mb_substr(strip_tags($tp->toHTML($dataset['commentText'], TRUE)),0,$PView -> getPView_config('profile_CommPreview'),'UTF-8');
		$pview_usercomm.= "<td style='vertical-align:top;width:".$pv_colwidth."%; border: #b7b5b5 1px solid; padding:5px; text-align: center;'>".$profileLink."<img src='".$pv_thumb."' title='".$PView->getImageName($dataset['commentImageId'])."'></a>";
		if ($PView -> getPView_config('profile_CommPreview')) {
			$pview_usercomm.= "<br /><span class='smalltext'>".$pv_preview_Text."...</span></td>";
		}
		$pv_colCount++;
	}
	$pv_currCount++;
}
// fill row with empty cells
while ($pv_colCount < $pv_ImgCols) {
	$pview_usercomm.= "<td style='width:".$colwidth."%;'>&nbsp;</td>";
	$pv_colCount++;
}
$pview_usercomm.= "</table>";
return $pview_usercomm;

//?>