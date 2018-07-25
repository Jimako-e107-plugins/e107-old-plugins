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
require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;
global $tp;

// Include plugin language file, check first for site's preferred language
if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
	include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
}
else
{
    include_once(e_PLUGIN . "pviewgallery/languages/German.php");
} 

// Check current user is an admin, redirect to main site if not
if (!getperms("P")) {
	header("location:".e_HTTP."index.php");
	exit;
}

// Include page header stuff for admin pages
require_once(e_ADMIN."auth.php");


// Save values
if ($_POST['pv_admin'] == "admin_nominate") {
	global $sql;
	$sqlOK = $PView -> pviewUpdateDb("pview_config","Nominate",$_POST['pv_Nominate'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","NomFeature",$_POST['pv_NomFeature'],"checkbox");
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","permNominate",$PView -> getpermClasses("pv_permNominate"));
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","maxImageNom",$_POST['pv_maxImageNom']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","maxAlbumNom",$_POST['pv_maxAlbumNom']);
	
	foreach($_POST['pv_delImgNom'] as $key => $dataset) {
		$sqlOK = $sqlOK & delNom("image",$key);
	}
	
	foreach($_POST['pv_delImgFeature'] as $key => $dataset) {
		$sqlOK = $sqlOK & delFeature("image",$key);
	}
	
	foreach($_POST['pv_setImgFeature'] as $key => $dataset) {
		$sqlOK = $sqlOK & actFeature("image",$key);
		if ($PView -> getPView_config("NomFeature")) {
			$sqlOK = $sqlOK & delNom("image",$key);
		}		
	}
	
	foreach($_POST['pv_delAlbumNom'] as $key => $dataset) {
		$sqlOK = $sqlOK & delNom("album",$key);
	}
	
	foreach($_POST['pv_delAlbumFeature'] as $key => $dataset) {
		$sqlOK = $sqlOK & delFeature("album",$key);
	}
	
	foreach($_POST['pv_setAlbumFeature'] as $key => $dataset) {
		$sqlOK = $sqlOK & actFeature("album",$key);
		if ($PView -> getPView_config("NomFeature")) {
			$sqlOK = $sqlOK & delNom("album",$key);
		}		
	}	
	
	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}


$list_Images = array();
$list_Images = $PView -> getListImagesData();

$list_Albums = array();
$list_Albums = $PView -> getListAlbumsData();

// delete all unused db-rows (images)
foreach ($list_Images as $dataset) {
	if (!$dataset['isNominated'] && !$dataset['isFeatured']) {
		$sql -> db_Delete("pview_featured", "imageId=".$dataset['imageId']." AND calDay='0'");
	}
}
// reload listImages after db update
$list_Images = $PView -> getListImagesData();

// delete all unused db-rows (albums)
foreach ($list_Albums as $dataset) {
	if (!$dataset['isNominated'] && !$dataset['isFeatured']) {
		$sql -> db_Delete("pview_featured", "albumId=".$dataset['albumId']." AND calDay='0'");
	}
}
// reload listAlbums after db update
$list_Albums = $PView -> getListAlbumsData();

// all userclasses
$allUserclasses = $PView -> getUserclasses();

// userclasses with permNominate
$ValidUserclass = array();
$ValidUserclass = explode ( ',', $PView -> getPView_config('permNominate') );

// Config Table
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_nominate'>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_217."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_Nominate' name='pv_Nominate' value='on' ";
if ($PView -> getPView_config('Nominate')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";


$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_29.LAN_ADMIN_218."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_permNominate[all]' name='pv_permNominate[all]' value='on' ";
if ($PView -> getPView_config('permNominate') == "ALL") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_31."<br /><input class='tbox' type='checkbox' id='pv_permNominate[member]' name='pv_permNominate[member]' value='on' ";
if ($PView -> getPView_config('permNominate') == "MEMBER") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".LAN_ADMIN_32."<br />";
foreach ($allUserclasses as $dataset) {
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_permNominate[".$dataset['userclass_id']."] ' name='pv_permNominate[".$dataset['userclass_id']."]' value='on' ";
if (in_array ($dataset['userclass_id'],$ValidUserclass)) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/> ".$dataset['userclass_name']."<br />";
}
$out_HTML.= "</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_219."</td><td class='forumheader3'><input class='tbox' id='pv_maxImageNom' name='pv_maxImageNom' type='text' size='6' maxlength='4' value='".$PView -> getPView_config('maxImageNom')."' /> (".LAN_ADMIN_35.") </td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_220."</td><td class='forumheader3'><input class='tbox' id='pv_maxAlbumNom' name='pv_maxAlbumNom' type='text' size='6' maxlength='4' value='".$PView -> getPView_config('maxAlbumNom')."' /> (".LAN_ADMIN_35.") </td></tr>";

$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_221."</td><td class='forumheader3'><input class='tbox' type='checkbox' id='pv_NomFeature' name='pv_NomFeature' value='on' ";
if ($PView -> getPView_config('NomFeature')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/></td></tr>";

$out_HTML.= "</table><br />";

// imagetable
if (count($list_Images)) {
	
	$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
	$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_IMAGE_54."</td><td class='fcaption'>".LAN_ADMIN_224."</td></tr>";
	foreach ($list_Images as $dataset) {
		$ImageSize = getimagesize($PView -> getOrigPath($dataset['imageId'],"REL",1));
		$FileSize = round(filesize($PView -> getOrigPath($dataset['imageId'],"REL",1))/1024,2);		
		$out_HTML.= "<tr><td class='forumheader3' style='width:30%;'><img src='".$PView -> getThumbPath($dataset['imageId'])."'><br />".$ImageSize[0]."x".$ImageSize[1]."&nbsp;".LAN_IMAGE_15."<br />".$FileSize." kB</td>";
		$out_HTML.= "<td class='forumheader3' style='width:30%;'>".LAN_IMAGE_9.": ".$dataset['name']." [ID: ".$dataset['imageId']."]<br /><br />".LAN_IMAGE_10.": ".$tp -> toForm($dataset['description'])."<br /><br />".LAN_ADMIN_53.": <a href='pviewgallery.php?album=".$dataset['albumId']."' target='_blank'>".$tp -> toHTML($PView -> getAlbumName($dataset['albumId']))."</a></td>";
		$out_HTML.= "<td class='forumheader3' style='width:40%;'>";
		if ($dataset['isNominated']) {
			$out_HTML.= LAN_ADMIN_90.LAN_ADMIN_222."<br />";
		}
		if ($dataset['isFeatured']) {
			$out_HTML.= "<span style='font-weight:bold;'>".LAN_ADMIN_90.LAN_ADMIN_223."</span><br />";
		}
		if ($dataset['isNominated']) {		
			$out_HTML.= "<br /><input class='tbox' type='checkbox' id='pv_delImgNom[".$dataset['imageId']."]' name='pv_delImgNom[".$dataset['imageId']."]' value='on' /><span style='color:red;'>".LAN_ADMIN_225."</span>";
		}
		if ($dataset['isFeatured']) {
			$out_HTML.= "<br /><input class='tbox' type='checkbox' id='pv_delImgFeature[".$dataset['imageId']."]' name='pv_delImgFeature[".$dataset['imageId']."]' value='on' />".LAN_ADMIN_226;
		}
		if (!$dataset['isFeatured']) {
		$out_HTML.= "<br /><input class='tbox' type='checkbox' id='pv_setImgFeature[".$dataset['imageId']."]' name='pv_setImgFeature[".$dataset['imageId']."]' value='on' /><span style='color:green;'>".LAN_ADMIN_90.LAN_ADMIN_227."</span>";
		}
		$out_HTML.= "</td></tr>";
	}

	
	$out_HTML.= "</table><br />";
} else {
	$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style= margin-top:10px'><tr><td>".LAN_ADMIN_231."</td></tr></table><br />";
}

// albumtable
if (count($list_Albums)) {
	
	$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style= margin-top:10px'>";
	$out_HTML.= "<tr><td colspan='2' class='fcaption'>".LAN_ADMIN_233."</td><td class='fcaption'>".LAN_ADMIN_224."</td></tr>";
	foreach ($list_Albums as $dataset) {		
		$out_HTML.= "<tr><td class='forumheader3' style='width:30%;'><img src='".$PView -> getAlbumImage($dataset['albumId'])."'></td>";
		$out_HTML.= "<td class='forumheader3' style='width:30%;'>".LAN_IMAGE_9.": ".$dataset['name']." [ID: ".$dataset['albumId']."]<br /><br />".LAN_IMAGE_10.": ".$tp -> toForm($dataset['description'])."<br /><br />".LAN_ADMIN_53.": <a href='pviewgallery.php?album=".$dataset['albumId']."' target='_blank'>".$tp -> toHTML($PView -> getAlbumName($dataset['albumId']))."</a></td>";
		$out_HTML.= "<td class='forumheader3' style='width:40%;'>";
		if ($dataset['isNominated']) {
			$out_HTML.= LAN_ADMIN_53.LAN_ADMIN_222."<br />";
		}
		if ($dataset['isFeatured']) {
			$out_HTML.= "<span style='font-weight:bold;'>".LAN_ADMIN_53.LAN_ADMIN_223."</span><br />";
		}
		if ($dataset['isNominated']) {		
			$out_HTML.= "<br /><input class='tbox' type='checkbox' id='pv_delAlbumNom[".$dataset['albumId']."]' name='pv_delAlbumNom[".$dataset['albumId']."]' value='on' /><span style='color:red;'>".LAN_ADMIN_225."</span>";
		}
		if ($dataset['isFeatured']) {
			$out_HTML.= "<br /><input class='tbox' type='checkbox' id='pv_delAlbumFeature[".$dataset['albumId']."]' name='pv_delAlbumFeature[".$dataset['albumId']."]' value='on' />".LAN_ADMIN_226;
		}
		if (!$dataset['isFeatured']) {
		$out_HTML.= "<br /><input class='tbox' type='checkbox' id='pv_setAlbumFeature[".$dataset['albumId']."]' name='pv_setAlbumFeature[".$dataset['albumId']."]' value='on' /><span style='color:green;'>".LAN_ADMIN_53.LAN_ADMIN_227."</span>";
		}
		$out_HTML.= "</td></tr>";
	}

	
	$out_HTML.= "</table><br />";

} else {
	$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style= margin-top:10px'><tr><td>".LAN_ADMIN_232."</td></tr></table><br />";
}
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;";
$out_HTML.= "</form>";
$ns->tablerender(LAN_ADMIN_216, $out_HTML);

function delNom($typ,$id) {
// delete album/image nomination
// returns 1 if db update successful, 0 if error
	global $sql;
    global $e107cache;
    
    // clear cache for adv. startpage
	$e107cache -> clear("pview_stat");
    // clear cache for this album
	$e107cache -> clear("pview_album_".$id);
	
	if ($sql -> db_Update("pview_featured","isNominated=0 WHERE calDay='0' AND ".$typ."Id=".$id) === FALSE) {
		return 0;
	} else {
		return 1;
	}
}

function delFeature($typ,$id) {
// delete album/image feature	
// returns 1 if db update successful, 0 if error
	global $sql;
    global $e107cache;
	
	// clear cache for adv. startpage
	$e107cache -> clear("pview_stat");
	
	if ($sql -> db_Update("pview_featured","isFeatured=0 WHERE calDay='0' AND ".$typ."Id=".$id) === FALSE) {
		return 0;
	} else {
		return 1;
	}
}

function actFeature($typ,$id) {
// enable album/image feature	
// returns 1 if db update successful, 0 if error
	global $sql;
    global $e107cache;
	
	// clear cache for adv. startpage
	$e107cache -> clear("pview_stat");
	
	if ($sql -> db_Update("pview_featured","isFeatured=1 WHERE calDay='0' AND ".$typ."Id=".$id) === FALSE) {
		return 0;
	} else {
		return 1;
	}	
}

require_once(e_ADMIN."footer.php");