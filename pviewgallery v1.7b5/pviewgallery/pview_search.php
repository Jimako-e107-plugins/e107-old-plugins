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
// Include pview.class for permission request
require_once(e_PLUGIN."pviewgallery/pview.class.php");
$PView = new PView;

$imgArray = array();
$sql->db_Select("pview_image", "*", "", "nowhere");
while ($image = $sql -> db_Fetch()) {
	// PERMISSION!!!
	if ($PView->getPermission("image",$image['imageId'],"View")) {
		array_push ($imgArray, $image['imageId']);
	}
}

$advanced_where = "";

$return_fields = "imageId, name, description, uploaderUserId, uploadDate";
$search_fields = array("name", "description");
$weights = array("1.2", "1.0");
$no_results = LAN_198;
$where = "imageId IN (".implode(",",$imgArray).") and";
//$where = "";
$order = array('uploadDate' => DESC);
$table = "pview_image";
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_pview', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_pview($row) {
	global $pref;
	global $con;
	$PView = new PView;
    
    if ($PView -> getPView_config("img_Link_search_extJS")) {
    	$script = $PView -> getPView_config("img_Link_extJS");
    } else {
    	$script = "noscript";
    }    

	// Include plugin language file, check first for site's preferred language
	if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
		include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
	}
	else
	{
		include_once(e_PLUGIN . "pviewgallery/languages/German.php");
	} 

	$user = get_user_data($row["uploaderUserId"]);
	$datestamp = $con->convert_date($row['uploadDate'], "short");
	
	switch ($script) {
				case "noscript":
				// image will open in pviewgallery
				$res['link'] = e_PLUGIN."pviewgallery/pviewgallery.php?image=".$row["imageId"];
				break;
				case "lightbox":
				// image will open in lightbox group
                $res['link'] = $PView -> getResizePath($row["imageId"]). "' rel='lightbox";	
				break;
				case "shadowbox":
				// image will open in shadowbox group	
				$res['link'] = $PView -> getResizePath($row["imageId"]). "' rel='shadowbox";
				break;
				case "highslide":
				// image will open in highslide group
                $res['link'] = $PView -> getResizePath($row["imageId"]). "' class='highslide' onclick='return hs.expand(this)'";
				break;																	
				
	}
	
	$res['pre_title'] = "";
	$res['title'] = $row["name"];
	$res['summary'] = $row["description"];
	$res['detail'] = LAN_IMAGE_13." <a href='user.php?id.".$row['uploaderUserId']."'>".$user['user_name']."</a>, ".LAN_IMAGE_14." ".$datestamp;
	return $res;

	
}

?>