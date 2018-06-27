<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Template File: e107_plugins/sgallery/templates/sgallery_manager_tmpl.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:96%"); } 

if(!defined('SGAL_NOPIC_MAIN')) define('SGAL_NOPIC_MAIN', SGAL_IMAGES_ABS.'gallery_120.png');

if(!defined('SGAL_BREADC_CHAR')) define('SGAL_BREADC_CHAR', ' &raquo; ');

if(!defined('SGAL_BC_SITENAME')) define('SGAL_BC_SITENAME', 0);

// ##### GALLERY TABLE --------------------------------------------------------------------------------
//Manager header & Info form
if(!$SGALLERY_MNG_TABLE_START){
    $SGALLERY_MNG_TABLE_START = "
<div style='text-align:center'>
<table class='fborder' style='".USER_WIDTH."'>
<tr>
    <td colspan='2' class='fcaption' style='text-align:left; width: 100%'>
        <div style='float: right'><!-- -->{SGAL_GAL_UALBUMSLINK}&nbsp;{SGAL_GAL_UALBUMSLINK=my%%|&nbsp;%%&nbsp;}{SGAL_ITEM_USERCREATE=|&nbsp;}</div>{SGAL_BREADC}
    </td>
</tr>
    ";
}

//manager edit body
if(!$SGALLERY_MNG_EDIT_BODY){
    $SGALLERY_MNG_EDIT_BODY = "
<tr>
    <td colspan='2' class='forumheader3' style='text-align:left; width: 100%'>
        {SGAL_ALBUM_DATE}, {SGAL_ALBUM_USERDATA=profile%%".SGAL_LAN_15.":&nbsp;}&nbsp;&nbsp;[<a href='{SGAL_ALBUM_LINK}'>".SGAL_LANMNG_4."</a>]<br /><br />
    </td>
</tr>
<tr>
<td colspan='2' class='fcaption' style='text-align:left; width: 100%'>".SGAL_LANMNG_0."</td>
</tr>
<tr>
    <td class='forumheader3' style='text-align:left; width: 20%; vertical-align: top'>
        <span style='text-decoration: underline;'>".SGAL_LANMNG_29."</span><br />
        ".SGAL_LANMNG_30.": <em>{SGAL_USER_ALSTATUS}</em><br />
        ".SGAL_LANMNG_31.": <em>{SGAL_USER_ALPREFSIZE}</em><br />
        ".SGAL_LANMNG_32.": <em>{SGAL_USER_ALPICSIZE}</em><br />
        <br /><span style='text-decoration: underline;'>".SGAL_LANMNG_33."</span><br />
        ".SGAL_LANMNG_34.": <em>{SGAL_USER_PICPREFNUMBER}</em><br />
        ".SGAL_LANMNG_35.": <em>{SGAL_USER_ALPICNUMBER}</em><br />
        ".SGAL_LANMNG_36.": <em>{SGAL_USER_ALAWPICNUMBER}</em><br />
        <br /><span style='text-decoration: underline;'>".SGAL_LANMNG_37."</span><br />
        ".SGAL_LANMNG_31.": <em>{SGAL_USER_TOTALPREFSIZE}</em><br />
        ".SGAL_LANMNG_32.": <em>{SGAL_USER_TOTALPICSIZE}</em><br />
        ".SGAL_LANMNG_38.": <em>{SGAL_USER_ALPREFNUMBER}</em><br />
        ".SGAL_LANMNG_39.": <em>{SGAL_USER_ALBUMNUMBER}</em><br />
    </td>
    <td class='forumheader3' style='text-align:left; width: 80%; vertical-align: top'>
        {DATA_FORM_OPEN}
        {SGAL_CATEGORY_BOX}
        <table style='width: 100%' cellpadding='5' cellspacing='5'>
        <tr>
            <td>".SGAL_LANMNG_8.":</td>
        </tr>
        <tr>
            <td>{TITLE_FIELD}</td>
        </tr>
        <tr>
            <td>".SGAL_LANMNG_9.":<br />{DESCRIPTION_FIELD}</td>
        </tr>
        <tr>
            <td style='text-align: left'>{DATA_FORM_SUBMIT}</td>
        </tr>
        </table>
        {DATA_FORM_CLOSE}
    </td>
</tr>
    ";
}


//manager create body
//SGAL_CATEGORY_BOX parms -> Empty msg | pre | post 
$cat_box_pre = "<tr><td>".SGAL_GALLERY.":</td></tr><tr><td>";
$cat_box_post = "</td></tr>";
if(!$SGALLERY_MNG_CREATE_BODY){
    $SGALLERY_MNG_CREATE_BODY = "
<tr>
    <td class='forumheader3' style='text-align:left; width: 20%; vertical-align: top'>
        <span style='text-decoration: underline;'>".SGAL_LANMNG_29."</span><br />
        ".SGAL_LANMNG_30.": <em>{SGAL_USER_ALSTATUS}</em><br />
        ".SGAL_LANMNG_31.": <em>{SGAL_USER_ALPREFSIZE}</em><br />
        ".SGAL_LANMNG_32.": <em>{SGAL_USER_ALPICSIZE}</em><br />
        <br /><span style='text-decoration: underline;'>".SGAL_LANMNG_33."</span><br />
        ".SGAL_LANMNG_34.": <em>{SGAL_USER_PICPREFNUMBER}</em><br />
        ".SGAL_LANMNG_35.": <em>{SGAL_USER_ALPICNUMBER}</em><br />
        ".SGAL_LANMNG_36.": <em>{SGAL_USER_ALAWPICNUMBER}</em><br />
        <br /><span style='text-decoration: underline;'>".SGAL_LANMNG_37."</span><br />
        ".SGAL_LANMNG_31.": <em>{SGAL_USER_TOTALPREFSIZE}</em><br />
        ".SGAL_LANMNG_32.": <em>{SGAL_USER_TOTALPICSIZE}</em><br />
        ".SGAL_LANMNG_38.": <em>{SGAL_USER_ALPREFNUMBER}</em><br />
        ".SGAL_LANMNG_39.": <em>{SGAL_USER_ALBUMNUMBER}</em><br />
    </td>
    <td class='forumheader3' style='text-align:left; width: 80%; vertical-align: top'>
        {DATA_FORM_OPEN}
        <table style='width: 100%' cellpadding='5' cellspacing='5'>
        {SGAL_CATEGORY_BOX=%%".$cat_box_pre."%%".$cat_box_post."}
        <tr>
            <td>".SGAL_LANMNG_8.":</td>
        </tr>
        <tr>
            <td>{TITLE_FIELD}</td>
        </tr>
        <tr>
            <td>".SGAL_LANMNG_9.":<br />{DESCRIPTION_FIELD}</td>
        </tr>
        <tr>
            <td style='text-align: left'>{DATA_FORM_SUBMIT}</td>
        </tr>
        </table>
        {DATA_FORM_CLOSE}
    </td>
</tr>
    ";
}

//Upload form
if(!$SGALLERY_MNG_TABLE_ULPOAD){
    $SGALLERY_MNG_TABLE_ULPOAD .= "
<tr>
    <td colspan='2' class='fcaption' style='text-align:left; width: 100%'>".SGAL_LANMNG_1."</td>
</tr>
<tr>
    <td class='forumheader2' style='text-align: center; vertical-align: top; width: 20%'>".SGAL_LANMNG_3."<div style='clear: both; padding: 5px'><!-- --></div>{SGAL_ALBUM_MAINIMG}</td>
    <td class='forumheader2' style='text-align: left; vertical-align: top; padding: 10px; width: 20%'>
        {UPLOAD_FORM}
    </td>
</tr>
{PUBLISHXP}
    ";
}

//XP publish
if(!$SGALLERY_MNG_TABLE_PUBLISHXP){
    $SGALLERY_MNG_TABLE_PUBLISHXP .= "
<tr>
    <td colspan='2' class='fcaption' style='text-align:left; width: 100%'>".SGAL_LANMNG_28."</td>
</tr>
<tr>
    <td colspan='2' class='forumheader2' style='text-align: left; vertical-align: top; padding: 5px'>
        <a href='#' onclick='expandit(this); return false'>".SGAL_LANMNG_6."</a>
        <div style='display: none; margin-top: 10px'>
            <em>".SGAL_LANMNG_28a."</em><br />".SGAL_LANMNG_28b."<br /><br />
            <strong>".SGAL_LANMNG_28c."</strong>
            <p>
            ".SGAL_LANMNG_28i.": {DOWNLOAD_REG_FILE}<br />
            ".SGAL_LANMNG_28l."<br />
            ".SGAL_LANMNG_28j.": {DOWNLOAD_XPREG_FILE}<br />
            ".SGAL_LANMNG_28k.": {DOWNLOAD_VISTAREG_FILE}<br />
            <br />".SGAL_LANMNG_28e."
            </p>
            <strong>".SGAL_LANMNG_28f."</strong>
            <p>
            ".SGAL_LANMNG_28g."
            ".SGAL_LANMNG_28h."
            </p>
        </div>
    </td>
</tr>
    ";
}

//Gallery list row body - loop
if(!$SGALLERY_MNG_TABLE_IMAGES){
    $SGALLERY_MNG_TABLE_IMAGES .= "
<tr>
<td colspan='2' class='fcaption' style='text-align:left; width: 100%'>".SGAL_LANMNG_2."</td>
</tr>
<tr>
<td colspan='2' class='forumheader2' style='text-align: left; vertical-align: top; padding: 5px;'>{IMAGE_AND_ACTIONS}</td>
</tr>
    ";
}

//Gallery list row body - loop
if(!$SGALLERY_MNG_AWAITING_IMAGES){
    $SGALLERY_MNG_AWAITING_IMAGES .= "
<tr>
<td colspan='2' class='fcaption' style='text-align:left; width: 100%'>".SGAL_LANMNG_21."</td>
</tr>
<tr>
<td colspan='2' class='forumheader2' style='text-align: left; vertical-align: top; padding: 5px;'>{IMAGE_AWAITING}</td>
</tr>
    ";
}


//Gallery list footer
if(!$SGALLERY_MNG_TABLE_END){
    $SGALLERY_MNG_TABLE_END = "
<tr>
    <td colspan='2' class='forumheader' style='text-align:right; width: 100%'>
        <a href='{SGAL_ALBUM_LINK}'>".SGAL_LANMNG_4."</a> | <a href='#'>".SGAL_LANMNG_5."</a>
    </td>
</tr>
</table>
</div>\n";
}
// ##### ------------------------------------------------------------------------------------------
?>