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

class UserTemplate {

function getContent() {

	// returns the gallery content
	$PView = new PView;
	$Template = new Template;
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
				$AG.= "<tr><td class='fborder' style='padding:2px;'>".$Template->getModuleContent($key)."</td></tr>";
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
			$MG.= "<tr><td class='fcaption' style='border: 0px;'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/gallery.png' border='0px'> {pv_MainGalleryName} (".LAN_GALLERY_3.": {pv_RootalbumCount})</td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_MainGalleryMenu}</td></tr>";
			$MG.= "{pv_RootAlbums}";
			$MG.= "</table><br/>";
		}
		// List of Category and User View
		$LV = "<table cellspacing='0px' style='width:98%;' class='fborder'>";
		$LV.= "<tr><td class='fcaption' style='border: 0px;'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/image_multi.png' border='0px'> ".LAN_GALLERY_14."</td></tr>";
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
			$UG.= "<tr><td class='fcaption' style='border: 0px;'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/gallery.png' border='0px'> {pv_MemberGalleryName} ({pv_UserGalleryCount})</td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_UserGalleryMenu}</td></tr>";
			$UG.= "{pv_UserGalleries}";
			$UG.= "</table>";
		}	
		return $MG.$LV.$UG;
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
			$UG = "<table cellspacing='0px' style='width:98%;' class='fborder'>";
			$UG.= "<tr><td class='fcaption' style='border: 0px;'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/gallery.png' border='0px'> {pv_UserGalleryName} (".LAN_GALLERY_3.": {pv_RootalbumCount})</td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_MainGalleryMenu}</td></tr>";
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
			$ALBUM.= "<tr><td class='fcaption' style='border: 0px;'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/album.png' border='0px'> {pv_AlbumName} <span class='smalltext'>(".LAN_ALBUM_1.": {pv_AlbumImageCount} / ".LAN_ALBUM_2.": {pv_SubAlbumCount})</span></td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_AlbumMenu}</td></tr>";
			$ALBUM.= "{pv_SubAlbums}";
			$ALBUM.= "<tr><td colspan='2' class='forumheader'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/image_multi.png' border='0px'> ".LAN_ALBUM_1.":</td></tr><tr><td colspan='2'><table style='width:100%'>";
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
			$IMG.= "<tr><td class='fcaption' style='border: 0px;'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/image.png' border='0px'> {pv_ImageName}</td><td class='fcaption' style='border: 0px; text-align:right; padding-right:5px;'>{pv_ImageMenu}</td></tr>";
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
		if (!strip_tags($tmpList = $Template->getAllUsers())){
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
function getAllImages() {
// returns imagegrid for album, category and user view
	$PView = new PView;
	$Template = new Template;
	global $tp;
	
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
		$cols = 1;
		$pics = $PView -> getPView_config("pics_per_page");
		$picCount = 0;
		$colwidth = 100/$cols;
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
					$thumb = $PView -> getResizePath($dataset['imageId']);
					if ($PView->getPView_config("seo_links")){
						$seo = "&amp;name=".$dataset['name'];
					} else {
						$seo = "";
					}	
					if ($PView->getPView_config("center_thumbs")){
						$infoPos = "left:30%;";
					} else{
						$infoPos = "left:10px;";
					}
					$backgr = "background:url(".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/gt.png) repeat;";		
										
					$out_AllImages.= "<td style='vertical-align:top;width:".$colwidth."%; border: #b7b5b5 1px solid; padding:5px; ".$Template->getThumbPosition()."'><div style='position:relative;'><div style='position:relative;'>".$Template -> getImageLink($pv_Appl[0],$dataset,'resize','resize','pview_gal')."</div>";
					
					$out_AllImages.= "<div style='position:absolute; bottom:10px; ".$infoPos." width:40%; border: 2px solid #b7b5b5; text-align:left; padding: 5px; ".$backgr."'>";
					foreach($showDetails as $detail){
						
						switch($detail){
							case "name":
							$out_AllImages.= "<span><b>".$tp -> toHTML($dataset['name'])."</b></span>";
							break;
							case "descr":
							$out_AllImages.= "<br/><span>".$tp -> toHTML($dataset['description'])."</span>";
							break;
							case "user":
							$userData = $PView->getUserData($dataset['uploaderUserId']);
							// LINK Abfrage: Link zur Anzeige aller Bilder des Users
							if ($PView->getPView_config("details_link")){
								$out_AllImages.= "<br/><a href='pviewgallery.php?user=".$dataset['uploaderUserId']."'><span>".$tp -> toHTML($userData['user_name'])."</span></a>";
							}else{
								$out_AllImages.= "<br/><span>".$tp -> toHTML($userData['user_name'])."</span>";
							}
							break;
							case "cat":
							if ($catData = $PView -> getCatData($dataset['cat'])){
								$catName = $catData['name'];
							} else {
								$catName = LAN_IMAGE_46;
							}							
							// LINK Abfrage: Link zur Anzeige aller Bilder der Kategorie
							if ($PView->getPView_config("details_link") && $dataset['cat']){
								$out_AllImages.= "<br/><a href='pviewgallery.php?cat=".$dataset['cat']."'><span>".LAN_IMAGE_45.": ".$tp -> toHTML($catName)."</span></a>";
							}else{
								$out_AllImages.= "<br/><span>".LAN_IMAGE_45.": ".$tp -> toHTML($catName)."</span>";
							}
							break;
							case "date":
							$out_AllImages.= "<br/><span>".$tp -> toHTML(date('d.m.Y',$dataset['uploadDate']))."</span>";
							break;
							case "gal":
							$albumData = $PView->getAlbumData($dataset['albumId']);
							// LINK Abfrage: Link zur Anzeige der Galerie
							if ($PView->getPView_config("details_link")){
								$out_AllImages.= "<br/><a href='pviewgallery.php?gallery=".$albumData['galleryId']."'><span>".$tp -> toHTML($PView->getGalleryName($albumData['galleryId']))."</span></a>";
							}else{
								$out_AllImages.= "<br/><span>".$tp -> toHTML($PView->getGalleryName($albumData['galleryId']))."</span>";
							}
							break;
							case "album":
							// LINK Abfrage: Link zur Anzeige aller Bilder des albums
							if ($PView->getPView_config("details_link")){
								$out_AllImages.= "<br/><a href='pviewgallery.php?album=".$dataset['albumId']."'><span>".$tp -> toHTML($PView->getAlbumName($dataset['albumId']))."</span></a>";
							}else{
								$out_AllImages.= "<br/><span>".$tp -> toHTML($PView->getAlbumName($dataset['albumId']))."</span>";
							}
							break;
							case "edit":
							//PERMISSION!!!
							if ($PView -> getPermission("album",$dataset['sendImage'],"Edit")) {
								$out_AllImages.= "<br/><a href='pview_actions.php?image=".$dataset['imageId']."&amp;action=edit'><span>".LAN_IMAGE_2."</span></a>";
							}
							break;
							case "send":
							//PERMISSION!!!
							if (($PView -> getPView_config("email") && $dataset['sendImage']) OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
								if ($PView -> getPermission("config","permEmail","")) {
									$out_AllImages.= "<br/><a href='".e_BASE."email.php?plugin:pviewgallery.".$dataset['imageId']."'><span>".LAN_IMAGE_48_1."</span></a>";
								}
							}
							break;
							case "comm":
							if ($PView->getPView_config("Comments")){
								$out_AllImages.= "<br /><span>".LAN_IMAGE_4.": ".$PView -> getCommentsCount($dataset['imageId'])."</span>";
							}							
							break;	
							case "rating":
							if ($PView->getPView_config("Rating")){
								$ratingData = $PView -> getRatingData($dataset['imageId']);
								$out_AllImages.= "<br /><span>".LAN_IMAGE_3.": ".round($ratingData['value'],1)." (".$ratingData['count'].")</span>";
							}
							break;	
							case "views":
							$out_AllImages.= "<br/><span>".LAN_IMAGE_16.": ".$tp -> toHTML($dataset['views'])." ".LAN_IMAGE_17."</span>";
							break;																				
						}			
					}
					$out_AllImages.= "</div></div></td>";		
					$colCount++;
				}
				$picCount++;
			}
		}
		// fill row with empty cells
		while ($colCount < $cols) {
			$out_AllImages.= "<td>&nbsp;</td>";
			$colCount++;
		}
		$out_AllImages.= "</tr>";
		return $out_AllImages;
	}
	return "<div style='padding:10px;'>".$message."</div>";
}
function getAllAlbums($typ) {
// returns all albums for gallery and subalbum view
	$PView = new PView;
	global $tp;
	
	$details = $PView->getPView_config("gal_details");
	$showDetails = explode("|",$details);
	
	if ($typ == "root"){
		$AllAlbumData = $PView -> getRootAlbumData();
	} else {
		if (!$PView -> getSubAlbumsCount()) { return ""; }// exit if no subalbums
		$AllAlbumData = $PView -> getSubAlbumData();	
	}

	$out_AllAlbums = "<tr><td colspan='2' style='padding-top:5px;'><table style='width:100%'>";
	foreach ($AllAlbumData as $dataset) {
		//PERMISSION!!!
		if ($PView -> getPermission("album",$dataset['albumId'],"View")) {
			$out_AllAlbums .= "<tr><td><div style='background-image:url(".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/ringbuch_650.jpg); background-repeat:no-repeat; width:660px; height:400px;'>";
			$out_AllAlbums .= "<table style='width:550px;'><tr style='height:300px;'><td style='text-align:left;padding-top:30px; width:40%;'>";
			if (array_search("name",$showDetails) !== FALSE) {
				$out_AllAlbums .= "<a href='pviewgallery.php?album=".$dataset['albumId']."'>". $tp -> toHTML($dataset['name'])."</a>";
			}
			if (array_search("descr",$showDetails) !== FALSE) {
				$out_AllAlbums .= "<br><br>". $tp -> toHTML($dataset['description']);
			}
			$out_AllAlbums .= "</td><td style='text-align:right;padding-top:30px;width:60%;'><a href='pviewgallery.php?album=".$dataset['albumId']."'><img src='".$PView -> getAlbumImage($dataset['albumId'])."' border='0px'></a></td></tr>";
			$out_AllAlbums .= "<tr><td style='text-align:left;'>";
			if (array_search("edit",$showDetails) !== FALSE && $PView -> getPermission("album",$dataset['albumId'],"Edit")) {
				$out_AllAlbums .= "<a href='pview_actions.php?album=".$dataset['albumId']."&action=edit'>".LAN_ALBUM_7."</a>";
			}
			$out_AllAlbums .= "</td><td style='text-align:right;'>";
			if (array_search("info",$showDetails) !== FALSE) {
				$out_AllAlbums .= LAN_ALBUM_1.": ".$PView -> getAlbumImageCount($dataset['albumId'])." / ".LAN_ALBUM_2.": ".$PView -> getSubAlbumsCount($dataset['albumId']);
			}
			$out_AllAlbums ."</td></tr>";
			$out_AllAlbums .= "</table> ";
			$out_AllAlbums .= "</div></td></tr>";
		}
	}
	
	$out_AllAlbums .= "</table></td></tr>";
	if (!strip_tags($out_AllAlbums)) {
	$out_AllAlbums = "<tr><td colspan='2' style='padding:10px;'>".LAN_GALLERY_4."</td></tr>";
	}
return $out_AllAlbums;
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

	$NavMenu = "<table width='95%'><tr>";
	$NavMenu.= "<td width='18%' style='text-align:center;'><a href='pviewgallery.php?image=".$imageFirst."&amp;view=".$view."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/back.png' border='0px'></a></td>";
	$NavMenu.= "<td width='18%' style='text-align:center;'>";
	if ($imagePrev) {
		$NavMenu.= "<a href='pviewgallery.php?image=".$imagePrev."&amp;view=".$view."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/image_prev.png' border='0px'></a>";
	}
	$NavMenu.= "&nbsp;</td>";
	$NavMenu.= "<td width='28%' style='text-align:center;'><a href='pviewgallery.php?".$backTo."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/up.png' border='0px'></a></td>";
	$NavMenu.= "<td width='18%' style='text-align:center;'>";
	if ($imageNext) {
		$NavMenu.= "<a href='pviewgallery.php?image=".$imageNext."&amp;view=".$view."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/image_next.png' border='0px'></a>";
	}
	$NavMenu.= "&nbsp;</td>";
	$NavMenu.= "<td width='18%' style='text-align:center;'><a href='pviewgallery.php?image=".$imageLast."&amp;view=".$view."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/next.png' border='0px'></a></td>";
	$NavMenu.= "</tr></table>";
	return $NavMenu;
}
function getGalleryMenu($galType) {
// returns menu for gallery view
	$PView = new PView;
	$Appl = $PView -> getAppl();
	if ($galType == "main") {
		// PERMISSION!!!
		if ($PView -> getPermission("gallery",$Appl[1],"CreateAlbum")) {
			$galMenu = "<a href='".e_PLUGIN."pviewgallery/pview_actions.php?gallery=".$Appl[1]."&amp;action=newalbum'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/album_add.png' border='0px'alt='".LAN_GALLERY_2."' title='".LAN_GALLERY_2."'></a>";
		}
		// PERMISSION!!!
		if ($PView -> getPermission("gallery",$Appl[1],"Edit")) {
			$galMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?gallery=".$Appl[1]."&amp;action=edit'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/gallery_edit.png' border='0px'alt='".LAN_GALLERY_6."' title='".LAN_GALLERY_6."'></a>";
		}
	}
	if ($galType == "user") {
		// PERMISSION!!!
		if ($PView -> getPermission("config","permCreateGallery","")) {
			$galMenu = "<a href='".e_PLUGIN."pviewgallery/pview_actions.php?gallery=".$Appl[1]."&amp;action=newgallery'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/gallery_add.png' border='0px'alt='".LAN_GALLERY_1."' title='".LAN_GALLERY_1."'></a>";
		}
	}
	return $galMenu;
}
function getAlbumMenu() {
// returns menu for album view
	$PView = new PView;
	$Appl = $PView -> getAppl();
	$AlbumMenu.= "<form action='".e_SELF."?".e_QUERY."' method='post'>";
	
	// PERMISSION!!!
	if ($PView -> getPermission("album",$Appl[1],"CreateAlbum")) {
		$AlbumMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$Appl[1]."&amp;action=newalbum'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/album_add.png' border='0px'alt='".LAN_ALBUM_6."' title='".LAN_ALBUM_6."'></a>";
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
		$AlbumMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$Appl[1]."&amp;action=edit'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/album_edit.png' border='0px'alt='".LAN_ALBUM_7."' title='".LAN_ALBUM_7."'></a>";
	}
	// PERMISSION!!!
	if ($PView -> getPermission("album",$Appl[1],"Upload")) {
		$AlbumMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$Appl[1]."&amp;action=upload'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/image_add.png' border='0px'alt='".LAN_ALBUM_8."' title='".LAN_ALBUM_8."'></a>";
	}
	// ViewerSort
	if ($PView->getPView_config("viewer_sort")){
		$AlbumMenu.= "<br>".LAN_ALBUM_19.": ".$PView->getSortBox("album",1);
	}
	$AlbumMenu.= "</form>";
	return $AlbumMenu;
}
function getImageMenu() {
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
			$ImageMenu.= " <a href='".e_BASE."email.php?plugin:pviewgallery.".$Appl[1]."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/mail_next.png' border='0px'alt='".LAN_IMAGE_48."' title='".LAN_IMAGE_48."'></a>";
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
		$ImageMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$PView -> getImageAlbum()."&amp;changeimage=".$Appl[1]."'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/favorite.png' border='0px'alt='".LAN_ACTION_31."' title='".LAN_ACTION_31."'></a>";
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
		$ImageMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?image=".$Appl[1]."&amp;action=edit'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/image_edit.png' border='0px'alt='".LAN_IMAGE_2."' title='".LAN_IMAGE_2."'></a>";
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
// returns a button image incl. link
	$PView = new PView;
	// PERMISSION!!!
	if ($PView -> getPermission("config","permComment","")) {
		if (!$_GET['comment'] && !$_POST['submit']) {
			$btn = "<a href='javascript:pv_CommentAdd();'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/comment_add.png' border='0px'alt='".LAN_IMAGE_18."' title='".LAN_IMAGE_18."'></a>";
		}
	}
	return $btn;
}
function getButton_editComment($commentid) {
// returns a button image incl. link
	$PView = new PView;
	// PERMISSION!!!
	if ($PView -> getPermission("config","permComment","")) {
	$btn = "<a href='pviewgallery.php?image=".$_GET['image']."&comment=".$commentid."#a_preview'><img src='".e_PLUGIN."pviewgallery/templates/".$PView -> getPView_config("template")."/images/comment_edit.png' border='0px'alt='".LAN_IMAGE_19."' title='".LAN_IMAGE_19."'></a>";
	}
	return $btn;
}




} //class usertemplate end
?>