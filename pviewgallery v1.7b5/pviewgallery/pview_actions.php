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

// all userclasses
$allUserclasses = $PView -> getUserclasses();

// all cats (Id and name)
$catArray = $PView -> getCatArray();

// Batch Upload:
// Use functions only, no rendering required
if (!$batchUpload){
	
	$Action_OK = 0;	
	
	// Nominate image for featured pictures
	if ($_GET['nomimage'] && !$Action_OK) {
		$Action_OK = 1;	
		//Permission!!!
		if ($PView -> getPView_config("Nominate") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
			if ($PView -> getPermission("config","permNominate","") AND $PView -> checkNomLimit("image")) {
				$PView -> setImageNom($_GET['nomimage']);
				//return to image
				header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php?image=".$_GET['nomimage']."&view=".$_GET['view']);
				exit;
			} else {
				$out_HTML = $PView -> getNoPerm(); //forbidden action
			}
		}else {
			$out_HTML = $PView -> getNoPerm(); //forbidden action
		}
	}
	
	// Nominate album for featured albums
	if ($_GET['nomalbum'] && !$Action_OK) {
		$Action_OK = 1;	
		//Permission!!!
		if ($PView -> getPView_config("Nominate") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
			if ($PView -> getPermission("config","permNominate","") AND $PView -> checkNomLimit("album")) {
				$PView -> setAlbumNom($_GET['nomalbum']);
                
                // clear cache for adv. startpage
				$e107cache -> clear("pview_stat");
                // clear cache for this album
				$e107cache -> clear("pview_album_".$_GET['nomalbum']);
                                
				//return to image
				header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php?album=".$_GET['nomalbum']."&view=".$_GET['view']);
				exit;
			} else {
				$out_HTML = $PView -> getNoPerm(); //forbidden action
			}
		}else {
			$out_HTML = $PView -> getNoPerm(); //forbidden action
		}
	}	
	
	// Rating
	if ($_GET['image'] && $_GET['rate'] && !$Action_OK) {
		$Action_OK = 1;	
		//Permission!!!
		if ($PView -> getPermission("config","permRating","") && !$PView -> getUserRated()) {
			// invalid parameters
			if (!$PView -> getImageData($_GET['image']) OR intval($_GET['rate']) > 10 OR intval($_GET['rate']) < 1) { 
				header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php");
				exit;
			}
			$PView -> setImageRating($_GET['image']);
			//return to image
			header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php?image=".$_GET['image']."&view=".$_GET['view']);
			exit;
		} else {
			$out_HTML = $PView -> getNoPerm(); //forbidden action
		}
	}
	// Delete/Edit Image
	if ($_GET['image'] && $_GET['action'] == "edit" && !$Action_OK) {
		$Action_OK = 1;
		if ($PView -> getPermission("image",$_GET['image'],"edit")) {
			// delete image
			if (isset($_GET['delete'])){
				if (!$_GET['confirm']) {
					$ns->tablerender(LAN_ADMIN_90." ".LAN_ADMIN_50, $PView -> getDelConfirm(LAN_ADMIN_90.$_GET['image']));
					require_once(FOOTERF);
					exit;
				} else {
					$parentAlbum = $PView -> getImageAlbum($_GET['image']);
                    $imgData = $PView -> getImageData($_GET['image']);
                    
					$delOK = $PView -> deleteImage($_GET['image']);
                    					
					// clear cache for adv. startpage
					$e107cache -> clear("pview_stat");
					// clear cache for related album 
					$e107cache -> clear("pview_album_".$parentAlbum);
					// clear cache for menu
					$e107cache -> clear("nq_pview_menu");
                    // clear cache for categorie list
					$e107cache -> clear("pview_cat_list");
                    // clear cache for related categorie view
					$e107cache -> clear("pview_cat_".$imgData['cat']);                    
                    // clear cache for user list
					$e107cache -> clear("pview_user_list");
                    // clear cache for related user view
					$e107cache -> clear("pview_user_".$imgData['uploaderUserId']);
					
					$out_HTML = $PView -> getAdminMsg($delOK);
					$out_HTML.= getContLinks("deleteimage",$parentAlbum);
					$ns->tablerender(LAN_ADMIN_55, $out_HTML);
					if ($delOK) {
						require_once(FOOTERF);
						exit;
					}
				}
			}
			
			// update values
			if ($_POST['pv_action'] == "editimage") {
                
                // clear cache of current elements before move/edit image
                $imgData = $PView -> getImageData($_GET['image']);
				// clear cache for related album 
				$e107cache -> clear("pview_album_".$imgData['albumId']);
                // clear cache for related categorie view
				$e107cache -> clear("pview_cat_".$imgData['cat']);                    
                // clear cache for related user view
				$e107cache -> clear("pview_user_".$imgData['uploaderUserId']);                
                
				$sqlOK = $PView -> pviewUpdateDb("image","name",$_POST['pv_name'],"text",$_GET['image']);
				$sqlOK = $sqlOK & $PView -> pviewUpdateDb("image","description",$_POST['pv_description'],"text",$_GET['image']);
				if (!$catId = array_search($_POST['pv_cat'],$catArray)) {
					$catId = 0;
				}
				$sqlOK = $sqlOK & $PView -> pviewUpdateDb("image","cat",$catId,"",$_GET['image']);
				$newAlbum = explode(",",$_POST['pv_albumSelect']);
				$curAlbum = $PView -> getImageAlbum($_GET['image']);
				$sqlOK = $sqlOK & $PView -> pviewUpdateDb("image","albumId",$newAlbum[1],"",$_GET['image']);
				$sqlOK = $sqlOK & $PView -> pviewUpdateDb("image","permView",$PView -> getpermClasses("pv_permView"),"",$_GET['image']);
				if (ADMIN) {
					$sqlOK = $sqlOK & $PView -> pviewUpdateDb("image","permEdit",$PView -> getpermClasses("pv_permEdit"),"",$_GET['image']);
					$sqlOK = $sqlOK & $PView -> pviewUpdateDb("image","sendImage",$_POST['pv_sendImage'],"checkbox",$_GET['image']);
				}
				// move files if album is changed, secure albumimage
				if ($sqlOK && $curAlbum <> $newAlbum[1]) {
					$imgData = $PView -> getImageData($_GET['image']);
					$curPath = e_PLUGIN."pviewgallery/gallery/album".$curAlbum."/";
					$newPath = e_PLUGIN."pviewgallery/gallery/album".$newAlbum[1]."/";
					if (file_exists($curPath.$imgData['filename']) && !$imgData['externalImage']) {
						rename($curPath.$imgData['filename'],$newPath.$imgData['filename']);
					}
					if (file_exists($curPath.$imgData['filenameResized'])) {
						rename($curPath.$imgData['filenameResized'],$newPath.$imgData['filenameResized']);
					}
					if (file_exists($curPath.$imgData['thumbnail'])) {
						$albumData = $PView -> getAlbumData($curAlbum);
						if ($albumData['albumImage'] == $imgData['thumbnail']) {
							copy($curPath.$imgData['thumbnail'],$newPath.$imgData['thumbnail']);
						} else {
							rename($curPath.$imgData['thumbnail'],$newPath.$imgData['thumbnail']);
						}
					}
				}
                
                // clear cache of new elements
                $imgData = $PView -> getImageData($_GET['image']);
				// clear cache for adv. startpage
				$e107cache -> clear("pview_stat");
				// clear cache for related album 
				$e107cache -> clear("pview_album_".$imgData['albumId']);
				// clear cache for menu
				$e107cache -> clear("nq_pview_menu");
                // clear cache for categorie list
				$e107cache -> clear("pview_cat_list");
                // clear cache for related categorie view
				$e107cache -> clear("pview_cat_".$imgData['cat']);                    
                // clear cache for user list
				$e107cache -> clear("pview_user_list");
                // clear cache for related user view
				$e107cache -> clear("pview_user_".$imgData['uploaderUserId']);
					
				
				// feedback and continuation links
				$out_HTML = $PView -> getAdminMsg($sqlOK);
				$out_HTML.= getContLinks("editimage");
				
				$ns->tablerender(LAN_ADMIN_55, $out_HTML);
			}
			// edit form
			$out_HTML = getForm_image($PView -> getImageData($_GET['image']));
		} else {
			$out_HTML = $PView -> getNoPerm(); //forbidden action
		}
	}
	// Upload Image
	if ($_GET['album'] && $_GET['action'] == "upload" && !$Action_OK) {
		$Action_OK = 1;
		if ($PView -> getPermission("album",$_GET['album'],"upload")) {
			if ($_POST['pv_action'] == "uploadimage") {
			// save values (normal upload)
			if ($_FILES['pv_uploadimage']['tmp_name']) { 
				$uploadResult = uploadImage($_FILES['pv_uploadimage']['tmp_name'],"normal");
				if ($uploadResult) {
					$out_HTML.= getFeedback($uploadResult);
					if ($uploadResult == LAN_ACTION_19) {  // filelimit
						$out_HTML.= getContLinks("cancelupload");
					}
					$ns -> tablerender($PView -> getPView_config("pview_name"), $out_HTML);
					require_once(FOOTERF);
					exit;
				}
			}
			// save values (external upload)
			if (isset($_POST['pv_externalImage'])) { 
				if ($PView -> getPermission("config","permExtern","")){
					$uploadResult = uploadImage($_POST['pv_uploadimage'],"external");
					if ($uploadResult) {
						$out_HTML.= getFeedback($uploadResult);
						$ns -> tablerender($PView -> getPView_config("pview_name"), $out_HTML);
						require_once(FOOTERF);
						exit;
					}
				}else{
					$ns -> tablerender($PView -> getPView_config("pview_name"), $PView -> getNoPerm());
					require_once(FOOTERF);
					exit;
				}
			}
				            			
			$out_HTML.= getFeedback(LAN_ACTION_23);
			if ($PView -> getPView_config("approval") && !ADMIN){
				$out_HTML.= getFeedback(LAN_ACTION_26);
			}
			$out_HTML.= getContLinks("uploadimage");
			$ns -> tablerender($PView -> getPView_config("pview_name"), $out_HTML);
			require_once(FOOTERF);
			exit;
			}
			if (checkGalleryLimit()) {
				$out_HTML = getFeedback(LAN_ACTION_27);
				$out_HTML.= getContLinks("cancelupload");
			} else {
				$out_HTML = getForm_upload();
			}
			
		} else {
			$out_HTML = $PView -> getNoPerm(); //forbidden action
		}
	}
	// Set albumimage from image in gallery
	if ($_GET['album'] && isset($_GET['changeimage'])) {
		if ($PView -> getPermission("album",$_GET['album'],"Edit")) {
			$imageData = $PView -> getImageData($_GET['changeimage']);
			$albumData = $PView -> getAlbumData($_GET['album']);
			if ($imageData['thumbnail']) {
				$sqlOK = $PView -> pviewUpdateDb("album","albumImage",$imageData['thumbnail'],"",$_GET['album']);
			}
			
			// clear cache for adv. startpage
			$e107cache -> clear("pview_stat");
			// clear cache for related gallery 
			$e107cache -> clear("pview_gal_".$albumdata['galleryId']);
			// clear cache for parent album 
			$e107cache -> clear("pview_album_".$PView -> getParentAlbum($_GET['album']));
			
			// feedback und ContLinks
			$out_HTML = $PView -> getAdminMsg($sqlOK);
			$out_HTML.= getContLinks("changeimage",$albumData['galleryId']);
			$ns->tablerender(LAN_ADMIN_55, $out_HTML);
			require_once(FOOTERF);
			exit;
		} else {
			// no permission!
			$out_HTML = $PView -> getNoPerm("album");
		}
	}
	// Delete/Edit Album
	if ($_GET['album'] && $_GET['action'] == "edit" && !$Action_OK) {
		$Action_OK = 1;
		if ($PView -> getPermission("album",$_GET['album'],"Edit")) {
			// delete album
			if (isset($_GET['delete'])){
				if (!$_GET['confirm']) {
					if (intval($PView -> getAlbumImageCount($_GET['album'],1))) {
						$out_HTML = getFeedback(LAN_ACTION_35);
						$delAtt = 1;
					}
					if (intval($PView -> getSubAlbumsCount($_GET['album'],1))) {
						$out_HTML.= getFeedback(LAN_ACTION_36);
						$delAtt = 1;
					}
					if ($delAtt && !ADMIN) {
						// escape if album is not empty
						$out_HTML.= getFeedback(LAN_ACTION_32);
						$out_HTML.= $PView -> getNoPerm();
						$ns->tablerender(LAN_ADMIN_53." ".LAN_ADMIN_50,$out_HTML);
					} else {
						$ns->tablerender(LAN_ADMIN_53." ".LAN_ADMIN_50,$out_HTML.$PView -> getDelConfirm(LAN_ADMIN_53.$_GET['album']));
					}
					require_once(FOOTERF);
					exit;
				} else {
					$parentAlbum = $PView -> getParentAlbum($_GET['album']);
					$albumdata = $PView -> getAlbumData($_GET['album']);
					// and now delete it
					$delOK = $PView -> deleteAlbum($_GET['album']);
					
					// clear cache for adv. startpage
					$e107cache -> clear("pview_stat");
					// clear cache for related gallery 
					$e107cache -> clear("pview_gal_".$albumdata['galleryId']);
					// clear cache for parent album 
					$e107cache -> clear("pview_album_".$parentAlbum);
					// clear cache for menu
					$e107cache -> clear("nq_pview_menu");
					
					$out_HTML = $PView -> getAdminMsg($delOK);
					$out_HTML.= getContLinks("deletealbum",$parentAlbum);
					$ns->tablerender(LAN_ADMIN_55, $out_HTML);
					if ($delOK) {
						require_once(FOOTERF);
						exit;
					}
				}
			}
			
			// update album data
			if ($_POST['pv_action'] == "editalbum") {
				$albumData = $PView -> getAlbumData($_GET['album']);
				
				// clear cache for adv. startpage
				$e107cache -> clear("pview_stat");
				// clear cache for this album
				$e107cache -> clear("pview_album_".$_GET['album']);
				// clear cache for related gallery (before change)
				$e107cache -> clear("pview_gal_".$albumdata['galleryId']);
				// clear cache for parent album (before change)
				$e107cache -> clear("pview_album_".$PView -> getParentAlbum($_GET['album']));
				
				$sqlOK = $PView -> pviewUpdateDb("album","name",$_POST['pv_name'],"text",$_GET['album']);
				$sqlOK = $sqlOK & $PView -> pviewUpdateDb("album","description",$_POST['pv_description'],"text",$_GET['album']);
				$sqlOK = $sqlOK & $PView -> pviewUpdateDb("album","permView",$PView -> getpermClasses("pv_permView"),"",$_GET['album']);
				if (ADMIN) {
					$sqlOK = $sqlOK & $PView -> pviewUpdateDb("album","permEdit",$PView -> getpermClasses("pv_permEdit"),"",$_GET['album']);
					$sqlOK = $sqlOK & $PView -> pviewUpdateDb("album","permCreateAlbum",$PView -> getpermClasses("pv_permCreateAlbum"),"",$_GET['album']);
					$sqlOK = $sqlOK & $PView -> pviewUpdateDb("album","permUpload",$PView -> getpermClasses("pv_permUpload"),"",$_GET['album']);
				}
				// new Albumimage
				if ($_FILES['pv_uploadimage']['tmp_name']) {
					$albumImage = albumImage();
				} else {
					$albumImage = "";
				}
				if ($albumImage){
					saveNewImage("albumimage",$_FILES['pv_uploadimage']['tmp_name'],e_PLUGIN."pviewgallery/gallery/album".$_GET['album']."/".$albumImage);
					$sqlOK = $sqlOK & $PView -> pviewUpdateDb("album","albumImage",$albumImage,"",$_GET['album']);
				}			
				// move Album
				$newAlbumGal = explode(",",$_POST['pv_albumSelect']);
				$galAlbums = $PView -> getGalleryAlbums($albumData['galleryId']);
				// set gallerId for all sub-albums
				foreach ($galAlbums as $dataset) {
					$isParent = $PView -> getParentAlbum($dataset['albumId']);
					$isChildren = 0;
					while ($isParent) {
						if ($isParent == $_GET['album']) {
							$sqlOK = $sqlOK & $PView -> pviewUpdateDb("album","galleryId",$newAlbumGal[0],"",$dataset['albumId']);
							$isParent = 0; // escape
						} else  {
							$isParent = $PView -> getParentAlbum($isParent); // recursive find parents
						}
					}
				}
				$sqlOK = $sqlOK & $PView -> pviewUpdateDb("album","parentAlbumId",$newAlbumGal[1],"",$_GET['album']);
				$sqlOK = $sqlOK & $PView -> pviewUpdateDb("album","galleryId",$newAlbumGal[0],"",$_GET['album']);
				
				// clear cache for related gallery (after change)
				$e107cache -> clear("pview_gal_".$albumdata['galleryId']);
				// clear cache for parent album (after change)
				$e107cache -> clear("pview_album_".$PView -> getParentAlbum($_GET['album']));	
				
				// feedback and continuation links
				$out_HTML = $PView -> getAdminMsg($sqlOK);
				$out_HTML.= getContLinks("editalbum",$albumData['galleryId']);
				
				$ns->tablerender(LAN_ADMIN_55, $out_HTML);
			}
			$out_HTML = getForm_album(LAN_ALBUM_7,"editalbum",$PView -> getAlbumData($_GET['album']));
		
		} else {
			$out_HTML = "<div style='padding:10px'>".LAN_IMAGE_36."<br /><br /><a href='pviewgallery.php?album=".$_GET['album']."'>".LAN_IMAGE_37."</a></div>";
		}
	}
	// New Sub-Album
	if ($_GET['album'] && $_GET['action'] == "newalbum" && !$Action_OK) {
		$Action_OK = 1;
		if ($PView -> getPermission("album",$_GET['album'],"CreateAlbum")) {
			if ($_POST['pv_action'] == "newsubalbum") {
			// save values
			$albumName = $tp -> toDB($_POST['pv_name']);
			$albumDesc = $tp -> toDB($_POST['pv_description']);
			$tmp_galId = $PView -> getAlbumData($_GET['album']);
			$galId = $tmp_galId['galleryId'];
			$parentAlbum = $_GET['album'];
			// upload albumimage
			if ($_FILES['pv_uploadimage']['tmp_name']) {
				$albumImage = albumImage();
				if (!$albumImage) {
					$out_HTML.= getFeedback(LAN_ACTION_5);
				}
			} else {
				$albumImage = "";
			}
			
			$arg = "0,".$galId.",".$parentAlbum.",'".$albumName."','".$albumDesc."','".$albumImage."','".$PView -> getpermClasses("pv_permUpload")."','".$PView -> getpermClasses("pv_permEdit")."','".$PView -> getpermClasses("pv_permView")."','".$PView -> getpermClasses("pv_permCreateAlbum")."'";
			$sqlOK = $sql -> db_insert("pview_album","$arg");
			// feedback and links for continuation
			if ($sqlOK === FALSE) {
					$out_HTML.= getFeedback(LAN_ADMIN_57);
				} else {
					mkdir(e_PLUGIN."pviewgallery/gallery/album".$sqlOK);
					// set chmod option, if specified
					if ($chmod = $PView->getPView_config("chmod")){
						$oldMask = umask(0777);
						chmod(e_PLUGIN."pviewgallery/gallery/album".$sqlOK,octdec($chmod));
						umask($oldMask);
					}
					if ($albumImage){
						saveNewImage("albumimage",$_FILES['pv_uploadimage']['tmp_name'],e_PLUGIN."pviewgallery/gallery/album".$sqlOK."/".$albumImage);	
					}
					$out_HTML.= getFeedback(LAN_ACTION_6);
					$out_HTML.= getContLinks("newsubalbum");
					
					// clear cache for adv. startpage
					$e107cache -> clear("pview_stat");
					// clear cache for parent album 
					$e107cache -> clear("pview_album_".$_GET['album']);
					// clear cache for menu
					$e107cache -> clear("nq_pview_menu");
					
				}
				$ns -> tablerender($PView -> getPView_config("pview_name"), $out_HTML);
				require_once(FOOTERF);
				exit;
			}
			$out_HTML = getForm_album(LAN_ALBUM_6,"newsubalbum");
		
		} else {
			$out_HTML = $PView -> getNoPerm(); //forbidden action
		}
	}
	// New Root-Album
	if (isset($_GET['gallery']) && $_GET['action'] == "newalbum" && !$Action_OK) {
		$Action_OK = 1;
		if ($PView -> getPermission("gallery",$_GET['gallery'],"CreateAlbum")) {
			if ($_POST['pv_action'] == "newrootalbum") {
			// save values
			$albumName = $tp -> toDB($_POST['pv_name']);
			$albumDesc = $tp -> toDB($_POST['pv_description']);
			$galId = $_GET['gallery'];
			// upload albumimage
			if ($_FILES['pv_uploadimage']['tmp_name']) {
				$albumImage = albumImage();
				if (!$albumImage) {
					$out_HTML.= getFeedback(LAN_ACTION_5);
				}
			} else {
				$albumImage = "";
			}
			
			$arg = "0,".$galId.",0,'".$albumName."','".$albumDesc."','".$albumImage."','".$PView -> getpermClasses("pv_permUpload")."','".$PView -> getpermClasses("pv_permEdit")."','".$PView -> getpermClasses("pv_permView")."','".$PView -> getpermClasses("pv_permCreateAlbum")."'";
			$sqlOK = $sql -> db_insert("pview_album","$arg");
			// feedback and links for continuation
			if ($sqlOK === FALSE) {
					$out_HTML.= getFeedback(LAN_ADMIN_57);
				} else {
					mkdir(e_PLUGIN."pviewgallery/gallery/album".$sqlOK);
					// set chmod option, if specified
					if ($chmod = $PView->getPView_config("chmod")){
						$oldMask = umask(0777);
						chmod(e_PLUGIN."pviewgallery/gallery/album".$sqlOK,octdec($chmod));
						umask($oldMask);
					}
					if ($albumImage){
						saveNewImage("albumimage",$_FILES['pv_uploadimage']['tmp_name'],e_PLUGIN."pviewgallery/gallery/album".$sqlOK."/".$albumImage);	
					}
					$out_HTML.= getFeedback(LAN_ACTION_6);
					$out_HTML.= getContLinks("newrootalbum");
					
					// clear cache for adv. startpage
					$e107cache -> clear("pview_stat");
					// clear cache for related gallery 
					$e107cache -> clear("pview_gal_".$_GET['gallery']);
					// clear cache for menu
					$e107cache -> clear("nq_pview_menu");	
					
				}
				$ns -> tablerender($PView -> getPView_config("pview_name"), $out_HTML);
				require_once(FOOTERF);
				exit;
			}	
			$out_HTML = getForm_album(LAN_ALBUM_6,"newrootalbum");
		
		} else {
			$out_HTML = $PView -> getNoPerm(); //forbidden action
		}
	}
	// New User-Gallery
	if ($_GET['gallery'] == "0" && $_GET['action'] == "newgallery" && !$Action_OK) {
		$Action_OK = 1;
		if ($PView -> getPermission("config","permCreateGallery","")) {
			if (!$PView -> getGalleryName(USERID)) {
				if ($_POST['pv_action'] == "newgallery") {
				// save values
				if ($_POST['pv_active'] == "on") {
					$galActive = "1";
				} else {
					$galActive = "0";
				}
				$galName = $tp -> toDB($_POST['pv_name']);
				$arg = USERID.",'".$galName."',".$galActive.",'".$PView -> getpermClasses("pv_permEdit")."','".$PView -> getpermClasses("pv_permView")."','".$PView -> getpermClasses("pv_permCreateAlbum")."'";
				$sqlOK = $sql -> db_insert("pview_gallery","$arg");
				
				// clear cache for adv. startpage
				$e107cache -> clear("pview_stat");
				// clear cache for maingallery (id=0)
				$e107cache -> clear("pview_gal_0");
				// clear cache for menu
				$e107cache -> clear("nq_pview_menu");
				
				// feedback and links for continuation
				if ($sqlOK === FALSE) {
					$out_HTML.= getFeedback(LAN_ADMIN_57);
				} else {
					$out_HTML.= getFeedback(LAN_ACTION_12);
					$out_HTML.= getContLinks("newgallery");
				}
				$ns -> tablerender($PView -> getPView_config("pview_name"), $out_HTML);
				require_once(FOOTERF);
				exit;
				}			
				$out_HTML = getForm_gallery(LAN_GALLERY_1,"newgallery");
				
			} else {
				// usergallery already exist
				$out_HTML = "<div style='padding:10px'>".LAN_ACTION_1."<br /><br /><a href='pviewgallery.php?gallery=0'>".LAN_IMAGE_37."</a> ".LAN_ACTION_3." <a href='pviewgallery.php?gallery=".USERID."'>".LAN_ACTION_2."</a></div>";
			}
		} else {
			$out_HTML = $PView -> getNoPerm(); //forbidden action
		}
	}
	// Delete/Edit Gallery
	if (isset($_GET['gallery']) && $_GET['action'] == "edit" && !$Action_OK && $PView -> getExist("gallery",$_GET['gallery'])) {
		$Action_OK = 1;
		if ($PView -> getPermission("gallery",$_GET['gallery'],"Edit")) {
			// delete gallery
			if (isset($_GET['delete'])){
				if (!$_GET['confirm']) {
					if (intval($PView -> getGalleryAlbumCount($_GET['gallery'],1))) {
						$out_HTML = getFeedback(LAN_ACTION_34);
						$delAtt = 1;
					}
					
					if ($delAtt && !ADMIN) {
						// escape if gallery is not empty
						$out_HTML.= getFeedback(LAN_ACTION_38);
						$out_HTML.= $PView -> getNoPerm();
						$ns->tablerender(LAN_ACTION_33,$out_HTML);
					} else {
						$ns->tablerender(LAN_ACTION_33,$out_HTML.$PView -> getDelConfirm(LAN_ACTION_39.$_GET['gallery']));
					}
					require_once(FOOTERF);
					exit;
				} else {
					// and now delete it
					if (!$_GET['gallery']) {
						$out_HTML.= getFeedback(LAN_ACTION_40);
					} else {
						$delOK = $PView -> deleteGallery($_GET['gallery']);
						$out_HTML.= $PView -> getAdminMsg($delOK);
					}
					$out_HTML.= getContLinks("deletegallery");
					$ns->tablerender(LAN_ADMIN_55, $out_HTML);
					if ($delOK) {
						require_once(FOOTERF);
						exit;
					}
				}
			}
					
			
			// edit gallery, save data
			if ($_POST['pv_action'] == "editgallery") {
				// clear cache for main gallery (id=0)
				$e107cache -> clear("pview_gal_0");
				// clear cache for adv. startpage
				$e107cache -> clear("pview_stat");
				
				$sqlOK = $PView -> pviewUpdateDb("gallery","name",$_POST['pv_name'],"text",$_GET['gallery']);
				$sqlOK = $sqlOK & $PView -> pviewUpdateDb("gallery","permView",$PView -> getpermClasses("pv_permView"),"",$_GET['gallery']);
				$sqlOK = $sqlOK & $PView -> pviewUpdateDb("gallery","active",$_POST['pv_active'],"checkbox",$_GET['gallery']);
				if (ADMIN) {
					$sqlOK = $sqlOK & $PView -> pviewUpdateDb("gallery","permEdit",$PView -> getpermClasses("pv_permEdit"),"",$_GET['gallery']);
					$sqlOK = $sqlOK & $PView -> pviewUpdateDb("gallery","permCreateAlbum",$PView -> getpermClasses("pv_permCreateAlbum"),"",$_GET['gallery']);
				}
				
				// feedback and links for continuation
				$out_HTML = $PView -> getAdminMsg($sqlOK);
				$out_HTML.= getContLinks("editgallery");
				
				$ns->tablerender(LAN_ADMIN_55, $out_HTML);
				
			}
			// -------------------------------------------------------------
			$out_HTML = getForm_gallery(LAN_GALLERY_6,"editgallery",$PView -> getGalleryData($_GET['gallery']));
		
		} else {
			$out_HTML = $PView -> getNoPerm(); //forbidden action
		}
	}
	
	// Render action
	if (!$Action_OK) {
		header("location:" . e_PLUGIN . "pviewgallery/pviewgallery.php");
	} else {
		$ns -> tablerender($PView -> getPView_config("pview_name"), $out_HTML);
		require_once(FOOTERF);
	}
}

// functions....

function getForm_gallery($header,$appl,$content){
// returns form for new/edit gallery
// $header: box-header
// $appl: what to do
// $content: array with values for edit
	$PView = new PView;
	global $tp;
	if (!is_array($content)){
		$content = array();
		$content['permView'] = "ALL";
		$content['active'] = "1";
	}
	if ($content['active'] == "1") {
		$content['active'] = "checked='checked'";
	}
	if ($_GET['gallery'] OR $appl == "newgallery") {
		$galleryType = LAN_ADMIN_28;
	} else {
		$galleryType = LAN_ADMIN_14;
	}
	$permText_View = LAN_GALLERY_10;
	$permText_Edit = LAN_GALLERY_6;
	$permText_CreateAlbum = LAN_ALBUM_17;
	
	$out_Form.= "<script type=\"text/javascript\">
				function frmVerify() {
					if(document.getElementById('pv_name').value == \"\") {
						alert('".LAN_ACTION_4."');
						return false;
					}
				}
				</script>";
	$out_Form.= "<form enctype='multipart/form-data' action=' ".e_SELF."?".e_QUERY."' method='post' onsubmit='return frmVerify()'><br /><table class='fborder' style='width:90%;'>";
	$out_Form.= "<tr><td colspan='2' class='forumheader' style='text-align:center;'>".$header."</td></tr>";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_IMAGE_9."*:</td><td class='forumheader3'><input class='tbox' id='pv_name' name='pv_name' type='text' size='40' maxlength='60' value='".$tp -> toForm($content['name'])."' /></td></tr>";	
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_29.$permText_View.":</td><td class='forumheader3'>";
	$out_Form.= getCheckBoxes("permView",$content['permView']);
	$out_Form.= "</td></tr>";
	if (ADMIN){
		// set permEdit
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_29.$permText_Edit."</td><td class='forumheader3'>";
		$out_Form.= getCheckBoxes("permEdit",$content['permEdit']);
		$out_Form.= "</td></tr>";
		// set permCreateAlbum
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_29.$permText_CreateAlbum."</td><td class='forumheader3'>";
		$out_Form.= getCheckBoxes("permCreateAlbum",$content['permCreateAlbum']);
		$out_Form.= "</td></tr>";
	}
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".$galleryType.":</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_active' name='pv_active' value='on' ".$content['active']." /></td></tr>";
	if ($appl == "editgallery" && $_GET['gallery']) {
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>&nbsp;</td><td class='forumheader3'><a href='".e_SELF."?".e_QUERY."&delete=".$_GET['gallery']."'><span class='button' style='padding-left:4px; padding-right:4px;'>".LAN_ACTION_33."</span></a></td></tr>";	
	}	
	$out_Form.= "<tr><td colspan='2' class='forumheader3' style='width:30%; vertical-align:top;'>* <span class='smalltext'>".LAN_ACTION_17."</span></td></tr>";
	$out_Form.= "</table><br />";
	$out_Form.= "<input type='hidden'id='pv_action' name='pv_action' value='".$appl."' />";
	$out_Form.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;<input class='button' id='pv_cancelbtn' name='pv_cancelbtn' type='reset' value='".LAN_IMAGE_27."' onclick='location.href=\"".e_PLUGIN."pviewgallery/pviewgallery.php?gallery=".$_GET['gallery']."\"')></div>";
	$out_Form.= "</form>";
	return $out_Form;	
}

function getForm_album($header,$appl,$content){
// returns form for new/edit album
// $header: box-header
// $appl: what to do
// $content: array with values for edit
	global $tp;
	$PView = new PView;
	
	if (!is_array($content)){
		$content = array();
		$content['permView'] = "ALL";
	}
	
	$permText_View = LAN_ALBUM_15;
	$permText_Edit = LAN_ALBUM_7;
	$permText_CreateAlbum = LAN_ALBUM_17;
	$permText_Upload = LAN_ALBUM_8;
	
	$out_Form.= "<script type=\"text/javascript\">
				function frmVerify() {
					if(document.getElementById('pv_name').value == \"\") {
						alert('".LAN_ACTION_4."');
						return false;
					}
				}
				</script>";
	$out_Form.= "<form enctype='multipart/form-data' action=' ".e_SELF."?".e_QUERY."' method='post' onsubmit='return frmVerify()'><br /><table class='fborder' style='width:90%;'>";
	$out_Form.= "<tr><td colspan='2' class='forumheader' style='text-align:center;'>".$header."</td></tr>";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_IMAGE_9."*:</td><td class='forumheader3'><input class='tbox' id='pv_name' name='pv_name' type='text' size='40' maxlength='60' value='".$tp -> toForm($content['name'])."' /></td></tr>";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_IMAGE_10.":</td><td class='forumheader3'><textarea class='tbox' id='pv_desription' name='pv_description'cols='60' rows='5'>".$tp -> toForm($content['description'])."</textarea></td></tr>";
	if ($appl == "editalbum") {
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ALBUM_14.":</td><td class='forumheader3'><img src='".$PView -> getAlbumImage($_GET['album'])."'></td></tr>";
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ALBUM_18.":</td><td class='forumheader3'><input class='tbox' id='pv_uploadimage' name='pv_uploadimage' type='file' size='40' maxlength='255'/>";
	} else {
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ALBUM_14.":</td><td class='forumheader3'><input class='tbox' id='pv_uploadimage' name='pv_uploadimage' type='file' size='40' maxlength='255'/>";
	}
	$out_Form.= "<br />".LAN_ALBUM_16.": jpg (jpeg), gif, png</td></tr>";
	if ($appl == "editalbum") {
		// SelectBox
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ACTION_30.":</td><td class='forumheader3'>".getSelectBox()."</td></tr>";
	} else {
		$out_Form.= "<input type='hidden'id='pv_parentalbum' name='pv_parentalbum' value='".$_GET['album']."' />";
		$out_Form.= "<input type='hidden'id='pv_gallery' name='pv_gallery' value='".$_GET['gallery']."' />";
	}
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_29.$permText_View.":</td><td class='forumheader3'>";
	$out_Form.= getCheckBoxes("permView",$content['permView']);
	$out_Form.= "</td></tr>";
	// Admin has more config values
	if (ADMIN){
		// set permEdit
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_29.$permText_Edit."</td><td class='forumheader3'>";
		$out_Form.= getCheckBoxes("permEdit",$content['permEdit']);
		$out_Form.= "</td></tr>";
		// set permCreateAlbum
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_29.$permText_CreateAlbum."</td><td class='forumheader3'>";
		$out_Form.= getCheckBoxes("permCreateAlbum",$content['permCreateAlbum']);
		$out_Form.= "</td></tr>";
		// set permUpload
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_29.$permText_Upload."</td><td class='forumheader3'>";
		$out_Form.= getCheckBoxes("permUpload",$content['permUpload']);
		$out_Form.= "</td></tr>";
	}
	if ($appl == "editalbum") {
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>&nbsp;</td><td class='forumheader3'><a href='".e_SELF."?".e_QUERY."&delete=".$_GET['album']."'><span class='button' style='padding-left:4px; padding-right:4px;'>".LAN_ADMIN_53." ".LAN_ADMIN_50."</span></a></td></tr>";
		
	}
	$out_Form.= "<tr><td colspan='2' class='forumheader3' style='width:30%; vertical-align:top;'>* <span class='smalltext'>".LAN_ACTION_17."</span></td></tr>";
	$out_Form.= "</table><br />";
	$out_Form.= "<input type='hidden'id='pv_action' name='pv_action' value='".$appl."' />";
	$out_Form.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;<input class='button' id='pv_cancelbtn' name='pv_cancelbtn' type='reset' value='".LAN_IMAGE_27."' onclick='location.href=\"".e_PLUGIN."pviewgallery/pviewgallery.php?album=".$_GET['album']."\"')></div>";
	$out_Form.= "</form>";
	return $out_Form;
}

function getForm_upload() {
// returns form for image upload
	global $allUserclasses;
	global $sql;
	global $catArray;
	$PView = new PView;

	if (checkGalleryLimit()) {
		$out_Form.= getFeedback();
		$out_Form.= getContLinks("cancelupload");
		return $out_Form;
	}
	// prepare fileselector
	$fileSelector_normal = "<input class=\"tbox\" id=\"pv_uploadimage\" name=\"pv_uploadimage\" type=\"file\" size=\"40\" maxlength=\"255\"/><br />".LAN_ALBUM_16.": jpg (jpeg), gif, png<br />".LAN_ADMIN_59.": ".$PView -> getPView_config("file_limit")."kB";
	$fileSelector_external = "<input class=\"tbox\" id=\"pv_uploadimage\" name=\"pv_uploadimage\" type=\"text\" size=\"40\" maxlength=\"255\" value=\"http://\"/><br />".LAN_ALBUM_16.": jpg (jpeg), gif, png <input type=\"hidden\" id=\"pv_externalImage\" name=\"pv_externalImage\" value=\"external\">";
	
	$out_Form.= "<script type=\"text/javascript\">
				function frmVerify() {
					if(document.getElementById('pv_name').value == \"\") {
						alert('".LAN_ACTION_4."');
						return false;
					}
					if(document.getElementById('pv_uploadimage').value == \"\") {
						alert('".LAN_ACTION_15."');
						return false;
					}
					document.getElementById('wait_upload').style.display = 'block';
				}
				function frmSwitcher() {
					if (document.getElementById('pv_switcher').checked == true) {
						document.getElementById('pv_ImageSelect').innerHTML = '".$fileSelector_external."';
					} else {
						document.getElementById('pv_ImageSelect').innerHTML = '".$fileSelector_normal."';
					}
				}
				</script>";
	$out_Form.= "<div name='wait_upload' id='wait_upload' class='tbox' style='display:none; position:absolute; top:150px; left:200px; width:500px; height:200px;'>";
	$out_Form.= "<p style='padding:35px; text-align:center;'>".LAN_ACTION_37."</p>";
	$out_Form.= "<p style='padding:15px; text-align:center;'><img src='images/wait_upload_5.gif'></p>";
	$out_Form.= "</div>";
	$out_Form.= "<form enctype='multipart/form-data' action=' ".e_SELF."?".e_QUERY."' method='post' onsubmit='return frmVerify()'><br /><table class='fborder' style='width:90%;'>";
	$out_Form.= "<tr><td colspan='2' class='forumheader' style='text-align:center;'>".LAN_ACTION_14."</td></tr>";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_IMAGE_9."*:</td><td class='forumheader3'><input class='tbox' id='pv_name' name='pv_name' type='text' size='40' maxlength='60'/></td></tr>";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_IMAGE_10.":</td><td class='forumheader3'><textarea class='tbox' id='pv_description' name='pv_description'cols='60' rows='5'></textarea></td></tr>";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_IMAGE_45."</td><td class='forumheader3'><select class='tbox' id='pv_cat' name='pv_cat' onchange='document.getElementById(\"pv_submitbtn\").focus()'>";
	$out_Form.= "<option>".LAN_IMAGE_46."</option>";
	foreach ($catArray as $key => $dataset) {
		$out_Form.= "<option>".$dataset."</option>";
	}
	$out_Form.= "</select></td></tr>";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ACTION_13."*:<br /></td><td class='forumheader3'><div id='pv_ImageSelect'><input class='tbox' id='pv_uploadimage' name='pv_uploadimage' type='file' size='40' maxlength='255'/>";
	$out_Form.= "<br />".LAN_ALBUM_16.": jpg (jpeg), gif, png<br />".LAN_ADMIN_59.": ".$PView -> getPView_config("file_limit")."kB</div>";
	if ($PView -> getPermission("config","permExtern","")){
		$out_Form.= "<input class='tbox' id='pv_switcher' name='pv_switcher' type='checkbox' value='on' onclick='javascript:frmSwitcher()'> ".LAN_ACTION_47;
	}
	$out_Form.= "</td></tr>";
	$out_Form.= "<input type='hidden'id='pv_albumId' name='pv_albumId' value='".$_GET['album']."' />";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_29.LAN_ACTION_16.":</td><td class='forumheader3'>";
	$out_Form.= getCheckBoxes("permView","ALL");
	$out_Form.= "</td></tr>";
	if (ADMIN){
		// set permEdit
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_29.LAN_IMAGE_2."</td><td class='forumheader3'>";
		$out_Form.= getCheckBoxes("permEdit","");
		$out_Form.= "</td></tr>";
	}
	if (ADMIN){
		// activate sendImage
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_112.":</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_sendImage' name='pv_sendImage' value='on' /></td></tr>";
	}
	$out_Form.= "<tr><td colspan='2' class='forumheader3' style='width:30%; vertical-align:top;'>* <span class='smalltext'>".LAN_ACTION_17."</span></td></tr>";
	$out_Form.= "</table><br />";
	$out_Form.= "<input type='hidden'id='pv_action' name='pv_action' value='uploadimage' />";
	$out_Form.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;<input class='button' id='pv_cancelbtn' name='pv_cancelbtn' type='reset' value='".LAN_IMAGE_27."' onclick='location.href=\"".e_PLUGIN."pviewgallery/pviewgallery.php?album=".$_GET['album']."\"')></div>";
	$out_Form.= "</form>";
	$out_Form.= "<script type=\"text/javascript\">document.getElementById('pv_submitbtn').focus();</script>";
	return $out_Form;
}
function getForm_image($content) {
// returns form for edit image / batchupload
// $content: array with values for edit	/ batch
	global $catArray;
	global $tp;
	$PView = new PView;
	if ($content['sendImage'] == "1") {
		$content['sendImage'] = "checked='checked'";
	}
	
	$out_Form.= "<script type=\"text/javascript\">
				function frmVerify() {
					if(document.getElementById('pv_name').value == \"\") {
						alert('".LAN_ACTION_4."');
						return false;
					}
				}
				</script>";
	$out_Form.= "<form enctype='multipart/form-data' action=' ".e_SELF."?".e_QUERY."' method='post' onsubmit='return frmVerify()'><br /><table class='fborder' style='width:90%;'>";
	
	if ($content['batch']){
		$out_Form.= "<tr><td colspan='2' class='forumheader' style='text-align:center;'>".LAN_ACTION_14."</td></tr>";
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_90.":</td><td class='forumheader3' style='width:30%; vertical-align:top;'><img src='batch_upload/tmp_batch.jpg'></td></tr>";
	} else {
		$out_Form.= "<tr><td colspan='2' class='forumheader' style='text-align:center;'>".LAN_IMAGE_2."</td></tr>";
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_90.":</td><td class='forumheader3' style='width:30%; vertical-align:top;'><img src='".$PView -> getThumbPath($_GET['image'])."'></td></tr>";
	}
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_IMAGE_9."*:</td><td class='forumheader3'><input class='tbox' id='pv_name' name='pv_name' type='text' size='40' maxlength='60' value='".$tp -> toForm($content['name'])."'/></td></tr>";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_IMAGE_10.":</td><td class='forumheader3'><textarea class='tbox' id='pv_description' name='pv_description'cols='60' rows='5'>".$tp -> toForm($content['description'])."</textarea></td></tr>";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_IMAGE_45."</td><td class='forumheader3'><select class='tbox' id='pv_cat' name='pv_cat' onchange='document.getElementById(\"pv_submitbtn\").focus()'>";
	$out_Form.= "<option>".LAN_IMAGE_46."</option>";
	foreach ($catArray as $key => $dataset) {
		if ($key == $content['cat']) {
			$selText = "selected";
		} else {
			$selText = "";
		}
		$out_Form.= "<option ".$selText.">".$dataset."</option>";
	}
	$out_Form.= "</select></td></tr>";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_53.":</td><td class='forumheader3' style='width:30%; vertical-align:top;'>".getSelectBox()."</td></tr>";
	$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_29.LAN_ACTION_16.":</td><td class='forumheader3'>";
	$out_Form.= getCheckBoxes("permView",$content['permView']);
	$out_Form.= "</td></tr>";
	if (ADMIN){
		// set permEdit
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_29.LAN_IMAGE_2."</td><td class='forumheader3'>";
		$out_Form.= getCheckBoxes("permEdit",$content['permEdit']);
		$out_Form.= "</td></tr>";
		// set sendImage
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>".LAN_ADMIN_112.":</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_sendImage' name='pv_sendImage' value='on' ".$content['sendImage']." /></td></tr>";
	
	}
	if (!$content['batch']){
		$out_Form.= "<tr><td class='forumheader3' style='width:30%; vertical-align:top;'>&nbsp;</td><td class='forumheader3' style='width:30%; vertical-align:top;'><a href='".e_SELF."?".e_QUERY."&delete=".$_GET['image']."'><span class='button' style='padding-left:4px; padding-right:4px;'>".LAN_ADMIN_90." ".LAN_ADMIN_50."</span></a></td></tr>";
	}
	$out_Form.= "<tr><td colspan='2' class='forumheader3' style='width:30%; vertical-align:top;'>* <span class='smalltext'>".LAN_ACTION_17."</span></td></tr>";
	$out_Form.= "</table><br />";
	if (!$content['batch']){
		$out_Form.= "<input type='hidden'id='pv_action' name='pv_action' value='editimage' />";
	} else {
		$out_Form.= "<input type='hidden'id='pv_action' name='pv_action' value='batchupload' />";
		$out_Form.= "<input type='hidden'id='pv_batch_image' name='pv_batch_image' value='".htmlentities($content['batch_image'])."' />";
	}
	$out_Form.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;<input class='button' id='pv_cancelbtn' name='pv_cancelbtn' type='reset' value='".LAN_IMAGE_27."' onclick='location.href=\"".e_PLUGIN."pviewgallery/pviewgallery.php?image=".$_GET['image']."\"')></div>";
	$out_Form.= "</form>";	
	$out_Form.= "<script type=\"text/javascript\">document.getElementById('pv_submitbtn').focus();</script>";
	return $out_Form;
	
}
function getFeedback($msg) {
// returns a feedback for changes
	return "<div style='padding:10px'>".$msg."</div>";
}
function getContLinks($appl,$option) {
// returns links for corresponding actions
	global $sqlOK;
	$PView = new PView;
	switch ($appl) {
		case "newgallery":
		$out_Link.= "<a href='pviewgallery.php'>".LAN_ACTION_11."...</a><br />";
		$out_Link.= "<a href='pviewgallery.php?gallery=".USERID."'>".LAN_ACTION_2."...</a><br />";
		$out_Link.= "<a href='pview_actions.php?gallery=".USERID."&action=newalbum'>".LAN_ACTION_9."...</a> ";
		break;
		case "newrootalbum":
		$out_Link.= "<a href='pviewgallery.php?gallery=".$_GET['gallery']."'>".LAN_ACTION_8."...</a><br />";
		$out_Link.= "<a href='pviewgallery.php?album=".$sqlOK."'>".LAN_ACTION_7."...</a> ";
		break;
		case "newsubalbum":
		$out_Link.= "<a href='pviewgallery.php?album=".$_GET['album']."'>".LAN_ACTION_10."...</a><br />";
		$out_Link.= "<a href='pviewgallery.php?album=".$sqlOK."'>".LAN_ACTION_7."...</a> ";
		break;
		case "uploadimage":
		$out_Link.= "<a href='pview_actions.php?album=".$_GET['album']."&action=upload'>".LAN_ACTION_25."...</a><br />";
		$out_Link.= "<a href='pviewgallery.php?album=".$_GET['album']."'>".LAN_ACTION_24."...</a><br />";
		break;
		case "cancelupload":
		$out_Link.= "<a href='pviewgallery.php?album=".$_GET['album']."'>".LAN_ACTION_24."...</a><br />";
		break;
		case "editgallery":
		$out_Link.= "<a href='pviewgallery.php'>".LAN_ACTION_11."...</a><br />";
		$out_Link.= "<a href='pviewgallery.php?gallery=".$_GET['gallery']."'>".LAN_ACTION_8."...</a><br />";
		break;
		case "editimage":
		$out_Link.= "<a href='pviewgallery.php?image=".$_GET['image']."'>".LAN_ACTION_28."...</a><br />";
		$out_Link.= "<a href='pviewgallery.php?album=".$PView -> getImageAlbum($_GET['image'])."'>".LAN_ACTION_7."...</a><br />";
		break;
		case "deleteimage":
		$out_Link.= "<a href='pviewgallery.php?album=".$option."'>".LAN_ACTION_24."...</a><br />";
		break;
		case "editalbum":
		$out_Link.= "<a href='pviewgallery.php?album=".$_GET['album']."'>".LAN_ACTION_24."...</a><br />";
		$out_Link.= "<a href='pviewgallery.php?gallery=".$option."'>".LAN_ACTION_8."...</a><br />";
		break;
		case "changeimage":
		$out_Link.= "<a href='pviewgallery.php?album=".$_GET['album']."'>".LAN_ACTION_7."...</a><br />";
		$out_Link.= "<a href='pviewgallery.php?gallery=".$option."'>".LAN_ACTION_2."...</a><br />";
		$out_Link.= "<a href='pviewgallery.php?image=".$_GET['changeimage']."'>".LAN_ACTION_28."...</a><br />";
		break;
		case "deletealbum":
		$out_Link.= "<a href='pviewgallery.php?album=".$option."'>".LAN_ACTION_10."...</a><br />";
		break;
		case "deletegallery":
		$out_Link.= "<a href='pviewgallery.php'>".LAN_ACTION_11."...</a><br />";
		break;
		case "cancelbatch":
		$out_Link.= "<a href='pviewgallery.php'>".LAN_ACTION_11."...</a><br />";
		break;
	}
	return "<div style='padding:10px'>".$out_Link."</div>";
}
function albumImage() {
// returns filename or FALSE
	$ImageData = getimagesize($_FILES['pv_uploadimage']['tmp_name']);
	if ($ImageData[2] <> "1" && $ImageData[2] <> "2" && $ImageData[2] <> "3") {
		return FALSE;
	}

	return "albumimage_".ereg_replace("[^a-z0-9._]","",str_replace(" ","_",str_replace("%20","_",strtolower($_FILES['pv_uploadimage']['name']))));
}
function uploadImage($uploadFile, $mode) {
// returns FALSE or errortext or Error
// mode: normal, batch, external
	$PView = new PView;
	global $sql;
	global $tp;
	global $catArray;
	global $e107cache;
	$ImageData = getimagesize($uploadFile);
	if ($mode == "batch" OR $mode == "external") {
		$uploadFileName = basename($uploadFile);
	}else {
		$uploadFileName = $_FILES['pv_uploadimage']['name'];
	}
	
	if ($ImageData[2] <> "1" && $ImageData[2] <> "2" && $ImageData[2] <> "3") {
		return LAN_ACTION_18;
	}
	if (!isset($_POST['pv_externalImage'])){
		if (filesize($uploadFile)/1024 > $PView -> getPView_config("file_limit")) {
			return LAN_ACTION_19;
		}		
	}
	if (checkGalleryLimit()) {
		return LAN_ACTION_27;
	}
	if (isset($_POST['pv_albumId'])) {
		// Edit
		$uploadAlbum = $_POST['pv_albumId'];
		$uploaddir = e_PLUGIN."pviewgallery/gallery/album".$_POST['pv_albumId']."/";
	}
	if (isset($_POST['pv_albumSelect'])) {
		// batch upload
		$albumSelect = explode(",",$_POST['pv_albumSelect']);
		$uploadAlbum = $albumSelect[1];
		$uploaddir = e_PLUGIN."pviewgallery/gallery/album".$albumSelect[1]."/";
	}
	
	// do not copy original image during external upload
	if (!isset($_POST['pv_externalImage'])){
		if ($PView -> getPView_config("keep_original_image")) {
			$new_file = checkFileName($uploadAlbum,$uploadFileName);
			if ($mode == "batch"){
				if (!copy($uploadFile,$uploaddir.$new_file)){
					return LAN_ACTION_20;
				}
			}else {
				if (!move_uploaded_file($uploadFile, $uploaddir . $new_file)) {
					return LAN_ACTION_20;
				}
			}
		}
	}
	
	if ($PView -> getPView_config("resize_images")) {
		$new_resize = checkFileName($uploadAlbum,"resize_".$uploadFileName);
		if ($new_file) {
			saveNewImage("resize",$uploaddir.$new_file,$uploaddir.$new_resize);
		} else {
			saveNewImage("resize",$uploadFile,$uploaddir.$new_resize);
		}
		if (!file_exists($uploaddir.$new_resize))
		return LAN_ACTION_21;		
	}
	if ($PView -> getPView_config("create_thumb")) {
		$new_thumb = checkFileName($uploadAlbum,"thumb_".$uploadFileName);
		if ($new_file) {
			saveNewImage("thumb",$uploaddir.$new_file,$uploaddir.$new_thumb);
		} else {
			saveNewImage("thumb",$uploadFile,$uploaddir.$new_thumb);
		}
		if (!file_exists($uploaddir.$new_thumb))
		return LAN_ACTION_22;		
	}
	// SQL
	if (!$PView -> getPView_config("approval") OR ADMIN) {
		$approved = 1;
	} else {
		$approved = 0;
	}
	if (!intval(USERID)) {
		$userid = "";
	} else {
		$userid = USERID;
	}
	if (!$catId = array_search($_POST['pv_cat'],$catArray)) {
		$catId = 0;
	}
	if ($_POST['pv_sendImage'] == "on"){
		$sendImage = "1";
	} else {
		$sendImage = "0";
	}
	
	if (isset($_POST['pv_externalImage'])){
		$externalImage = "1";
		$new_file = $uploadFile;
	} else {
		$externalImage = "0";
	}
	
	$arg = "0,".$uploadAlbum.",'".$tp -> toDB($_POST['pv_name'])."','".$tp -> toDB($_POST['pv_description'])."','".$new_file."','".$new_resize."','".$new_thumb."','".$userid."',".time().",".$approved.",'".$PView -> getpermClasses("pv_permEdit")."','".$PView -> getpermClasses("pv_permView")."',0,".$catId.",".$sendImage.",".$externalImage;
	$sqlOK = $sql -> db_insert("pview_image","$arg");
	// delete files on error
	if (!$sqlOK) {
		if (file_exists($uploaddir.$new_file)){
			unlink($uploaddir.$new_file);
		}
		if (file_exists($uploaddir.$new_resize)){
			unlink($uploaddir.$new_resize);
		}
		if (file_exists($uploaddir.$new_thumb)){
			unlink($uploaddir.$new_thumb);
		}
		return LAN_ADMIN_57;
	}
    
	// clear cache for adv. startpage
	$e107cache -> clear("pview_stat");
	// clear cache for related album 
	$e107cache -> clear("pview_album_".$uploadAlbum);
	// clear cache for menu
	$e107cache -> clear("nq_pview_menu");
    // clear cache for categorie list
	$e107cache -> clear("pview_cat_list");
    // clear cache for related categorie view
	$e107cache -> clear("pview_cat_".$catId);                    
    // clear cache for user list
	$e107cache -> clear("pview_user_list");
    // clear cache for related user view
	$e107cache -> clear("pview_user_".$userid);    
    
	// delete batch/tmp image on success
	if (file_exists($uploadFile)){
		unlink($uploadFile);
	}
	return FALSE;	
}
function saveNewImage($type,$orig_file,$new_file) {
// no return
	$PView = new PView;
	$ImageData = getimagesize($orig_file);
	$ImageRatio = $ImageData[0] / $ImageData[1];
	
	if ($type == "thumb" OR $type == "albumimage") {
		$new_width = $PView -> getPView_config("thumb_width");
		$new_height = $PView -> getPView_config("thumb_height");
		if (!$new_width && !$new_height) {
			$new_width = 150; //default
			$new_height = 150; //default
		}
	}
	if ($type == "resize") {
		$new_width = $PView -> getPView_config("max_image_width");
		$new_height = $PView -> getPView_config("max_image_height");
		if (!$new_width && !$new_height) {
			$new_width = 400; //default
			$new_height = 400; //default
		}
	}
	if ($new_height && $new_width) {
		if ($new_height * $ImageRatio <= $new_width) {
			$new_width = $new_height * $ImageRatio;
		} else {
			$new_height = $new_width / $ImageRatio;
		}
	} else {
		if (!$new_height) {
			$new_height = $new_width / $ImageRatio;
		}
		if (!$new_width) {
			$new_width = $new_height * $ImageRatio;
		}
	}
	$new_width = round($new_width);
	$new_height = round($new_height);
	// do not increase images
	if ($new_height > $ImageData[1] OR $new_width > $ImageData[0]) {
		$new_height = $ImageData[1];
		$new_width = $ImageData[0];
	}
	
	if ($ImageData[2] == "1") { // gif
		$original = ImageCreateFromGIF($orig_file);
		$resize = ImageCreateTrueColor($new_width, $new_height );
		imagecopyresampled($resize, $original, 0, 0, 0, 0, $new_width , $new_height, $ImageData[0], $ImageData[1]);
		ImageGIF($resize, $new_file);
	}
	if ($ImageData[2] == "2") { // jpg
		$original = ImageCreateFromJPEG($orig_file);
		$resize = ImageCreateTrueColor($new_width, $new_height );
		imagecopyresampled($resize, $original, 0, 0, 0, 0, $new_width , $new_height, $ImageData[0], $ImageData[1]);
		ImageJPEG($resize, $new_file,85);
	}
	if ($ImageData[2] == "3") { // png
		$original = ImageCreateFromPNG($orig_file);
		$resize = ImageCreateTrueColor($new_width, $new_height );
		imagecopyresampled($resize, $original, 0, 0, 0, 0, $new_width , $new_height, $ImageData[0], $ImageData[1]);
		ImagePNG($resize, $new_file);		
	}
}
function checkFileName($albumid,$file) {
// returns new filename
	$counter = 1;
	$file = ereg_replace("[^a-z0-9._]","",str_replace(" ","_",str_replace("%20","_",strtolower($file))));
	$fileinfo = pathinfo($file);
	// prevent NULL filename
	if (".".$fileinfo['extension'] == $file){
		$file = "_.".$fileinfo['extension'];
	}
	$tmp_file = $file;
	while (file_exists(e_PLUGIN."pviewgallery/gallery/album".$albumid."/".$tmp_file)) {
		$tmp_file = basename($file,".".$fileinfo['extension'])."_".strval($counter).".".$fileinfo['extension'];
		$counter++;
	}
	return $tmp_file;
}
function checkGalleryLimit() {
// returns TRUE if Limit is reached
	$PView = new PView;
	global $sql;
	if ($PView -> getPView_config("usergallery_limit") == "") { return FALSE; } // no limit
	if (isset($_GET['album'])){
		$albumdata = $PView -> getAlbumData($_GET['album']);
	}
	if (isset($_POST['pv_albumSelect'])) {
		// batch upload
		$albumSelect = explode(",",$_POST['pv_albumSelect']);
		$uploadAlbum = $albumSelect[1];
		$albumdata = $PView -> getAlbumData($uploadAlbum);
	}
	if (!$albumdata['galleryId']) { return FALSE; } // no usergallery
	$galleryid = $albumdata['galleryId'];
	$sql->db_Select("pview_album", "*", "WHERE galleryId='$galleryid'", "nowhere");
	while ($galAlbum = $sql -> db_Fetch()) {
		$albumSpace = dirSpace(e_PLUGIN."pviewgallery/gallery/album".$galAlbum['albumId']);
		$allSpace = $allSpace + $albumSpace;
		$count++;
	}
	$allSpace = round($allSpace / 1024 /1024,1); // in MByte
	if ($allSpace < intval($PView -> getPView_config("usergallery_limit"))) { return FALSE; } // in limit
	return TRUE;
}
function dirSpace($dir) {
// returns directory space
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
		if ($file != "." and $file != "..") {
			$space = $space + filesize($dir."/".$file);
		}
	}
    closedir($dh);
	return $space;
} 
function getCheckBoxes($permType,$checkOn){
// returns checkboxes for all userclasses + ALL + MEMBERS
	global $allUserclasses;
	$userClassArray = array();
	$userClassArray = explode(",",$checkOn);
	$out_Boxes.= "<input class='tbox' type='checkbox' id='pv_".$permType."[all]' name='pv_".$permType."[all]' value='on' ";
	if ($checkOn == "ALL"){
		$out_Boxes.= "checked='checked' ";
	}
	$out_Boxes.= "/> ".LAN_ADMIN_31."<br />";
	$out_Boxes.= "<input class='tbox' type='checkbox' id='pv_".$permType."[member]' name='pv_".$permType."[member]' value='on' ";
	if ($checkOn == "MEMBER"){
		$out_Boxes.= "checked='checked' ";
	}
	$out_Boxes.= "/> ".LAN_ADMIN_32."<br />";
	foreach ($allUserclasses as $dataset) {
		$out_Boxes.= "<input class='tbox' type='checkbox' id='pv_".$permType."[".$dataset['userclass_id']."] ' name='pv_".$permType."[".$dataset['userclass_id']."]' value='on' ";
		if (in_array($dataset['userclass_id'],$userClassArray)){
			$out_Boxes.= "checked='checked' ";
		}
		$out_Boxes.= "/> ".$dataset['userclass_name']."<br />";		
	}
	return $out_Boxes;
}
function getSelectBox() {
// returns selectbox with all available albums/galleries, actual item is selected
	$PView = new PView;
	$boxArray = array();
	$albumArr = array();
	$allGalleryData = $PView -> getAllGalleryData();
	$albumData = $PView -> getAlbumData($_GET['album']);
	$imageData = $PView -> getImageData($_GET['image']);
	
	$curGallery = $albumData['galleryId'];
	$curParentAlbum = $albumData['parentAlbumId'];
	$curAlbum = $imageData['albumId'];
	$batchAlbum = explode(",",$_POST['pv_albumSelect']);
	
	// collect data
	foreach ($allGalleryData as $datasetGal) {
		// set "direct to gallery"
		if (isset($_GET['album'])) {
			if ($PView -> getPermission("gallery",$datasetGal['galleryId'],"CreateAlbum") OR ($datasetGal['galleryId'] == $curGallery && !$curParentAlbum)) {
				$boxArray[$datasetGal['galleryId']] = "0,";
			}
		}
		// check all albums included in this gallery
		$galleryAlbums = $PView -> getGalleryAlbums($datasetGal['galleryId']);
		foreach ($galleryAlbums as $datasetAlbum) {
			if (isset($_GET['image'])) {
				// list all albums with "upload" permission and current album
				if ($PView -> getPermission("album",$datasetAlbum['albumId'],"Upload") OR $datasetAlbum['albumId'] == $PView -> getImageAlbum($_GET['image'])) {
					$boxArray[$datasetGal['galleryId']] = $boxArray[$datasetGal['galleryId']].$datasetAlbum['albumId'].",";
				}
			}
			// batch mode
			if (!isset($_GET['image']) && !isset($_GET['album'])) {
				// list all albums with "upload" permission and current album
				if ($PView -> getPermission("album",$datasetAlbum['albumId'],"Upload")) {
					$boxArray[$datasetGal['galleryId']] = $boxArray[$datasetGal['galleryId']].$datasetAlbum['albumId'].",";
				}
			}
			
			if (isset($_GET['album'])) {
				// list all albums with "createAlbum" permission and parent album, omit children albums
				if ($PView -> getPermission("album",$datasetAlbum['albumId'],"CreateAlbum") OR $datasetAlbum['albumId'] == $curParentAlbum) {
					// omit children-albums and the selected album
					$isParent = $PView -> getParentAlbum($datasetAlbum['albumId']);
					$isChildren = 0;
					while ($isParent) {
						if ($isParent == $_GET['album']) {
							$isChildren = 1;
							$isParent = 0; // escape
						} else  {
							$isParent = $PView -> getParentAlbum($isParent); // recursive find parents
						}
					}
					if ($datasetAlbum['albumId'] <> $_GET['album'] && !$isChildren) { 
						$boxArray[$datasetGal['galleryId']] = $boxArray[$datasetGal['galleryId']].$datasetAlbum['albumId'].",";
					}					
				}
			}
		}
	}
	// html
	$galTemp = "nothing";
	$out_Select = "<select name='pv_albumSelect' class='tbox'  onchange='document.getElementById(\"pv_submitbtn\").focus()'>";
	foreach ($boxArray as $keyBox => $datasetBox) {
		if (strval($keyBox) <> $galTemp) {
			if ($galTemp <> "nothing") {
				$out_Select.= "</optgroup>";
			}
			$out_Select.= "<optgroup label='".$PView -> getGalleryName($keyBox)."'>";
			$galTemp = $keyBox;
		}
		$albumArr = explode(",",rtrim($datasetBox,","));
		foreach ($albumArr as $dataset) {
			$selText = "";
			if (isset($_GET['album'])) {
				if ($dataset && $curParentAlbum == $dataset OR ($curGallery == $keyBox && $dataset == "0")) {
					$selText = " selected ";
				}
			}
			if (isset($_GET['image'])) {
				if ($curAlbum == $dataset) {
					$selText = " selected ";
				}
			}
			
			if ($batchAlbum[1] == $dataset){
				$selText = " selected ";
			}
			
			if ($dataset == "0") {
				$out_Select.= "<option value='".$keyBox.",0'".$selText.">".LAN_ACTION_29."</option>";
			} else {
				$out_Select.= "<option value='".$keyBox.",".$dataset."'".$selText.">".$PView -> getAlbumName($dataset)."</option>";
			}
		}
		$out_Select.= "</optgroup>";
	}
	$out_Select.= "</select>";
	if (!count($boxArray)){
		return "<span style='color:red;'>".LAN_ACTION_46."</span>";
	}
	return $out_Select;
}

?>