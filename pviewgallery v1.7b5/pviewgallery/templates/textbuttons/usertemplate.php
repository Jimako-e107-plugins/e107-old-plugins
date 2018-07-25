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
require_once(e_PLUGIN."pviewgallery/templates/textbuttons/language/".e_LANGUAGE.".php");

class UserTemplate {


function getGalleryMenu($galType) {
// returns menu for gallery view
	$PView = new PView;
	$Appl = $PView -> getAppl();
	if ($galType == "main") {
		// PERMISSION!!!
		if ($PView -> getPermission("gallery",$Appl[1],"CreateAlbum")) {
			$galMenu = "<a href='".e_PLUGIN."pviewgallery/pview_actions.php?gallery=".$Appl[1]."&amp;action=newalbum'><span class='button' style='padding:0px 4px;'>".LAN_GALLERY_2."</span></a>";
		}
		// PERMISSION!!!
		if ($PView -> getPermission("gallery",$Appl[1],"Edit")) {
			$galMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?gallery=".$Appl[1]."&amp;action=edit'><span class='button' style='padding:0px 4px;'>".LAN_GALLERY_6."</span></a>";
		}
	}
	if ($galType == "user") {
		// PERMISSION!!!
		if ($PView -> getPermission("config","permCreateGallery","")) {
			$galMenu = "<a href='".e_PLUGIN."pviewgallery/pview_actions.php?gallery=".$Appl[1]."&amp;action=newgallery'><span class='button' style='padding:0px 4px;'>".LAN_GALLERY_1."</span></a>";
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
		$AlbumMenu = "<a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$Appl[1]."&amp;action=newalbum'><span class='button' style='padding:0px 4px;'>".LAN_ALBUM_6."</span></a>";
	}
    
 	// button to nominate image for featured pictures
	if ($PView -> getPView_config("Nominate") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> checkNomLimit("album")) {
			if ($PView -> getPermission("config","permNominate","")) {
				if ($PView->getAlbumNom($Appl[1])) {
					$AlbumMenu.= " <span class='button' style='padding:0px 4px;'>".LAN_TMP_MENU_8."</span>";
				}else {
					$AlbumMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?view=".$_GET['view']."&amp;nomalbum=".$Appl[1]."'><span class='button' style='padding:0px 4px;'>".LAN_TMP_MENU_6."</span></a>";
				}	
			}			
		}
	}
    
	// PERMISSION!!!
	if ($PView -> getPermission("album",$Appl[1],"Edit")) {
		$AlbumMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$Appl[1]."&amp;action=edit'><span class='button' style='padding:0px 4px;'>".LAN_ALBUM_7."</span></a>";
	}
	// PERMISSION!!!
	if ($PView -> getPermission("album",$Appl[1],"Upload")) {
		$AlbumMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$Appl[1]."&amp;action=upload'><span class='button' style='padding:0px 4px;'>".LAN_ALBUM_8."</span></a>";
	}
	// ViewerSort
	if ($PView->getPView_config("viewer_sort")){
		$AlbumMenu.= "<p style='padding-top:3px;'>".LAN_ALBUM_19.": ".$PView->getSortBox("album",1)."</p>";
	}
	$AlbumMenu.= "</form>";
	return $AlbumMenu;
}
function getCatMenu() {
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
function getImageMenu() {
// returns menu for image view
	$PView = new PView;
	$Appl = $PView -> getAppl();
	$ImageData = $PView -> getImageData($Appl[1]);
	// button for printerfriendly page
	if ($PView -> getPView_config("print") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> getPermission("config","permPrint","")) {
			$ImageMenu.= " <a href='".e_BASE."print.php?plugin:pviewgallery.".$Appl[1]."'><span class='button' style='padding:0px 4px;'>".LAN_TMP_MENU_3."</span></a>";
		}
	}
	
	// button for Send image per email
	if (($PView -> getPView_config("email") && $ImageData['sendImage']) OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> getPermission("config","permEmail","")) {
			$ImageMenu.= " <a href='".e_BASE."email.php?plugin:pviewgallery.".$Appl[1]."'><span class='button' style='padding:0px 4px;'>".LAN_TMP_MENU_4."</span></a>";
		}
	}	
	
	// button for generate pdf
	if ($PView -> getPView_config("pdf") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> getPermission("config","permPdf","")) {
			$ImageMenu.= " <a href='".e_PLUGIN."pdf/pdf.php?plugin:pviewgallery.".$Appl[1]."'><span class='button' style='padding:0px 4px;'>".LAN_TMP_MENU_5."</span></a>";
		}
	}	
	
	
	// additional button to use image as albumimage (depends on album permission)
	if ($PView -> getPermission("album",$PView -> getImageAlbum(),"Edit") && $ImageData['thumbnail']) {
		$ImageMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?album=".$PView -> getImageAlbum()."&amp;changeimage=".$Appl[1]."'><span class='button' style='padding:0px 4px;'>".LAN_TMP_MENU_2."</span></a>";
	}
    
 	// button to nominate image for featured pictures
	if ($PView -> getPView_config("Nominate") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> checkNomLimit("image")) {
			if ($PView -> getPermission("config","permNominate","")) {
				if ($PView->getImageNom($Appl[1])) {
					$ImageMenu.= " <span class='button' style='padding:0px 4px;'>".LAN_TMP_MENU_9."</span>";
				}else {
					$ImageMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?view=".$_GET['view']."&amp;nomimage=".$Appl[1]."'><span class='button' style='padding:0px 4px;'>".LAN_TMP_MENU_7."</span></a>";
				}	
			}			
		}
	}
	
	// PERMISSION!!!
	if ($PView -> getPermission("image",$Appl[1],"Edit")) {
		$ImageMenu.= " <a href='".e_PLUGIN."pviewgallery/pview_actions.php?image=".$Appl[1]."&amp;action=edit'><span class='button' style='padding:0px 4px;'>".LAN_IMAGE_2."</span></a>";
	}
	$ImageSize = getimagesize($PView -> getOrigPath($Appl[1],"REL",1));
	$ImageMenu.= 	"<script type=\"text/javascript\">
					function showImage() {
						pv_imagezoom(\"".$PView -> getOrigPath($Appl[1])."\",".$ImageSize[0].",".$ImageSize[1].",\"".$PView -> getImageName($Appl[1])."\",\"".LAN_IMAGE_44."\");
					}
					</script>";
	$ImageMenu.= " <a href='javascript:showImage();'><span class='button' style='padding:0px 4px;'>".LAN_TMP_MENU_1."</span></a>";

	return $ImageMenu;
}
function getButton_addComment() {
// returns a button image incl. link
	$PView = new PView;
	// PERMISSION!!!
	if ($PView -> getPermission("config","permComment","")) {
		if (!$_GET['comment'] && !$_POST['submit']) {
			$btn = "<a href='javascript:pv_CommentAdd();'><span class='button' style='padding:0px 4px;'>".LAN_IMAGE_18."</span></a>";
		}
	}
	return $btn;
}
function getButton_editComment($commentid) {
// returns a button image incl. link
	$PView = new PView;
	// PERMISSION!!!
	if ($PView -> getPermission("config","permComment","")) {
	$btn = "<a href='pviewgallery.php?image=".$_GET['image']."&comment=".$commentid."#a_preview'><span class='button' style='padding:0px 4px;'>".LAN_IMAGE_19."</span></a>";
	}
	return $btn;
}

}//Class Template End

?>