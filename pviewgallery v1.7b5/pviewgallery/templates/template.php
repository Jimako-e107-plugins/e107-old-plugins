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

// Include pview.class
require_once(e_PLUGIN."pviewgallery/pview.class.php");
require_once(e_HANDLER."avatar_handler.php");
include_once(e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/usertemplate.php");

class Template {

// !!!!  EACH FUNCTION WILL LOOK AT USERTEMPLATE FOR MODIFIED CODE   !!!!

function getContent() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getContent)) {
	return $UserTemplate->getContent();
}
	
// returns the gallery content
$PView = new PView;
$pv_Appl = $PView -> getAppl();
global $applImages;


// Javascript source for DHTML
// Standard
$JS = "<script src = 'pview.js' type='text/javascript'></script>";

// Template
if (file_exists(e_PLUGIN . "pviewgallery/templates/".$PView -> getPView_config("template")."/template.js")){
	$template_JS = "<script src = '".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/template.js' type='text/javascript'></script>";
}

// Enhanced Gallery Start Page ---------------------------------------------------------------------
// don't forget to include your css styles in theme.css
if ($pv_Appl[0] == "gallery" && $pv_Appl[1] == "0" && $PView->getPView_config("start_page")=="advanced" && $_GET['gallery'] <>"classic") {
	$applImages = $PView->getAllImages(); // trigger only, no return!
	// prepare list order
	$listArray = $PView->getFrontpageArray();
	$PView->getStatistic_Totals(); // trigger only, no return!
	
	$AG = "<table style='width:98%;'>";
	foreach ($listArray as $key => $dataset) {
		$elementArray = explode("|",$dataset);
		if ($elementArray[1]){
			$AG.= "<tr><td class='fborder' style='padding:2px;'>".$this->getModuleContent($key)."</td></tr>";
		}
	}
	$AG.= "</table>";

	return $AG;
}

// Main Gallery Layout (Classic) -------------------------------------------------------------------
// also used in advanced mode with: pviewgallery.php?gallery=classic for gallery handling!
// don't forget to include your css styles in theme.css
if (($pv_Appl[0] == "gallery" && $pv_Appl[1] == "0" && $PView->getPView_config("start_page")=="classic") OR ($pv_Appl[0] == "gallery" && $_GET['gallery'] == "classic")) {
	//PERMISSION!!!
	if ($PView -> getPermission("gallery",0,"View")) {
		$MG = "<table cellspacing='0px' style='width:98%;' class='fborder'>";
		$MG.= "<tr><td class='fcaption' style='border: 0px;'>{pv_MainGalleryName} (".LAN_GALLERY_3.": {pv_RootalbumCount})</td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_MainGalleryMenu}</td></tr>";
		$MG.= "{pv_RootAlbums}";
		$MG.= "</table><br/>";
	}
	// List of Category and User View
	$LV = "<table cellspacing='0px' style='width:98%;' class='fborder'>";
	$LV.= "<tr><td class='fcaption' style='border: 0px;'>".LAN_GALLERY_14."</td></tr>";
	$LV.= "<tr><td style='padding-top:5px;'>";
	$LV.= "<table  style='width:100%'>";
	$LV.= "<tr><td class='forumheader'><a href='pviewgallery.php?cat=list'>".LAN_GALLERY_15.":</a> ".LAN_GALLERY_17."</td></tr>";
	$LV.= "<tr><td class='forumheader'><a href='pviewgallery.php?user=list'>".LAN_GALLERY_16.":</a> ".LAN_GALLERY_18."</td></tr>";	
	$LV.= "</table>";
	$LV.= "</td></tr>";
	$LV.= "</table><br/>";
	
	// List of Usergalleries
	if ($PView -> getPView_config("member_galleries") OR (ADMIN && $PView -> getPView_config("admin_Mode"))) {
		$UG = "<table cellspacing='0px' style='width:98%;' class='fborder'>";
		$UG.= "<tr><td class='fcaption' style='border: 0px;'>{pv_MemberGalleryName} ({pv_UserGalleryCount})</td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_UserGalleryMenu}</td></tr>";
		$UG.= "{pv_UserGalleries}";
		$UG.= "</table>";
	}	
	return $MG.$LV.$UG;
}
// User Gallery Layout -------------------------------------------------------------------
// don't forget to include your css styles in theme.css
if ($pv_Appl[0] == "gallery" && $pv_Appl[1] <> "0") {
	// redirect to gallery startpage if gallery not exist
	if (!$PView -> getExist("gallery",$pv_Appl[1])) { 
		header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php");
	}
	//PERMISSION!!!
	if ($PView -> getPermission("gallery",$pv_Appl[1],"View")) {
		$UG = "<table cellspacing='0px' style='width:98%;' class='fborder'>";
		$UG.= "<tr><td class='fcaption' style='border: 0px;'>{pv_UserGalleryName} (".LAN_GALLERY_3.": {pv_RootalbumCount})</td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_MainGalleryMenu}</td></tr>";
		$UG.= "{pv_RootAlbums}";
		$UG.= "</table><br/>";

		return $UG;
	}
	return $PView -> getNoPerm("gallery"); // forbidden action
}

// Album Layout -------------------------------------------------------------------
// don't forget to include your css styles in theme.css
if ($pv_Appl[0] == "album") {
	// redirect to gallery startpage if album not exist
	if (!$PView -> getAlbumData($pv_Appl[1])) { 
		header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php");
	}
	$applImages = $PView->getApplImages(); // trigger only, no return!
	//PERMISSION!!!
	if ($PView -> getPermission("album",$pv_Appl[1],"View")) {
		$ALBUM = "<table style='width:100%;' class='fborder'>";
		$ALBUM.= "<tr><td class='fcaption' style='border: 0px;'>{pv_AlbumName} <span class='smalltext'>(".LAN_ALBUM_1.": {pv_AlbumImageCount} / ".LAN_ALBUM_2.": {pv_SubAlbumCount})</span></td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_AlbumMenu}</td></tr>";
		$ALBUM.= "{pv_SubAlbums}";
		$ALBUM.= "<tr><td colspan='2' class='forumheader'>".LAN_ALBUM_1.":</td></tr><tr><td colspan='2'><table style='width:100%'>";
		$ALBUM.= "{pv_AlbumImages}";
		$ALBUM.= "</table></td></tr>";
		$ALBUM.= "<tr style='height:30px;'><td colspan='2' style='text-align:center;'>{pv_Pages}</td></tr>";
		$ALBUM.= "</table>";

		return $ALBUM;
	}
	return $PView -> getNoPerm("album"); // forbidden action
}

// Image Layout -------------------------------------------------------------------
// don't forget to include your css styles in theme.css
if ($pv_Appl[0] ==  "image") {
	// redirect to gallery startpage if image not exist
	if (!$PView -> getImageData($pv_Appl[1])) { 
		header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php");
		exit;
	}
	$applImages = $PView->getApplImages(); // trigger only, no return!
	//PERMISSION!!!
	if ($PView -> getPermission("image",$pv_Appl[1],"View")) {
		if ($PView -> getPermission("config","permComment","")) {
			// save comment and redirect to image
			if ($_POST['submit'] == LAN_IMAGE_40) {
				$PView -> setImageComment($_POST['appl']);
				header("location:".$PView -> getLink('cancel'));
				exit;
			}
			// delete comment after confirmation
			if ($_GET['deletecomment'] && ADMIN) {
				if ($_GET['confirm'] == 1) {
					$PView -> deleteComment($_GET['deletecomment']);
					header("location:".$PView -> getLink('cancel'));
					exit;
				}
				return $PView -> getDelConfirm(LAN_IMAGE_41." ".$_GET['deletecomment']);
			}
		}
		$IMG.= "<table cellspacing='0px' style='width:98%;' class='fborder'>";
		$IMG.= "<tr><td class='fcaption' style='border: 0px;'>{pv_ImageName}</td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_ImageMenu}</td></tr>";
		$IMG.= "<tr><td colspan='2' class='forumheader' style='border-left: 0px; border-right: 0px;'>{pv_NavMenu}</td></tr>";
		$IMG.= "<tr><td colspan='2' style='text-align:center;'><div style='padding-top:20px; padding-bottom:20px; overflow:hidden;'>{pv_ResizeImage}</div></td></tr>";
		$IMG.= "<tr><td colspan='2'><table cellspacing='0px' style='width:98%;' class='fborder'><tr><td><table width='85%'>{pv_ImageData}</table></td></tr></table><br /></td></tr>";
		if ($PView -> getPView_config("Comments")) {
			$IMG.= "<tr><td class='fcaption' style='border: 0px;'>".LAN_IMAGE_4." <span class='smalltext'>( {pv_CommentCount} )</span></td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_AddComment}</td></tr>";
			$IMG.= "<tr><td colspan='2' style='text-align:center;'>{pv_Comments}</td></tr>";
		}
		$IMG.= "</table>";

		return $JS.$template_JS.$IMG;
	}
	return $PView -> getNoPerm("image"); // forbidden action

}

// Userimages Layout -------------------------------------------------------------------
// don't forget to include your css styles in theme.css
if ($pv_Appl[0] == "user" && $pv_Appl[1] <> "list") {
	// redirect to gallery startpage if user not exist
	$userData = $PView -> getUserData($pv_Appl[1]);
	if ($userData['user_class'] == '255') { 
		header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php");
		exit;
	}
	$applImages = $PView->getApplImages(); // trigger only, no return!
	$UIMG.= "<table style='width:100%;' class='fborder'>";
	$UIMG.= "<tr><td class='fcaption' style='border: 0px;'>{pv_UserName} <span class='smalltext'>(".LAN_ALBUM_1.": {pv_UserImageCount})</span></td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_UserMenu}</td></tr>";
	$UIMG.= "<tr><td colspan='2' class='forumheader'>".LAN_ALBUM_1.":</td></tr><tr><td colspan='2'><table style='width:100%'>";
	$UIMG.= "{pv_UserImages}";
	$UIMG.= "</table></td></tr>";
	$UIMG.= "<tr style='height:30px;'><td colspan='2' style='text-align:center;'>{pv_Pages}</td></tr>";
	$UIMG.= "</table>";
	
	return $UIMG;
}
if ($pv_Appl[0] == "user" && $pv_Appl[1] == "list") {
	// message, if no user uploaded images
	if (!strip_tags($tmpList = $this->getAllUsers())){
		$LUIMG.= "<div style='padding:10px;'><p>".LAN_GALLERY_19."</p>";
		$LUIMG.= "<p><a href='pviewgallery.php'>".LAN_ACTION_8."</a></p>";
		$LUIMG.= "</div>";
	}else {
		$LUIMG.= $tmpList;
	}
	return $LUIMG;
}

// Category Layout -------------------------------------------------------------------
// don't forget to include your css styles in theme.css
if ($pv_Appl[0] == "cat" && $pv_Appl[1] <> "list") {
	// redirect to gallery startpage if category not exist
	$catArray = $PView -> getCatArray();
	if (!array_key_exists($pv_Appl[1],$catArray)) {
		header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php");
		exit;
	}
	$applImages = $PView->getApplImages(); // trigger only, no return!
	$CATIMG.= "<table style='width:100%;' class='fborder'>";
	$CATIMG.= "<tr><td class='fcaption' style='border: 0px;'>{pv_CatName} <span class='smalltext'>(".LAN_ALBUM_1.": {pv_CatImageCount})</span></td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_CatMenu}</td></tr>";
	$CATIMG.= "<tr><td colspan='2' class='forumheader'>".LAN_ALBUM_1.":</td></tr><tr><td colspan='2'><table style='width:100%'>";
	$CATIMG.= "{pv_CatImages}";
	$CATIMG.= "</table></td></tr>";
	$CATIMG.= "<tr style='height:30px;'><td colspan='2' style='text-align:center;'>{pv_Pages}</td></tr>";
	$CATIMG.= "</table>";
	
	return $CATIMG;
}
if ($pv_Appl[0] == "cat" && $pv_Appl[1] == "list") {
	$catArray = $PView -> getCatArray();
	// message, if no categories
	if (!count($catArray)){
		$LCATIMG.= "<div style='padding:10px;'><p>".LAN_GALLERY_11."</p>";
		$LCATIMG.= "<p><a href='pviewgallery.php'>".LAN_ACTION_8."</a></p>";
		$LCATIMG.= "</div>";
	} else {
		$LCATIMG.= "{pv_CatList}";
	}
	
	return $LCATIMG;
}
}
// Layout end
// ---------------------------------------------------------------------------------------
// Additional functions

function getAllImages() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getAllImages)) {
	return $UserTemplate->getAllImages();
}

// returns imagegrid for album, category and user view
	$PView = new PView;
	global $tp;
	
	$pv_Appl = $PView -> getAppl();
	$ImageData = array();
    /*
	if ($PView -> getPView_config("img_Link_gal_extJS")) {
		$script = $PView -> getPView_config("img_Link_extJS");
	} else {
		$script = "noscript";
	}
	*/
	
// prepare album-handling
	if ($pv_Appl[0] == "album"){
		$ImageCount = $PView -> getAlbumImageCount();
		$details = $PView->getPView_config("album_details");
		$message = LAN_ALBUM_9;
	}
// prepare category-handling
	if ($pv_Appl[0] == "cat"){
		$ImageCount = $PView -> getCatImageCount($pv_Appl[1]);
		$details = $PView->getPView_config("cat_details");
		$message = LAN_GALLERY_12;
	}	
// prepare userimage-handling
	if ($pv_Appl[0] == "user"){
		$ImageCount = $PView -> getUserImageCount($pv_Appl[1]);
		$details = $PView->getPView_config("user_details");
		$message = LAN_GALLERY_13;
	}
	
	global $applImages;
	$ImageData = $PView->sortApplImages($applImages);
	$showDetails = explode("|",$details);
	
	if ($ImageCount) {
		$cols = $PView -> getPView_config("pics_per_row");
		$pics = $PView -> getPView_config("pics_per_page");
		$picCount = 0;
		$colwidth = floor(100/$cols);
		if ($_GET['page']) {
			$page = $_GET['page'];
		}
		$Pages = ceil($ImageCount/$pics);
		if (!$page or $page > $Pages) {
			$page = 1;
		}
		
		$out_AllImages = "<tr>";
		foreach ($ImageData as $dataset) {
			//PERMISSION!!!
			if ($PView -> getPermission("image",$dataset['imageId'],"View")) {
				// insert images line by line, observe pagelimit
				if ($colCount == $cols) {
					$out_AllImages.= "</tr><tr>";
					$colCount = 0;
				}
				if ($picCount >= ($page - 1) * $pics && $picCount < $page * $pics) {
					$thumb = $PView -> getThumbPath($dataset['imageId']);
					$resize = $PView -> getResizePath($dataset['imageId']);
					if ($PView->getPView_config("seo_links")){
						$seo = "&amp;name=".$dataset['name'];
					} else {
						$seo = "";
					}
					
					$out_AllImages.= "<td style='vertical-align:top;width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'>";
					
                    // call ImageLink
                    $out_AllImages.= $this ->getImageLink($pv_Appl[0],$dataset,"thumb","resize","pview_gal");

					foreach($showDetails as $detail){
						
						switch($detail){
							case "name":
							$out_AllImages.= "<br/><span class='smalltext'><b>".$tp -> toHTML($dataset['name'])."</b></span>";
							break;
							case "descr":
							$out_AllImages.= "<br/><span class='smalltext'>".$tp -> toHTML($dataset['description'])."</span>";
							break;
							case "user":
							$userData = $PView->getUserData($dataset['uploaderUserId']);
							// LINK Check: link to show all images of user
							if ($PView->getPView_config("details_link")){
								$out_AllImages.= "<br/><a href='pviewgallery.php?user=".$dataset['uploaderUserId']."'><span class='smalltext'>".$tp -> toHTML($userData['user_name'])."</span></a>";
							}else{
								$out_AllImages.= "<br/><span class='smalltext'>".$tp -> toHTML($userData['user_name'])."</span>";
							}
							break;
							case "cat":
							if ($catData = $PView -> getCatData($dataset['cat'])){
								$catName = $catData['name'];
							} else {
								$catName = LAN_IMAGE_46;
							}							
							// LINK Check: Link to show all images of category
							if ($PView->getPView_config("details_link") && $dataset['cat']){
								$out_AllImages.= "<br/><a href='pviewgallery.php?cat=".$dataset['cat']."'><span class='smalltext'>".LAN_IMAGE_45.": ".$tp -> toHTML($catName)."</span></a>";
							}else{
								$out_AllImages.= "<br/><span class='smalltext'>".LAN_IMAGE_45.": ".$tp -> toHTML($catName)."</span>";
							}
							break;
							case "date":
							$out_AllImages.= "<br/><span class='smalltext'>".$tp -> toHTML(date('d.m.Y',$dataset['uploadDate']))."</span>";
							break;
							case "gal":
							$albumData = $PView->getAlbumData($dataset['albumId']);
							// LINK Check: link to show gallery
							if ($PView->getPView_config("details_link")){
								$out_AllImages.= "<br/><a href='pviewgallery.php?gallery=".$albumData['galleryId']."'><span class='smalltext'>".$tp -> toHTML($PView->getGalleryName($albumData['galleryId']))."</span></a>";
							}else{
								$out_AllImages.= "<br/><span class='smalltext'>".$tp -> toHTML($PView->getGalleryName($albumData['galleryId']))."</span>";
							}
							break;
							case "album":
							// LINK Check: link to show all images of album
							if ($PView->getPView_config("details_link")){
								$out_AllImages.= "<br/><a href='pviewgallery.php?album=".$dataset['albumId']."'><span class='smalltext'>".$tp -> toHTML($PView->getAlbumName($dataset['albumId']))."</span></a>";
							}else{
								$out_AllImages.= "<br/><span class='smalltext'>".$tp -> toHTML($PView->getAlbumName($dataset['albumId']))."</span>";
							}
							break;
							case "edit":
							//PERMISSION!!!
							if ($PView -> getPermission("album",$dataset['sendImage'],"Edit")) {
								$out_AllImages.= "<br/><a href='pview_actions.php?image=".$dataset['imageId']."&amp;action=edit'><span class='smalltext'>".LAN_IMAGE_2."</span></a>";
							}
							break;
							case "send":
							//PERMISSION!!!
							if (($PView -> getPView_config("email") && $dataset['sendImage']) OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
								if ($PView -> getPermission("config","permEmail","")) {
									$out_AllImages.= "<br/><a href='".e_BASE."email.php?plugin:pviewgallery.".$dataset['imageId']."'><span class='smalltext'>".LAN_IMAGE_48_1."</span></a>";
								}
							}
							break;
							case "comm":
							if ($PView->getPView_config("Comments")){
								$out_AllImages.= "<br /><span class='smalltext'>".LAN_IMAGE_4.": ".$PView -> getCommentsCount($dataset['imageId'])."</span>";
							}							
							break;	
							case "rating":
							if ($PView->getPView_config("Rating")){
								$ratingData = $PView -> getRatingData($dataset['imageId']);
								$out_AllImages.= "<br /><span class='smalltext'>".LAN_IMAGE_3.": ".round($ratingData['value'],1)." (".$ratingData['count'].")</span>";
							}
							break;	
							case "views":
							$out_AllImages.= "<br/><span class='smalltext'>".LAN_IMAGE_16.": ".$tp -> toHTML($dataset['views'])." ".LAN_IMAGE_17."</span>";
							break;																			
						}			
					}
					$out_AllImages.= "</td>";		
					$colCount++;
				}
				$picCount++;
			}
		}
		// fill row with empty cells
		while ($colCount < $cols) {
			$out_AllImages.= "<td style='width:".$colwidth."%;'>&nbsp;</td>";
			$colCount++;
		}
		$out_AllImages.= "</tr>";
		return $out_AllImages;
	}
	return "<div style='padding:10px;'>".$message."</div>";
}
function getAllCats() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getAllCats)) {
	return $UserTemplate->getAllCats();
}

// returns a list of all categories	
	$PView = new PView;
	$catArray = $PView -> getCatArray();
	$catArrayEdv = array();
	// add catimagescount for further sorting
	foreach ($catArray as $key=>$dataset){
		$catArrayEdv[$key]=$PView->getCatImageCount($key);
	}
	// sort list, cat with most images first
	arsort($catArrayEdv);
	$catList.= "<table style='width:100%;' class='fborder'>";
	foreach($catArrayEdv as $key=>$dataset){
		$catData = $PView->getCatData($key);
		$catImageCount = $PView->getCatImageCount($key);
		$catList.= "<tr><td colspan='2' class='forumheader'>";
		// name (image count)
		if ($catImageCount){
			$catList.= "<a href='pviewgallery.php?cat=".$key."'>";
			$catList.= $catData['name'];
			$catList.= "</a>";
		} else{
			$catList.= $catData['name'];
		}
		if ($catData['icon']){
			$icon = "<img src='".e_IMAGE."icons/".$catData['icon']."'>";
		} else {
			$icon = "&nbsp;";
		}
		
		$catList.= "<span class='smalltext'> (".$catImageCount."&nbsp;".LAN_ALBUM_1.")</span>";
		$catList.= "</td></tr><tr><td width='20%' style='padding-bottom:10px; text-align:center;'>";
		// icon
		if ($catImageCount){
			$catList.= "<a href='pviewgallery.php?cat=".$key."'>";
			$catList.= $icon;
			$catList.= "</a>";
		} else{
			$catList.= $icon;
		}			
		
		$catList.= "</td><td width='80%' style='padding-bottom:10px;'>";
		// description
		$catList.= $catData['description'];
		$catList.= "</td></tr>";
	}
	
	$catList.= "</table>";
	
	return $catList;
}
function getAllUsers(){
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getAllUsers)) {
	return $UserTemplate->getAllUsers();
}

// returns a list of all useres, they uploaded images
	$PView = new PView;
	$Appl = $PView -> getAppl();
	$u_SQL =& new db;
	$userArray = array();
	$u_SQL -> db_Select("user", "user_id","", "nowhere");
	while($userTmp = $u_SQL -> db_Fetch()) {
		if ($userImagesCount = $PView->getUserImageCount($userTmp['user_id'])){
			$userArray[$userTmp['user_id']] = $userImagesCount;
		}
	}
	arsort($userArray);
	
	$userList.= "<table class='fborder' width='100%'>";
	foreach ($userArray as $key=>$dataset) {
		$userData = $PView->getUserData($key);
		$userList.= "<tr><td class='forumheader' colspan='2'>".$userData['user_name']."</td></tr>";
		$userList.= "<tr><td width='30%' style='vertical-align:middle;'>";
		if ($userimage = $userData['user_image']){
			$userList.= "<img src='".avatar($userimage)."' style='padding:5px;' />";
		} else {
			$userList.= "<img src='";
			$userList.= SITEURLBASE.e_PLUGIN_ABS."pviewgallery/templates/".$PView -> getPView_config("template")."/images/profile.png";
			$userList.= "' alt='".LAN_IMAGE_53."' title='".LAN_IMAGE_53."' style='padding:5px;' />";
		}
		$userList.= "</td><td width='70%'>";
		$userList.= "<b><a href='".e_BASE."user.php?id.".$key."'>".$userData['user_name']."</a></b>";
		$userList.= "<p style='padding-top:10px;'><a href='pviewgallery.php?user=".$key."'>".$dataset."&nbsp;".LAN_ALBUM_1."</a></p>";
		$userList.= "<p class='smalltext' style='padding-top:20px;'>".$userData['user_signature']."</p>";
		$userList.= "</td></tr>";
	}
	$userList.= "</table>";	
	
	return $userList;
}
function getPages() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getPages)) {
	return $UserTemplate->getPages();
}

// returns pages-footer for album view
	$PView = new PView;
	$pics = $PView -> getPView_config("pics_per_page");
	$pv_Appl = $PView -> getAppl();
	if ($_GET['page']) {
		$page = $_GET['page'];
	}
	if (isset($_GET['album'])){
		$imgCount = $PView -> getAlbumImageCount();
		$link = "album=";
	}
	if (isset($_GET['user'])){
		$imgCount = $PView -> getUserImageCount($_GET['user']);
		$link = "user=";
	}
	if (isset($_GET['cat'])){
		$imgCount = $PView -> getCatImageCount($_GET['cat']);
		$link = "cat=";
	}		
	
	if (!$imgCount) { return ""; } //exit
	$Pages = ceil($imgCount/$pics);
	if (!$page or $page > $Pages) {
	$page = 1;
	}
	if ($page > 1) {
		$prevPage = "<span class='button' style='margin:20px;'>&nbsp;<a href='pviewgallery.php?".$link.$pv_Appl[1]."&amp;page=".strval($page-1)."'>".LAN_ALBUM_10."</a>&nbsp;</span>";
	}
	if ($page < $Pages) {
	$nextPage = "<span class='button' style='margin:20px;'>&nbsp;<a href='pviewgallery.php?".$link.$pv_Appl[1]."&amp;page=".strval($page+1)."'>".LAN_ALBUM_11."</a>&nbsp;</span>";
	}
	
return "<table><tr><td width='35%'>&nbsp;".$prevPage."</td><td width='30%'>".LAN_ALBUM_12."&nbsp;".$page."&nbsp;".LAN_ALBUM_13."&nbsp;".$Pages."</td><td width='35%'>".$nextPage."&nbsp;</td></tr></table>";
}
function getAllAlbums($typ) {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getAllAlbums)) {
	return $UserTemplate->getAllAlbums($typ);
}

// returns all albums for gallery and subalbum view
	$PView = new PView;
	global $tp;
	
	if ($typ == "root"){
		$AllAlbumData = $PView -> getRootAlbumData();
	} else {
		if (!$PView -> getSubAlbumsCount()) { return ""; }// exit if no subalbums
		$AllAlbumData = $PView -> getSubAlbumData();	
	}

	$cols = $PView -> getPView_config("gal_cols");
	$colwidth = floor(100/$cols);
	$details = $PView->getPView_config("gal_details");
	$showDetails = explode("|",$details);
	$thumbPos = $this->getThumbPosition();
	
	$out_AllAlbums = "<tr><td colspan='2' style='padding-top:5px;'><table style='width:100%; border:0px;'><tr>";
	foreach ($AllAlbumData as $dataset) {
		//PERMISSION!!!
		if ($PView -> getPermission("album",$dataset['albumId'],"View")) {
			if ($count+1 > $cols) {
				$out_AllAlbums .= "<tr>";
				$count = 0;
			}
			$out_AllAlbums .= "<td style='vertical-align:top;width:".$colwidth."%;'><table style='width:100%;'>";
			if (array_search("name",$showDetails) !== FALSE && array_search("info",$showDetails) !== FALSE) {
				// name and info in a row
				$out_AllAlbums .= "<tr><td class='forumheader' colspan='2' style='".$thumbPos."'><a href='pviewgallery.php?album=".$dataset['albumId']."'>". $tp -> toHTML($dataset['name'])."</a> <span class='smalltext'>(".LAN_ALBUM_1.": ".$PView -> getAlbumImageCount($dataset['albumId'])." / ".LAN_ALBUM_2.": ".$PView -> getSubAlbumsCount($dataset['albumId']).")</span></td></tr>";
			} else {
				if (array_search("name",$showDetails) !== FALSE) {
					// name only
					$out_AllAlbums .= "<tr><td class='forumheader' colspan='2' style='".$thumbPos."'><a href='pviewgallery.php?album=".$dataset['albumId']."'>". $tp -> toHTML($dataset['name'])."</a></td></tr>";
				}				
			}
			if (array_search("descr",$showDetails) === FALSE) {
				// thumb without description
				$out_AllAlbums .= "<tr style='height:90px;'><td colspan='2' style='".$thumbPos."'><a href='pviewgallery.php?album=".$dataset['albumId']."'><img src='".$PView -> getAlbumImage($dataset['albumId'])."' border='0px' title='".$dataset['name']."'></a>&nbsp;";
				if (array_search("name",$showDetails) === FALSE && array_search("info",$showDetails) !== FALSE) {
					$out_AllAlbums .= "<br><span class='smalltext'>(".LAN_ALBUM_1.": ".$PView -> getAlbumImageCount($dataset['albumId'])." / ".LAN_ALBUM_2.": ".$PView -> getSubAlbumsCount($dataset['albumId']).")</span>";
				}
				if (array_search("edit",$showDetails) !== FALSE && $PView -> getPermission("album",$dataset['albumId'],"Edit")) {
					$out_AllAlbums .= "<div style='padding-top:5px;'><a href='pview_actions.php?album=".$dataset['albumId']."&action=edit'>".LAN_ALBUM_7."</a></div>";
				}				
				$out_AllAlbums .= "</td></tr></table></td>";
			} else {
				// thumb with description
				$out_AllAlbums .= "<tr style='height:90px;'><td style='width:150px;'><a href='pviewgallery.php?album=".$dataset['albumId']."'><img src='".$PView -> getAlbumImage($dataset['albumId'])."' border='0px' title='".$dataset['name']."'></a>&nbsp;</td>";
				$out_AllAlbums .= "<td>".$tp -> toHTML($dataset['description'])."&nbsp;";
				if (array_search("name",$showDetails) === FALSE && array_search("info",$showDetails) !== FALSE) {
					$out_AllAlbums .= "<br><span class='smalltext'>(".LAN_ALBUM_1.": ".$PView -> getAlbumImageCount($dataset['albumId'])." / ".LAN_ALBUM_2.": ".$PView -> getSubAlbumsCount($dataset['albumId']).")</span>";
				}
				if (array_search("edit",$showDetails) !== FALSE && $PView -> getPermission("album",$dataset['albumId'],"Edit")) {
					$out_AllAlbums .= "<div style='padding-top:5px;'><a href='pview_actions.php?album=".$dataset['albumId']."&action=edit'>".LAN_ALBUM_7."</a></div>";
				}			
				$out_AllAlbums .= "</td></tr></table></td>";				
			}
			if ($count+1 == $cols) {
				$out_AllAlbums .= "</tr>";
			}
			$count++;
		}
	}
	
	$out_AllAlbums .= "</table></td></tr>";
	if (!strip_tags($out_AllAlbums)) {
	$out_AllAlbums = "<tr><td colspan='2' style='padding:10px;'>".LAN_GALLERY_4."</td></tr>";
	}
return $out_AllAlbums;
}
function getUserGalleries() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getUserGalleries)) {
	return $UserTemplate->getUserGalleries();
}

// returns all usergalleries for gallery view
	$PView = new PView;
	global $tp;
	$UserGalleryData = $PView -> getAllGalleryData();

	$out_UserGalleries = "<tr><td colspan='2' style='padding-top:5px;'><table style='width:100%'>";
	foreach ($UserGalleryData as $dataset) {
		if ($dataset['galleryId']) {
			$UserArray = $PView -> getUserData($dataset['galleryId']);
			$UserName = $UserArray['user_name'];
			//PERMISSION!!!
			if ($PView -> getPermission("gallery",$dataset['galleryId'],"View")) {
				$out_UserGalleries .= "<tr><td class='forumheader'><a href='pviewgallery.php?gallery=".$dataset['galleryId']."'>".$UserName.": ". $tp -> toHTML($dataset['name'])."</a> ";
				if (!$dataset['active']) {
					$out_UserGalleries .= LAN_GALLERY_7;
				}
				$out_UserGalleries .= "</td></tr>";
			}
		}
	}
	$out_UserGalleries .= "</table></td></tr>";
	return $out_UserGalleries;
}
function getImageInfo() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getImageInfo)) {
	return $UserTemplate->getImageInfo();
}

// returns image informations for image view
	$PView = new PView;
	global $tp;
	$Appl = $PView -> getAppl();

	$ImageData = $PView -> getImageData($Appl[1]);
	$UploadUser = $PView -> getUserData($ImageData['uploaderUserId']);
	if ($catData = $PView -> getCatData($ImageData['cat'])){
		$catName = $catData['name'];
	} else {
		$catName = LAN_IMAGE_46;
	}
	$FileSize = round(filesize($PView -> getOrigPath($Appl[1],"REL",1))/1024,2);
	$ImageSize = getimagesize($PView -> getOrigPath($Appl[1],"REL",1));
	$showDetails = explode("|",$PView->getPView_config("img_details"));
	
	foreach($showDetails as $detail){
		
		switch($detail){
			case "name":
			$out_ImageInfo = "<tr><td width='30%'>".LAN_IMAGE_9.":</td><td>".$tp -> toHTML($ImageData['name'])."&nbsp;</td></tr>";
			break;
			case "descr":
			$out_ImageInfo.= "<tr><td width='30%' style='vertical-align:top;'>".LAN_IMAGE_10.":</td><td>".$tp -> toHTML($ImageData['description'])."&nbsp;</td></tr>";
			break;
			case "user":
			$userData = $PView->getUserData($dataset['uploaderUserId']);
			// LINK Check: link to show all images of user
			if ($PView->getPView_config("details_link")){
				$out_ImageInfo.= "<tr><td width='30%'>".LAN_IMAGE_13.":</td><td><a href='pviewgallery.php?user=".$ImageData['uploaderUserId']."'>".$UploadUser['user_name']."</a></td></tr>";
			}else{
				$out_ImageInfo.= "<tr><td width='30%'>".LAN_IMAGE_13.":</td><td>".$UploadUser['user_name']."</td></tr>";
			}
			break;
			case "cat":
			//$catData = $PView->getCatData($dataset['cat']);
			// LINK Check: link to show all images of category
			if ($PView->getPView_config("details_link") && $catData){
				$out_ImageInfo.= "<tr><td width='30%' style='vertical-align:top;'>".LAN_IMAGE_45.":</td><td><a href='pviewgallery.php?cat=".$ImageData['cat']."'>".$catName."</a></td></tr>";
			}else{
				$out_ImageInfo.= "<tr><td width='30%' style='vertical-align:top;'>".LAN_IMAGE_45.":</td><td>".$catName."</td></tr>";
			}
			break;
			case "date":
			$out_ImageInfo.= "<tr><td width='30%'>".LAN_IMAGE_14.":</td><td>".date('d.m.Y',$ImageData['uploadDate'])."&nbsp;</td></tr>";
			break;	
			case "rating":
			if ($PView -> getPView_config("Rating")) {
				$out_ImageInfo.= "<tr><td width='30%'>".LAN_IMAGE_3.":</td><td>{pv_RatingResult}&nbsp;</td></tr>";
				//PERMISSION!!!
				if ($PView -> getPermission("config","permRating","") && !$PView -> getUserRated()) {
					$out_ImageInfo.= "<tr><td width='30%' style='vertical-align:top;'>".LAN_IMAGE_20.":</td><td>{pv_RatingRate}&nbsp;</td></tr>";
				}
			}
			break;	
			case "views":
			$out_ImageInfo.= "<tr><td width='30%'>".LAN_IMAGE_16.":</td><td>".$ImageData['views']."&nbsp;".LAN_IMAGE_17."</td></tr>";
			break;
			case "dim":
			$out_ImageInfo.= "<tr><td width='30%'>".LAN_IMAGE_11.":</td><td>".$ImageSize[0]." x ".$ImageSize[1]."&nbsp;".LAN_IMAGE_15."</td></tr>";
			break;	
			case "size":
			$out_ImageInfo.= "<tr><td width='30%'>".LAN_IMAGE_12.":</td><td>".$FileSize." kB&nbsp;</td></tr>";
			break;																	
		}			
	}	
	return $out_ImageInfo;
}
function getNavMenu() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getNavMenu)) {
	return $UserTemplate->getNavMenu();
}

// returns navigation menu for image view
	$PView = new PView;
	$Appl = $PView -> getAppl();
	$page = 1;

	global $applImages;
	$imagesData = $PView->sortApplImages($applImages);
	
	foreach($imagesData as $key => $dataset){
		if ($dataset['imageId'] == $Appl[1]){
			$currImage = $key;
		}
	}
	//back to list
	$currImageData = $PView->getImageData($Appl[1]);
	while ($PView->getPView_config("pics_per_page")*$page < $currImage + 1){
		$page++;
	}
	if (isset($_GET['view'])) {
		$view = $_GET['view'];
	}else{
		$view = "";
	}
	switch ($view) {
		case "cat":
			$backTo = "cat=".$currImageData['cat']."&amp;page=".$page;
			$linkText = LAN_IMAGE_51;
		break;
		case "user":
			$backTo = "user=".$currImageData['uploaderUserId']."&amp;page=".$page;
			$linkText = LAN_IMAGE_52;
		break;		
		case "album":
			$backTo = "album=".$currImageData['albumId']."&amp;page=".$page;
			$linkText = LAN_IMAGE_8;
		break;
		case "":
			// default for call from menu or a direct link
			$backTo = "album=".$currImageData['albumId']."&amp;page=".$page;
			$linkText = LAN_IMAGE_8;
		break;		
	}

	//first image
	$imageFirst = $imagesData[0]['imageId'];

	//last image
	$imageLast = $imagesData[count($imagesData) - 1]['imageId'];
	//previous image
	$imagePrev = $imagesData[$currImage - 1]['imageId'];
	//next image
	$imageNext = $imagesData[$currImage + 1]['imageId'];

	$NavMenu = "<table width='100%'><tr>";
	$NavMenu.= "<td width='16%' style='text-align:center;'><a href='pviewgallery.php?image=".$imageFirst."&amp;view=".$view."'><span class='button' style='padding-left:4px; padding-right:4px;'>&lt;&lt; ".LAN_IMAGE_29."</span></a></td>";
	$NavMenu.= "<td width='16%' style='text-align:center;'>";
	if ($imagePrev) {
		$NavMenu.= "<a href='pviewgallery.php?image=".$imagePrev."&amp;view=".$view."'><span class='button' style='padding-left:4px; padding-right:4px;'>&lt; ".LAN_IMAGE_6."</span></a>";
	}
	$NavMenu.= "&nbsp;</td>";
	$NavMenu.= "<td width='28%' style='text-align:center;'><a href='pviewgallery.php?".$backTo."'><span class='button' style='padding-left:4px; padding-right:4px;'>".$linkText."</span></a></td>";
	$NavMenu.= "<td width='16%' style='text-align:center;'>";
	if ($imageNext) {
		$NavMenu.= "<a href='pviewgallery.php?image=".$imageNext."&amp;view=".$view."'><span class='button' style='padding-left:4px; padding-right:4px;'>".LAN_IMAGE_7." &gt;</span></a>";
	}
	$NavMenu.= "&nbsp;</td>";
	$NavMenu.= "<td width='16%' style='text-align:center;'><a href='pviewgallery.php?image=".$imageLast."&amp;view=".$view."'><span class='button' style='padding-left:4px; padding-right:4px;'>".LAN_IMAGE_30." &gt;&gt;</span></a></td>";
	$NavMenu.= "</tr></table>";
	return $NavMenu;
}
function getGalleryMenu($galType) {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getGalleryMenu)) {
	return $UserTemplate->getGalleryMenu($galType);
}

// returns menu for gallery view
	$PView = new PView;
	$Appl = $PView -> getAppl();
	if ($galType == "main") {
		// PERMISSION!!!
		if ($PView -> getPermission("gallery",$Appl[1],"CreateAlbum")) {
			$galMenu = "<a href='".e_PLUGIN."pviewgallery/pview_actions.php?gallery=".$Appl[1]."&amp;action=newalbum'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/pv_insert_gray.gif' border='0px'alt='".LAN_GALLERY_2."' title='".LAN_GALLERY_2."'></a>";
		}
		// PERMISSION!!!
		if ($PView -> getPermission("gallery",$Appl[1],"Edit")) {
			$galMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?gallery=".$Appl[1]."&amp;action=edit'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/pv_edit_gray.gif' border='0px'alt='".LAN_GALLERY_6."' title='".LAN_GALLERY_6."'></a>";
		}
	}
	if ($galType == "user") {
		// PERMISSION!!!
		if ($PView -> getPermission("config","permCreateGallery","")) {
			$galMenu = "<a href='".e_PLUGIN."pviewgallery/pview_actions.php?gallery=".$Appl[1]."&amp;action=newgallery'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/pv_insert_gray.gif' border='0px'alt='".LAN_GALLERY_1."' title='".LAN_GALLERY_1."'></a>";
		}
	}
	return $galMenu;
}
function getAlbumMenu() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getAlbumMenu)) {
	return $UserTemplate->getAlbumMenu();
}

// returns menu for album view
	$PView = new PView;
	$Appl = $PView -> getAppl();
	$AlbumMenu.= "<form action='".e_SELF."?".e_QUERY."' method='post'>";
	
	// PERMISSION!!!
	if ($PView -> getPermission("album",$Appl[1],"CreateAlbum")) {
		$AlbumMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$Appl[1]."&amp;action=newalbum'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/pv_insert_gray.gif' border='0px'alt='".LAN_ALBUM_6."' title='".LAN_ALBUM_6."'></a>";
	}
	
	// button to nominate image for featured pictures
	if ($PView -> getPView_config("Nominate") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> checkNomLimit("album")) {
			if ($PView -> getPermission("config","permNominate","")) {
				if ($PView->getAlbumNom($Appl[1])) {
					$AlbumMenu.= " <img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/nominate.png' border='0px'alt='".LAN_ALBUM_21."' title='".LAN_ALBUM_21."'>";
				}else {
					$AlbumMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?view=".$_GET['view']."&amp;nomalbum=".$Appl[1]."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/nominate.png' border='0px'alt='".LAN_ALBUM_20."' title='".LAN_ALBUM_20."'></a>";
				}	
			}			
		}
	}	
	
	// PERMISSION!!!
	if ($PView -> getPermission("album",$Appl[1],"Edit")) {
		$AlbumMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$Appl[1]."&amp;action=edit'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/pv_edit_gray.gif' border='0px'alt='".LAN_ALBUM_7."' title='".LAN_ALBUM_7."'></a>";
	}
	// PERMISSION!!!
	if ($PView -> getPermission("album",$Appl[1],"Upload")) {
		$AlbumMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$Appl[1]."&amp;action=upload'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/pv_upload_gray.gif' border='0px'alt='".LAN_ALBUM_8."' title='".LAN_ALBUM_8."'></a>";
	}
	// ViewerSort
	if ($PView->getPView_config("viewer_sort")){
		$AlbumMenu.= "<br>".LAN_ALBUM_19.": ".$PView->getSortBox("album",1);
	}
	$AlbumMenu.= "</form>";
	return $AlbumMenu;
}
function getCatMenu() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getCatMenu)) {
	return $UserTemplate->getCatMenu();
}

// returns menu for category view
	$PView = new PView;
	$Appl = $PView -> getAppl();
	$CatMenu.= "<form action='".e_SELF."?".e_QUERY."' method='post'>";
	
	// ViewerSort
	if ($PView->getPView_config("viewer_sort")){
		$CatMenu.= LAN_ALBUM_19.": ".$PView->getSortBox("cat",1);
	}
	$CatMenu.= "</form>";
	return $CatMenu;	
}
function getUserMenu() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getUserMenu)) {
	return $UserTemplate->getUserMenu();
}
	
// returns menu for user view
	$PView = new PView;
	$Appl = $PView -> getAppl();
	$UserMenu.= "<form action='".e_SELF."?".e_QUERY."' method='post'>";
	
	// ViewerSort
	if ($PView->getPView_config("viewer_sort")){
		$UserMenu.= LAN_ALBUM_19.": ".$PView->getSortBox("user",1);
	}
	$UserMenu.= "</form>";
	return $UserMenu;	
}
function getImageMenu() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getImageMenu)) {
	return $UserTemplate->getImageMenu();
}
	
// returns menu for image view
	$PView = new PView;
	$Appl = $PView -> getAppl();
	$ImageData = $PView -> getImageData($Appl[1]);
	// button for printerfriendly page
	if ($PView -> getPView_config("print") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> getPermission("config","permPrint","")) {
			$ImageMenu.= " <a href='".e_BASE."print.php?plugin:pviewgallery.".$Appl[1]."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/printer.png' border='0px'alt='".LAN_IMAGE_47."' title='".LAN_IMAGE_47."'></a>";
		}
	}
	
	// button for Send image per email
	if (($PView -> getPView_config("email") && $ImageData['sendImage']) OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> getPermission("config","permEmail","")) {
			$ImageMenu.= " <a href='".e_BASE."email.php?plugin:pviewgallery.".$Appl[1]."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/email.png' border='0px'alt='".LAN_IMAGE_48."' title='".LAN_IMAGE_48."'></a>";
		}
	}	
	
	// button for generate pdf
	if ($PView -> getPView_config("pdf") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> getPermission("config","permPdf","")) {
			$ImageMenu.= " <a href='".e_PLUGIN."pdf/pdf.php?plugin:pviewgallery.".$Appl[1]."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/pdf.png' border='0px'alt='".LAN_IMAGE_49."' title='".LAN_IMAGE_49."'></a>";
		}
	}	
	
	
	// additional button to use image as albumimage (depends on album permission)
	if ($PView -> getPermission("album",$PView -> getImageAlbum(),"Edit") && $ImageData['thumbnail']) {
		$ImageMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$PView -> getImageAlbum()."&amp;changeimage=".$Appl[1]."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/star.png' border='0px'alt='".LAN_ACTION_31."' title='".LAN_ACTION_31."'></a>";
	}
	
	// button to nominate image for featured pictures
	if ($PView -> getPView_config("Nominate") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> checkNomLimit("image")) {
			if ($PView -> getPermission("config","permNominate","")) {
				if ($PView->getImageNom($Appl[1])) {
					$ImageMenu.= " <img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/nominate.png' border='0px'alt='".LAN_IMAGE_57."' title='".LAN_IMAGE_57."'>";
				}else {
					$ImageMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?view=".$_GET['view']."&amp;nomimage=".$Appl[1]."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/nominate.png' border='0px'alt='".LAN_IMAGE_56."' title='".LAN_IMAGE_56."'></a>";
				}	
			}			
		}
	}
	
	// PERMISSION!!!
	if ($PView -> getPermission("image",$Appl[1],"Edit")) {
		$ImageMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?image=".$Appl[1]."&amp;action=edit'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/edit.png' border='0px'alt='".LAN_IMAGE_2."' title='".LAN_IMAGE_2."'></a>";
	}
	$ImageSize = getimagesize($PView -> getOrigPath($Appl[1],"REL",1));
	$ImageMenu.= 	"<script type=\"text/javascript\">
					function showImage() {
						pv_imagezoom(\"".$PView -> getOrigPath($Appl[1])."\",".$ImageSize[0].",".$ImageSize[1].",\"".$PView -> getImageName($Appl[1])."\",\"".LAN_IMAGE_44."\");
					}
					</script>";
	$ImageMenu.= " <a href='javascript:showImage();'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/zoom.png' border='0px'alt='".LAN_IMAGE_1."' title='".LAN_IMAGE_1."'></a>";

	return $ImageMenu;
}
function getButton_addComment() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getButton_addComment)) {
	return $UserTemplate->getButton_addComment();
}
	
// returns a button image incl. link
	$PView = new PView;
	// PERMISSION!!!
	if ($PView -> getPermission("config","permComment","")) {
		if (!$_GET['comment'] && !$_POST['submit']) {
			$btn = "<a href='javascript:pv_CommentAdd();'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/pv_insert_gray.gif' border='0px'alt='".LAN_IMAGE_18."' title='".LAN_IMAGE_18."'></a>";
		}
	}
	return $btn;
}
function getButton_editComment($commentid) {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getButton_editComment)) {
	return $UserTemplate->getButton_editComment($commentid);
}
	
// returns a button image incl. link
	$PView = new PView;
	// PERMISSION!!!
	if ($PView -> getPermission("config","permComment","")) {
	$btn = "<a href='pviewgallery.php?image=".$_GET['image']."&comment=".$commentid."#a_preview'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/pv_edit_gray.gif' border='0px'alt='".LAN_IMAGE_19."' title='".LAN_IMAGE_19."'></a>";
	}
	return $btn;
}
function getComments() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getComments)) {
	return $UserTemplate->getComments();
}
	
// returns 3 div tags: comment_show, comment_edit, comment_preview
	$PView = new PView;
	global $tp;
	global $pref;
	global $sql;
	
	$Comments_perPage = $PView -> getPView_config("comments_per_page");
	$Count = 0;
	$out_HTML = "";
	$hiddenFields = "<input type='hidden' name='appl' id='appl' value='ADD' />";
	$formText = "";
	$PreviewComment = $tp -> toDB($_POST['pview_comment']);
	if (!$PreviewComment) {
		$sql->db_Select("pview_comment", "commentText", "WHERE commentId='$_GET[comment]'", "nowhere");
		list($PreviewComment) = $sql -> db_Fetch();
	}
	$Comments = $PView -> getCommentsData();
	$CommentCount = $PView -> getCommentsCount();
	if ($_GET['page']) {
		$page = $_GET['page'];
	}
		if ($_GET['view']) {
		$view = "&view=".$_GET['view'];
	}
	$Pages = ceil($CommentCount/$Comments_perPage);
	if (!$page or $page > $Pages) {
		$page = 1;
	}
	if ($page < $Pages) {
		$moreComments = "<a href='pviewgallery.php?image=".$_GET['image']."&page=".strval($page+1).$view."'>".LAN_IMAGE_34."</a>";
	}
	
	// Show Comments
	$out_HTML.= "<div name='comment_show' id='comment_show'";
	if ($_POST['submit'] == LAN_IMAGE_38 OR $_GET['comment']) {
		$out_HTML.= " style='display:none;'";
	}
	$out_HTML.= ">";
	if (!$CommentCount) {
		$out_HTML.= "<div style='padding:10px;'>".LAN_IMAGE_28."</div>";
	} else {
		$out_HTML.= "<table cellspacing='0px' style='width:68%;'>";
		foreach ($Comments as $dataset) {
			// table with all comments, observe pagelimit
			if ($Count >= ($page - 1) * $Comments_perPage && $Count < $page * $Comments_perPage) {
			$User = $PView -> getUserData($dataset['commente107userId']);
			$out_HTML.= "<tr><td><span class='smalltext'>".$User['user_name']."&nbsp;".LAN_IMAGE_26."&nbsp;".date('d.m.Y',$dataset['commentDate']).":</span></td><td style='text-align:right'>";
			if ($dataset['commente107userId'] == USERID OR ADMIN) {
				$out_HTML.= $this -> getButton_editComment($dataset['commentId']);
			}
			$out_HTML.= "</td></tr><tr><td colspan='2' style='padding-bottom:10px'>".$tp -> post_toHTML($dataset['commentText'], true)."</td></tr>";
			}
			$Count++;
		}
		$out_HTML.= "<tr><td colspan='2' style='text-align:right'>".$moreComments."</td></tr>";
		$out_HTML.= "</table>";
	}
	$out_HTML.= "</div>";
	
	// preview Comment
	$out_HTML.= "<a name='a_preview' id='a_preview'></a><center><div name='comment_preview' id='comment_preview' style='padding-top:10px; width:68%; text-align:left; display:block;'>";
	if ($_POST['submit'] == LAN_IMAGE_38 OR $_GET['comment']) {
		$out_HTML.= $tp -> post_toHTML($PreviewComment,TRUE);
		$formText = $tp -> toForm($PreviewComment);
		$hiddenFields = $PView -> getHiddenFields();
	}
	$out_HTML.= "</div></center>";
	
	// add, edit Comments	
	$out_HTML.= "<script type=\"text/javascript\">
				function frmVerify() {
					if(document.getElementById('pview_comment').value == \"\") {
						alert('".LAN_IMAGE_39."');
						return false;
					}
				}
		</script>";

	if ($_POST['submit'] == LAN_IMAGE_38 OR $_GET['comment']) {
		$out_HTML.= "<div style='text-align:center; display:block;' name='comment_edit' id='comment_edit'>";
	} else {
		$out_HTML.= "<div style='text-align:center; display:none;' name='comment_edit' id='comment_edit'>";
	}
	$out_HTML.= "<form id='dataform' method='post' action='".$PView -> getLink('submit')."' onsubmit='return frmVerify()'>\n";
	$out_HTML.= $hiddenFields;
	$out_HTML.= "<div style='padding-top:20px; padding-bottom:5px;' class='smalltext'>".LAN_IMAGE_25."</div>";
	$out_HTML.= "<table>";
	if ($pref['wysiwyg'] && !$PView -> getPView_config('Comment_simple')) {
		require_once(e_HANDLER . "tiny_mce/wysiwyg.php");
	} else {
		require_once(e_HANDLER."ren_help.php");
	}
	if (!$pref['wysiwyg']) {
		$insertjs = "rows='10' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'";
	} else {
		$insertjs = "rows='25' ";
		if ($PView -> getPView_config('Comment_simple')) {
			$insertjs = "rows='10' ";
		}
	}
	$out_HTML.= "<tr><td style=widht:100%;'>";
	$out_HTML.= "<textarea class='tbox' id='pview_comment' name='pview_comment' cols='90' ".$insertjs.">".$formText."</textarea><br />";
	if (!$pref['wysiwyg'] && !$PView -> getPView_config('Comment_simple')) {
		$out_HTML.= "<input id='helpb' class='helpbox' type='text' size='100' name='helpb'/>";
		$out_HTML.= "<br />".display_help("helpb");
	}
	$out_HTML.= "</td></tr></table>";

	$out_HTML.= "<input style='margin:10px;' class='button' type='submit' name='submit' value='".LAN_IMAGE_38."' />";
	$out_HTML.= "<input style='margin:10px;' class='button' type='submit' name='submit' value='".LAN_IMAGE_40."' />";
	if (ADMIN && $_GET['comment']) {
		$out_HTML.= "<input style='margin:10px;' class='button' type='button' name='delete' value='".LAN_IMAGE_42."' onclick='window.location.href = \"".e_SELF."?".e_QUERY."&deletecomment=".$_GET['comment']."\";'/>";
	}
	$out_HTML.= "<input style='margin:10px;' class='button' type='button' name='cancel' value='".LAN_IMAGE_27."' onclick='window.location.href = \"".$PView -> getLink('cancel')."\";'/>";
	
	$out_HTML.= "</form></div>";

	return $out_HTML;
}

function getRating() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getRating)) {
	return $UserTemplate->getRating();
}
	
// returns rate-images and summery
	$PView = new PView;
	$Result = $PView -> getRatingData();
	$roundFull = floor($Result['value']);
	$roundPart = (round($Result['value'],1) - $roundFull) * 10;
	if (!$Result['count']) {
		return LAN_IMAGE_21;
	}
	for ($i=0; $i < $roundFull; $i++) {
		$out_HTML.= "<img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/rate/star.png'>";
	}
	if ($roundPart) {
		$out_HTML.= "<img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/rate/".$roundPart.".png'>";
	}
	$out_HTML.= "<span style='padding-left:20px;'>(".round($Result['value'],1)."&nbsp;".LAN_IMAGE_22."&nbsp;".$Result['count']."&nbsp;".LAN_IMAGE_23.")</span>";
	return $out_HTML;
}
function getRate() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getRate)) {
	return $UserTemplate->getRate();
}
	
// returns rate-images in DHTML
	$PView = new PView;
	$Appl = $PView -> getAppl();
	if ($Appl[0] == "image" && !$imageid) {
		$imageid = $Appl [1];
	}
	if (isset($_GET['view'])) {
		$view = $_GET['view'];
	}else{
		$view = "album";
	}	
	for ($i=1; $i <= 10; $i++) {
	$out_HTML.= "<a href='pview_actions.php?rate=".$i."&amp;image=".$imageid."&amp;view=".$view."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/rate/star_gray.png' border='0px' name='star".$i."' onmouseover='pv_colorchange(".$i.")' onmouseout='pv_colorreset()'></a>";
	}
	$out_HTML.= "<br><span class='smalltext'>".LAN_IMAGE_24."</span>";
	return $out_HTML;
}
function getThumbPosition() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getThumbPosition)) {
	return $UserTemplate->getThumbPosition();
}
	
// returns style string for thumbnailposition
	$PView = new PView;
	if ($PView->getPView_config("center_thumbs")) {
		$thumbPos = " text-align: center;";
	} else {
		$thumbPos = "";
	}
	return $thumbPos;
}

function getImageLink($view,$imageData,$thumb_size,$img_size,$group){
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getImageLink)) {
	return $UserTemplate->getImageLink($view,$imageData,$thumb_size,$img_size,$group);
}

// returns image incl. links as specified for gallery pages	

// $view: backlink (album, user, cat) only used for pview
// $imageData: Array
// $thumb_size: size (thumb,resize,original) of shown image (link)
// $img_size: size (thumb,resize,original) of shown image (destination)
// $group: group to built galleries in javascripts

	$PView = new PView;	
	
    // prepare seo optimization
	if ($PView->getPView_config("seo_links")){
		$seo = "&amp;name=".$imageData['name'];
	} else {
		$seo = "";
	}
    // prepare view for backlink
	if ($view) {
		$view = "&amp;view=".$view;
	} else {
		$view = "&amp;view=album";
	}
    // prepare scripttype for gallery use only
	if ($PView -> getPView_config("img_Link_gal_extJS")) {
		$script = $PView -> getPView_config("img_Link_extJS");
	} else {
		$script = "noscript";
	}    
	
	switch ($thumb_size) {
		case "thumb":
		$thumb = $PView -> getThumbPath($imageData['imageId']);
		break;
		case "resize":
		$thumb = $PView -> getResizePath($imageData['imageId']);
		break;
		case "original":
		$thumb = $PView -> getOrigPath($imageData['imageId']);
		break;		
		default:
		$thumb = $PView -> getThumbPath($imageData['imageId']);
	}
	switch ($img_size) {
		case "thumb":
		$image = $PView -> getThumbPath($imageData['imageId']);
		break;
		case "resize":
		$image = $PView -> getResizePath($imageData['imageId']);
		break;
		case "original":
		$image = $PView -> getOrigPath($imageData['imageId']);
		break;		
		default:
		$image = $PView -> getResizePath($imageData['imageId']);
	}	
	
	switch ($script) {
		case "noscript":
		// image will open in pviewgallery
		$anchor_start = "<a href='pviewgallery.php?image=".$imageData['imageId'].$view.$seo."'>";
		$anchor_end = "</a>";
		break;
		case "lightbox":
		// image will open in lightbox group
		$anchor_start = "<a href='".$image."' rel='lightbox[".$group."]' title='".$imageData['name']."'>";
		$anchor_end = "</a>";
		break;
		case "lightbox26":
		// image will open in lightbox group
		$anchor_start = "<a href='".$image."' rel='lightbox[".$group."]' title='".$imageData['name']."'>";
		$anchor_end = "</a>";
		break;		
		case "highslide":
		// image will open in highslide gallery group (incl. slideshow)
		if ($PView -> getPView_config('img_Link_extJS_pview')) {
			// if pview scripts used, special option can be activated!!!
			$anchor_start = "<a href='".$image."'  class='highslide' onclick=\"return hs.expand(this,".$group.")\" title='".$imageData['name']."'>";
			$anchor_end = "</a>";			
		} else {
			// eHighslide plugin compatible
			$anchor_start = "<a href='".$image."'  class='highslide' onclick='return hs.expand(this)' title='".$imageData['name']."'>";
			$anchor_end = "</a>";			
		}
		break;	
		case "shadowbox":
		// image will open in shadowbox group
		$anchor_start = "<a href='".$image."' rel='shadowbox[".$group."]' title='".$imageData['name']."'>";
		$anchor_end = "</a>";
		break;		
	}

	$imageLink = $anchor_start;
	$imageLink.= "<img src='".$thumb."' title='".$imageData['name']."'>";
	$imageLink.= $anchor_end;
	
	return $imageLink;
}

function getModuleContent($listIndex) {
	switch ($listIndex) {
    case "stat_short":
        return $this->getStat_Short();
    case "stat_album":
        return $this->getStat_Album();
    case "stat_cat":
        return $this->getStat_Cat();
    case "stat_comm":
        return $this->getStat_Comm();
    case "stat_img":
        return $this->getStat_Img();
    case "stat_imgRating":
        return $this->getStat_ImgRating();
    case "stat_imgViews":
        return $this->getStat_ImgViews();
    case "stat_Uploader":
        return $this->getStat_Uploader();
    case "stat_userComm":
        return $this->getStat_UserComm();
    case "stat_userGals":
        return $this->getStat_Usergals();
    case "stat_FeatureImg":
        return $this->getStat_FeatureImg();
    case "stat_FeatureAlbum":
        return $this->getStat_FeatureAlbum();       
	}
}
function getStat_Short() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_Short)) {
	return $UserTemplate->getStat_Short();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $outStat_Totals;
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_176."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_20;
	$row.= "</td></tr></table>";
	return $row;
}
function getStat_Album() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_Album)) {
	return $UserTemplate->getStat_Album();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $outStat_Totals;
	global $tp;
	$elementArray = explode("|",$PView->getPView_config("stat_album"));
	$cols = $PView -> getPView_config("pics_per_row");
	$colwidth = floor(100/$cols);
	$elementCount = $elementArray[1];
	$details = $PView->getPView_config("gal_details");
	$showDetails = explode("|",$details);
	
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_177."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_21.LAN_GALLERY_22;
	if ($elementArray[2] == "1") {
		$row.= $elementArray[1].LAN_GALLERY_23;
		$statAlbums = $PView->getStatistic_Albums("latest");
	} else {
		$row.= $elementArray[1].LAN_GALLERY_24;
		$statAlbums = $PView->getStatistic_Albums("random");
	}
	$row.= "</td></tr>";
	$row.= "<tr><td><table width=100%>";
	// album grid

	$row.= "<tr>";
	foreach ($statAlbums as $dataset) {

		// insert albums line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($albumCount < $elementCount) {
			$thumb = $PView -> getThumbPath($dataset['imageId']);
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'><a href='pviewgallery.php?album=".$dataset['albumId']."'><img src='".$PView -> getAlbumImage($dataset['albumId'])."' title='".$dataset['name']."'></a>";
			
			if (array_search("name",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>". $tp -> toHTML($dataset['name'])."</span>";
			}

			if (array_search("info",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>".LAN_ALBUM_1.": ".$PView -> getAlbumImageCount($dataset['albumId'])." / ".LAN_ALBUM_2.": ".$PView -> getSubAlbumsCount($dataset['albumId'])."</span>";
			}

			if (array_search("edit",$showDetails) !== FALSE && $PView -> getPermission("album",$dataset['albumId'],"Edit")) {
					$row.= "<div style='padding-top:5px;'><a href='pview_actions.php?album=".$dataset['albumId']."&action=edit'>".LAN_ALBUM_7."</a></div>";
			}
			$row.= "</td>";		
			$colCount++;
		}
		$albumCount++;

	}
	// fill row with empty cells
	while ($colCount < $cols) {
		$row.= "<td style='width:".$colwidth."%;'>&nbsp;</td>";
		$colCount++;
	}
	$row.= "</tr>";


	$row.= "</table>";
	$row.= "</td></tr>";
	$row.= "</table>";
	return $row;
}
function getStat_Cat() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_Cat)) {
	return $UserTemplate->getStat_Cat();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $outStat_Totals;
	global $tp;
	$elementArray = explode("|",$PView->getPView_config("stat_cat"));
	$cols = $PView -> getPView_config("pics_per_row");
	$colwidth = floor(100/$cols);
	$elementCount = $elementArray[1];
	$details = $PView->getPView_config("cat_details");
	$showDetails = explode("|",$details);
	$statCats = $PView->getStatistic_Cats();
	
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_178."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_25.count($statCats)." ".LAN_ADMIN_62.". ".LAN_GALLERY_22;
	$row.= $elementArray[1]." ".LAN_ADMIN_62;
	

	$row.= "</td></tr>";
	$row.= "<tr><td><table width=100%>";
	// album grid

	$row.= "<tr>";
	foreach ($statCats as $dataset) {

		// insert categories line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($albumCount < $elementCount) {
			$thumb = $PView -> getThumbPath($dataset['imageId']);
					
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'><a href='pviewgallery.php?cat=".$dataset['catId']."'><img src='".e_IMAGE."icons/".$dataset['icon']."' title='".$dataset['name']."' style='padding:5px;'>";
			$row.= "</a>";
			$row.= "<br /><span class='smalltext'>". $tp -> toHTML($dataset['name']);
			$row.= "<br />".LAN_ALBUM_1.": ".$PView -> getCatImageCount($dataset['catId'])."</span>";	
			
			

			$row.= "</td>";		
			$colCount++;
		}
		$albumCount++;

	}
	// fill row with empty cells
	while ($colCount < $cols) {
		$row.= "<td style='width:".$colwidth."%;'>&nbsp;</td>";
		$colCount++;
	}
	$row.= "</tr>";


	$row.= "</table>";
	$row.= "</td></tr>";
	$row.= "</table>";
	return $row;
}
function getStat_Comm() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_Comm)) {
	return $UserTemplate->getStat_Comm();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $outStat_Totals;
	global $tp;
	global $ImageSort;
	global $applImages;
	$elementArray = explode("|",$PView->getPView_config("stat_comm"));
	$cols = $PView -> getPView_config("pics_per_row");
	$colwidth = floor(100/$cols);
	$elementCount = $elementArray[1];
	$details = $PView->getPView_config("album_details");
	$showDetails = explode("|",$details);
	
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_179."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_30.LAN_GALLERY_22;
	$row.= $elementArray[1]." ".LAN_ALBUM_1;
	
	$ImageSort = "commentscount";
	$statImgComm = $PView->sortApplImages($applImages,"DESC");

	$row.= "</td></tr>";
	$row.= "<tr><td><table width=100%>";
	// album grid

	$row.= "<tr>";
	foreach ($statImgComm as $dataset) {

		// insert albums line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($albumCount < $elementCount && $dataset['commentscount']) {
			$thumb = $PView -> getThumbPath($dataset['imageId']);
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'>".$this ->getImageLink("album",$dataset,"thumb","resize","pview_gal");
			
			if (array_search("name",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>". $tp -> toHTML($dataset['name'])."</span>";
			}
			
			// commentscount is shown always
			$row.= "<br /><span class='smalltext'>".LAN_ADMIN_179.": ".$PView->getCommentsCount($dataset['imageId'])."</span>";

			if (array_search("rating",$showDetails) !== FALSE) {
				$ratingData = $PView->getRatingData($dataset['imageId']);
				$row.= "<br /><span class='smalltext'>".LAN_IMAGE_3.": ".round($ratingData['value'],1)." (".$ratingData['count'].")</span>";
			}
			
			if (array_search("user",$showDetails) !== FALSE) {
				$userData = $PView->getUserData($dataset['uploaderUserId']);
				if ($PView->getPView_config("details_link")){
					$row.= "<br /><span class='smalltext'>".LAN_IMAGE_13.": <a href='pviewgallery.php?user=".$dataset['uploaderUserId']."'>".$tp -> toHTML($userData['user_name'])."</span></a>";
				} else {
					$row.= "<br /><span class='smalltext'>".LAN_IMAGE_13.": ".$tp -> toHTML($userData['user_name'])."</span>";
				}
				
			}
			if (array_search("edit",$showDetails) !== FALSE && $PView -> getPermission("image",$dataset['imageId'],"Edit")) {
					$row.= "<div style='padding-top:5px;'><a href='pview_actions.php?image=".$dataset['imageId']."&action=edit'>".LAN_IMAGE_2."</a></div>";
				}
			$row.= "</td>";		
			$colCount++;
		}
		$albumCount++;

	}
	// fill row with empty cells
	while ($colCount < $cols) {
		$row.= "<td style='width:".$colwidth."%;'>&nbsp;</td>";
		$colCount++;
	}
	$row.= "</tr>";


	$row.= "</table>";
	$row.= "</td></tr>";
	$row.= "</table>";
	return $row;
}
function getStat_Img() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_Img)) {
	return $UserTemplate->getStat_Img();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $outStat_Totals;
	global $tp;
	global $ImageSort;
	$elementArray = explode("|",$PView->getPView_config("stat_img"));
	$cols = $PView -> getPView_config("pics_per_row");
	$colwidth = floor(100/$cols);
	$elementCount = $elementArray[1];
	$details = $PView->getPView_config("album_details");
	$showDetails = explode("|",$details);
	
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_180."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_27.LAN_GALLERY_22;
	
	$ImageSort = "uploadDate";
	global $applImages;
	$statImg = $PView->sortApplImages($applImages,"DESC");	
	
	if ($elementArray[2] == "1") {
		$row.= $elementArray[1].LAN_GALLERY_28;
	} else {
		$row.= $elementArray[1].LAN_GALLERY_29;
		shuffle($statImg);
	}

	$row.= "</td></tr>";
	$row.= "<tr><td><table width=100%>";
	// album grid

	$row.= "<tr>";
	foreach ($statImg as $dataset) {

		// insert albums line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($imgCount < $elementCount) {
			$thumb = $PView -> getThumbPath($dataset['imageId']);
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'>".$this ->getImageLink("album",$dataset,"thumb","resize","pview_gal");
			
			if (array_search("name",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>". $tp -> toHTML($dataset['name'])."</span>";
			}
			
			// album will shown always
			$row.= "<br /><span class='smalltext'>".LAN_ADMIN_53.": <a href='pviewgallery.php?album=".$dataset['albumId']."'>".$PView->getAlbumName($dataset['albumId'])."</a></span>";

			if (array_search("date",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>".LAN_IMAGE_14.": ".date('d.m.Y',$dataset['uploadDate'])."</span>";
			}
			
			if (array_search("rating",$showDetails) !== FALSE) {
				$ratingData = $PView->getRatingData($dataset['imageId']);
				$row.= "<br /><span class='smalltext'>".LAN_IMAGE_3.": ".round($ratingData['value'],1)." (".$ratingData['count'].")</span>";
			}
					
			if (array_search("user",$showDetails) !== FALSE) {
				$userData = $PView->getUserData($dataset['uploaderUserId']);
				if ($PView->getPView_config("details_link")){
					$row.= "<br /><span class='smalltext'>".LAN_IMAGE_13.": <a href='pviewgallery.php?user=".$dataset['uploaderUserId']."'>".$tp -> toHTML($userData['user_name'])."</span></a>";
				} else {
					$row.= "<br /><span class='smalltext'>".LAN_IMAGE_13.": ".$tp -> toHTML($userData['user_name'])."</span>";
				}
				
			}
			if (array_search("edit",$showDetails) !== FALSE && $PView -> getPermission("image",$dataset['imageId'],"Edit")) {
					$row.= "<div style='padding-top:5px;'><a href='pview_actions.php?image=".$dataset['imageId']."&action=edit'>".LAN_IMAGE_2."</a></div>";
				}
			$row.= "</td>";		
			$colCount++;
			$imgCount++;
		}
		

	}
	// fill row with empty cells
	while ($colCount < $cols) {
		$row.= "<td>&nbsp;</td>";
		$colCount++;
	}
	$row.= "</tr>";


	$row.= "</table>";
	$row.= "</td></tr>";
	$row.= "</table>";
	return $row;
}
function getStat_FeatureImg() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_FeatureImg)) {
	return $UserTemplate->getStat_FeatureImg();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $tp;
	$elementArray = explode("|",$PView->getPView_config("stat_FeatureImg"));
	$cols = $PView -> getPView_config("pics_per_row");
	$colwidth = floor(100/$cols);
	$elementCount = $elementArray[1];
	$details = $PView->getPView_config("album_details");
	$showDetails = explode("|",$details);
	
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_229."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_41.LAN_GALLERY_22;
	
	$FeatureImgs = $PView->getListImagesData("feature");	
	$statImg = $FeatureImgs;

	$row.= $elementArray[1]." ".LAN_ALBUM_1;

	$row.= "</td></tr>";
	$row.= "<tr><td><table width=100%>";
	// image grid

	$row.= "<tr>";
	foreach ($statImg as $dataset) {

		// insert images line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($imgCount < $elementCount) {
			$thumb = $PView -> getThumbPath($dataset['imageId']);
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'>".$this ->getImageLink("album",$dataset,"thumb","resize","pview_gal");
			
			if (array_search("name",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>". $tp -> toHTML($dataset['name'])."</span>";
			}
			
			// album will shown always
			$row.= "<br /><span class='smalltext'>".LAN_ADMIN_53.": <a href='pviewgallery.php?album=".$dataset['albumId']."'>".$PView->getAlbumName($dataset['albumId'])."</a></span>";

			if (array_search("date",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>".LAN_IMAGE_14.": ".date('d.m.Y',$dataset['uploadDate'])."</span>";
			}
			
			if (array_search("rating",$showDetails) !== FALSE) {
				$ratingData = $PView->getRatingData($dataset['imageId']);
				$row.= "<br /><span class='smalltext'>".LAN_IMAGE_3.": ".round($ratingData['value'],1)." (".$ratingData['count'].")</span>";
			}
			// views is shown always
			$row.= "<br /><span class='smalltext'>".LAN_IMAGE_16.": ".$dataset['views']." ".LAN_IMAGE_17."</span>";
					
			if (array_search("user",$showDetails) !== FALSE) {
				$userData = $PView->getUserData($dataset['uploaderUserId']);
				if ($PView->getPView_config("details_link")){
					$row.= "<br /><span class='smalltext'>".LAN_IMAGE_13.": <a href='pviewgallery.php?user=".$dataset['uploaderUserId']."'>".$tp -> toHTML($userData['user_name'])."</span></a>";
				} else {
					$row.= "<br /><span class='smalltext'>".LAN_IMAGE_13.": ".$tp -> toHTML($userData['user_name'])."</span>";
				}
				
			}
			if (array_search("edit",$showDetails) !== FALSE && $PView -> getPermission("image",$dataset['imageId'],"Edit")) {
					$row.= "<div style='padding-top:5px;'><a href='pview_actions.php?image=".$dataset['imageId']."&action=edit'>".LAN_IMAGE_2."</a></div>";
				}
			$row.= "</td>";		
			$colCount++;
			$imgCount++;
		}
		

	}
	// fill row with empty cells
	while ($colCount < $cols) {
		$row.= "<td>&nbsp;</td>";
		$colCount++;
	}
	$row.= "</tr>";


	$row.= "</table>";
	$row.= "</td></tr>";
	$row.= "</table>";
	return $row;
}
function getStat_FeatureAlbum() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_FeatureAlbum)) {
	return $UserTemplate->getStat_FeatureAlbum();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $tp;
	$elementArray = explode("|",$PView->getPView_config("stat_FeatureAlbum"));
	$cols = $PView -> getPView_config("pics_per_row");
	$colwidth = floor(100/$cols);
	$elementCount = $elementArray[1];
	$details = $PView->getPView_config("gal_details");
	$showDetails = explode("|",$details);
	
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_230."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_42.LAN_GALLERY_22;
	
	$FeatureAlbums = $PView->getListAlbumsData("feature");	

	$row.= $elementArray[1]." ".LAN_ALBUM_3;

	$row.= "</td></tr>";
	$row.= "<tr><td><table width=100%>";
	// album grid

	$row.= "<tr>";
	foreach ($FeatureAlbums as $dataset) {

		// insert albums line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($imgCount < $elementCount) {
			$thumb = $PView -> getAlbumImage($dataset['albumId']);
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'><a href='".e_PLUGIN."pviewgallery/pviewgallery.php?album=".$dataset['albumId']."'>";
			$row.= "<img title='".$dataset['name']."' src='".$thumb."' />";
			$row.= "</a>";
			if (array_search("name",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>". $tp -> toHTML($dataset['name'])."</span>";
			}

			if (array_search("info",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>".LAN_ALBUM_1.": ".$PView -> getAlbumImageCount($dataset['albumId'])." / ".LAN_ALBUM_2.": ".$PView -> getSubAlbumsCount($dataset['albumId'])."</span>";
			}

			if (array_search("edit",$showDetails) !== FALSE && $PView -> getPermission("album",$dataset['albumId'],"Edit")) {
					$row.= "<div style='padding-top:5px;'><a href='pview_actions.php?album=".$dataset['albumId']."&action=edit'>".LAN_ALBUM_7."</a></div>";
			}
			$row.= "</td>";		
			$colCount++;
			$imgCount++;
		}
		

	}
	// fill row with empty cells
	while ($colCount < $cols) {
		$row.= "<td>&nbsp;</td>";
		$colCount++;
	}
	$row.= "</tr>";


	$row.= "</table>";
	$row.= "</td></tr>";
	$row.= "</table>";
	return $row;
}
function getStat_ImgRating() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_ImgRating)) {
	return $UserTemplate->getStat_ImgRating();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $outStat_Totals;
	global $tp;
	global $ImageSort;
	$elementArray = explode("|",$PView->getPView_config("stat_imgRating"));
	$cols = $PView -> getPView_config("pics_per_row");
	$colwidth = floor(100/$cols);
	$elementCount = $elementArray[1];
	$details = $PView->getPView_config("album_details");
	$showDetails = explode("|",$details);
	
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_181."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_26.LAN_GALLERY_22;
	$row.= $elementArray[1]." ".LAN_ALBUM_1;
	
	$ImageSort = "ratingvalue";
	global $applImages;
	$statImgRating = $PView->sortApplImages($applImages,"DESC");

	$row.= "</td></tr>";
	$row.= "<tr><td><table width=100%>";
	// album grid

	$row.= "<tr>";
	foreach ($statImgRating as $dataset) {

		// insert albums line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($imgCount < $elementCount && $dataset['ratingvalue']) {
			$thumb = $PView -> getThumbPath($dataset['imageId']);
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'>".$this ->getImageLink("album",$dataset,"thumb","resize","pview_gal");
			
			if (array_search("name",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>". $tp -> toHTML($dataset['name'])."</span>";
			}
			
			// rating is shown always
			$ratingData = $PView->getRatingData($dataset['imageId']);
			$row.= "<br /><span class='smalltext'>".LAN_IMAGE_3.": ".round($ratingData['value'],1)." (".$ratingData['count'].")</span>";
			
			if (array_search("user",$showDetails) !== FALSE) {
				$userData = $PView->getUserData($dataset['uploaderUserId']);
				if ($PView->getPView_config("details_link")){
					$row.= "<br /><span class='smalltext'>".LAN_IMAGE_13.": <a href='pviewgallery.php?user=".$dataset['uploaderUserId']."'>".$tp -> toHTML($userData['user_name'])."</span></a>";
				} else {
					$row.= "<br /><span class='smalltext'>".LAN_IMAGE_13.": ".$tp -> toHTML($userData['user_name'])."</span>";
				}
			}
			if (array_search("edit",$showDetails) !== FALSE && $PView -> getPermission("image",$dataset['imageId'],"Edit")) {
					$row.= "<div style='padding-top:5px;'><a href='pview_actions.php?image=".$dataset['imageId']."&action=edit'>".LAN_IMAGE_2."</a></div>";
				}
			$row.= "</td>";		
			$colCount++;
			$imgCount++;
		}
	}
	// fill row with empty cells
	while ($colCount < $cols) {
		$row.= "<td style='width:".$colwidth."%;'>&nbsp;</td>";
		$colCount++;
	}
	$row.= "</tr>";

	$row.= "</table>";
	$row.= "</td></tr>";
	$row.= "</table>";
	return $row;
}
function getStat_ImgViews() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_ImgViews)) {
	return $UserTemplate->getStat_ImgViews();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $outStat_Totals;
	global $tp;
	global $ImageSort;
	$elementArray = explode("|",$PView->getPView_config("stat_imgViews"));
	$cols = $PView -> getPView_config("pics_per_row");
	$colwidth = floor(100/$cols);
	$elementCount = $elementArray[1];
	$details = $PView->getPView_config("album_details");
	$showDetails = explode("|",$details);
	
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_182."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_31.LAN_GALLERY_22;
	$row.= $elementArray[1]." ".LAN_ALBUM_1;
	
	$ImageSort = "views";
	global $applImages;
	$statImgViews = $PView->sortApplImages($applImages,"DESC");

	$row.= "</td></tr>";
	$row.= "<tr><td><table width=100%>";
	// album grid

	$row.= "<tr>";
	foreach ($statImgViews as $dataset) {

		// insert albums line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($imgCount < $elementCount && $dataset['views']) {
			$thumb = $PView -> getThumbPath($dataset['imageId']);
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'>".$this ->getImageLink("album",$dataset,"thumb","resize","pview_gal");
			
			if (array_search("name",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>". $tp -> toHTML($dataset['name'])."</span>";
			}
			
			// views is shown always
			$row.= "<br /><span class='smalltext'>".LAN_IMAGE_16.": ".$dataset['views']." ".LAN_IMAGE_17."</span>";
			
			if (array_search("rating",$showDetails) !== FALSE) {
				$ratingData = $PView->getRatingData($dataset['imageId']);
				$row.= "<br /><span class='smalltext'>".LAN_IMAGE_3.": ".round($ratingData['value'],1)." (".$ratingData['count'].")</span>";
			}	
			
			if (array_search("album",$showDetails) !== FALSE) {
				$row.= "<br /><span class='smalltext'>".LAN_ADMIN_53.": <a href='pviewgallery.php?album=".$dataset['albumId']."'>".$PView->getAlbumName($dataset['albumId'])."</a></span>";
			}					
			
			if (array_search("user",$showDetails) !== FALSE) {
				$userData = $PView->getUserData($dataset['uploaderUserId']);
				if ($PView->getPView_config("details_link")){
					$row.= "<br /><span class='smalltext'>".LAN_IMAGE_13.": <a href='pviewgallery.php?user=".$dataset['uploaderUserId']."'>".$tp -> toHTML($userData['user_name'])."</span></a>";
				} else {
					$row.= "<br /><span class='smalltext'>".LAN_IMAGE_13.": ".$tp -> toHTML($userData['user_name'])."</span>";
				}
			}
					
			if (array_search("edit",$showDetails) !== FALSE && $PView -> getPermission("image",$dataset['imageId'],"Edit")) {
					$row.= "<div style='padding-top:5px;'><a href='pview_actions.php?image=".$dataset['imageId']."&action=edit'>".LAN_IMAGE_2."</a></div>";
				}
			$row.= "</td>";		
			$colCount++;
			$imgCount++;
		}
		

	}
	// fill row with empty cells
	while ($colCount < $cols) {
		$row.= "<td style='width:".$colwidth."%;'>&nbsp;</td>";
		$colCount++;
	}
	$row.= "</tr>";

	$row.= "</table>";
	$row.= "</td></tr>";
	$row.= "</table>";
	return $row;
}
function getStat_Uploader() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_Uploader)) {
	return $UserTemplate->getStat_Uploader();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $outStat_Totals;
	global $tp;
	global $ImageSort;
	$elementArray = explode("|",$PView->getPView_config("stat_Uploader"));
	$cols = $PView -> getPView_config("pics_per_row");
	$colwidth = floor(100/$cols);
	$elementCount = $elementArray[1];
	$details = $PView->getPView_config("album_details");
	$showDetails = explode("|",$details);
	$statUploader = $PView->getStatistic_Uploader();
	
	//calculate not registered users
	$invalidImgCount = $PView->getNoUserImages();
	
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_183."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_33;
	if ($invalidImgCount){
		// images by not registered users
		$row.= LAN_GALLERY_34;
	}
	
	$row.= LAN_GALLERY_22;
	$row.= $elementArray[1]." ".LAN_GALLERY_35;
	$row.= "</td></tr>";
	$row.= "<tr><td><table width=100%>";
	// uploader grid

	$row.= "<tr>";
	foreach ($statUploader as $key=>$dataset) {

		$userData = $PView->getUserData($key);
		if ($userimage = $userData['user_image']){
			$avatar= "<img src='".avatar($userimage)."' />";
		} else {
			$avatar= "<img src='";
			$avatar.= SITEURLBASE.e_PLUGIN_ABS."pviewgallery/templates/".$PView -> getPView_config("template")."/images/profile.png";
			$avatar.= "' / alt='".LAN_IMAGE_53."' title='".LAN_IMAGE_53."'>";
		}
		
		// insert uploader line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($uploaderCount < $elementCount) {
			
			$row.= "<td style='vertical-align:top; width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'><a href='".e_BASE."user.php?id.".$key."'>".$avatar."</a>";
			$row.= "<br /><a href='".e_BASE."user.php?id.".$key."'><span class='smalltext'>".$PView -> getUserName($key)."</span></a>";
			$row.= "<br /><a href='pviewgallery.php?user=".$key."'><span class='smalltext'>".$dataset." ".LAN_ALBUM_1."</span></a>";
			$row.= "</td>";		
			$colCount++;
		}
		$uploaderCount++;

	}
	// fill row with empty cells
	while ($colCount < $cols) {
		$row.= "<td style='width:".$colwidth."%;'>&nbsp;</td>";
		$colCount++;
	}
	$row.= "</tr>";

	$row.= "</table>";
	$row.= "</td></tr>";	
	
	$row.= "</table>";
	return $row;
}
function getStat_UserComm() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_UserComm)) {
	return $UserTemplate->getStat_UserComm();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $outStat_Totals;
	global $tp;
	global $ImageSort;
	$elementArray = explode("|",$PView->getPView_config("stat_userComm"));
	$cols = $PView -> getPView_config("pics_per_row");
	$colwidth = floor(100/$cols);
	$elementCount = $elementArray[1];
	$details = $PView->getPView_config("album_details");
	$showDetails = explode("|",$details);
	$statUserComm = $PView->getStatistic_Comm();
	
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_184."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_36;
	
	$row.= LAN_GALLERY_22;
	$row.= $elementArray[1]." ".LAN_GALLERY_35;
	$row.= "</td></tr>";
	$row.= "<tr><td><table width=100%>";
	// comment-user grid
	
	$row.= "<tr>";
	foreach ($statUserComm as $key=>$dataset) {
		$userData = $PView->getUserData($key);
		if ($userimage = $userData['user_image']){
			$avatar= "<img src='".avatar($userimage)."' style='padding:5px;' />";
		} else {
			$avatar= "<img src='";
			$avatar.= SITEURLBASE.e_PLUGIN_ABS."pviewgallery/templates/".$PView -> getPView_config("template")."/images/profile.png";
			$avatar.= "' alt='".LAN_IMAGE_53."' title='".LAN_IMAGE_53."' style='padding:5px;' />";
		}
		
		// insert comment-user line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($uploaderCount < $elementCount) {
			
			$row.= "<td style='vertical-align:top; width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'><a href='".e_BASE."user.php?id.".$key."'>".$avatar."</a>";
			$row.= "<br /><a href='".e_BASE."user.php?id.".$key."'><span class='smalltext'>".$PView -> getUserName($key)."</span></a>";
			$row.= "<br /><span class='smalltext'>".$dataset." ".LAN_IMAGE_4."</span>";
			$row.= "</td>";		
			$colCount++;
		}
		$uploaderCount++;

	}
	// fill row with empty cells
	while ($colCount < $cols) {
		$row.= "<td style='width:".$colwidth."%;'>&nbsp;</td>";
		$colCount++;
	}
	$row.= "</tr>";

	$row.= "</table>";
	$row.= "</td></tr>";	
	
	$row.= "</table>";
	return $row;
}
function getStat_Usergals() {
$UserTemplate = new Usertemplate;	
if (method_exists($UserTemplate,getStat_Usergals)) {
	return $UserTemplate->getStat_Usergals();
}
	
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
	global $outStat_Totals;
	global $tp;
	$elementArray = explode("|",$PView->getPView_config("stat_userGals"));
	$cols = $PView -> getPView_config("pics_per_row");
	$colwidth = floor(100/$cols);
	$elementCount = $elementArray[1];
	$details = $PView->getPView_config("gal_details");
	$showDetails = explode("|",$details);
	$statGals = $PView->getStatistic_UserGals();
	
	$row = "<table width=100%><tr><td class='forumheader'>".LAN_ADMIN_3."</td></tr>";
	$row.= "<tr><td style='padding:10px 0px;'>";
	$row.= LAN_GALLERY_25.count($statGals)." ".LAN_GALLERY_38.". ";
	if ($PView -> getPermission("gallery",0,"View")) {
		$row.= LAN_GALLERY_37.". ";
	}
	$row.= LAN_GALLERY_22;
	$row.= $elementArray[1]." ".LAN_GALLERY_38."<br />";
	if ($PView -> getPermission("config","permCreateGallery","")) {
		$row.= LAN_GALLERY_39." <a href='".e_PLUGIN."pviewgallery/pview_actions.php?gallery=0&amp;action=newgallery'>".LAN_GALLERY_40."</a>.";
	}
	$row.= "</td></tr>";
	$row.= "<tr><td><table width=100%>";
	// gallery grid

	$row.= "<tr>";
	foreach ($statGals as $dataset) {

		// insert galleries line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($galCount < $elementCount) {
			
			$userData = $PView->getUserData($dataset['galleryId']);
			if ($userimage = $userData['user_image']){
				$avatar= "<img src='".avatar($userimage)."' style='padding:5px;' />";
			} else {
				$avatar= "<img src='";
				$avatar.= SITEURLBASE.e_PLUGIN_ABS."pviewgallery/templates/".$PView -> getPView_config("template")."/images/profile.png";
				$avatar.= "' alt='".LAN_IMAGE_53."' title='".LAN_IMAGE_53."' style='padding:5px;' />";
			}			
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$this->getThumbPosition()."'><a href='pviewgallery.php?gallery=".$dataset['galleryId']."'>".$tp -> toHTML($dataset['name'])."</a>";
			$row.= "<br />".$avatar;
			if ($dataset['galleryId'] == "classic") { // set maingallery username to "Administrator"
				$row.= "<br /><span class='smalltext'>".LAN_GALLERY_32."</span>";
			} else {
				$row.= "<br /><span class='smalltext'>". $tp -> toHTML($PView->getUserName($dataset['galleryId']))."</span>";
			}
			
			
			$galAlbum = $PView->getGalleryAlbums($dataset['galleryId']);
			$row.= "<br /><span class='smalltext'>".LAN_ALBUM_3.": ".count($galAlbum)." / ".LAN_ALBUM_1.": ".$PView -> getGalleryImageCount($dataset['galleryId'])."</span>";

			if ($PView -> getPermission("gallery",$dataset['galleryId'],"Edit")) {
					$row.= "<div style='padding-top:5px;'><a href='pview_actions.php?gallery=".$dataset['galleryId']."&action=edit'>".LAN_GALLERY_6."</a></div>";
				}
			$row.= "</td>";		
			$colCount++;
		}
		$galCount++;

	}
	// fill row with empty cells
	while ($colCount < $cols) {
		$row.= "<td style='width:".$colwidth."%;'>&nbsp;</td>";
		$colCount++;
	}
	$row.= "</tr>";

	$row.= "</table>";
	$row.= "</td></tr>";
	$row.= "</table>";
	return $row;
}


}//Class Template End

?>