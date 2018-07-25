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

// Include special template language file
require_once(e_PLUGIN."pviewgallery/templates/Galleriffic1/language/".e_LANGUAGE.".php");

// Special Settings for this template
$g1 = array('th_height'=>'height:80px; ','th_width'=>'width:80px; ','img_width'=>'600px','cont_width'=>'610px','img_height'=>'400px','cont_height'=>'410px','nav_width'=>'290px','gal_height'=>'550px');

class UserTemplate {



function getContent() {
// returns the gallery content
$PView = new PView;
$Template = new Template;
$pv_Appl = $PView -> getAppl();
global $applImages;
global $g1;



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
			$AG.= "<tr><td>".$Template->getModuleContent($key)."</td></tr>";
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
		$MG = "<link rel='stylesheet' href='templates/Galleriffic1/css/galleriffic-3.css' type='text/css' />";
		$MG.= "<table cellspacing='0px' style='width:100%;'>";
		$MG.= "<tr><td style='text-align:left; padding-bottom:5px;'><div class='image-title'>{pv_MainGalleryName}</div></td><td style='text-align:right; padding-right:5px;'>{pv_MainGalleryMenu}</td></tr>";
		$MG.= "<tr><td colspan='2' class='forumheader'><span class='smalltext'>".LAN_GALLERY_3.": {pv_RootalbumCount}</span></td></tr>";
		$MG.= "{pv_RootAlbums}";
		$MG.= "</table><br/>";
	}
	// List of Category/User View (1st col) and Usergalleries (2nd col)
	if ($PView -> getPView_config("member_galleries") OR (ADMIN && $PView -> getPView_config("admin_Mode"))) {
		$LV_usergalleries = $PView -> getPView_config("usergallery_name");
	}
	$LV = "<table cellspacing='5px' style='width:100%;'>";
	$LV.= "<tr><td class='forumheader'>".LAN_GALLERY_14."</td>";
	if ($LV_usergalleries) {
		$LV.= "<td class='forumheader'>".$LV_usergalleries." ({pv_UserGalleryCount})<div style='float:right; text-align:right;'>{pv_UserGalleryMenu}</div></td></tr>";
	} else {
		$LV.= "<td class='forumheader'>&nbsp;</td></tr>";
	}
	$LV.= "<tr><td style='padding-top:5px; width:50%;'>";
	$LV.= "<table  style='width:100%'>";
	$LV.= "<tr><td style='padding:5px;'><a href='pviewgallery.php?cat=list'>".LAN_GALLERY_15.":</a><br/><span class='smalltext'>".LAN_GALLERY_17."</span></td></tr>";
	$LV.= "<tr><td style='padding:5px;'><a href='pviewgallery.php?user=list'>".LAN_GALLERY_16.":</a><br/><span class='smalltext'>".LAN_GALLERY_18."</span></td></tr>";	
	$LV.= "</table>";
	$LV.= "</td><td style='padding-top:5px; width:50%;'>";
	if ($LV_usergalleries) {
		if ($PView -> getUserGalleryCount()) {
			$LV.= "<table style='width:100%;'>";
			$LV.= "{pv_UserGalleries}";
			$LV.= "</table>";
		}
		if (!$PView -> getUserGalleryCount()) {
			$LV.= "<div class='smalltext' style='padding:10px;'>".LAN_TMP_GALL_01."</div>";
		}		
	} else {
		$LV.= "&nbsp;";
	}
	$LV.= "</td></tr>";
	$LV.= "</table><br/>";
		
	return $MG.$LV;
}
// User Gallery Layout -------------------------------------------------------------------
// don't forget to include your css styles in theme.css
if ($pv_Appl[0] == "gallery" && $pv_Appl[1] <> "0") {
	// redirect to gallery startpage if gallery not exist
	if (!$PView -> getGalleryName($pv_Appl[1])) { 
		header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php");
	}
	//PERMISSION!!!
	if ($PView -> getPermission("gallery",$pv_Appl[1],"View")) {
		$UG = "<link rel='stylesheet' href='templates/Galleriffic1/css/galleriffic-3.css' type='text/css' />";
		$UG.= "<table cellspacing='0px' style='width:100%;'>";
		$UG.= "<tr><td style='text-align:left; padding-bottom:5px;'><div class='image-title'>{pv_UserGalleryName}</div></td><td style='text-align:right; padding-right:5px;'>{pv_MainGalleryMenu}</td></tr>";
		$UG.= "<tr><td colspan='2' class='forumheader'><span class='smalltext'>".LAN_GALLERY_3.": {pv_RootalbumCount}</span></td></tr>";
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
		$ALBUM = $this -> getGalleriffic_start();
		$ALBUM.= "<table style='width:100%;'>";
		$ALBUM.= "<tr><td style='border: 0px; padding-bottom:8px; padding-left:5px;'><div class='image-title'>{pv_AlbumName}</div><span class='smalltext'>(".LAN_ALBUM_1.": {pv_AlbumImageCount} / ".LAN_ALBUM_2.": {pv_SubAlbumCount})</span></td>";
		$ALBUM.= "<td class='smalltext' style='border: 0px; text-align:right; padding-right:5px; padding-bottom:8px; vertical-align:bottom;'>{pv_AlbumMenu}</td></tr>";
		
		$ALBUM.= "<tr><td colspan='2' class='forumheader'>".LAN_ALBUM_1.":</td></tr><tr><td colspan='2'><table style='width:100%'>";
		$ALBUM.= "{pv_AlbumImages}";
		if ($PView -> getSubAlbumsCount($pv_Appl[1])) {
			$ALBUM.= "<tr><td colspan='2' class='forumheader'>".LAN_ALBUM_2.":</td></tr>";
			$ALBUM.= "{pv_SubAlbums}";
		}
		$ALBUM.= "</table></td></tr>";
		$ALBUM.= "</table>";
		$ALBUM.= $this -> getGalleriffic_end();		
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
		$IMG= $this -> getGalleriffic_start();
		$IMG.= "<table cellspacing='0px' style='width:100%;'>";
		$IMG.= "<tr><td style='padding-bottom:8px;width:".$g1['nav_width'].";'><div class='image-title'>{pv_ImageName}</div></td><td style='text-align:right; padding-right:5px; padding-bottom:8px;'>{pv_ImageMenu}</td></tr>";
		$IMG.= "<tr><td style='width:".$g1['nav_width'].";'>&nbsp;</td><td>{pv_NavMenu}</td></tr>";
		$IMG.= "<tr><td style='width:".$g1['nav_width'].";'>";
		$IMG.= "<table width='100%'>{pv_ImageData}</table>";
		$IMG.= "</td><td style='text-align:center; vertical-align: top;'><div class='slideshow'>{pv_ResizeImage}</div></td></tr></table>";
		if ($PView -> getPView_config("Comments")) {
			$IMG.= "<table cellspacing='0' style='width:100%; margin-top:20px;'><tr>";
			$IMG.= "<td class='forumheader' style='border-right:0px;'>".LAN_IMAGE_4." <span class='smalltext'>( {pv_CommentCount} )</span></td>";
			$IMG.= "<td class='forumheader' style='border-left:0px; text-align:right; padding-right:5px;'>{pv_AddComment}</td></tr>";
			$IMG.= "<tr><td colspan='2' style='text-align:center;'>{pv_Comments}</td></tr>";
			$IMG.= "</table>";
		}
		

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
	$UIMG = $this -> getGalleriffic_start();
	$UIMG.= "<table style='width:100%;'>";
	$UIMG.= "<tr><td style='border: 0px; padding-bottom:8px; padding-left:5px;'><div class='image-title'>".LAN_ALBUM_1." ".LAN_ALBUM_13." {pv_UserName} </div><span class='smalltext'>(".LAN_ALBUM_1.": {pv_UserImageCount})</span></td>";
	$UIMG.= "<td class='smalltext' style='border: 0px; text-align:right; padding-right:5px; padding-bottom:8px; vertical-align:bottom;'>{pv_UserMenu}</td></tr>";
	$UIMG.= "<tr><td colspan='2' class='forumheader'>".LAN_ALBUM_1.":</td></tr><tr><td colspan='2'><table style='width:100%'>";
	$UIMG.= "{pv_UserImages}";
	$UIMG.= "</table></td></tr>";
	$UIMG.= "</table>";
	$UIMG.= $this -> getGalleriffic_end();		
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
    global $g1;
	if (!array_key_exists($pv_Appl[1],$catArray)) {
		header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php");
		exit;
	}
	$applImages = $PView->getApplImages(); // trigger only, no return!
	$CATIMG = $this -> getGalleriffic_start();
	$CATIMG.= "<table style='width:100%;'>";
	$CATIMG.= "<tr><td style='border: 0px; padding-bottom:8px; padding-left:5px;'><div class='image-title'>{pv_CatName} </div><span class='smalltext'>(".LAN_ALBUM_1.": {pv_CatImageCount})</span></td><td style='border: 0px; text-align:right; padding-right:5px;'>{pv_CatMenu}</td></tr>";
	$CATIMG.= "<tr><td colspan='2' class='forumheader'>".LAN_ALBUM_1.":</td></tr><tr><td colspan='2'><table style='width:100%'>";
	$CATIMG.= "{pv_CatImages}";
	$CATIMG.= "</table></td></tr>";
	$CATIMG.= "</table>";
    $CATIMG.= $this -> getGalleriffic_end();
	
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

function getAllImages() {
// returns imagegrid for album, category and user view
	$PView = new PView;
	global $tp;
	global $g1;
	$pv_Appl = $PView -> getAppl();
	$ImageData = array();
	
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

		
		$out_AllImages = "<tr><td valign='top'><div id='gallery' class='content'><div id='controls' class='controls'></div><div class='slideshow-container'>";
		$out_AllImages.= "<div id='loading' class='loader'></div><div id='slideshow' class='slideshow'></div></div><div id='caption' class='caption-container'></div></div>";
		$out_AllImages.= "<div id='thumbs' class='navigation'><ul class='thumbs noscript'>";
		foreach ($ImageData as $dataset) {
			//PERMISSION!!!
			if ($PView -> getPermission("image",$dataset['imageId'],"View")) {
				// insert images line by line, observe pagelimit
				if ($picCount >= ($page - 1) * $pics && $picCount < $page * $pics) {
					$thumb = $PView -> getThumbPath($dataset['imageId']);
					$resize = $PView -> getResizePath($dataset['imageId']);
					if ($PView->getPView_config("seo_links")){
						$seo = "&amp;name=".$dataset['name'];
					} else {
						$seo = "";
					}

					$out_AllImages.= "<li>\n";
					$out_AllImages.= "<a class='thumb' name='".preg_replace('![^0-9a-zA-Z]!is', '', $dataset['name'])."' href='".$resize."' title='".$dataset['name']."'>";
                    $out_AllImages.= "<img src='".$thumb."' alt='".$dataset['name']."' style='".$g1['th_height'].$g1['th_width']."' />";
					$out_AllImages.= "</a>\n";
					$out_AllImages.= "<div class='caption' style='border-top: 1px solid #ccc;'><div class='download'>\n";
					$out_AllImages.= "<a href='pviewgallery.php?image=".$dataset['imageId']."&view=".$pv_Appl[0]."'>".LAN_IMAGE_54.",<br/>".LAN_IMAGE_4.LAN_IMAGE_55."<br/>".LAN_IMAGE_23."</a></div>\n";
					$out_AllImages.= "<div class='image-title'>".$dataset['name']."</div>\n";
					$out_AllImages.= "<div class='image-desc'>".$dataset['description']."</div>\n";
					$out_AllImages.= "</div>";
					$out_AllImages.= "</li>";		
				}
				$picCount++;
			}
		}
		$out_AllImages.= "</ul>{pv_Pages}</div><div style='clear: both;'></div></td></tr>";

		
		return $out_AllImages;
	}
	return "<div style='padding:10px;'>".$message."</div>";
}
function getPages() {
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
		$prevPage = "<a href='pviewgallery.php?".$link.$pv_Appl[1]."&amp;page=".strval($page-1)."'>".LAN_TMP_GALL_07."</a>";
	}
	if ($page < $Pages) {
	$nextPage = "<a href='pviewgallery.php?".$link.$pv_Appl[1]."&amp;page=".strval($page+1)."'>".LAN_TMP_GALL_08."</a>";
	}
	
return "<div class='pagination'>".$prevPage."&nbsp;<span class='current'>".$page."</span>&nbsp;".$nextPage."&nbsp;</div>";
}
function getAlbumMenu() {
// returns menu for album view
	$PView = new PView;
	$Appl = $PView -> getAppl();
	$AlbumMenu.= "<form action='".e_SELF."?".e_QUERY."' method='post'>";
	
	// ViewerSort
	if ($PView->getPView_config("viewer_sort")){
		$AlbumMenu.= LAN_ALBUM_19.": ".$PView->getSortBox("album",1);
	}	
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

	$AlbumMenu.= "</form>";
	return $AlbumMenu;
}
function getNavMenu() {
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
	$NavMenu.= "<td width='50%' style='text-align:left;'><div class='controls'><a href='pviewgallery.php?".$backTo."'>".$linkText." &rsaquo;&rsaquo;</a></div></td>";
	$NavMenu.= "<td width='25%' style='text-align:right;'>";
	if ($imagePrev) {
		$NavMenu.= "<div class='controls'><a href='pviewgallery.php?image=".$imagePrev."&amp;view=".$view."'>&lsaquo; ".LAN_IMAGE_6."</a></div>";
	}
	$NavMenu.= "&nbsp;</td>";
	$NavMenu.= "<td width='25%' style='text-align:right;'>";
	if ($imageNext) {
		$NavMenu.= "<div class='controls'><a href='pviewgallery.php?image=".$imageNext."&amp;view=".$view."'>".LAN_IMAGE_7." &rsaquo;</a></div>";
	}
	$NavMenu.= "&nbsp;</td>";
	$NavMenu.= "</tr></table>";
	return $NavMenu;
}
function getImageInfo() {
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
			$out_ImageInfo = "<tr><td width='100%' class='smalltext'>".LAN_IMAGE_9.":</td></tr><tr><td style='padding-bottom:5px;'>".$tp -> toHTML($ImageData['name'])."&nbsp;</td></tr>";
			break;
			case "descr":
			$out_ImageInfo.= "<tr><td width='100%' class='smalltext' style='vertical-align:top;'>".LAN_IMAGE_10.":</td></tr><tr><td style='padding-bottom:5px;'>".$tp -> toHTML($ImageData['description'])."&nbsp;</td></tr>";
			break;
			case "user":
			$userData = $PView->getUserData($dataset['uploaderUserId']);
			// LINK Check: link to show all images of user
			if ($PView->getPView_config("details_link")){
				$out_ImageInfo.= "<tr><td width='100%' class='smalltext'>".LAN_IMAGE_13.":</td></tr><tr><td style='padding-bottom:5px;'><a href='pviewgallery.php?user=".$ImageData['uploaderUserId']."'>".$UploadUser['user_name']."</a></td></tr>";
			}else{
				$out_ImageInfo.= "<tr><td width='100%' class='smalltext'>".LAN_IMAGE_13.":</td></tr><tr><td style='padding-bottom:5px;'>".$UploadUser['user_name']."</td></tr>";
			}
			break;
			case "cat":
			// LINK Check: link to show all images of category
			if ($PView->getPView_config("details_link") && $catData){
				$out_ImageInfo.= "<tr><td width='100%' class='smalltext' style='vertical-align:top;'>".LAN_IMAGE_45.":</td></tr><tr><td style='padding-bottom:5px;'><a href='pviewgallery.php?cat=".$ImageData['cat']."'>".$catName."</a></td></tr>";
			}else{
				$out_ImageInfo.= "<tr><td width='100%' class='smalltext' style='vertical-align:top;'>".LAN_IMAGE_45.":</td></tr><tr><td style='padding-bottom:5px;'>".$catName."</td></tr>";
			}
			break;
			case "date":
			$out_ImageInfo.= "<tr><td width='100%' class='smalltext'>".LAN_IMAGE_14.":</td></tr><tr><td style='padding-bottom:5px;'>".date('d.m.Y',$ImageData['uploadDate'])."&nbsp;</td></tr>";
			break;	
			case "rating":
			if ($PView -> getPView_config("Rating")) {
				$out_ImageInfo.= "<tr><td width='100%' class='smalltext'>".LAN_IMAGE_3.":</td></tr><tr><td class='smalltext' style='padding-bottom:5px;'>{pv_RatingResult}&nbsp;</td></tr>";
				//PERMISSION!!!
				if ($PView -> getPermission("config","permRating","") && !$PView -> getUserRated()) {
					$out_ImageInfo.= "<tr><td width='100%' class='smalltext' style='vertical-align:top;'>".LAN_IMAGE_20.":</td></tr><tr><td class='smalltext' style='padding-bottom:5px;'>{pv_RatingRate}&nbsp;</td></tr>";
				}
			}
			break;	
			case "views":
			$out_ImageInfo.= "<tr><td width='100%' class='smalltext'>".LAN_IMAGE_16.":</td></tr><tr><td style='padding-bottom:5px;'>".$ImageData['views']."&nbsp;".LAN_IMAGE_17."</td></tr>";
			break;
			case "dim":
			$out_ImageInfo.= "<tr><td width='100%' class='smalltext'>".LAN_IMAGE_11.":</td></tr><tr><td style='padding-bottom:5px;'>".$ImageSize[0]." x ".$ImageSize[1]."&nbsp;".LAN_IMAGE_15."</td></tr>";
			break;	
			case "size":
			$out_ImageInfo.= "<tr><td width='100%' class='smalltext'>".LAN_IMAGE_12.":</td></tr><tr><td style='padding-bottom:5px;'>".$FileSize." kB&nbsp;</td></tr>";
			break;																	
		}			
	}	
	return $out_ImageInfo;
}
function getRating() {
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
	$out_HTML.= "<br/>(".round($Result['value'],1)."&nbsp;".LAN_IMAGE_22."&nbsp;".$Result['count']."&nbsp;".LAN_IMAGE_23.")";
	return $out_HTML;
}
function getComments() {
// returns 3 div tags: comment_show, comment_edit, comment_preview
	$PView = new PView;
	$Template = new Template;
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
		$out_HTML.= "<table cellspacing='0px' style='width:100%;'>";
		foreach ($Comments as $dataset) {
			// table with all comments, observe pagelimit
			if ($Count >= ($page - 1) * $Comments_perPage && $Count < $page * $Comments_perPage) {
			$User = $PView -> getUserData($dataset['commente107userId']);
			$out_HTML.= "<tr><td style='padding-top:10px;'><span class='smalltext'>".$User['user_name']."&nbsp;".LAN_IMAGE_26."&nbsp;".date('d.m.Y',$dataset['commentDate']).":</span></td><td style='text-align:right; padding-top:10px; padding-right:5px;'>";
			if ($dataset['commente107userId'] == USERID OR ADMIN) {
				$out_HTML.= $Template -> getButton_editComment($dataset['commentId']);
			}
			$out_HTML.= "</td></tr><tr><td colspan='2' style='padding-bottom:5px; border-bottom: 1px solid #ccc;'>".$tp -> post_toHTML($dataset['commentText'], true)."</td></tr>";
			}
			$Count++;
		}
		$out_HTML.= "<tr><td colspan='2' style='text-align:right'>".$moreComments."</td></tr>";
		$out_HTML.= "</table>";
	}
	$out_HTML.= "</div>";
	
	// preview Comment
	$out_HTML.= "<a name='a_preview' id='a_preview'></a><center><div name='comment_preview' id='comment_preview' style='padding-top:10px; width:100%; text-align:left; display:block;'>";
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
function getUserGalleries() {
// returns all usergalleries for gallery view
	$PView = new PView;
	global $tp;
	$UserGalleryData = $PView -> getAllGalleryData();

	//$out_UserGalleries = "<tr><td>";
	foreach ($UserGalleryData as $dataset) {
		if ($dataset['galleryId']) {
			$UserArray = $PView -> getUserData($dataset['galleryId']);
			$UserName = $UserArray['user_name'];
			//PERMISSION!!!
			if ($PView -> getPermission("gallery",$dataset['galleryId'],"View")) {
				$out_UserGalleries .= "<tr><td style='padding:5px;'><a href='pviewgallery.php?gallery=".$dataset['galleryId']."'>". $tp -> toHTML($dataset['name'])."</a><br/><span class='smalltext'>".LAN_ALBUM_13." ".$UserName."<span> ";
				if (!$dataset['active']) {
					$out_UserGalleries .= LAN_GALLERY_7;
				}
				$out_UserGalleries .= "</td></tr>";
			}
		}
	}
	$out_UserGalleries .= "</td></tr>";
	return $out_UserGalleries;
}
function getAllUsers(){
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
	
	$userList = $this -> getGalleriffic_start();
	$userList.= "<table width='100%'>";
	foreach ($userArray as $key=>$dataset) {
		$userData = $PView->getUserData($key);
		if ($pv_galName = $PView -> getGalleryName($key)) {
			$pv_galInfo = "<a href='pviewgallery.php?gallery=".$key."'>".LAN_PVIEW_SC_3." ".$pv_galName."</a>";
		} else {
			$pv_galInfo = LAN_PVIEW_SC_2;
		}
		$userList.= "<tr><td colspan = '2' style='border: 0px; padding-bottom:8px; padding-left:5px; padding-top: 15px;'><div class='image-title'>".$userData['user_name']."</div>";
		$userList.= "<span class='smalltext'>(".$dataset."&nbsp;".LAN_ALBUM_1." , ".$pv_galInfo.")</span></td></tr>";
		$userList.= "<tr><td width='25%' class='forumheader'>".LAN_TMP_GALL_04."</td>";
		$userList.= "<td width='75%' class='forumheader'>".LAN_MENU_1."</td></tr>";
		$userList.= "<tr><td width='25%' style='vertical-align:middle;'>";
		$userList.= "<a href='".e_BASE."user.php?id.".$key."'>";
		if ($userimage = $userData['user_image']){
			$userList.= "<img src='".avatar($userimage)."' style='padding:5px;' />";
		} else {
			$userList.= "<img src='";
			$userList.= SITEURLBASE.e_PLUGIN_ABS."pviewgallery/templates/".$PView -> getPView_config("template")."/images/profile.png";
			$userList.= "' alt='".LAN_IMAGE_53."' title='".LAN_IMAGE_53."' style='padding:5px;' />";
		}
		$userList.= "</a>";
		$userList.= "</td><td width='75%'>";
		$userList.= $this -> getLatestuserImages($key);
		$userList.= "<p style='padding-top:10px;'><a href='pviewgallery.php?user=".$key."'>".LAN_TMP_GALL_05."</a></p>";
		$userList.= "<p class='smalltext' style='padding-top:10px;'>".$userData['user_signature']."</p>";
		$userList.= "</td></tr>";
	}
	$userList.= "</table>";	
	
	return $userList;
}
function getAllCats() {
// returns a list of all categories	
	$PView = new PView;
    global $g1;
	$catArray = $PView -> getCatArray();
	$catArrayEdv = array();
	// add catimagescount for further sorting
	foreach ($catArray as $key=>$dataset){
		$catArrayEdv[$key]=$PView->getCatImageCount($key);
	}
	// sort list, cat with most images first
	arsort($catArrayEdv);
    $catList = $this -> getGalleriffic_start();
	$catList.= "<table style='width:100%;'>";
	foreach($catArrayEdv as $key=>$dataset){
		$catData = $PView->getCatData($key);
		$catImageCount = $PView->getCatImageCount($key);
        $catList.= "<tr><td colspan = '2' style='border: 0px; padding-bottom:8px; padding-left:5px; padding-top: 15px;'><div class='image-title'>".$catData['name']."</div>";
        $catList.= "<span class='smalltext'>(".$catImageCount."&nbsp;".LAN_ALBUM_1.")</span></td></tr>";
        $catList.= "<tr><td class='forumheader'>&nbsp;</td>";
		$catList.= "<td class='forumheader'>".LAN_MENU_1;

		if ($catData['icon']){
			$icon = "<img src='".e_IMAGE."icons/".$catData['icon']."'>";
		} else {
			$icon = "&nbsp;";
		}
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
        $catList.= $this -> getLatestCatImages($key);
        if ($catImageCount) {
            $catList.= "<p style='padding-top:10px;'><a href='pviewgallery.php?cat=".$key."'>".LAN_TMP_GALL_06."</a></p>";
        }
        // description
		$catList.= "<p class='smalltext'>".$catData['description']."</p>";
		$catList.= "</td></tr>";
	}
	
	$catList.= "</table>";
	
	return $catList;
}
function getAllAlbums($typ) {
// returns all albums for gallery and subalbum view
	$PView = new PView;
    global $g1;
    $Template = new Template;
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
	$thumbPos = $Template->getThumbPosition();
	
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
				$out_AllAlbums .= "<tr style='height:90px;'><td colspan='2' style='".$thumbPos."'><a href='pviewgallery.php?album=".$dataset['albumId']."'><img src='".$PView -> getAlbumImage($dataset['albumId'])."' style='border: 1px solid #ccc; padding:2px; ".$g1['th_height'].$g1['th_width']." float: left; margin-right:5px;' title='".$dataset['name']."'></a>&nbsp;";
				if (array_search("name",$showDetails) === FALSE && array_search("info",$showDetails) !== FALSE) {
					$out_AllAlbums .= "<br><span class='smalltext'>(".LAN_ALBUM_1.": ".$PView -> getAlbumImageCount($dataset['albumId'])." / ".LAN_ALBUM_2.": ".$PView -> getSubAlbumsCount($dataset['albumId']).")</span>";
				}
				if (array_search("edit",$showDetails) !== FALSE && $PView -> getPermission("album",$dataset['albumId'],"Edit")) {
					$out_AllAlbums .= "<div style='padding-top:5px;'><a href='pview_actions.php?album=".$dataset['albumId']."&action=edit'>".LAN_ALBUM_7."</a></div>";
				}				
				$out_AllAlbums .= "</td></tr></table></td>";
			} else {
				// thumb with description
				$out_AllAlbums .= "<tr style='height:90px;'><td style='width:150px;'><a href='pviewgallery.php?album=".$dataset['albumId']."'><img src='".$PView -> getAlbumImage($dataset['albumId'])."' style='border: 1px solid #ccc; padding:2px; ".$g1['th_height'].$g1['th_width']." float: left; margin-right:5px;' title='".$dataset['name']."'></a>";
				$out_AllAlbums .= "<span class='smalltext'>".$tp -> toHTML($dataset['description'])."&nbsp;</span>";
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
function getGalleriffic_start() {
// special settings for galleriffic template:
    global $g1;
	return "<link rel='stylesheet' href='templates/Galleriffic1/css/galleriffic-3.css' type='text/css' />
	<script type='text/javascript' src='templates/Galleriffic1/js/jquery-1.3.2.js'></script>

	<script type='text/javascript' src='templates/Galleriffic1/js/jquery.galleriffic.js'></script>
	<script type='text/javascript' src='templates/Galleriffic1/js/jquery.opacityrollover.js'></script>
	<!-- We only want the thunbnails to display when javascript is disabled -->
	<script type='text/javascript'>
		document.write('<style>.noscript { display: none; }</style>');
        document.write('<style>div.content { width: ".$g1['cont_width']."; height: ".$g1['gal_height'].";  }</style>');
        document.write('<style>div.slideshow-container { min-height: ".$g1['cont_height']."; }</style>');
        document.write('<style>div.slideshow-container img { max-width: ".$g1['img_width']."; max-height: ".$g1['img_height']."; }</style>');
        document.write('<style>div.loader { min-height: ".$g1['cont_height']."; width: ".$g1['cont_width']."; }</style>');
        document.write('<style>div.slideshow a.advance-link { width: ".$g1['cont_width']."; min-height: ".$g1['cont_height']."; line-height: ".$g1['cont_height']."; }</style>');
        document.write('<style>div.slideshow img { max-height: ".$g1['img_height']."; max-width: ".$g1['img_width']."; }</style>');
        document.write('<style>span.image-caption { width: ".$g1['cont_width']."; }</style>');
        document.write('<style>div.navigation { width: ".$g1['nav_width']."; }</style>');
	</script>";
}
function getGalleriffic_end() {
// special settings for galleriffic template:
	global $g1;
	return "<script type='text/javascript'>
	jQuery(document).ready(function($) {
			// We only want these styles applied when javascript is enabled
			$('div.navigation').css({'width' : '".$g1['nav_width']."', 'float' : 'left'});
			$('div.content').css('display', 'block');

			// Initially set opacity on thumbs and add
			// additional styling for hover effect on thumbs
			var onMouseOutOpacity = 0.67;
			$('#thumbs ul.thumbs li').opacityrollover({
				mouseOutOpacity:   onMouseOutOpacity,
				mouseOverOpacity:  1.0,
				fadeSpeed:         'fast',
				exemptionSelector: '.selected'
			});
	
			// Initialize Advanced Galleriffic Gallery
			var gallery = $('#thumbs').galleriffic({
				delay:                     2500,
				numThumbs:                 100,
				preloadAhead:              10,
				enableTopPager:            true,
				enableBottomPager:         true,
				maxPagesToShow:            7,
				imageContainerSel:         '#slideshow',
				controlsContainerSel:      '#controls',
				captionContainerSel:       '#caption',
				loadingContainerSel:       '#loading',
				renderSSControls:          true,
				renderNavControls:         true,
				playLinkText:              '".LAN_TMP_GALL_02." &rsaquo;&rsaquo;',
				pauseLinkText:             '".LAN_TMP_GALL_03."',
				prevLinkText:              '&lsaquo; ".LAN_IMAGE_6."',
				nextLinkText:              '".LAN_IMAGE_7." &rsaquo;',
				nextPageLinkText:          'Next &rsaquo;',
				prevPageLinkText:          '&lsaquo; Prev',
				enableHistory:             false,
				autoStart:                 false,
				syncTransitions:           true,
				defaultTransitionDuration: 900,
				onSlideChange:             function(prevIndex, nextIndex) {
					// 'this' refers to the gallery, which is an extension of $('#thumbs')
					this.find('ul.thumbs').children()
						.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
						.eq(nextIndex).fadeTo('fast', 1.0);
				},
				onPageTransitionOut:       function(callback) {
					this.fadeTo('fast', 0.0, callback);
				},
				onPageTransitionIn:        function() {
					this.fadeTo('fast', 1.0);
				}
			});
		});
	</script>";
}
function getLatestuserImages($userId) {
// returns latest Images by selected user in one row
    global $sql;
    global $g1;
    $PView = new PView;
    $pv_Images = array();
    $pv_arg = "WHERE uploaderUserId='".$userId."' ORDER BY uploadDate DESC";
    $sql->db_Select("pview_image","*",$pv_arg,"nowhere");
    while ($pv_Image = $sql -> db_Fetch()) {
    	// PERMISSION!!!
    	if ($PView -> getPermission("image",$pv_Image['imageId'],"View")){
    		array_push ($pv_Images, $pv_Image);
    	}
    }
    $outHtml = "<table width=100%><tr><td>";
    foreach ($pv_Images as $dataset) {
        $pv_thumb = $PView -> getThumbPath($dataset['imageId']);
        $pv_resize = $PView -> getresizePath($dataset['imageId']);
        $outHtml.= "<div style='float:left; margin:2px;'>";
        $outHtml.= $this ->getImageLink("user",$dataset,"thumb","resize","pview_user");
        $outHtml.= "</div>";
        if ($counter++ >=5) {break;} //value = number of listed images - 1
    }
    $outHtml.= "</td></tr></table>";
   return $outHtml;
}
function getLatestCatImages($catId) {
// returns latest Images by selected user in one row
    global $sql;
    global $g1;
    $PView = new PView;
    $pv_Images = array();
    $pv_arg = "WHERE cat='".$catId."' ORDER BY uploadDate DESC";
    $sql->db_Select("pview_image","*",$pv_arg,"nowhere");
    while ($pv_Image = $sql -> db_Fetch()) {
    	// PERMISSION!!!
    	if ($PView -> getPermission("image",$pv_Image['imageId'],"View")){
    		array_push ($pv_Images, $pv_Image);
    	}
    }
    $outHtml = "<table width=100%><tr><td>";
	foreach ($pv_Images as $dataset) {
        $pv_thumb = $PView -> getThumbPath($dataset['imageId']);
        $pv_resize = $PView -> getresizePath($dataset['imageId']);
        $outHtml.= "<div style='float:left; margin:2px;'>";
        $outHtml.= $this ->getImageLink("cat",$dataset,"thumb","resize","pview_cat");
        $outHtml.= "</div>";
        if ($counter++ >=5) {break;} //value = number of listed images - 1
    }
    $outHtml.= "</td></tr></table>";
   return $outHtml;
}
function getStat_ImgRating() {
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
    $Template = new Template;
	global $outStat_Totals;
	global $tp;
	global $ImageSort;
    global $g1;
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
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border:0px; padding:5px; ".$Template->getThumbPosition()."'>".$this ->getImageLink("album",$dataset,"thumb","resize","pview_gal");
			
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
function getStat_UserComm() {
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
    $Template = new Template;
	global $outStat_Totals;
	global $tp;
	global $ImageSort;
    global $g1;
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
			$avatar= "<img src='".avatar($userimage)."' style='".$g1['th_height'].$g1['th_width']."; border: 1px solid #ccc; padding:2px;' />";
		} else {
			$avatar= "<img src='";
			$avatar.= SITEURLBASE.e_PLUGIN_ABS."pviewgallery/templates/".$PView -> getPView_config("template")."/images/profile.png";
			$avatar.= "' alt='".LAN_IMAGE_53."' title='".LAN_IMAGE_53."' style='".$g1['th_height'].$g1['th_width']."; border: 1px solid #ccc; padding:2px;' />";
		}
		
		// insert comment-user line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($uploaderCount < $elementCount) {
			
			$row.= "<td style='vertical-align:top; width:".$colwidth."%; border: 0px; padding:5px; ".$Template->getThumbPosition()."'><a href='".e_BASE."user.php?id.".$key."'>".$avatar."</a>";
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
function getStat_Uploader() {
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
    $Template = new Template;
	global $outStat_Totals;
	global $tp;
    global $g1;
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
			$avatar= "<img src='".avatar($userimage)."' style='".$g1['th_height'].$g1['th_width']."; border: 1px solid #ccc; padding:2px;' />";
		} else {
			$avatar= "<img src='";
			$avatar.= SITEURLBASE.e_PLUGIN_ABS."pviewgallery/templates/".$PView -> getPView_config("template")."/images/profile.png";
			$avatar.= "' / alt='".LAN_IMAGE_53."' title='".LAN_IMAGE_53."' style='".$g1['th_height'].$g1['th_width']."; border: 1px solid #ccc; padding:2px;' >";
		}
		
		// insert uploader line by line, observe pagelimit
		if ($colCount == $cols) {
			$row.= "</tr><tr>";
			$colCount = 0;
		}
		if ($uploaderCount < $elementCount) {
			
			$row.= "<td style='vertical-align:top; width:".$colwidth."%; border: 0px; padding:5px; ".$Template->getThumbPosition()."'><a href='".e_BASE."user.php?id.".$key."'>".$avatar."</a>";
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
function getStat_Comm() {
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
    $Template = new Template;
	global $outStat_Totals;
	global $tp;
    global $g1;
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
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: 0px; padding:5px; ".$Template->getThumbPosition()."'>".$this ->getImageLink("album",$dataset,"thumb","resize","pview_gal");
			
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
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
    $Template = new Template;
	global $outStat_Totals;
	global $tp;
	global $ImageSort;
    global $g1;
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
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: 0px; padding:5px; ".$Template->getThumbPosition()."'>".$this ->getImageLink("album",$dataset,"thumb","resize","pview_gal");
			
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
function getStat_ImgViews() {
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
    $Template = new Template;
	global $outStat_Totals;
	global $tp;
	global $ImageSort;
    global $g1;
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
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: 0px; padding:5px; ".$Template->getThumbPosition()."'>".$this ->getImageLink("album",$dataset,"thumb","resize","pview_gal");
			
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
function getStat_Usergals() {
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
    $Template = new Template;
	global $outStat_Totals;
	global $tp;
    global $g1;
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
				$avatar= "<img src='".avatar($userimage)."' style='".$g1['th_height'].$g1['th_width']."; border: 1px solid #ccc; padding:2px; margin:5px;' />";
			} else {
				$avatar= "<img src='";
				$avatar.= SITEURLBASE.e_PLUGIN_ABS."pviewgallery/templates/".$PView -> getPView_config("template")."/images/profile.png";
				$avatar.= "' alt='".LAN_IMAGE_53."' title='".LAN_IMAGE_53."' style='".$g1['th_height'].$g1['th_width']."; border: 1px solid #ccc; padding:2px; margin:5px;' />";
			}			
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: 0px; padding:5px; ".$Template->getThumbPosition()."'><a href='pviewgallery.php?gallery=".$dataset['galleryId']."'>".$tp -> toHTML($dataset['name'])."</a>";
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
function getStat_Album() {
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
    $Template = new Template;
	global $outStat_Totals;
	global $tp;
    global $g1;
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
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: 0px; padding:5px; ".$Template->getThumbPosition()."'><a href='pviewgallery.php?album=".$dataset['albumId']."'><img src='".$PView -> getAlbumImage($dataset['albumId'])."' title='".$dataset['name']."' style='".$g1['th_height'].$g1['th_width']."; border: 1px solid #ccc; padding:2px;'></a>";
			
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
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
    $Template = new Template;
	global $outStat_Totals;
	global $tp;
    global $g1;
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
					
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border:0px; padding:5px; ".$Template->getThumbPosition()."'><a href='pviewgallery.php?cat=".$dataset['catId']."'><img src='".e_IMAGE."icons/".$dataset['icon']."' title='".$dataset['name']."' style='".$g1['th_height'].$g1['th_width']."; border: 1px solid #ccc; padding:2px;'>";
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
function getImageLink($view,$imageData,$thumb_size,$img_size,$group){
// returns image incl. links as specified for gallery pages	

// $view: backlink (album, user, cat) only used for pview
// $imageData: Array
// $thumb_size: size (thumb,resize,original) of shown image (link)
// $img_size: size (thumb,resize,original) of shown image (destination)
// $group: group to built galleries in javascripts

	$PView = new PView;
    global $g1;	
	
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
	$imageLink.= "<img src='".$thumb."' title='".$imageData['name']."' style='".$g1['th_height'].$g1['th_width']." border: 1px solid #ccc; padding:2px;'>";
	$imageLink.= $anchor_end;
	
	return $imageLink;
}

function getStat_FeatureImg() {
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
    $Template = new Template;
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
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: 0px; padding:5px; ".$Template->getThumbPosition()."'>".$this ->getImageLink("album",$dataset,"thumb","resize","pview_gal");
			
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
// returns a tableRow for Advanced Frontpage
	$PView = new PView;
    $Template = new Template;
	global $tp;
    global $g1;
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
			
			$row.= "<td style='vertical-align:top;width:".$colwidth."%; border: 0px; padding:5px; ".$Template->getThumbPosition()."'><a href='".e_PLUGIN."pviewgallery/pviewgallery.php?album=".$dataset['albumId']."'>";
			$row.= "<img title='".$dataset['name']."' src='".$thumb."' style='".$g1['th_height'].$g1['th_width']."; border: 1px solid #ccc; padding:2px;' />";
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

}
//Class UserTemplate End

?>