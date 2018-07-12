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
if ($_POST['pv_admin'] == "admin_profile") {
	global $sql;
	$sqlOK = $PView -> pviewUpdateDb("pview_config","profile_ImgCount",$_POST['pv_profile_ImgCount']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","profile_ImgOrder",$_POST['pv_profile_ImgOrder']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","profile_ImgCols",$_POST['pv_profile_ImgCols']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","profile_CommCount",$_POST['pv_profile_CommCount']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","profile_CommCols",$_POST['pv_profile_CommCols']);
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","profile_CommPreview",$_POST['pv_profile_CommPreview']);	
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","img_Link_profileCom_extJS",$_POST['pv_img_Link_profileCom_extJS'],"checkbox",0); 
	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","img_Link_profileImg_extJS",$_POST['pv_img_Link_profileImg_extJS'],"checkbox",0); 
//	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","profileImg_lightbox",$_POST['pv_profileImg_lightbox'],"checkbox");
//	$sqlOK = $sqlOK & $PView -> pviewUpdateDb("pview_config","profileComm_lightbox",$_POST['pv_profileComm_lightbox'],"checkbox");

	$ns->tablerender(LAN_ADMIN_55, $PView -> getAdminMsg($sqlOK));
}

// Config Table: Instructions
$out_HTML.= "<form action='".e_SELF."' method='post'>";
$out_HTML.= "<input type='hidden' name='pv_admin' value='admin_profile'>";
$out_HTML.= "<div style='width:95%; margin:auto;'><p>".LAN_ADMIN_200_1."</p>";
$out_HTML.= "<p>".LAN_ADMIN_200_2."</p></div>";
$out_HTML.= "<table cellspacing='0' width='95%' border='0' style='margin-top:10px'>";
$out_HTML.= "<tr><td width='30%'>{PVIEW_USERGAL}</td><td width='70%'>".LAN_ADMIN_200_5."</td></tr>";
$out_HTML.= "<tr><td width='30%'>{PVIEW_USERIMG}</td><td width='70%'>".LAN_ADMIN_200_6."</td></tr>";
$out_HTML.= "<tr><td width='30%'>{PVIEW_USERCOMM}</td><td width='70%'>".LAN_ADMIN_200_7."</td></tr>";
$out_HTML.= "</table>";
$out_HTML.= "<div style='width:95%; margin:auto;'><p>".LAN_ADMIN_200_3."</p>";
$out_HTML.= "<p>".LAN_ADMIN_200_4."</p></div>";
$ns->tablerender(LAN_ADMIN_199, $out_HTML);

// Config Table: Gallery Link
$out_HTML = "<div style='width:95%; margin:auto;'><p>".LAN_ADMIN_197."</p></div>";
$ns->tablerender(LAN_ADMIN_198, $out_HTML);

// Config Table: Images
$out_HTML = "<div style='width:95%; margin:auto;'><p>".LAN_ADMIN_194."</p></div>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td width='30%' class='forumheader3'>".LAN_ADMIN_63."</td><td width='70%' class='forumheader3'><input class='tbox' id='pv_profile_ImgOrder' name='pv_profile_ImgOrder' type='radio' value='RAND'";
if ($PView -> getPView_config('profile_ImgOrder') == "RAND") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /> ".LAN_ADMIN_191.LAN_ALBUM_1."<br /><input class='tbox' id='pv_profile_ImgOrder' name='pv_profile_ImgOrder' type='radio' value='DESC'";
if ($PView -> getPView_config('profile_ImgOrder') == "DESC") {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= " /> ".LAN_ADMIN_190.LAN_ALBUM_1."</td></tr>";
$out_HTML.= "<tr><td width='30%' class='forumheader3'>".LAN_ADMIN_64.LAN_ADMIN_196."</td><td width='70%' class='forumheader3'><input class='tbox' id='pv_profile_ImgCount' name='pv_profile_ImgCount' type='text' size='2' maxlength='2' value='".$PView -> getPView_config('profile_ImgCount')."' /></td></tr>";
$out_HTML.= "<tr><td width='30%' class='forumheader3'>".LAN_ADMIN_17."</td><td width='70%' class='forumheader3'><input class='tbox' id='pv_profile_ImgCols' name='pv_profile_ImgCols' type='text' size='2' maxlength='2' value='".$PView -> getPView_config('profile_ImgCols')."' /></td></tr>";

$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_201."</td><td class='forumheader3'>";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_img_Link_profileImg_extJS' name='pv_img_Link_profileImg_extJS' value='on' ";
if ($PView -> getPView_config('img_Link_profileImg_extJS')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/>".LAN_ADMIN_207.LAN_ADMIN_204."</p>";
$out_HTML.= "<p>".LAN_ADMIN_209."</p>";
$out_HTML.= "</td></tr>";
$out_HTML.= "</table>";
$ns->tablerender(LAN_ALBUM_1, $out_HTML);

// Config Table: Comments
$out_HTML = "<div style='width:95%; margin:auto;'><p>".LAN_ADMIN_195."</p></div>";
$out_HTML.= "<table cellspacing='0' width='95%' class='fborder' style='margin-top:10px'>";
$out_HTML.= "<tr><td width='30%' class='forumheader3'>".LAN_ADMIN_110.LAN_ADMIN_196."</td><td width='70%' class='forumheader3'><input class='tbox' id='pv_profile_CommCount' name='pv_profile_CommCount' type='text' size='2' maxlength='2' value='".$PView -> getPView_config('profile_CommCount')."' /></td></tr>";
$out_HTML.= "<tr><td width='30%' class='forumheader3'>".LAN_ADMIN_111."</td><td width='70%' class='forumheader3'><input class='tbox' id='pv_profile_CommPreview' name='pv_profile_CommPreview' type='text' size='2' maxlength='2' value='".$PView -> getPView_config('profile_CommPreview')."' /> ".LAN_ADMIN_193."</td></tr>";
$out_HTML.= "<tr><td width='30%' class='forumheader3'>".LAN_ADMIN_17."</td><td width='70%' class='forumheader3'><input class='tbox' id='pv_profile_CommCols' name='pv_profile_CommCols' type='text' size='2' maxlength='2' value='".$PView -> getPView_config('profile_CommCols')."' /></td></tr>";

$out_HTML.= "<tr><td class='forumheader3'>".LAN_ADMIN_201."</td><td class='forumheader3'>";
$out_HTML.= "<input class='tbox' type='checkbox' id='pv_img_Link_profileCom_extJS' name='pv_img_Link_profileCom_extJS' value='on' ";
if ($PView -> getPView_config('img_Link_profileCom_extJS')) {
$out_HTML.= "checked='checked' ";
}
$out_HTML.= "/>".LAN_ADMIN_210.LAN_ADMIN_204."</p>";
$out_HTML.= "<p>".LAN_ADMIN_209."</p>";
$out_HTML.= "</td></tr>";
$out_HTML.= "</table>";

// Submit Button for all values!
$out_HTML.= "<div style='padding:10px; text-align:center;'><input class='button' id='pv_submitbtn' name='pv_submitbtn' type='submit' value='".LAN_ADMIN_192."'>&nbsp;";
$out_HTML.= "</form>";

$ns->tablerender(LAN_ADMIN_179, $out_HTML);


require_once(e_ADMIN."footer.php");