<?php
/*
+---------------------------------------------------------------+
|        Gold System for e107 v7xx - by Father Barry
|			Based on the original by AznDevil
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
include_once(e_HANDLER . 'shortcode_handler.php');
$gold_shortcodes =$tp->e_sc->parse_scbatch(__FILE__);

// * start shortcodes
/*

SC_BEGIN GOLD_CURRENCY_NAME
global $GOLD_PREF, $tp;
return $GOLD_PREF['gold_currency_name'];
SC_END

SC_BEGIN GOLD_BUY_CURRENCY
global $GOLD_PREF;
switch ($GOLD_PREF['buy_gold_currency'])
{
    case "AUD":
        $retval=ADLAN_GS_PP11;
        break;
    case "CAD":
        $retval=ADLAN_GS_PP12;

        break;
    case "CHF":
        $retval=ADLAN_GS_PP13;
        break;
    case "CZK":
        $retval=ADLAN_GS_PP14;
        break;
    case "DKK":
        $retval=ADLAN_GS_PP15;
        break;
    case "EUR":
        $retval=ADLAN_GS_PP16;
        break;
    case "GBP":
        $retval=ADLAN_GS_PP17;
        break;
    case "HKD":
        $retval=ADLAN_GS_PP18;
        break;
    case "HUF":
        $retval=ADLAN_GS_PP19;
        break;
    case "JPY":
        $retval=ADLAN_GS_PP20;
        break;
    case "NOK":
        $retval=ADLAN_GS_PP21;
        break;
    case "NZD":
        $retval=ADLAN_GS_PP22;
        break;
    case "PLN":
        $retval=ADLAN_GS_PP23;
        break;
    case "SEK":
        $retval=ADLAN_GS_PP24;
        break;
    case "SGD":
        $retval=ADLAN_GS_PP25;
        break;
    case "USD":
        $retval=ADLAN_GS_PP26;
        break;
    case "ILS":
        $retval=ADLAN_GS_PP27;
        break;
    case "MXN":
        $retval=ADLAN_GS_PP28;
        break;
}
return $retval;
SC_END

SC_BEGIN GOLD_BUY_COST
global $GOLD_PREF;
return $GOLD_PREF['buy_gold_cost'];
SC_END

SC_BEGIN GOLD_MESSAGE
global $gold_message;
return $gold_message;
SC_END

SC_BEGIN GOLD_MONTH_SEL
global $gold_currentmonthname;
return $gold_currentmonthname;
SC_END

SC_BEGIN GOLD_YEAR_SEL
global $gold_yearsel;
return $gold_yearsel;
SC_END

SC_BEGIN GOLD_SEL_FILTER
return '<input type="submit" value="'.LAN_GS_H037.'" class="button" name="gold_filter" />';
SC_END

SC_BEGIN GOLD_HIST_TITLE
global $title;
return $title;
SC_END

SC_BEGIN GOLD_HIST_PREVRECS
global $gold_hist_prevrecs;
return $gold_hist_prevrecs;
SC_END

SC_BEGIN GOLD_HIST_DATE
global $date;
return $date;
SC_END

SC_BEGIN GOLD_HIST_TYPE
global $type;
return $type;
SC_END

SC_BEGIN GOLD_HIST_AMOUNT
global $gold_obj, $gold_amount;
return $gold_obj->formation($gold_amount);
SC_END

SC_BEGIN GOLD_HIST_BALANCE
global $gold_hbalance,$gold_obj;
return $gold_obj->formation($gold_hbalance);
SC_END

SC_BEGIN GOLD_HIST_CURRENTBAL
global $gold_hist_cbalance,$gold_obj;
return  $gold_obj->formation($gold_hist_cbalance);
SC_END

SC_BEGIN GOLD_HIST_PERSON
global $person;
return $person;
SC_END

SC_BEGIN GOLD_HIST_COMMENT
global $tp, $row;
#$row['gold_hist_comment']=nl2br($row['gold_hist_comment']);
return $tp->toHTML($row['gold_hist_comment'], true);
SC_END

SC_BEGIN GOLD_HIST_CLASS
global $class;
return $class;
SC_END

SC_BEGIN GOLD_HIST_TRANS
global $gold_trans;
return $gold_trans;
SC_END

SC_BEGIN GOLD_HIST_GOLDIN
global $gold_obj, $gold_in;
return $gold_obj->formation($gold_in) ;
SC_END

SC_BEGIN GOLD_HIST_GOLDOUT
global $gold_obj, $gold_out;
return $gold_obj->formation($gold_out) ;
SC_END

SC_BEGIN GOLD_HIST_NEXTREV
global $gold_nextprev;
return $gold_nextprev;
SC_END

SC_BEGIN GOLD_DONATE_BALANCE
global $gold_mygold, $gold_obj;
return $gold_obj->formation($gold_mygold);
SC_END

SC_BEGIN GOLD_DONATE_MAXIMUM
global $gold_obj,$GOLD_PREF;
if($GOLD_PREF['gold_maxdonatepermonth'] > 0 )
{
	return LAN_GS_DG021.' '.$gold_obj->formation($GOLD_PREF['gold_maxdonatepermonth']).' '.LAN_GS_DG022;
}
else
{
	return '';
}
SC_END

SC_BEGIN GOLD_SELECT_USER
global $user, $gold_obj;
return $gold_obj->select_user("user", $user);
SC_END

SC_BEGIN GOLD_DONATE_AMOUNT
return '<input class="tbox" type="text" size="25" maxlength="10" name="amount" value="' . $_POST['amount'] . '" />';
SC_END
SC_BEGIN GOLD_DONATE_COMMENT
return '<textarea class="tbox" cols="22" rows="5" style="width:80%" name="comment" >' . $_POST['comment'] . '</textarea>';
SC_END

SC_BEGIN GOLD_DONATE_SUBMIT
return '<input class="button" type="submit" name="submitgold" value="' . LAN_GS_6 . '" />';
SC_END

SC_BEGIN GOLD_BUY_UNITCOST
global $gold_obj,$GOLD_PREF;
return $gold_obj->formation($GOLD_PREF['buy_gold_perunit']);
SC_END

SC_BEGIN GOLD_BUY_MYBALANCE
global $gold_obj, $gold_mybalance;
return $gold_obj->formation($gold_mybalance);
SC_END

SC_BEGIN GOLD_BUY_AVATAR_IMAGE
global $tp,$gold_userimage;
return '<input class="tbox" type="text" name="avatar" size="60" onKeyDown=\'avatar_remote();\' value="'.$tp->toFORM($gold_userimage).'"/>';
SC_END

SC_BEGIN GOLD_BUY_PAYPAL
// btn_buynowCC_LG.gif
// x-click-butcc.gif
return '<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but5.gif" border="0" name="submit" title="' . LAN_GS_BG011 . '" alt="' . LAN_GS_BG011 . '">';
SC_END

#SC_BEGIN GOLD_BUY_PRICE
#global $gold_obj, $GOLD_PREF;
#switch ($parm)
#{
#    case 'shop_orb_femininity' :
#        return $gold_obj->formation($GOLD_PREF['shop_orb_femininity']);
#        break;
#    case 'shop_orb_flames' :
#        return $gold_obj->formation($GOLD_PREF['shop_orb_flames']);
#        break;
#    case 'shop_orb_toxin' :
#        return $gold_obj->formation($GOLD_PREF['shop_orb_toxin']);
#        break;
#    case 'shop_orb_frost' :
#        return $gold_obj->formation($GOLD_PREF['shop_orb_frost']);
#        break;
#    case 'shop_orb_darkness' :
#        return $gold_obj->formation($GOLD_PREF['shop_orb_darkness']);
#        break;
#    case 'shop_orb_light' :
#        return $gold_obj->formation($GOLD_PREF['shop_orb_light']);
#        break;
#}
#
#SC_END

#SC_BEGIN GOLD_SHOP_CUSTOMTITLE
#global $GOLD_PREF, $gold_obj;
#return "<a href='shop.php?buy=custom_title' style='text-decoration: none'  onclick=\"return gold_ConfirmPurchase('" . LAN_GS_58 . "'," . $GOLD_PREF['shop_customtitle'] . ")\">" . $gold_obj->formation($GOLD_PREF['shop_customtitle']) . "</a>";
#SC_END
#
#SC_BEGIN GOLD_SHOP_DISPLAY
#global $GOLD_PREF, $gold_obj;
#return "<a href='shop.php?buy=display_name' style='text-decoration: none' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_33 . "'," . $GOLD_PREF['shop_name'] . ")\">" . $gold_obj->formation($GOLD_PREF['shop_name']) . "</a>";
#SC_END
#
#SC_BEGIN GOLD_SHOP_SIGNATURE
#global $GOLD_PREF, $gold_obj;
#return "<a href='shop.php?buy=signature' style='text-decoration: none' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_35 . "'," . $GOLD_PREF['shop_signature'] . ")\">" . $gold_obj->formation($GOLD_PREF['shop_signature']) . "</a>";
#SC_END
#
#SC_BEGIN GOLD_SHOP_AVATAR
#global $GOLD_PREF, $gold_obj;
#return "<a href='shop.php?buy=avatar' style='text-decoration: none' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_37 . "'," . $GOLD_PREF['shop_avatar'] . ")\" >" . $gold_obj->formation($GOLD_PREF['shop_avatar']) . "</a>";
#SC_END

#SC_BEGIN GOLD_SHOP_MESSAGE
#global $message;
#return $message;
#SC_END
#
#SC_BEGIN GOLD_SHOP_BALANCE
#global $gold_mybalance, $gold_obj;
#return $gold_obj->formation($gold_mybalance);
#SC_END

#SC_BEGIN GOLD_BUY_FEMININITY_TITLE
#global $GOLD_PREF;
#return "<div class='orb_fem' id='b_fem'><a href='?buy=orb_fem'  onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_001 . "'," . $GOLD_PREF['shop_orb_femininity'] . ")\">" . LAN_GS_ORB_001 . "</a></div>";
#
#SC_END
#
#SC_BEGIN GOLD_BUY_FLAMES_TITLE
#global $GOLD_PREF;
#return "<div class='orb_flame' id='b_flame'><a href='?buy=orb_flame' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_011 . "'," . $GOLD_PREF['shop_orb_flames'] . ")\">" . LAN_GS_ORB_011 . "</a></div>";
#SC_END
#
#SC_BEGIN GOLD_BUY_TOXIN_TITLE
#global $GOLD_PREF;
#return "<div class='orb_toxin' id='b_toxin'><a href='?buy=orb_toxin'  onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_021 . "'," . $GOLD_PREF['shop_orb_toxin'] . ")\">" . LAN_GS_ORB_021 . "</a></div>";
#SC_END
#
#SC_BEGIN GOLD_BUY_FROST_TITLE
#global $GOLD_PREF;
#return "<div class='orb_frost' id='b_frost'><a href='?buy=orb_frost' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_031 . "'," . $GOLD_PREF['shop_orb_frost'] . ")\">" . LAN_GS_ORB_031 . "</a></div>";
#
#SC_END
#
#SC_BEGIN GOLD_BUY_DARKNESS_TITLE
#global $GOLD_PREF;
#return "<div class='orb_dark' id='b_dark'><a href='?buy=orb_dark' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_041 . "'," . $GOLD_PREF['shop_orb_darkness'] . ")\">" . LAN_GS_ORB_041 . "</a></div>";
#SC_END
#
#SC_BEGIN GOLD_BUY_LIGHT_TITLE
#global $GOLD_PREF;
#return "<div class='orb_light' id='b_light'><a href='?buy=orb_light' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_051 . "'," . $GOLD_PREF['shop_orb_light'] . ")\">" . LAN_GS_ORB_051 . "</a></div>";
#SC_END
#
#SC_BEGIN GOLD_BUY_FEMININITY_IMG
#global $GOLD_PREF;
#return "<a href='?buy=orb_fem' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_001 . "'," . $GOLD_PREF['shop_orb_femininity'] . ")\"><img src='" . e_PLUGIN . "gold_system/orbs/Femininity.gif' border='0' alt='" . LAN_GS_ORB_001 . "' title='" . LAN_GS_ORB_001 . "'></a>";
#
#SC_END
#
#SC_BEGIN GOLD_BUY_FLAMES_IMG
#global $GOLD_PREF;
#return "<a href='?buy=orb_flame' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_011 . "'," . $GOLD_PREF['shop_orb_flames'] . ")\"><img src='" . e_PLUGIN . "gold_system/orbs/Flames.gif' border='0' alt='" . LAN_GS_ORB_011 . "' title='" . LAN_GS_ORB_011 . "'></a>";
#SC_END
#
#SC_BEGIN GOLD_BUY_TOXIN_IMG
#global $GOLD_PREF;
#return "<a href='?buy=orb_toxin' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_021 . "'," . $GOLD_PREF['shop_orb_toxin'] . ")\"><img src='" . e_PLUGIN . "gold_system/orbs/Toxin.gif' border='0' alt='" . LAN_GS_ORB_021 . "' title='" . LAN_GS_ORB_021 . "'></a>";
#SC_END
#
#SC_BEGIN GOLD_BUY_FROST_IMG
#global $GOLD_PREF;
#return "<a href='?buy=orb_frost' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_031 . "'," . $GOLD_PREF['shop_orb_frost'] . ")\"><img src='" . e_PLUGIN . "gold_system/orbs/Frost.gif' border='0' title='" . LAN_GS_ORB_031 . "' alt='" . LAN_GS_ORB_032 . "'></a>";
#
#SC_END
#
#SC_BEGIN GOLD_BUY_DARKNESS_IMG
#global $GOLD_PREF;
#return "<a href='?buy=orb_dark' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_041 . "'," . $GOLD_PREF['shop_orb_darkness'] . ")\"><img src='" . e_PLUGIN . "gold_system/orbs/Darkness.gif' border='0' title='" . LAN_GS_ORB_041 . "' alt='" . LAN_GS_ORB_041 . "'></a>";
#SC_END
#
#SC_BEGIN GOLD_BUY_LIGHT_IMG
#global $GOLD_PREF;
#return "<a href='?buy=orb_light' onclick=\"return gold_ConfirmPurchase('" . LAN_GS_ORB_051 . "'," . $GOLD_PREF['shop_orb_light'] . ")\"><img src='" . e_PLUGIN . "gold_system/orbs/Light.gif' border='0' title='" . LAN_GS_ORB_051 . "' alt='" . LAN_GS_ORB_051 . "'></a>";
#SC_END
#
#SC_BEGIN GOLD_BUY_FEMININITY_BUTTON
#global $GOLD_PREF,$gold_orbs,$gold_wielded;
#if(empty($gold_orbs['orb_fem']))
#{
#	return "<input class='button' type='button' onclick=\"return gold_ConfirmPurchaseGo('" . LAN_GS_ORB_001 . "'," . $GOLD_PREF['shop_orb_femininity'] . ",'orb_fem')\"  value='" . LAN_GS_ORB_101 . "'>";
#}
#else
#{
#	if($gold_wielded=='orb_fem')
#	{
#		return "<input class='button' type='button' onclick=\"location.href='" . e_SELF . "?unwield=orb_fem'\" value='" . LAN_GS_INV003 . "'>";
#	}
#	else
#	{
#		return "<input class='button' type='button' onclick=\"location.href='" . e_SELF . "?wield=orb_fem'\" value='" . LAN_GS_INV002 . "'>";
#	}
#}
#SC_END
#
#SC_BEGIN GOLD_BUY_FLAMES_BUTTON
#global $GOLD_PREF,$gold_orbs,$gold_wielded;
#if(empty($gold_orbs['orb_flame']))
#{
#	return "<input class='button' type='button' onclick=\"return gold_ConfirmPurchaseGo('" . LAN_GS_ORB_011 . "'," . $GOLD_PREF['shop_orb_flames'] . ",'orb_flame')\"  value='" . LAN_GS_ORB_101 . "'>";
#}
#else
#{
#	if($gold_wielded=='orb_flame')
#	{
#		return "<input class='button' type='button' onclick=\"location.href='" . e_SELF . "?unwield=orb_flame'\" value='" . LAN_GS_INV003 . "'>";
#	}
#	else
#	{
#		return "<input class='button' type='button' onclick=\"location.href='?wield=orb_flame'\" value='" . LAN_GS_INV002 . "'>";
#	}
#}
#SC_END
#
#SC_BEGIN GOLD_BUY_TOXIN_BUTTON
#global $GOLD_PREF,$gold_orbs,$gold_wielded;
#if(empty($gold_orbs['orb_toxin']))
#{
#	return "<input class='button' type='button'  onclick=\"return gold_ConfirmPurchaseGo('" . LAN_GS_ORB_021 . "'," . $GOLD_PREF['shop_orb_toxin'] . ",'orb_toxin')\" value='" . LAN_GS_ORB_101 . "'>";
#}
#else
#{
#	if($gold_wielded=='orb_toxin')
#	{
#		return "<input class='button' type='button' onclick=\"location.href='" . e_SELF . "?unwield=orb_toxin'\" value='" . LAN_GS_INV003 . "'>";
#	}
#	else
#	{
#  		return "<input class='button' type='button' onclick=\"location.href='?wield=orb_toxin'\" value='" . LAN_GS_INV002 . "'>";
#  	}
#}
#SC_END
#
#SC_BEGIN GOLD_BUY_FROST_BUTTON
#global $GOLD_PREF,$gold_orbs,$gold_wielded;
#if(empty($gold_orbs['orb_frost']))
#{
#	return "<input class='button' type='button' onclick=\"return gold_ConfirmPurchaseGo('" . LAN_GS_ORB_031 . "'," . $GOLD_PREF['shop_orb_frost'] . ",'orb_frost')\"  value='" . LAN_GS_ORB_101 . "'>";
#}
#else
#{
#	if($gold_wielded=='orb_frost')
#	{
#		return "<input class='button' type='button' onclick=\"location.href='" . e_SELF . "?unwield=orb_frost'\" value='" . LAN_GS_INV003 . "'>";
#	}
#	else
#	{
#	return "<input class='button' type='button' onclick=\"location.href='?wield=orb_frost'\" value='" . LAN_GS_INV002 . "'>";
#	}
#}
#SC_END
#
#SC_BEGIN GOLD_BUY_DARKNESS_BUTTON
#global $GOLD_PREF,$gold_orbs,$gold_wielded;
#if(empty($gold_orbs['orb_dark']))
#{
#	return "<input class='button' type='button' onclick=\"return gold_ConfirmPurchaseGo('" . LAN_GS_ORB_041 . "'," . $GOLD_PREF['shop_orb_darkness'] . ",'orb_dark')\" value='" . LAN_GS_ORB_101 . "'>";
#}
#else
#{
#	if($gold_wielded=='orb_dark')
#	{
#		return "<input class='button' type='button' onclick=\"location.href='" . e_SELF . "?unwield=orb_dark'\" value='" . LAN_GS_INV003 . "'>";
#	}
#	else
#	{
# 		return "<input class='button' type='button' onclick=\"location.href='?wield=orb_dark'\" value='" . LAN_GS_INV002 . "'>";
# 	}
#}
#SC_END
#
#SC_BEGIN GOLD_BUY_LIGHT_BUTTON
#global $GOLD_PREF,$gold_orbs,$gold_wielded;
#if(empty($gold_orbs['orb_light']))
#{
#return "<input class='button' type='button' onclick=\"return gold_ConfirmPurchaseGo('" . LAN_GS_ORB_051 . "'," . $GOLD_PREF['shop_orb_light'] . ",'orb_light')\" value='" . LAN_GS_ORB_101 . "'>";
#}
#else
#{
#	if($gold_wielded=='orb_light')
#	{
#		return "<input class='button' type='button' onclick=\"location.href='" . e_SELF . "?unwield=orb_light'\" value='" . LAN_GS_INV003 . "'>";
#	}
#	else
#	{
# 		return "<input class='button' type='button' onclick=\"location.href='?wield=orb_light'\" value='" . LAN_GS_INV002 . "'>";
# 	}
#}
#SC_END
#
#SC_BEGIN GOLD_BUY_TITLE_BUTTON
#global $GOLD_PREF;
#return "<input class='button' type='button'  onclick=\"return gold_ConfirmPurchaseGo('" . LAN_GS_58 . "'," . $GOLD_PREF['shop_customtitle'] . ",'custom_title')\" value='" . LAN_GS_ORB_101 . "' />";
#SC_END
#
#SC_BEGIN GOLD_BUY_NAME_BUTTON
#global $GOLD_PREF;
#return "<input class='button' type='button'  onclick=\"return gold_ConfirmPurchaseGo('" . LAN_GS_33 . "'," . $GOLD_PREF['shop_name'] . ",'display_name')\" value='" . LAN_GS_ORB_101 . "'>";
#SC_END
#
#SC_BEGIN GOLD_BUY_SIGNATURE_BUTTON
#global $GOLD_PREF;
#return "<input class='button' type='button'  onclick=\"return gold_ConfirmPurchaseGo('" . LAN_GS_35 . "'," . $GOLD_PREF['shop_signature'] . ",'signature')\" value='" . LAN_GS_ORB_101 . "'>";
#SC_END
#
#SC_BEGIN GOLD_BUY_AVATAR_BUTTON
#global $GOLD_PREF;
#return "<input class='button' type='button'  onclick=\"return gold_ConfirmPurchaseGo('" . LAN_GS_37 . "'," . $GOLD_PREF['shop_avatar'] . ",'avatar')\" value='" . LAN_GS_ORB_101 . "'>";
#SC_END
#
#SC_BEGIN GOLD_BUY_TITLE
#global $display;
#return '<input class="tbox" type="text" name="customtitle" value="'.$display.'" />';
#SC_END
#
#SC_BEGIN GOLD_BUY_SUBMIT
#return "<input class='button' type='submit' name='update' value='" . LAN_GS_ORB_109 . "' />";
#SC_END
#
#SC_BEGIN GOLD_BUY_DISPLAYNAME
#global $display, $GOLD_PREF;
#return '<input class="tbox" type="text" name="display_name" maxlength="'.$GOLD_PREF['displayname_maxlength'].'" value="'.$display.'" />';
#SC_END
#
#SC_BEGIN GOLD_BUY_SIGPREVIEW
#global $tp;
#return $tp->toHTML($_POST['signature'], true);
#SC_END
#
#SC_BEGIN GOLD_BUY_SIGNATURE
#global $display;
#
#return "<textarea class='tbox signature' name='signature' cols='58' style='width:80%' rows='4' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>{$display}</textarea>
#<input id='goldhelp' class='helpbox' type='text' name='goldhelp' size='100' style='width:80%'/>
#			<br />" . display_help("goldhelp");;
#SC_END
#
#SC_BEGIN GOLD_BUY_PREVIEW
#
#return "<input class='button' name='preview' type='submit' value='" . LAN_GS_ORB_113 . "' />";
#SC_END
#
#SC_BEGIN GOLD_BUY_SITEAVATAR
#global $ret;
#return $ret;
#SC_END
#
#SC_BEGIN GOLD_BUY_RESET
#
#return "<input class='button' type='reset' name='reset' value='" . LAN_GS_ORB_115 . "' />";
#SC_END
#
#SC_BEGIN GOLD_BUY_AVATAR_UPLOAD
#global $upload;
#return "<input class='tbox' id='upload' {$upload} name='file_userfile[]' type='file' size='47' onchange=\"avatar_upload();\" />";
#SC_END
#
#SC_BEGIN GOLD_BUY_AVATAR_STATUS
#global $upload_value;
#return $upload_value;
#SC_END
#
#SC_BEGIN GOLD_INV_ORBCLASS
#global $ORBCLASS;
#return $ORBCLASS;
#SC_END

#SC_BEGIN GOLD_INV_ORBTITLE
#global $ORBTITLE;
#return $ORBTITLE;
#SC_END
#
#SC_BEGIN GOLD_INV_ORBWORDS
#global $ORBWORDS;
#return $ORBWORDS;
#SC_END
#
#SC_BEGIN GOLD_INV_ORBIMG
#global $ORBCLASS;
#
#switch ($ORBCLASS)
#{
#    case "orb_fem":
#        return "<img src='" . e_PLUGIN . "gold_system/orbs/Femininity.gif' border='0' alt='" . LAN_GS_ORB_011 . "' title='" . LAN_GS_ORB_011 . "'>";
#        break;
#    case "orb_flame":
#        return "<img src='" . e_PLUGIN . "gold_system/orbs/Flames.gif' border='0' alt='" . LAN_GS_ORB_011 . "' title='" . LAN_GS_ORB_011 . "'>";
#        break;
#    case "orb_toxin":
#        return "<img src='" . e_PLUGIN . "gold_system/orbs/Toxin.gif' border='0' alt='" . LAN_GS_ORB_011 . "' title='" . LAN_GS_ORB_011 . "'>";
#        break;
#    case "orb_frost":
#        return "<img src='" . e_PLUGIN . "gold_system/orbs/Frost.gif' border='0' alt='" . LAN_GS_ORB_011 . "' title='" . LAN_GS_ORB_011 . "'>";
#        break;
#    case "orb_dark":
#        return "<img src='" . e_PLUGIN . "gold_system/orbs/Darkness.gif' border='0' alt='" . LAN_GS_ORB_011 . "' title='" . LAN_GS_ORB_011 . "'>";
#        break;
#    case "orb_light":
#        return "<img src='" . e_PLUGIN . "gold_system/orbs/Light.gif' border='0' alt='" . LAN_GS_ORB_011 . "' title='" . LAN_GS_ORB_011 . "'>";
#        break;
#}
#SC_END
#
#SC_BEGIN GOLD_INV_ORBID
#global $ORBCLASS;
#return substr($ORBCLASS, 2);
#SC_END
#
#SC_BEGIN GOLD_INV_WIELD
#global $ORBCLASS;
#
#switch ($ORBCLASS)
#{
#    case "orb_fem":
#        return "<input class='button' type='button' onclick=\"location.href='" . e_SELF . "?wield=orb_fem'\" value='" . LAN_GS_INV002 . "'>";
#        break;
#    case "orb_flame":
#        return "<input class='button' type='button' onclick=\"location.href='?wield=orb_flame'\" value='" . LAN_GS_INV002 . "'>";
#        break;
#    case "orb_toxin":
#        return "<input class='button' type='button' onclick=\"location.href='?wield=orb_toxin'\" value='" . LAN_GS_INV002 . "'>";
#        break;
#    case "orb_frost":
#        return "<input class='button' type='button' onclick=\"location.href='?wield=orb_frost'\" value='" . LAN_GS_INV002 . "'>";
#        break;
#    case "orb_dark":
#        return "<input class='button' type='button' onclick=\"location.href='?wield=orb_dark'\" value='" . LAN_GS_INV002 . "'>";
#        break;
#    case "orb_light":
#        return "<input class='button' type='button' onclick=\"location.href='?wield=orb_light'\" value='" . LAN_GS_INV002 . "'>";
#        break;
#}
#SC_END
#
#SC_BEGIN GOLD_INV_MESSAGE
#global $message;
#return $message;
#SC_END

SC_BEGIN GOLD_DLC_DOWNLOAD
global $download_name, $tp;
return $tp->toHTML($download_name, false);
SC_END

SC_BEGIN GOLD_DLC_COST
global $gold_charge, $gold_obj;
return $gold_obj->formation($gold_charge);
SC_END

SC_BEGIN GOLD_DLC_BALANCE
global $gold_dlbalance, $gold_obj;
return $gold_obj->formation($gold_dlbalance);
SC_END

SC_BEGIN GOLD_DLC_PROCEED
return '<input type="submit" class="button" name="gold_dlok" value="' . LAN_GS_DLC06 . '" />';
SC_END

SC_BEGIN GOLD_DLC_CANCEL
return '<input type="submit" class="button" name="goldcancel" value="' . LAN_GS_DLC07 . '" />';
SC_END

SC_BEGIN GOLD_MYHISTORY
return '<a href="' . e_PLUGIN . 'gold_system/history.php">' . LAN_GS_MAIN010 . '</a><br />';
SC_END

#SC_BEGIN GOLD_MYSHOP
#global $gold_obj,$GOLD_PREF;
#if ($GOLD_PREF['gold_centreshow']['gold_shop'] &&  $gold_obj->plugin_active('gold_shop'))
#{
#	return '<a href="' . e_PLUGIN . 'gold_shop/index.php">' . LAN_GS_MAIN011 . '</a><br />';
#}
#else
#{
#	return '';
#}
#SC_END

#SC_BEGIN GOLD_MYINVENTORY
#return '<a href="' . e_PLUGIN . 'gold_system/inventory.php">' . LAN_GS_MAIN012 . '</a><br />';
#SC_END

SC_BEGIN GOLD_MYDONATE
return '<a href="' . e_PLUGIN . 'gold_system/donate.php">' . LAN_GS_MAIN013 . '</a><br />';
SC_END

SC_BEGIN GOLD_MYDATA
global $gold_obj, $tp;
$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_mydata\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . LAN_GS_MAIN040 . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_mydata\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_mydataimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_mydata" style="display:none" >';
$retval .= '<br />' . LAN_GS_GM006 . ': <b>' . $gold_obj->formation($gold_obj->gold_balance(USERID)) . '</b><br />';
$retval .= LAN_GS_GM013  . ': <b>' . $gold_obj->formation($gold_obj->gold_spent(USERID)) . '</b><br />';
$retval .= LAN_GS_GM008 . ': <b>' . $gold_obj->formation($gold_obj->gold_received(USERID)) . '</b><br />
	<br /></div>';
return $retval;
SC_END

SC_BEGIN GOLD_MYTOP
global $gold_obj, $sql2, $GOLD_PREF;

$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_myrich\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . LAN_GS_MAIN041 . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_myrich\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_myrichimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_myrich" style="display:none" >';
$retval .= '<br />';
$gold_arg = "select user_name,gold_id,gold_orb,gold_balance from #gold_system left join #user on user_id=gold_id ORDER BY gold_balance DESC LIMIT {$GOLD_PREF['gold_mrichest']}";
$sql2->db_Select_gen($gold_arg, false);
while ($rows = $sql2->db_Fetch())
{
    $retval .= '<a href="' . e_BASE . 'user.php?id.' . $rows['gold_id'] . '">' . $gold_obj->show_orb($rows['gold_id'], $rows['user_name']) . '</a> ' . $gold_obj->formation($rows['gold_balance']) . '<br />';
}
$retval .= '<br /></div>';
return $retval;
SC_END

SC_BEGIN GOLD_MYBOTTOM
global $gold_obj, $sql2, $GOLD_PREF;

$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_mypoor\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . LAN_GS_MAIN043 . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_mypoor\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_mypoorimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_mypoor" style="display:none" >';
$retval .= '<br />';
$gold_arg = "select user_name,gold_id,gold_orb,gold_balance from #gold_system left join #user on user_id=gold_id ORDER BY gold_balance asc LIMIT {$GOLD_PREF['gold_mrichest']}";
$sql2->db_Select_gen($gold_arg, false);
while ($rows = $sql2->db_Fetch())
{
    $retval .= '<a href="' . e_BASE . 'user.php?id.' . $rows['gold_id'] . '">' . $gold_obj->show_orb($rows['gold_id'], $rows['user_name']) . '</a> ' . $gold_obj->formation($rows['gold_balance']) . '<br />';
}
$retval .= '<br /></div>';

return $retval;
SC_END

SC_BEGIN GOLD_MYCLASSES
$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_myclass\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . LAN_GS_MAIN042 . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_myclass\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_myclassimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_myclass" style="display:none" >';
$gold_ulist = explode(",", USERCLASS_LIST);
$retval .= '<br />';
foreach($gold_ulist as $row)
{
    if ($row != 0 && $row != 251)
    {
        $retval .= r_userclass_name($row) . ' <br />';
    }
}
$retval .= '<br /></div>';
return $retval;
SC_END

SC_BEGIN GOLD_MYPROFILE
global $GOLD_PREF, $gold_obj;

$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_myprofile\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . LAN_GS_MAIN095 . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_myprofile\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_myprofileimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_myprofile" style="display:none" >';

$retval .= '<br />' . LAN_GS_MAIN096 . ' ' . $gold_obj->formation($GOLD_PREF['gold_usrcost']) . '<br />';
$retval .= '<br /></div>';
return $retval;
SC_END
SC_BEGIN GOLD_MYDOWNLOAD
global $GOLD_PREF, $gold_obj;
$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_mydload\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . LAN_GS_MAIN050 . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_mydload\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_mydloadimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_mydload" style="display:none" >';
$gold_dllist = unserialize($GOLD_PREF['gold_dlclasses']);
$retval .= '<br />' . LAN_GS_MAIN051 . '<br /><br />';
foreach($gold_dllist as $key => $value)
{
    if ($key != 251)
    {
        $retval .= r_userclass_name($key) . ' ' . $gold_obj->formation($value) . ' <br />';
    }
}
$retval .= '<br /></div>';
return $retval;
SC_END

SC_BEGIN GOLD_MYLINKS
global $GOLD_PREF, $gold_obj;
if ($GOLD_PREF['gold_linkaction'] == 0)
{
    $title = LAN_GS_MAIN061;
    $action = LAN_GS_MAIN063;
}
else
{
    $title = LAN_GS_MAIN060;
    $action = LAN_GS_MAIN062;
}
$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_mylink\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . $title . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_mylink\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_mylinkimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_mylink" style="display:none" >';

$retval .= '<br />' . $action . ' ' . $gold_obj->formation($GOLD_PREF['gold_link']) . '<br />';
$retval .= '<br /></div>';
return $retval;
SC_END
SC_BEGIN GOLD_MYFAQ
SC_END

SC_BEGIN GOLD_MYFORUM
global $GOLD_PREF, $gold_obj;
$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_myforum\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . LAN_GS_MAIN070 . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_myforum\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_myforumimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_myforum" style="display:none" >';

if ($GOLD_PREF['forum_addsub'] == 1)
{
    $action = LAN_GS_MAIN071;
}
$retval .= '<br />' . LAN_GS_MAIN072 . ' ' . $gold_obj->formation($GOLD_PREF['gold_newthread']);
$retval .= '<br />' . LAN_GS_MAIN073 . ' ' . $gold_obj->formation($GOLD_PREF['gold_reply']) . '<br />';
$retval .= '<br />' . $action . '<br />';

$retval .= '<br /></div>';
return $retval;
SC_END

SC_BEGIN GOLD_MYCOMMENTS
global $GOLD_PREF, $gold_obj;

$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_mycomment\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . LAN_GS_MAIN065 . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_mycomment\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_mycommentimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_mycomment" style="display:none" >';

$retval .= '<br />' . LAN_GS_MAIN066 . ' ' . $gold_obj->formation($GOLD_PREF['gold_comment']) . '<br />';

$retval .= '<br /></div>';
return $retval;
SC_END

SC_BEGIN GOLD_MYNEWS
global $GOLD_PREF, $gold_obj;

$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_mynews\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . LAN_GS_MAIN080 . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_mynews\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_mynewsimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_mynews" style="display:none" >';

$retval .= '<br />' . LAN_GS_MAIN081 . ' ' . $gold_obj->formation($GOLD_PREF['gold_news']) . '<br />';

$retval .= '<br /></div>';
return $retval;
SC_END

SC_BEGIN GOLD_MYCHATS
global $GOLD_PREF, $gold_obj;

$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_mychat\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . LAN_GS_MAIN085 . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_mychat\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_mychatimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_mychat" style="display:none" >';

$retval .= '<br />' . LAN_GS_MAIN086 . ' ' . $gold_obj->formation($GOLD_PREF['gold_chatbox']) . '<br />';

$retval .= '<br /></div>';
return $retval;
SC_END

SC_BEGIN GOLD_MYVISITS
global $GOLD_PREF, $gold_obj;

$retval .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_myvisit\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . LAN_GS_MAIN090 . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_myvisit\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_myvisitimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_myvisit" style="display:none" >';

$retval .= '<br />' . LAN_GS_MAIN091 . ' ' . $gold_obj->formation($GOLD_PREF['gold_visit']) . '<br />';
$retval .= '<br />' . LAN_GS_MAIN092 . ' ' . $gold_obj->formation($GOLD_PREF['gold_tarnish']) . '<br />';

$retval .= '<br /></div>';
return $retval;
SC_END

SC_BEGIN GOLD_MYFAQ
SC_END

SC_BEGIN GOLD_USR_MEMBER
global $gold_obj, $gold_usrid;
return $gold_obj->gold_username($gold_usrid);

SC_END

SC_BEGIN GOLD_USR_CHARGE
global $gold_obj, $gold_charge;
return $gold_obj->formation($gold_charge);

SC_END

SC_BEGIN GOLD_USR_BALANCE
global $gold_obj;
return $gold_obj->formation($gold_obj->gold_balance(USERID));
SC_END

SC_BEGIN GOLD_USR_PROCEED
return '<input type="submit" class="button" name="gold_usrok" value="' . LAN_GS_USR05 . '" />';
SC_END

SC_BEGIN GOLD_USR_CANCEL
return '<input type="submit" class="button" name="goldusrcancel" value="' . LAN_GS_USR06 . '" />';
SC_END

SC_BEGIN GOLD_MYPLUGINS
global $pref,$gold_obj,$GOLD_PREF;
$gold_pluglist = $pref['plug_installed'];
    ksort($gold_pluglist);
    foreach($gold_pluglist as $gold_row => $it)
    {
        if ($gold_obj->plugin_active($gold_row) && $GOLD_PREF['gold_centreshow'][$gold_row] == 1 && !empty($GOLD_PREF['gold_link'][$gold_row]) && !empty($GOLD_PREF['gold_title'][$gold_row]))
        {
            $gold_link = str_replace('{e_PLUGIN}', e_PLUGIN, $GOLD_PREF['gold_link'][$gold_row]);
            $gold_text .= '<a href="' . $gold_link . '" >' . $GOLD_PREF['gold_title'][$gold_row] . '</a><br />' ;
        }
    }
    return $gold_text;
SC_END

SC_BEGIN GOLD_BUY_MESSAGE
global $gold_buy_message;
return $gold_buy_message;
SC_END

SC_BEGIN GOLD_MYPLUGCHARGE
global $gold_plugcharge;
return $gold_plugcharge;
SC_END


*/