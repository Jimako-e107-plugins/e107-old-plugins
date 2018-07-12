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
// insert all wysiwyg textareas, comma separated
$e_wysiwyg = "pview_comment";

// Include pview.class
require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;

define('e_PAGETITLE', $tp->toHTML($PView->getGalleryName()));

require_once(HEADERF);
// Include plugin language file, check first for site's preferred language
if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
}
else
{
include_once(e_PLUGIN . "pviewgallery/languages/German.php");
} 



// Include Template
include_once(e_PLUGIN."pviewgallery/templates/template.php");
if (!class_exists('Template')) {
	$ns -> tablerender($PView -> getPView_config("pview_name"), LAN_ADMIN_61);
	require_once(FOOTERF);
    exit;
}
$Template = new Template;

// --------------------------- SESSION Handling for Viewer Sorting --------------------------------------------------------------

if ($PView->getPView_config("viewer_sort")){
	session_start();
	$sortArray = $PView->getSortArray();
	if (isset($_POST['pv_album_sort'])){
		$_SESSION['pv_album_sort'] = array_search($_POST['pv_album_sort'],$sortArray);
	}
	if (isset($_POST['pv_cat_sort'])){
		$_SESSION['pv_cat_sort'] = array_search($_POST['pv_cat_sort'],$sortArray);
	}
	if (isset($_POST['pv_user_sort'])){
		$_SESSION['pv_user_sort'] = array_search($_POST['pv_user_sort'],$sortArray);
	}	
}

// ----------------------------------- Render Gallery ---------------------------------------------------------------------------

// ------------------------------------- e107 Cache -----------------------------------------------------------------------------

// gallery cache ON?
if ($PView->getPView_config("cacheON")) {
	$pv_Appl = $PView -> getAppl();
	$cacheThis = 1;
	
// If the current view is sorted by user, the user will get a uncached (fresh) view, cache will NOT changed/refreshed
	if (isset($_SESSION['pv_album_sort']) && $pv_Appl[0] == "album") {
		$cacheThis = 0;
	}
	if (isset($_SESSION['pv_cat_sort']) && $pv_Appl[0] == "cat") {
		$cacheThis = 0;
	}
	if (isset($_SESSION['pv_user_sort']) && $pv_Appl[0] == "user") {
		$cacheThis = 0;
	}	

// Admins in ADMIN Mode get the uncached (fresh) view, cache will NOT changed/refreshed
	if ((ADMIN && $PView -> getPView_config("admin_Mode")) || !$cacheThis) {
		$tmpHTML = $PView -> sc_Replace($Template -> getContent());
		if (!$tmpHTML) {
			$tmpHTML = "<div style='padding:10px;'>".LAN_GALLERY_9."</div>";
		}

		$ns -> tablerender($PView -> getPath(), $tmpHTML);
	}
	else {
// prepare caching...
// Create an identifying string for this page (IDs are included to manage individual elements in AUTO Mode)
		
		switch ($pv_Appl[0]) {
		case "gallery":
			if ($pv_Appl[0] == "gallery" && $pv_Appl[1] == "0" && $PView->getPView_config("start_page")=="advanced" && $_GET['gallery'] <>"classic") {
				// adv. frontpage
				$cache_tag = "pview_stat";
			} else {
				// normal gallery
				$cache_tag = "pview_gal_".$pv_Appl[1];
			}
			break;
		case "album":
			$cache_tag = "pview_album_".$pv_Appl[1];
			break;
		case "cat":
			$cache_tag = "pview_cat_".$pv_Appl[1];
			break;
		case "user":
			$cache_tag = "pview_user_".$pv_Appl[1];
			break;		
		default:
			$cache_tag = "";
			break;
		}
		// get refresh interval
		// in AUTO Mode the returnvalue is 0
		$cacheInterval = $PView -> getPView_config("cacheInt") * 24 * 60;

		// See if the page is already in the cache
		if($cacheData = $e107cache->retrieve($cache_tag, $cacheInterval))
		{
			$ns -> tablerender($PView -> getPath(), $cacheData);
		}
		else
		{
			$tmpHTML = $PView -> sc_Replace($Template -> getContent());
			if (!$tmpHTML) {
				$tmpHTML = "<div style='padding:10px;'>".LAN_GALLERY_9."</div>";
			}

			$ns -> tablerender($PView -> getPath(), $tmpHTML);

			// image view will NOT cached (useless)
			if (!isset($_GET['image']) && $cache_tag) {
				$e107cache->set($cache_tag, $tmpHTML);	// Save to cache: only the pview content
			}
		}
	}
} else {
	// if cache is turned off, render page as usual
	$tmpHTML = $PView -> sc_Replace($Template -> getContent());
	if (!$tmpHTML) {
		$tmpHTML = "<div style='padding:10px;'>".LAN_GALLERY_9."</div>";
	}

	$ns -> tablerender($PView -> getPath(), $tmpHTML);	
}
// ------------------------------------- e107 Cache end -------------------------------------------------------------------------

// ------------------------------------------ Views Count -----------------------------------------------------------------------
// Cookie handling for views count
if ($PView -> getPView_config('viewControl_by') == "cookie") {
	// prepare cookie for cookies enabled check
	if(!isset($_COOKIE['PView'])) {
		if ($_GET['gallery'] OR $_GET['album']) {
			setcookie("PView","ON");
		}
	} else {
	// count imageviews if cookies enabled
		if ($_GET['image']) {
			$pv_Cookie = $_COOKIE['PView'];
			if (strpos ($pv_Cookie, ",".$_GET['image'].",") === false) {
				// incViews
				$PView -> setImageViews($_GET['image']);
				$pv_Cookie = $pv_Cookie.",".$_GET['image'].",";
				setcookie ("PView", $pv_Cookie);
			}
		}
	}
}

// Session handling for views count
if ($PView -> getPView_config('viewControl_by') == "session") {
	session_start();
	if ($_GET['image']) {
		$pv_Session = $_SESSION['pv_images'];
		if (strpos ($pv_Session, ",".$_GET['image'].",") === false & !SID) {
			// incViews
			$PView -> setImageViews($_GET['image']);
			$_SESSION['pv_images'] = $_SESSION['pv_images']. ",".$_GET['image'].",";
		}
	}
}
// IP Addr. handling for views count
if ($PView -> getPView_config('viewControl_by') == "ip") {
	// delete outdated entries
	$PView -> deleteIPs();
	if ($_GET['image']) {
		$currentIP = $_SERVER['REMOTE_ADDR'];
		$imagesViewed = $PView -> getImagesfromIP($currentIP);
		if (strpos ($imagesViewed['images'], ",".$_GET['image'].",") === false) {
			// incViews
			$PView -> setImageViews($_GET['image']);
			global $sql;
			 if ($imagesViewed) {
				$newImagestring = $imagesViewed['images'].",".$_GET['image'].",";
				$sql -> db_Update("pview_tmpip","images='$newImagestring',time='".time()."' WHERE ip_addr='$currentIP'");
			} else {
				$sql -> db_Insert("pview_tmpip","'$currentIP',',".$_GET['image'].",','".time()."'");
			}
		}
	}
}

// views count without reload interlock
if (!$PView -> getPView_config('viewControl_by')) {
	if ($_GET['image']) {
		// incViews
		$PView -> setImageViews($_GET['image']);
	}
}
// ------------------------------------------ Views Count End --------------------------------------------------------------------

require_once(FOOTERF);

?>