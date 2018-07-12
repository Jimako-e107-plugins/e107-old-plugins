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

// check hidden email address of user
global $sql;
if ($email_from = $sql->db_Select("user", "*", "user_id = '".USERID."' AND user_hideemail = 1")) {
	$fromEmail = "noreply@".$_SERVER["HTTP_HOST"];
} else {
	$fromEmail = USEREMAIL;
}

// Save values
if ($_POST['pv_admin'] == "admin_activate") {
	global $sql;
	global $fromEmail;
	$sqlOK = "nochanges";
	$imgArray = array();
	
	foreach($_POST['pv_act_name'] as $key => $dataset){
		// find imagedata before they are deleted :))
		$imageData = $PView -> getImageData($key);
		$imgArray[$key]['user'] = $imageData['uploaderUserId'];
		$imgArray[$key]['name'] = $imageData['name'];
		$imgArray[$key]['uploadDate'] = $imageData['uploadDate'];
		$imgArray[$key]['new_name'] = $_POST['pv_act_name'][$key];
		$imgArray[$key]['new_descr'] = $_POST['pv_act_descr'][$key];
		
		// delete image
		$tmp = $_POST['pv_act_delete'];
		if ($tmp[$key] == "on") {
			// delete image and set del-flag
			$imgArray[$key]['del'] = $PView -> deleteImage($key);
		}
		// activate image
		$tmp = $_POST['pv_act_approve'];
		if ($tmp[$key] == "on" && $imgArray[$key]['del'] <> 1) {
			// approve image and set act-flag
			$imgArray[$key]['act'] = approveImage($key);
		}	
		// edit image
		$tmp = $_POST['pv_act_edit'];
		if ($tmp[$key] == "on" && $imgArray[$key]['del'] <> 1) {
			// edit image data and set edit-flag
			$imgArray[$key]['edit'] = editImage($key);
		}
	}
	
	foreach($_POST['pv_act_message'] as $key => $dataset) {
		if ($_POST['pv_act_userinfo'][$key] == "on"){
			$subject = $pref['sitename']." - ".$PView -> getPView_config("pview_name");
			$mailText = getMailText($key,$subject);
			$userData = $PView -> getUserData($key);
			$mailTo = $userData['user_name']."<".$userData['user_email'].">";
			
			// send mail
			$mailArray[$key] = mail($mailTo,$subject,$mailText,getMailHeader(), "-f".$fromEmail);
		}
	}

	foreach ($mailArray as $key => $dataset) {
		$userData = $PView -> getUserData($key);
		if ($dataset) {
			$outMail.= LAN_ADMIN_88.$userData['user_name'].LAN_ADMIN_88_1."<br />";
		} else {
			$outMail.= "<span style='color:red; font-weight:bold;'>".LAN_ADMIN_89.LAN_ADMIN_88.$userData['user_name'].LAN_ADMIN_88_2."</span><br />";
		}
		
	}

	foreach ($imgArray as $key => $dataset) {
		if ($imgArray[$key]['del'] === 0){
			$feedback.= "<span style='color:red; font-weight:bold;'>".LAN_ADMIN_89.LAN_ADMIN_90." [".$key."] ".LAN_ADMIN_91."</span><br />";
		}
		if ($imgArray[$key]['del'] == 2){
			$feedback.= "<span style='color:red; font-weight:bold;'>".LAN_ADMIN_89.LAN_ADMIN_90." [".$key."] ".LAN_ADMIN_92."</span><br />";
		}
		if ($imgArray[$key]['act'] === 0){
			$feedback.= "<span style='color:red; font-weight:bold;'>".LAN_ADMIN_89.LAN_ADMIN_90." [".$key."] ".LAN_ADMIN_93."</span><br />";
		}
		if ($imgArray[$key]['edit'] === 0){
			$feedback.= "<span style='color:red; font-weight:bold;'>".LAN_ADMIN_89.LAN_ADMIN_90." [".$key."] ".LAN_ADMIN_94."</span><br />";
		}
	}		
	
	if (!$feedback){$feedback = LAN_ADMIN_95;}
	$ns->tablerender(LAN_ADMIN_55, $outMail."<br />".$feedback);
}
$nonapproved_Images = $PView -> getnonapprovedImages();
if (count($nonapproved_Images)) {
	$tmp_userid = '';
	
	$out_HTML.= "<form action='".e_SELF."' method='post'>";
	$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_activate'>";
	$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
	foreach ($nonapproved_Images as $dataset) {
		$userData = $PView -> getUserData($dataset['uploaderUserId']);
		$ImageSize = getimagesize($PView -> getOrigPath($dataset['imageId'],"REL",1));
		$FileSize = round(filesize($PView -> getOrigPath($dataset['imageId'],"REL",1))/1024,2);
		if ($tmp_userid <> $dataset['uploaderUserId']) {
			if ($tmp_userid) {
				$out_HTML.= "<tr><td colspan='2' class='forumheader3'>".LAN_ADMIN_52.":<br /><textarea class='tbox' name='pv_act_message[".$tmp_userid."]' id='pv_act_message[".$tmp_userid."]' cols='70' rows='5'></textarea></td>";
				$out_HTML.= "<td style='vertical-align:top;' class='forumheader3'><input class='tbox' type='checkbox' id='pv_act_userinfo[".$tmp_userid."]' name='pv_act_userinfo[".$tmp_userid."]' checked='checked' value='on' /> ".LAN_ADMIN_51."</td></tr>";
			}
			$out_HTML.= "<tr><td colspan='3' class='fcaption'>".$userData['user_name']."</td></tr>";
			
			$tmp_userid = $dataset['uploaderUserId'];
		}
		$out_HTML.= "<tr><td style='vertical-align:top;' class='forumheader3'><img src='".$PView -> getThumbPath($dataset['imageId'])."'><br />".$ImageSize[0]."x".$ImageSize[1]."&nbsp;".LAN_IMAGE_15."<br />".$FileSize." kB<br /><br />".LAN_ADMIN_53.": <a href='pviewgallery.php?album=".$dataset['albumId']."' target='_blank'>".$tp -> toHTML($PView -> getAlbumName($dataset['albumId']))."</a></td>";
		$out_HTML.= "<td style='vertical-align:top;' class='forumheader3'><input class='tbox' id='pv_act_name[".$dataset['imageId']."]' name='pv_act_name[".$dataset['imageId']."]' type='text' size='40' value='".$tp -> post_toForm($dataset['name'])."' onchange='document.getElementsByName(\"pv_act_edit[".$dataset['imageId']."]\")[0].checked=\"checked\"'/> [ID: ".$dataset['imageId']."]<br /><br /><textarea class='tbox' name='pv_act_descr[".$dataset['imageId']."]' id='pv_act_descr[".$dataset['imageId']."]' cols='40' rows='7' onchange='document.getElementsByName(\"pv_act_edit[".$dataset['imageId']."]\")[0].checked=\"checked\"'>".$tp -> toForm($dataset['description'])."</textarea></td>";
		$out_HTML.= "<td style='vertical-align:top;' class='forumheader3'><input class='tbox' type='checkbox' id='pv_act_approve[".$dataset['imageId']."]' name='pv_act_approve[".$dataset['imageId']."]' value='on' /> ".LAN_ADMIN_48."<br /><input class='tbox' type='checkbox' id='pv_act_edit[".$dataset['imageId']."]' name='pv_act_edit[".$dataset['imageId']."]' value='on' /> ".LAN_ADMIN_49."<br /><input class='tbox' type='checkbox' id='pv_act_delete[".$dataset['imageId']."]' name='pv_act_delete[".$dataset['imageId']."]' value='on' /> ".LAN_ADMIN_50."</td></tr>";
		
	}
	$out_HTML.= "<tr><td colspan='2' class='forumheader3'>".LAN_ADMIN_52.":<br /><textarea class='tbox' name='pv_act_message[".$dataset['uploaderUserId']."]' id='pv_act_message[".$dataset['uploaderUserId']."]' cols='70' rows='5'></textarea></td>";
	$out_HTML.= "<td style='vertical-align:top;' class='forumheader3'><input class='tbox' type='checkbox' id='pv_act_userinfo[".$dataset['uploaderUserId']."]' name='pv_act_userinfo[".$dataset['uploaderUserId']."]' checked='checked' value='on' /> ".LAN_ADMIN_51."</td></tr>";
	
	$out_HTML.= "</table>";
	$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;";
	$out_HTML.= "</form>";
	$ns->tablerender(LAN_ADMIN_47, $out_HTML);
} else {
	$ns->tablerender(LAN_ADMIN_47, LAN_ADMIN_54);
}

function getMailText($userid,$subject){
// returns html mailtext
	global $imgArray;
	global $tp;
	global $fromEmail;
	$PView = new PView;
	$userData = $PView -> getUserData($userid);
	$out_Text = "<html><head><title>".$subject."</title></head><body>";
	$out_Text.= "<h2>".LAN_ADMIN_96.$userData['user_name']."!</h2>";
	$out_Text.= "<p>".LAN_ADMIN_97."</p>";
	$out_Text.= "<table border='1' width='400px'><tr><th width='50px'>ID</th><th width='200px'>".LAN_IMAGE_9."</th><th width='150'>".LAN_ADMIN_99."</th></tr>";
	//loop for all images of user
	foreach($imgArray as $key => $dataset){
		// collect action-data for all user-images
		if ($dataset['user'] == $userid){
			$out_Text.= dataCollector($key);
		}
	}
	$out_Text.= "</table>";
	// message text to user
	$out_Text.= "<p>".$tp -> post_toHTML($_POST['pv_act_message'][$userid])."</p>";
	// date, username of image-checker
	$out_Text.= "<p>".date("d.m.Y",time()).", ".LAN_ADMIN_98.USERNAME."</p>";
	if ($fromEmail != USEREMAIL) {
		$out_Text.= "<p style='margin-top:20px; font-weight:bold;'>".LAN_ADMIN_212."</p>";
	}
	
	return $out_Text;
}
function getMailHeader() {
// returns maiheader for html mails
	global $fromEmail;
	$mailHeader = "MIME-Version: 1.0\n";
	$mailHeader.= "Content-type: text/html; charset=utf-8\n";
	$mailHeader.= "From:".USERNAME."<".$fromEmail.">\n";
	$mailHeader.= "Reply-To: " .$fromEmail. "\n";
	$mailHeader.= "Return-Path: " .$fromEmail. "\n";
	$mailHeader.= "X-Mailer: PHP/" .phpversion(). "\n";
	
	return $mailHeader;
}

function approveImage($imageid){
// approve image
// returns 0: not approved (ERR)
// returns 1: approved (OK)
	global $sql;
	global $e107cache;
    $PView = new PView;
	
    
	if($sql -> db_Update("pview_image", "approved=1 WHERE imageId='".$imageid."'")){
		
        $imageData = $PView -> getImageData($imageid);
    	// clear cache for adv. startpage
    	$e107cache -> clear("pview_stat");
    	// clear cache for related album 
    	$e107cache -> clear("pview_album_".$imageData['albumId']);
    	// clear cache for menu
    	$e107cache -> clear("nq_pview_menu");
        // clear cache for categorie list
    	$e107cache -> clear("pview_cat_list");
        // clear cache for related categorie view
    	$e107cache -> clear("pview_cat_".$imageData['cat']);                    
        // clear cache for user list
    	$e107cache -> clear("pview_user_list");
        // clear cache for related user view
    	$e107cache -> clear("pview_user_".$imageData['uploaderUserId']);
        
        return 1;
	}
	return 0;
}
function editImage($imageid){
// edit image Data
// returns 0: not edited (ERR)
// returns 3: edit name and description
// returns 1: edit name
// returns 2: edit description
	global $sql;
	global $imgArray;
	global $tp;
	$PView = new PView;
	$status = 0;
	$imgData = $PView -> getImageData($imageid);
	
	$new_name = $tp -> toDB($imgArray[$imageid]['new_name']);
	$new_descr = $tp -> toDB($imgArray[$imageid]['new_descr']);
	
	if ($imgData['name'] <> $new_name) {
		if ($sql -> db_Update("pview_image", "name='".$new_name."' WHERE imageId='".$imageid."'")){
			$status = 1;
		}
	}
	
	if ($imgData['description'] <> $new_descr) {
		if ($sql -> db_Update("pview_image", "description='".$new_descr."' WHERE imageId='".$imageid."'")){
			$status = $status + 2;
		}
	}
	
	return $status;
}
function dataCollector($imageid){
// returns a collection of admin-actions per image
	global $tp;
	global $imgArray;
	$PView = new PView;
	$out_Text.= "<tr><td>".$imageid."</td><td>".$tp -> post_toHTML($imgArray[$imageid]['name'])."</td><td>".date("d.m.Y",$imgArray[$imageid]['uploadDate'])."</td></tr>";
	$out_Text.= "<tr><td colspan='3'>";
	// - feedback, if approved successfully (else nothing)
	if ($imgArray[$imageid]['act'] == 1){
		$out_Change.= LAN_ADMIN_100."</br>";
	}
	// - feedback, if edited successfully (else nothing)
	if ($imgArray[$imageid]['edit'] == 3){
		$out_Change.= LAN_ADMIN_101."</br>";
	}
	if ($imgArray[$imageid]['edit'] == 1){
		$out_Change.= LAN_ADMIN_102."</br>";
	}
	if ($imgArray[$imageid]['edit'] == 2){
		$out_Change.= LAN_ADMIN_103."</br>";
	}
	// - feedback, if deleted successfully (else nothing)
	if ($imgArray[$imageid]['del'] == 1 OR $imgArray[$imageid]['del'] == 2){
		$out_Change.= LAN_ADMIN_104."</br>";
	}	
	if (!$out_Change){
	// - feedback, no action 
		$out_Change = LAN_ADMIN_105;
	}
	$out_Text.= $out_Change."</td></tr>";
	
	return $out_Text;
}

require_once(e_ADMIN."footer.php");