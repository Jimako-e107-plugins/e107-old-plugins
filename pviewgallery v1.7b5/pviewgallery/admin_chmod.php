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

// Save values
if ($_POST['pv_admin'] == "admin_chmod") {
	if ($_POST['pv_chmodsave'] == "on"){
		if ($_POST['pv_chmod'] <> ""){
			$sqlOK = $PView -> pviewUpdateDb("pview_config","chmod",$_POST['pv_chmod'],"text");
			$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
		} else {
			$ns->tablerender(LAN_ADMIN_55, LAN_ADMIN_127);
		}
	} else {
		$sqlOK = $PView -> pviewUpdateDb("pview_config","chmod","","text");
		$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
	}	
// execute chmod
	if ($_POST['pv_chmod'] <> ""){
		$mask = umask(0777);
		if (chmod(e_PLUGIN."pviewgallery",octdec($_POST['pv_chmod']))){
			$out_CHMOD.= "<p style='color:green;'>".LAN_ADMIN_128_1."'pviewgallery'".LAN_ADMIN_128_2."</p>";
		} else {
			$out_CHMOD.= "<p style='color:red;'>".LAN_ADMIN_128_1."'pviewgallery'".LAN_ADMIN_128_3."<br />";
			$out_CHMOD.= LAN_ADMIN_130."</p>";
		}
		if (chmod(e_PLUGIN."pviewgallery/gallery",octdec($_POST['pv_chmod']))){
			$out_CHMOD.= "<p style='color:green;'>".LAN_ADMIN_128_1."'gallery'".LAN_ADMIN_128_2."</p>";
		} else {
			$out_CHMOD.= "<p style='color:red;'>".LAN_ADMIN_128_1."'gallery'".LAN_ADMIN_128_3."<br />";
			$out_CHMOD.= LAN_ADMIN_130."</p>";
		}
		if (chmod(e_PLUGIN."pviewgallery/batch_upload",octdec($_POST['pv_chmod']))){
			$out_CHMOD.= "<p style='color:green;'>".LAN_ADMIN_128_1."'batch_upload'".LAN_ADMIN_128_2."</p>";
		} else {
			$out_CHMOD.= "<p style='color:red;'>".LAN_ADMIN_128_1."'batch_upload'".LAN_ADMIN_128_3."<br />";
			$out_CHMOD.= LAN_ADMIN_130."</p>";
		}		
		
		umask($mask);
		$ns->tablerender(LAN_ADMIN_129, $out_CHMOD);
	}
}

// Config Table
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_chmod'>";
$out_HTML.= "<div style='width:95%; margin:auto;'><p>".LAN_ADMIN_131."<br />".LAN_ADMIN_132."</p>";
$out_HTML.= "<p>".LAN_ADMIN_133."<br />".LAN_ADMIN_134."</p>";
$out_HTML.= "<p style='font-weight:bold;'>".LAN_ADMIN_135."</p>";
$out_HTML.= "<p>".LAN_ADMIN_136."</p></div>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td class='forumheader3' width='30%'>".LAN_ADMIN_137."</td><td class='forumheader3' width='70%'>";
$out_HTML.= "<table border='0px' width='100%'>";
// IMPORTANT!
clearstatcache();
if (is_readable(e_PLUGIN."pviewgallery") && is_writeable(e_PLUGIN."pviewgallery")){
	$out_HTML.= "<tr><td>pviewgallery</td><td><span style='color:green;'>".LAN_ADMIN_138."</span></td><td>".substr(decoct(fileperms(e_PLUGIN."pviewgallery")), 2)."</td></tr>";
} else {
	$out_HTML.= "<tr><td>pviewgallery</td><td><span style='color:red;'>".LAN_ADMIN_139."</span></td><td>".substr(decoct(fileperms(e_PLUGIN."pviewgallery")), 2)."</td></tr>";
}
if (is_readable(e_PLUGIN."pviewgallery/gallery") && is_writeable(e_PLUGIN."pviewgallery/gallery")){
	$out_HTML.= "<tr><td>gallery</td><td><span style='color:green;'>".LAN_ADMIN_138."</span></td><td>".substr(decoct(fileperms(e_PLUGIN."pviewgallery/gallery")), 2)."</td></tr>";
} else{
	$out_HTML.= "<tr><td>gallery</td><td><span style='color:red;'>".LAN_ADMIN_139."</span></td><td>".substr(decoct(fileperms(e_PLUGIN."pviewgallery/gallery")), 2)."</td></tr>";
}
if (is_readable(e_PLUGIN."pviewgallery/batch_upload") && is_writeable(e_PLUGIN."pviewgallery/batch_upload")){
	$out_HTML.= "<tr><td>batch_upload</td><td><span style='color:green;'>".LAN_ADMIN_138."</span></td><td>".substr(decoct(fileperms(e_PLUGIN."pviewgallery/batch_upload")), 2)."</td></tr>";
} else {
	$out_HTML.= "<tr><td>batch_upload</td><td><span style='color:red;'>".LAN_ADMIN_139."</span></td><td>".substr(decoct(fileperms(e_PLUGIN."pviewgallery/batch_upload")), 2)."</td></tr>";
}
$out_HTML.= "</table>";
$out_HTML.= "</td></tr>";
$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_140."</td><td class='forumheader3'><input class='tbox' id='pv_chmod' name='pv_chmod' type='text' size='3' maxlength='3' value='".$PView -> getPView_config('chmod')."' /></td></tr>";
$out_HTML.= "<tr><td class='forumheader3' width='30%'>".LAN_ADMIN_141."</td><td class='forumheader3' width='70%'><input class='tbox' type='checkbox' id='pv_chmodsave' name='pv_chmodsave' value='on' ";
if ($PView -> getPView_config('chmod')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/><br />".LAN_ADMIN_142."</td></tr>";
$out_HTML.= "</table>";
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_23."'>&nbsp;";
$out_HTML.= "</form>";
$ns->tablerender(LAN_ADMIN_126, $out_HTML);

require_once(e_ADMIN."footer.php");