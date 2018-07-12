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
// Include plugin language file, check first for site's preferred language
if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
}
else
{
include_once(e_PLUGIN . "pviewgallery/languages/German.php");
}

require_once(e_PLUGIN."pviewgallery/pview.class.php");


if (!defined('e107_INIT'))
{
    exit;
}
function print_item($id){
	$PView = new PView;	
	$image = $PView -> getImageData($id);
    //Permission
    if ($PView -> getPView_config("print") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> getPermission("config","permPrint","") && $PView -> getPermission("image",$id,"View")) {
		    //Bild und Bildinformationen
		    $text = "<img src='".$PView -> getResizePath($id)."'><br />";
		    $text.= "<b>".$image['name']."</b><br />";
		    $text.= $image['description'];
	
		    //alle Kommentare
		    $text.= "<br /><br /><b>".LAN_IMAGE_4.":</b>";
			$comments = $PView -> getCommentsData($id);
			foreach ($comments as $key => $dataset){
				$text.= "<br />".$dataset['commentText'];
			}
			
		    return $text;
		}
    }
    
	return LAN_IMAGE_36;
}

function email_item($id){
	$PView = new PView;
	$image = $PView -> getImageData($id);
    //Permission
    if (($PView -> getPView_config("email") && $image['sendImage']) OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> getPermission("config","permEmail","") && $PView -> getPermission("image",$id,"View")) {
		    //Bild und Bildinformationen
		    $text = "<center><b>".$image['name']."</b><br /><br />";
		    $text.= "<img src='".$PView -> getResizePath($id)."'></center>";
			
		    return $text;
		}
	}
}
function print_item_pdf($id){
	$PView = new PView;
	$image = $PView -> getImageData($id);
    //Permission
    if ($PView -> getPView_config("pdf") OR (ADMIN && $PView -> getPView_config("admin_Mode"))){
		if ($PView -> getPermission("config","permPdf","") && $PView -> getPermission("image",$id,"View")) {
		    //Bild und Bildinformationen
		    $text = "<img src='".$PView -> getResizePath($id)."'><br />";
		    $text.= "<b>".$image['name']."</b><br />";
		    $text.= $image['description'];
	
		    //alle Kommentare
		    $text.= "<br /><br /><b>".LAN_IMAGE_4.":</b>";
			$comments = $PView -> getCommentsData($id);
			foreach ($comments as $key => $dataset){
				$text.= "<br />".$dataset['commentText'];
			}
	    } else {
			$text= LAN_IMAGE_36;
		}
	} else {
		$text= LAN_IMAGE_36;
	}
	
	
        // the following defines are processed in the document properties of the pdf file
        // Do NOT add parser function to the variables, leave them as raw data !
        // as the pdf methods will handle this !
        $text = $text; //define text
        $creator = SITENAME; //define creator
        $author = $PView -> getUserData($image['uploaderUserId']) ; //define author
        $title = LAN_ADMIN_90 . $id; //define title
        $subject = "pviewgallery"; //define subject
        $keywords = ""; //define keywords

        // define url to use in the header of the pdf file
        $url = SITEURLBASE . e_PLUGIN_ABS . "pviewgallery/pviewgallery.php?image=" . $id;
        // always return an array with the following data:
        return array($text, $creator, $author, $title, $subject, $keywords, $url);
}


?>