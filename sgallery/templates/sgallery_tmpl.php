<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|       Template File: e107_plugins/sgallery/templates/sgallery_tmpl.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:96%"); } 

if(!defined('SGAL_NOPIC_MAIN')) define('SGAL_NOPIC_MAIN', SGAL_IMAGES_ABS.'gallery_120.png');

if(!defined('SGAL_BREADC_CHAR')) define('SGAL_BREADC_CHAR', ' &raquo; ');

if(!defined('SGAL_BC_SITENAME')) define('SGAL_BC_SITENAME', 0);

$adop_icon = (file_exists(THEME."images/newsedit.png") ? THEME."images/newsedit.png" : e_IMAGE."generic/".IMODE."/newsedit.png");
$adop_img = "<img src='".$adop_icon."' alt='' style='border: 0px none; vertical-align: top;' />";

// ##### GALLERY TABLE --------------------------------------------------------------------------------
//Gallery list header
if(!$SGALLERY_GAL_TABLE_START){
    $SGALLERY_GAL_TABLE_START = "
    <div style='text-align:center; margin: 0px auto'>
    <table class='fborder' style='".USER_WIDTH."'>
    <tr>
    <td class='fcaption' style='text-align:left;'><div style='float: right'><!-- -->{SGAL_GAL_UALBUMSLINK}&nbsp;{SGAL_GAL_UALBUMSLINK=my%%|&nbsp;%%&nbsp;}{SGAL_ITEM_USERCREATE=|&nbsp;}</div>{SGAL_BREADC}</td>
    </tr>
    <tr>
    <td class='forumheader' style='text-align: center; width: 100%;'>
     <table cellspacing='3' cellpadding='0' style='width: 100%;'>
    ";
}

//Gallery list row start 
/*it will be printed out when $pref['sgal_galperrow'] is reached during the galeries loop
    if you've set $pref['sgal_galperrow'] = 0, pre and post template vars will not be printed out 
    only body template will be used (usefull with div tag with style float: left and no tr and td tags)
    $pref['sgal_galperrow'] should be a divisor of 100 (eg 2,4,5...). However value 3 is working Ok too.
*/
if(!isset($SGALLERY_GAL_TABLE_BODY_PRE)){
    $SGALLERY_GAL_TABLE_BODY_PRE .= "
        <tr>
        
    ";
}

//$sc_style['SGAL_GAL_DESCRIPTION']['pre'] = "";           
//$sc_style['SGAL_GAL_DESCRIPTION']['post'] = "";
//Gallery list row body - loop
if(!$SGALLERY_GAL_TABLE_BODY){
    $SGALLERY_GAL_TABLE_BODY .= "
        <td class='forumheader2' style='text-align: left; vertical-align: top; width: {SGAL_GALROW_W};'>
            <table cellspacing='0' cellpadding='0' style='width: 100%; border: 0px none'>
            <tr>
               <td colspan='2' style='text-align: left;width: 100%;'><h3><a href='{SGAL_GAL_LINK}'>{SGAL_GAL_TITLE}</a>{SGAL_ITEM_ADMINEDIT=gallery%%&nbsp;%%%%".$adop_img."}</h3></td>
            </tr>
            <tr>
               <td style='text-align: center; vertical-align: middle; width: {THIMG_MAX_WH}px;'><div style='border: 1px solid #c0c0c0'>{SGAL_GAL_MAINIMG_LINK}</div></td>
               <td style='text-align: left; vertical-align: top; padding: 10px;width: 100%;'>".SGAL_LAN_2.": {SGAL_GAL_ALBUMCNT}<br />".SGAL_LAN_3.": {SGAL_GAL_PICCNT}<br />".SGAL_LAN_13.": {SGAL_GAL_VIEWCNT}</td>
            </tr>
            <tr>
                <td class='smalltext' colspan='2' style='text-align: left; padding: 15px 5px;width: 100%;'><!-- -->{SGAL_GAL_DESCRIPTION=100%%}</td>
            </tr>
            </table>
        </td>
    ";
}

//Gallery list row empty body - loop
/*it will be printed out until $pref['sgal_galperrow'] is reached (when there is no more galeries - after the Galeries loop)*/
if(!$SGALLERY_GAL_TABLE_EBODY){
    $SGALLERY_GAL_TABLE_EBODY .= "
        <td class='forumheader' style='text-align: center; width: {SGAL_GALROW_W}; border: 0px none'>
            &nbsp;
        </td>
    ";
}

//Gallery list row end
/*it will be printed out when $pref['sgal_galperrow'] is reached during the galleries loop*/
if(!isset($SGALLERY_GAL_TABLE_BODY_POST)){
    $SGALLERY_GAL_TABLE_BODY_POST .= "
        </tr>
    ";
}

//Gallery list - no records
if(!$SGALLERY_GAL_TABLE_EMPTY){
    $SGALLERY_GAL_TABLE_EMPTY .= "
        <tr><td>".SGAL_LAN_50."</td></tr>
    ";
}

//Gallery list footer
if(!$SGALLERY_GAL_TABLE_END){
    $SGALLERY_GAL_TABLE_END = "
    </table>
    </td>
    </tr>
    <tr>
        <td class='forumheader3' style='text-align:right; width: 100%'>
            <div style='float: left'>{SGAL_LATEST_PICTURESLINK}</div>
            ".SGAL_LAN_4." <strong>{SGAL_GAL_TFILES}</strong> ".SGAL_LAN_5." ".SGAL_LAN_6." <strong>{SGAL_GAL_TGALS}</strong> ".SGAL_LAN_7." ".SGAL_LAN_9." <strong>{SGAL_GAL_TALBUMS}</strong> ".SGAL_LAN_8."
        </td>
    </tr>
    </table>
    </div>\n";
}
// ##### ------------------------------------------------------------------------------------------

// ##### ALBUM LIST TABLE --------------------------------------------------------------------------------
//Album list header
if(!$SGALLERY_ALBUM_TABLE_START){
    $SGALLERY_ALBUM_TABLE_START = "
    <div style='text-align:center; margin: 0px auto'>
    <table class='fborder' style='".USER_WIDTH."'>
    <tr>
    <td class='fcaption' style='text-align:left;'><div style='float: right'><!-- -->{SGAL_GAL_UALBUMSLINK}&nbsp;{SGAL_GAL_UALBUMSLINK=my%%|&nbsp;%%&nbsp;}{SGAL_ITEM_USERCREATE=|&nbsp;}</div>{SGAL_BREADC}</td>
    </tr>
    {SGAL_GALINFO}
   	<tr>
    <td class='forumheader' style='text-align: center; width: 100%;'>
     <table cellspacing='3' cellpadding='0' style='width: 100%;'>
    ";
}

if(!$SGALLERY_ALBUM_GALINFO){
    $SGALLERY_ALBUM_GALINFO = "
    <tr>
        <td class='fcaption' style='text-align:left; width: 100%'>
            <div style='float: right'>{SGAL_ALBUM_LATEST_LINK}</div>
            <h2>{SGAL_GAL_TITLE}{SGAL_ITEM_ADMINEDIT=gallery%%&nbsp;%%%%".$adop_img."}</h2>
            {SGAL_GAL_DESCRIPTION=%%%%<br /><br />}
            (".SGAL_LAN_13.": {SGAL_GAL_VIEWCNT})
        </td>
    </tr>
    ";
}

//Album list row start 
/*it will be printed out when $pref['sgal_albumperrow'] is reached during the albums loop
    if you've set $pref['sgal_albumperrow'] = 0, pre and post template vars will not be printed out 
    only body template will be used (usefull with div tag with style float: left and no tr and td tags)
    $pref['sgal_albumperrow'] should be a divisor of 100 (eg 2,4,5...). However value 3 is working Ok too.
*/
if(!isset($SGALLERY_ALBUM_TABLE_BODY_PRE)){
    $SGALLERY_ALBUM_TABLE_BODY_PRE .= "
        <tr>
        
    ";
}

//Album list row body - loop
if(!$SGALLERY_ALBUM_TABLE_BODY){
    $SGALLERY_ALBUM_TABLE_BODY .= "
        <td class='forumheader2' style='text-align: left; vertical-align: top; width: {SGAL_ALBUM_W};'>
            <table cellspacing='0' cellpadding='0' style='width: 100%; border: 0px none; font-weight: normal'>
			<tr>
               <td colspan='2' style='text-align: left; width: 100%;'><h3><a href='{SGAL_ALBUM_LINK}'>{SGAL_ALBUM_TITLE}</a>{SGAL_ITEM_ADMINEDIT=%%&nbsp;%%%%".$adop_img."}</h3></td>
            </tr>
            <tr>
               <td style='text-align: center; vertical-align: top; width: {THIMG_MAX_WH}px;'><div style='border: 1px solid #c0c0c0'>{SGAL_ALBUM_MAINIMG_LINK}</div></td>
               <td style='text-align: left; width: 100%; vertical-align: top; padding: 0px 10px'>
				   ".SGAL_LAN_13.": {SGAL_ALBUM_VIEWCNT}<br />
				   ".SGAL_LAN_10.": {SGAL_ALBUM_FILES}
				   {SGAL_ALBUM_USERDATA=profile%%<br /><br /><strong>".SGAL_LAN_15.":</strong><br />%%}
			   </td>
            </tr>
            <tr>
                <td class='smalltext' colspan='2' style='text-align: left; padding: 8px 8px 8px 0px;width: 100%;'>
                {SGAL_ALBUM_DESCRIPTION=100}
                </td>
            </tr>
			<tr>
				<td class='smalltext' colspan='2' style='text-align: left;'>
					{SGAL_USER_UALBUMSLINK}{SGAL_ITEM_USEREDIT=&nbsp;|&nbsp;}
				</td>
			</tr>
            </table>
        </td>
    ";
}

//Album list row empty body - loop
/*it will be printed out until $pref['sgal_albumperrow'] is reached (when there is no more albums - after the Albums loop)*/
if(!$SGALLERY_ALBUM_TABLE_EBODY){
    $SGALLERY_ALBUM_TABLE_EBODY .= "
        <td class='forumheader' style='text-align: center; width: {SGAL_ALBUM_W}; border: 0px none'>
            &nbsp;
        </td>
    ";
}

//Album list row end
/*it will be printed out when $pref['sgal_albumperrow'] is reached during the Albums loop*/
if(!isset($SGALLERY_ALBUM_TABLE_BODY_POST)){
    $SGALLERY_ALBUM_TABLE_BODY_POST .= "
        </tr>
        
    ";
}

//Album list - no records
if(!$SGALLERY_ALBUM_TABLE_EMPTY){
    $SGALLERY_ALBUM_TABLE_EMPTY .= "
        <tr><td>".SGAL_LAN_51."</td></tr>
    ";
}

//Album list footer
if(!$SGALLERY_ALBUM_TABLE_END){
    $SGALLERY_ALBUM_TABLE_END = "
    </table>
    </td>
    </tr>
    <tr>
        <td class='forumheader3' style='text-align:left; width: 100%'>
            <div style='float: right'>{SGAL_ALBUM_PAGES}</div>".SGAL_LAN_4." <strong>{SGAL_ALBUM_TFILES}</strong> ".SGAL_LAN_5." ".SGAL_LAN_6." <strong>{SGAL_ALBUM_TALBUMS}</strong> ".SGAL_LAN_8." ".SGAL_LAN_11."
        </td>
    </tr>
    </table>
    </div>\n";
}
// ##### ------------------------------------------------------------------------------------------

// ##### LATEST PICTURES TABLE -------------------------------------------------------------------------------
//Album Image view - header
if(!$SGALLERY_LATEST_TABLE_START){
    $SGALLERY_LATEST_TABLE_START = "
    <div style='text-align:center; margin 0px auto;'>
    <table class='fborder' style='".USER_WIDTH."'>
    <tr>
   		<td class='fcaption' style='text-align:left; width: 100%'>
			<div style='float: right'><!-- -->{SGAL_GAL_UALBUMSLINK}&nbsp;{SGAL_GAL_UALBUMSLINK=my%%|&nbsp;%%&nbsp;}{SGAL_ITEM_USERCREATE=|&nbsp;}</div>
			{SGAL_BREADC}
		</td>
    </tr>
    <tr>
        <td class='forumheader' style='text-align:left; width: 100%'>
            <h2>".SGAL_LAN_25."</h2>
        </td>
    </tr>
    <tr>
        <td class='forumheader3' style='text-align: center; width: 100%; padding: 0px'>
        <!-- ALBUM BODY TABLE -->
         <table cellspacing='3' cellpadding='0' style='width: 100%; border: 0px none'>
    ";
}

//Image item - loop
if(!$SGALLERY_LATEST_TABLE_BODY){
	$SGALLERY_LATEST_TABLE_BODY .= "
	
        <td class='forumheader2' style='text-align: left; vertical-align: top; width: {SGAL_ALBUM_W};'>
            <table cellspacing='0' cellpadding='0' style='width: 100%; border: 0px none; font-weight: normal'>
			<tr>
               <td colspan='2' style='text-align: left; width: 100%;'><h3><a href='{SGAL_ALBUM_LINK}'>{SGAL_ALBUM_TITLE}</a></h3></td>
            </tr>
            <tr>
               <td style='text-align: center; vertical-align: top; width: {THIMG_MAX_WH}px;'><div style='border: 1px solid #c0c0c0'>{SGAL_ALBUM_IMGTABLE}</div></td>
               <td style='text-align: left; width: 100%; vertical-align: top; padding: 0px 10px'>
				   {SGAL_ALBUM_USERDATA=profile%%<br /><br /><strong>".SGAL_LAN_15.":</strong><br />%%}
			   </td>
            </tr>
			<tr>
				<td class='smalltext' colspan='2' style='text-align: left;'>
					{SGAL_USER_UALBUMSLINK}{SGAL_ITEM_USEREDIT=&nbsp;|&nbsp;}
				</td>
			</tr>
            </table>
        </td>
    ";
}

if(!isset($SGALLERY_LATEST_TABLE_BODY_PRE)){
    $SGALLERY_LATEST_TABLE_BODY_PRE .= "
        <tr>
        
    ";
}

if(!$SGALLERY_LATEST_TABLE_EBODY){
	$SGALLERY_LATEST_TABLE_EBODY .= "
    <td class='forumheader2' style='text-align: center; width: {SGAL_VIEW_W}; border: 0px none'>
	 &nbsp;
	</td>
    ";
}

if(!isset($SGALLERY_LATEST_TABLE_BODY_POST)){
    $SGALLERY_LATEST_TABLE_BODY_POST .= "
        </tr>
        
    ";
}

//no records
if(!$SGALLERY_LATEST_TABLE_EMPTY){
    $SGALLERY_LATEST_TABLE_EMPTY .= "
    <div style='text-align:center'>
    <table class='fborder' style='".USER_WIDTH."'>
    <tr>
    <td class='forumheader' style='text-align:left; width: 100%'>{SGAL_BREADC}</td>
    </tr>
    <tr>
        <td class='forumheader3' style='text-align: center; width: 100%; padding: 0px'>
         <table cellspacing='3' cellpadding='0' style='width: 100%; border: 0px none'>
        <tr><td>".SGAL_LAN_54."</td></tr>
    ";
}

//footer
if(!$SGALLERY_LATEST_TABLE_END){
	$SGALLERY_LATEST_TABLE_END = "
	   </table>
	   <!-- ALBUM BODY TABLE END -->
	   </td>
	</tr>
    <tr>
        <td class='forumheader3' style='text-align:right; width: 100%;'>{SGAL_IMG_PAGES}</td>
    </tr>
	</table>
	</div>\n";
}


// ##### ALBUM VIEW TABLE -------------------------------------------------------------------------------
//Album Image view - header
//$sc_style['SGAL_ALBUMVIEW_DESCRIPTION']['pre'] = "<br /><span class='smalltext'>";
//$sc_style['SGAL_ALBUMVIEW_DESCRIPTION']['post'] = '</span>';
if(!$SGALLERY_VIEW_TABLE_START){
    $SGALLERY_VIEW_TABLE_START = "
    <div style='text-align:center; margin 0px auto;'>
    <table class='fborder' style='".USER_WIDTH."'>
    <tr>
   		<td class='fcaption' style='text-align:left; width: 100%'>
			<div style='float: right'><!-- -->{SGAL_GAL_UALBUMSLINK}&nbsp;{SGAL_GAL_UALBUMSLINK=my%%|&nbsp;%%&nbsp;}{SGAL_ITEM_USERCREATE=|&nbsp;}</div>
			{SGAL_BREADC}
		</td>
    </tr>
    <tr>
        <td class='forumheader' style='text-align:left; width: 100%'>
            <h2>{SGAL_ALBUM_TITLE}{SGAL_ITEM_ADMINEDIT=album%%&nbsp;%%%%".$adop_img."}</h2>
            {SGAL_ALBUM_USERDATA=profile%%<strong>".SGAL_LAN_15."</strong>:&nbsp;%%,&nbsp;}{SGAL_ALBUM_DATE}<br />
            {SGAL_ALBUMVIEW_DESCRIPTION}<br /><br />
            {SGAL_ALBUM_RATING=%%<br /><br />}
            ".SGAL_LAN_13.": {SGAL_ALBUM_VIEWCNT}{SGAL_USER_UALBUMSLINK=&nbsp;|&nbsp;}{SGAL_ITEM_USEREDIT=&nbsp;|&nbsp;}
        </td>
    </tr>
    <tr>
        <td class='forumheader3' style='text-align: center; width: 100%; padding: 0px'>
        <!-- ALBUM BODY TABLE -->
         <table cellspacing='3' cellpadding='0' style='width: 100%; border: 0px none'>
    ";
}

//Album image view row start 
/*it will be printed out when $pref['sgal_picperrow'] is reached during the images loop
    if you've set $pref['sgal_picperrow'] = 0, pre and post template vars will not be printed out 
    only body template will be used (usefull with div tag with style float: left and no tr and td tags)
    $pref['sgal_picperrow'] should be a divisor of 100 (eg 2,4,5...). However value 3 is working Ok too.
*/
if(!isset($SGALLERY_VIEW_TABLE_BODY_PRE)){
    $SGALLERY_VIEW_TABLE_BODY_PRE .= "
        <tr>
        
    ";
}

//Album Image view - loop
if(!$SGALLERY_VIEW_TABLE_BODY){
	$SGALLERY_VIEW_TABLE_BODY .= '
    <td class="forumheader2" style="text-align: center; width: {SGAL_VIEW_W}; height: 120px; border: 0px none">
		{SGAL_ALBUM_IMGTABLE}		
	</td>
    ';
}

//Album Image view - empty loop
if(!$SGALLERY_VIEW_TABLE_EBODY){
	$SGALLERY_VIEW_TABLE_EBODY .= "
    <td class='forumheader2' style='text-align: center; width: {SGAL_VIEW_W}; border: 0px none'>
	 &nbsp;
	</td>
    ";
}

//Album Image view row end
/*it will be printed out when $pref['sgal_picperrow'] is reached during the images loop*/
if(!isset($SGALLERY_VIEW_TABLE_BODY_POST)){
    $SGALLERY_VIEW_TABLE_BODY_POST .= "
        </tr>
        
    ";
}

//Album Image view - no records
if(!$SGALLERY_VIEW_TABLE_EMPTY){
    $SGALLERY_VIEW_TABLE_EMPTY .= "
    <div style='text-align:center'>
    <table class='fborder' style='".USER_WIDTH."'>
    <tr>
    <td class='forumheader' style='text-align:left; width: 100%'>{SGAL_BREADC}</td>
    </tr>
    <tr>
        <td class='forumheader3' style='text-align: center; width: 100%; padding: 0px'>
        <!-- ALBUM BODY TABLE -->
         <table cellspacing='3' cellpadding='0' style='width: 100%; border: 0px none'>
        <tr><td>".SGAL_LAN_55."</td></tr>
    ";
}

//Album Image view - footer
if(!$SGALLERY_VIEW_TABLE_END){
	$SGALLERY_VIEW_TABLE_END = "
	   </table>
	   <!-- ALBUM BODY TABLE END -->
	   </td>
	</tr>
    <tr>
        <td class='forumheader3' style='text-align:right; width: 100%;'><div style='float: left'>{SGAL_LATEST_PICTURESLINK}</div>{SGAL_IMG_PAGES}</td>
    </tr>
    <!-- ALBUM TABLE END -->
	</table>
	</div>\n";
}
// ##### ------------------------------------------------------------------------------------------


// ##### ALBUM IMAGE -------------------------------------------------------------------------------
// Image Item template - will replace SGAL_ALBUM_IMGTABLE in $SGALLERY_VIEW_TABLE_BODY
// More available shortcodes: THIMG_MAX_WH - max width/height
if(!$SGALLERY_ALBUM_IMAGE){
	$SGALLERY_ALBUM_IMAGE = " 
    <!-- IMG TABLE -->
		{SGAL_ALBUM_IMGLINK}
    <!-- IMG TABLE -->
    ";
}
// ##### ------------------------------------------------------------------------------------------
?>