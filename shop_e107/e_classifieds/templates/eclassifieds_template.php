<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) {
    exit;
}
if (!defined('USER_WIDTH')) {
    define(USER_WIDTH, 'width:100%');
}
global $eclassf_shortcodes;
// *******************************************************************************************
// *
// *	Display advert page
// *
// *******************************************************************************************
if (!isset($ECLASSF_ITEM_HEAD)) {
    $ECLASSF_ITEM_HEAD = '
<table class="fborder" style="' . USER_WIDTH . ';">
	<tr>
		<td class="fcaption" colspan="2">{ECLASSF_ITEMHEAD}</td>
	</tr>';
    if (file_exists('./images/logo.png')) {
        $ECLASSF_ITEM_HEAD .= '
	<tr>
		<td class="forumheader2" style="text-align:center;" colspan="2">&nbsp;</td>
	</tr>';
        $ECLASSF_ITEM_HEAD .= '
	<tr>
		<td class="forumheader2" style="text-align:left;" colspan="2">{ECLASSF_ITEMUPDIR}&nbsp;&nbsp;{ECLASSF_ITEMPRINT}&nbsp;&nbsp;{ECLASSF_ITEMEMAIL}&nbsp;&nbsp;{ECLASSF_SENDPM}&nbsp;&nbsp;{ECLASSF_EDIT}</td>
	</tr>';
    }
}
// shortcode prefixes
// ECLASSF_ITEMPICTURE
$sc_style['ECLASSF_ITEMPICTURE']['pre'] = '
	<tr>
		<td class="forumheader3" style="width:20%;">' . ECLASSF_9 . '</td>
		<td class="forumheader3" id="eclassf_piccell">';
$sc_style['ECLASSF_ITEMPICTURE']['post'] = '
		</td>
	</tr>';
// ECLASSF_ITEMVIEWS
$sc_style['ECLASSF_ITEMVIEWS']['pre'] = '
		<tr>
		<td class="forumheader3" style="width:20%;">' . ECLASSF_86 . '</td>
		<td class="forumheader3">';
$sc_style['ECLASSF_ITEMVIEWS']['post'] = '
		</td>
	</tr>';
// ECLASSF_ITEMDETAILS
$sc_style['ECLASSF_ITEMDETAILS']['pre'] = '
	<tr>
		<td class="forumheader3" style="width:20%;">' . ECLASSF_10 . '</td>
		<td class="forumheader3">';
$sc_style['ECLASSF_ITEMDETAILS']['post'] = '
		</td>
	</tr>';
// ECLASSF_ITEMPHONE
$sc_style['ECLASSF_ITEMPHONE']['pre'] = '
	<tr>
		<td class="forumheader3" style="width:20%;">' . ECLASSF_12 . '</td>
		<td class="forumheader3"> ';
$sc_style['ECLASSF_ITEMPHONE']['post'] = '
		</td>
	</tr>';
// ECLASSF_ITEMPRICE
$sc_style['ECLASSF_ITEMPRICE']['pre'] = '
		<tr>
		<td class="forumheader3" style="width:20%;">' . ECLASSF_60 . '</td>
		<td class="forumheader3"> ';
$sc_style['ECLASSF_ITEMPRICE']['post'] = '
		</td>
	</tr>';
// ECLASSF_ITEMEXPIRES
$sc_style['ECLASSF_ITEMEXPIRES']['pre'] = '
		<tr>
		<td class="forumheader3" style="width:20%;">' . ECLASSF_135 . '</td>
		<td class="forumheader3"> ';
$sc_style['ECLASSF_ITEMEXPIRES']['post'] = '
		</td>
	</tr>';
// ECLASSF_ITEMLOCATION
$sc_style['ECLASSF_ITEMLOCATION']['pre'] = '
		<tr>
		<td class="forumheader3" style="width:20%;">' . ECLASSF_136 . '</td>
		<td class="forumheader3">';
$sc_style['ECLASSF_ITEMLOCATION']['post'] = '
		</td>
	</tr>';
if (!isset($ECLASSF_ITEM_DETAIL)) {
    $ECLASSF_ITEM_DETAIL = '
	<tr>
		<td class="forumheader3" style="width:20%;">' . ECLASSF_7 . '</td>
		<td class="forumheader3">{ECLASSF_ITEMNAME}&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:20%;">' . ECLASSF_8 . '</td>
		<td class="forumheader3">{ECLASSF_ITEMDESC}&nbsp;</td>
	</tr>
	{ECLASSF_ITEMLOCATION}
	{ECLASSF_ITEMPICTURE}
	{ECLASSF_ITEMDETAILS}
	<tr>
		<td class="forumheader3" style="width:20%;">' . ECLASSF_11a . '</td>
		<td class="forumheader3">{ECLASSF_POSTERNAME}</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:20%;">Anbieter</td>
		<td class="forumheader3">{ECLASSF_SELERRNAME}</td>
	</tr>
	{ECLASSF_ITEMPHONE}
    <tr>
		<td class="forumheader3" style="width:20%;">' . ECLASSF_13 . '</td>
		<td class="forumheader3">{ECLASSF_ITEMPOSTEREMAIL}&nbsp;</td>
	</tr>
	{ECLASSF_ITEMPRICE}
	{ECLASSF_ITEMVIEWS}
	{ECLASSF_ITEMEXPIRES}';
}
if (!isset($ECLASSF_ITEM_NONE)) {
    $ECLASSF_ITEM_NONE .= '
			<tr>
				<td class="forumheader3" colspan="2"">' . ECLASSF_44 . '</td>
			</tr>';
}
// *******************************************************************************************
// *
// *	List Sub Categories Page
// *
// *******************************************************************************************
if (!isset($ECLASSF_SUB_HEAD)) {
    // Template if not using drop downs
    $ECLASSF_SUB_HEAD = '
<table class="fborder" style="' . USER_WIDTH . ';">
	<tr>
		<td class="fcaption" colspan="{ECLASSF_SUBCOLSPAN}">{ECLASSF_SUBHEAD}</td>
	</tr>
		';
    if (file_exists('./images/logo.png')) {
        $ECLASSF_SUB_HEAD .= '
	<tr>
		<td class="forumheader2" style="width:30%;text-align:center;" colspan="{ECLASSF_SUBCOLSPAN}">&nbsp;</td>
	</tr>';
        $ECLASSF_SUB_HEAD .= '
	<tr>
		<td class="forumheader2" style="width:30%;text-align:left;" colspan="{ECLASSF_SUBCOLSPAN}">{ECLASSF_SUBUPDIR}</td>
	</tr>';
    }
    if ($ECLASSF_PREF['eclassf_icons'] > 0) {
        $ECLASSF_SUB_HEAD .= '
	<tr>
		<td class="forumheader2" style="width:10%;">&nbsp;</td>
		<td class="forumheader2" style="width:60%;"><b>' . ECLASSF_5 . '</b></td>
		<td class="forumheader2" style="width:30%;"><b>' . ECLASSF_6 . '</b></td>
	</tr>';
    }else {
        $ECLASSF_SUB_HEAD .= '
	<tr>
		<td class="forumheader2" style="width:70%;"><b>' . ECLASSF_5 . '</b></td>
		<td class="forumheader2" style="width:30%;"><b>' . ECLASSF_6 . '</b></td>
	</tr>';
    }
}
if (!isset($ECLASSF_SUB_DETAIL)) {
    // Template if not using drop downs
    if ($ECLASSF_PREF['eclassf_icons'] > 0) {
        $ECLASSF_SUB_DETAIL = '
	<tr>
		<td class="forumheader3" style="width:10%;text-align:left;">{ECLASSF_SUBICON}</td>
		<td class="forumheader3" style="width:60%;text-align:left;">{ECLASSF_SUBNAME}</td>
		<td class="forumheader3" style="width:30%;text-align:left;">{ECLASSF_SUBADVERTS}</td>
	</tr>';
    }else {
        $ECLASSF_SUB_DETAIL = '
	<tr>
		<td class="forumheader3" style="width:70%;text-align:left;">{ECLASSF_SUBNAME}</td>
		<td class="forumheader3" style="width:30%;text-align:left;">{ECLASSF_SUBADVERTS}</td>
	</tr>';
    }
}
if (!isset($ECLASSF_SUB_HEADDROP)) {
    // Template if using drop downs
    $ECLASSF_SUB_HEADDROP = '
<table class="fborder" style="' . USER_WIDTH . ';">
	<tr>
		<td class="fcaption" colspan="{ECLASSF_SUBCOLSPAN}">{ECLASSF_SUBHEAD}</td>
	</tr>
';
    if (file_exists('./images/logo.png')) {
        $ECLASSF_SUB_HEADDROP .= '
	<tr>
		<td class="forumheader2" style="width:30%;text-align:center;" colspan="{ECLASSF_SUBCOLSPAN}">&nbsp;</td>
	</tr>';
    }
    $ECLASSF_SUB_HEADDROP .= '
	<tr>
		<td class="forumheader2" style="text-align:left;" colspan="{ECLASSF_SUBCOLSPAN}">{ECLASSF_SUBUPDIR}</td>
	</tr>
	<tr>
		<td class="forumheader2" style="width:100%;"><strong>' . ECLASSF_5 . '</strong></td>
	</tr>	';
}
if (!isset($ECLASSF_SUB_DETAILDROP)) {
    // Template if using drop downs
    $ECLASSF_SUB_DETAILDROP = '
	<tr>
		<td class="forumheader3" style="width:70%;text-align:left;">{ECLASSF_SELECTOR} {ECLASSF_SUBMIT}</td>
	</tr>';
}
if (!isset($ECLASSF_SUB_NOAD)) {
    $ECLASSF_SUB_NOAD = '
	<tr>
		<td class="forumheader3" colspan="$eclassf_colspan">' . ECLASSF_51 . '</td>
	</tr>';
}
if (!isset($ECLASSF_SUB_FOOTER)) {
    $ECLASSF_SUB_FOOTER = '
</table>';
}
// *******************************************************************************************
// *
// *	List Categories Page
// *
// *******************************************************************************************
if (!isset($ECLASSF_CAT_HEAD)) {
    $ECLASSF_CAT_HEAD = '
<table class="fborder" style="' . USER_WIDTH . ';">
	<tr>
		<td class="fcaption" colspan="{ECLASSF_CAT_COLSPAN}">' . ECLASSF_4 . '</td>
	</tr>
	';
    if (file_exists('./images/logo.png')) {
        $ECLASSF_CAT_HEAD .= '
	<tr>
		<td class="forumheader2" style="text-align:center;" colspan="{ECLASSF_CAT_COLSPAN}">&nbsp;</td>
	</tr>';
    }
    $ECLASSF_CAT_HEAD .= '
	<tr>
		<td class="forumheader2" style="text-align:left;" colspan="{ECLASSF_CAT_COLSPAN}"><img src="./images/blank.png" alt="" style="border:0;"/></td>
	</tr>';
    if ($ECLASSF_PREF['eclassf_icons'] > 0) {
        $ECLASSF_CAT_HEAD .= '
    <tr>
		<td class="forumheader2" style="width:10%;">&nbsp;</td>
		<td class="forumheader2" style="width:25%;"><strong>' . ECLASSF_2 . '</strong></td>
		<td class="forumheader2" style="width:40%;"><strong>' . ECLASSF_3 . '</strong></td>
		<td class="forumheader2" style="width:25%;"><strong>' . ECLASSF_5 . '</strong></td>
	</tr>';
    }else {
        $ECLASSF_CAT_HEAD .= '
    <tr>
		<td class="forumheader2" style="width:25%;"><strong>' . ECLASSF_2 . '</strong></td>
		<td class="forumheader2" style="width:50%;"><strong>' . ECLASSF_3 . '</strong></td>
		<td class="forumheader2" style="width:25%;"><strong>' . ECLASSF_5 . '</strong></td>
	</tr>';
    }
}
if (!isset($ECLASSF_CAT_DETAIL)) {
    if ($ECLASSF_PREF['eclassf_icons'] > 0) {
        $ECLASSF_CAT_DETAIL = '
	<tr>
		<td class="forumheader3" style="width:10%;">{ECLASSF_CATICON}</td>
		<td class="forumheader3" style="width:25%;">{ECLASSF_CATNAME}</td>
		<td class="forumheader3" style="width:40%;">{ECLASSF_CATDESC}</td>
		<td class="forumheader3" style="width:25%;">{ECLASSF_CATSUB}</td>
	</tr>';
    }else {
        $ECLASSF_CAT_DETAIL = '
	<tr>
		<td class="forumheader3" style="width:25%;">{ECLASSF_CATNAME}</td>
		<td class="forumheader3" style="width:50%;">{ECLASSF_CATDESC}</td>
		<td class="forumheader3" style="width:25%;">{ECLASSF_CATSUB}</td>
	</tr>';
    }
}
if (!isset($ECLASSF_CAT_FOOTER)) {
    $ECLASSF_CAT_FOOTER = '
</table>';
} // *******************************************************************************************
// *
// *	List adverts page
// *
// *******************************************************************************************
if (!isset($ECLASSF_LIST_HEAD)) {
    // Heading for list adverts page
    $ECLASSF_LIST_HEAD = '
<table class="fborder" style="' . USER_WIDTH . ';">
	<tr>
		<td class="fcaption" colspan="{ECLASSF_LISTCOLSPAN}">{ECLASSF_LIST_CATNAME}</td>
	</tr>
	';
    if (file_exists('./images/logo.png')) {
        $ECLASSF_LIST_HEAD .= '
	<tr>
		<td class="forumheader2" style="text-align:center;" colspan="{ECLASSF_LISTCOLSPAN}">&nbsp;</td>
	</tr>';
    }
    $ECLASSF_LIST_HEAD .= '
	<tr>
		<td class="forumheader2" style="text-align:left;" colspan="{ECLASSF_LISTCOLSPAN}">{ECLASSF_LISTUPDIR}</td>
	</tr>';
    if ($ECLASSF_PREF['eclassf_thumbs'] > 0) {
        // If we are using thumbnails then extra column
        $ECLASSF_LIST_HEAD .= '
    <tr>
		<td class="forumheader2" style="width:10%; text-align:left;"><strong>'.ECLASSF_14a.'</strong></td>
		<td class="forumheader2" style="width:40%; text-align:left;"><strong>' . ECLASSF_15 . '</strong></td>
		<td class="forumheader2" style="width:15%; text-align:center;"><strong>' . ECLASSF_60 . '{ECLASSF_CURRENCY}</strong></td>
		<td class="forumheader2" style="width:20%; text-align:center;"><strong>' . ECLASSF_11 . '</strong></td>
		<td class="forumheader2" style="width:15%; text-align:center;"><strong>' . ECLASSF_16 . '</strong></td>
	</tr>';
    }else {
        $ECLASSF_LIST_HEAD .= '
    <tr>
		<td class="forumheader2" style="width:50%; text-align:left;"><strong>' . ECLASSF_15 . '</strong></td>
		<td class="forumheader2" style="width:15%; text-align:center;"><strong>' . ECLASSF_60 . '{ECLASSF_CURRENCY}</strong></td>
		<td class="forumheader2" style="width:20%; text-align:center;"><strong>' . ECLASSF_11 . '</strong></td>
		<td class="forumheader2" style="width:15%; text-align:center;"><strong>' . ECLASSF_16 . '</strong></td>
	</tr>';
    }
}
if (!isset($ECLASSF_LIST_DETAIL)) {
    // The individual rows of adverts
    if ($ECLASSF_PREF['eclassf_thumbs'] > 0) {
        $ECLASSF_LIST_DETAIL .= '
	<tr>
		<td class="forumheader3" style="width:10%;">{ECLASSF_LISTTHUMBS}</td>
		<td class="forumheader3" style="width:40%; text-align:left; vertical-align: top;">{ECLASSF_LISTNAME}<br /><br />{ECLASSF_ITEMDESC}</td>
		<td class="forumheader3" style="width:15%; text-align:center; vertical-align: top;">{ECLASSF_CURRENCY} {ECLASSF_LISTPRICE}</td>
		<td class="forumheader3" style="width:20%; text-align:center; vertical-align: top;">{ECLASSF_LISTPOSTER}</td>
		<td class="forumheader3" style="width:15%; text-align:center; vertical-align: top;">{ECLASSF_POSTED}</td>
	</tr>';
    }else {
        $ECLASSF_LIST_DETAIL .= '
	<tr>
		<td class="forumheader3" style="width:50%; text-align:left; vertical-align: top;">{ECLASSF_LISTNAME}<br /><br />{ECLASSF_ITEMDESC}</td>
		<td class="forumheader3" style="width:15%; text-align:center; vertical-align: top;">{ECLASSF_CURRENCY} {ECLASSF_LISTPRICE}</td>
		<td class="forumheader3" style="width:20%; text-align:center; vertical-align: top;">{ECLASSF_LISTPOSTER}</td>
		<td class="forumheader3" style="width:15%; text-align:center; vertical-align: top;">{ECLASSF_POSTED}</td>
	</tr>';
    }
}

if (!isset($ECLASSF_LIST_NORES)) {
    // Error message for no adverts found
    $ECLASSF_LIST_NORES = '
	<tr>
		<td class="forumheader3" colspan="{ECLASSF_LISTCOLSPAN}">' . ECLASSF_52 . '</td>
	</tr>';
}
if (!isset($ECLASSF_LIST_FOOTER)) {
    // List adverts footer - shows next prev if there are too many records
    $ECLASSF_LIST_FOOTER = '
	<tr>
		<td class="forumheader2" colspan="{ECLASSF_LISTCOLSPAN}">{ECLASSF_LISTNEXTPREV}</td>
	</tr>
</table>';
}
// *******************************************************************************************
// *
// *	Standard page footer
// *
// *******************************************************************************************
if (!isset($ECLASSF_FOOTER)) {
    $ECLASSF_FOOTER = '
<table class="fborder" style="' . USER_WIDTH . ';">
	<tr>
		<td class="fcaption" style="width:100%;">{ECLASSF_TERMSLINK} {ECLASSF_MANAGE}</td>
	</tr>
</table>';
}
// *******************************************************************************************
// *
// *	Terms and conditions
// *
// *******************************************************************************************
if (!isset($ECLASSF_TC)) {
    $ECLASSF_TC = '
<table class="fborder" style="' . USER_WIDTH . ';">
	<tr>
		<td class="fcaption">' . ECLASSF_41 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" style="width:30%;text-align:left;" >
			{ECLASSF_UPDIRTC}
		</td>
	</tr>';
    if (file_exists('./images/logo.png')) {
        $ECLASSF_TC .= '
	<tr>
		<td class="forumheader2" style="width:30%;text-align:center;" >&nbsp;</td>
	</tr>';
    }

    $ECLASSF_TC .= '
	<tr>
		<td class="forumheader2" style="width:70%;"><strong>' . ECLASSF_41 . '</strong></td>
	</tr>
	<tr>
		<td class="forumheader3">{ECLASSF_TANDC}</td>
	</tr>
</table>';
}

?>