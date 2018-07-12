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
if (!defined('e107_INIT'))
{
    exit;
}
include_once(e_HANDLER . 'shortcode_handler.php');
$eclassf_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
// * start shortcodes
/*

SC_BEGIN ECLASSF_SENDPM
global $eclassf_pmto,$pref;
if($pref['plug_installed']['pm']){
if ($eclassf_pmto > 0)
{
	$retval = "<a href='".e_PLUGIN."pm/pm.php?send.{$eclassf_pmto}' ><img src='".e_PLUGIN."pm/images/pm.png' style='border:0;' alt='".ECLASSF_123."' title='".ECLASSF_123."' /></a>";
}
else
{
	$retval="";
}
}
return $retval;
SC_END

SC_BEGIN ECLASSF_EDIT
global $eclassf_itemid;
if (check_class($ECLASSF_PREF['eclassf_create']) || check_class($ECLASSF_PREF['eclassf_admin']) )
{
	$retval="<a href='".e_PLUGIN."e_classifieds/add.php?action=godo&catid=$eclassf_itemid&actvar=edit'><img src='".e_IMAGE."admin_images/edit_16.png' style='border:0;' alt='".ECLASSF_36."' title='".ECLASSF_36."'/></a>";
}

return $retval;

SC_END
SC_BEGIN ECLASSF_ITEMPICTURE
global $eclassf_itempicture;
return $eclassf_itempicture;
SC_END

SC_BEGIN ECLASSF_ITEMVIEWS
global $eclassf_itemviews;
return $eclassf_itemviews;
SC_END

SC_BEGIN ECLASSF_ITEMLOCATION
   global $eclassf_location;
   return $eclassf_location;
SC_END

SC_BEGIN ECLASSF_ITEMEXPIRES
   global $eclassf_expirydate;
   return $eclassf_expirydate;
SC_END
SC_BEGIN ECLASSF_ITEMPRICE
global $tp,$eclassf_price;
return $tp->toHTML($eclassf_price);
SC_END

SC_BEGIN ECLASSF_ITEMPOSTEREMAIL
global $eclassf_jemailaddr;
return $eclassf_jemailaddr;
SC_END

SC_BEGIN ECLASSF_ITEMPHONE
global $tp,$eclassf_phone;
return $tp->toHTML($eclassf_phone);
SC_END

SC_BEGIN ECLASSF_POSTERNAME
global $eclassf_namerate;
return $eclassf_namerate;
SC_END

SC_BEGIN ECLASSF_SELERRNAME
global $eclassf_name_seller;
return $eclassf_name_seller;
SC_END

SC_BEGIN ECLASSF_ITEMDETAILS
global $tp,$eclassf_details;
return $tp->toHTML($eclassf_details, true);
SC_END

SC_BEGIN ECLASSF_ITEMNAME
global $tp,$eclassf_name;
return $tp->toHTML($eclassf_name);
SC_END

SC_BEGIN ECLASSF_ITEMDESC
global $tp,$eclassf_desc;
return $tp->toHTML($eclassf_desc);
SC_END

SC_BEGIN ECLASSF_ITEMUPDIR
global $eclassf_from,$eclassf_catid,$eclassf_subid;
return "<a href='" . e_SELF . "?{$eclassf_from}.list.{$eclassf_catid}.{$eclassf_subid}.0'><img src='./images/updir.png' title='".ECLASSF_124."' alt='".ECLASSF_124."' style='border:0;'/></a>";
SC_END

SC_BEGIN ECLASSF_ITEMPRINT
global $eclassf_from,$eclassf_catid,$eclassf_subid,$eclassf_itemid;
return "<a href='../../print.php?plugin:e_classifieds.{$eclassf_itemid}' ><img src='" . e_IMAGE . "generic/" . IMODE . "/printer.png' style='border:0;' title='" . ECLASSF_77 . "' alt='" . ECLASSF_77 . "' /></a>";
SC_END

SC_BEGIN ECLASSF_ITEMEMAIL
global $eclassf_from,$eclassf_catid,$eclassf_subid,$eclassf_itemid;
return "<a href='../../email.php?plugin:e_classifieds." . $eclassf_itemid . "'><img src='" . e_IMAGE . "generic/" . IMODE . "/email.png' style='border:0' alt='" . ECLASSF_78 . "' title='" . ECLASSF_78 . "' /></a>";
SC_END

SC_BEGIN ECLASSF_ITEMHEAD
global $eclassf_itemhead;
return $eclassf_itemhead;
SC_END

SC_BEGIN ECLASSF_SELECTOR
global $eclassf_selector;
return $eclassf_selector;
SC_END

SC_BEGIN ECLASSF_SUBMIT
$retval ='<input type="submit" class="button" name="subsub" value="'.ECLASSF_97.'" />';
return $retval;
SC_END
SC_BEGIN ECLASSF_SUBADVERTS
global $eclassf_count;
return $eclassf_count;
SC_END

SC_BEGIN ECLASSF_SUBICON
global $tp,$eclassf_subname,$eclassf_subicon;
if (!empty($eclassf_subicon) && file_exists('./images/icons/' . $eclassf_subicon))
{
	$retval .= "<img src='images/icons/" . $eclassf_subicon . "'  alt='" . $tp->toFORM($eclassf_subname) . " icon' title='" . $tp->toFORM($eclassf_subname) . "' style='border:0;' />";
}
else
{
    $retval .= "<img src='images/icons/blank.png'  alt='' title='' style='border:0;' />";
}
return $retval;
SC_END

SC_BEGIN ECLASSF_SUBNAME
global $tp,$eclassf_from,$eclassf_categoryid,$eclassf_subid,$eclassf_subname;
$retval ="<a href='" . e_SELF . "?$eclassf_from.list.$eclassf_categoryid.$eclassf_subid.0'>" . $tp->toHTML($eclassf_subname) . "</a>";
return $retval;
SC_END

SC_BEGIN ECLASSF_SUBHEAD
global $eclassf_subhead;
return $eclassf_subhead;
SC_END

SC_BEGIN ECLASSF_SUBCOLSPAN
global $eclassf_colspan;
return $eclassf_colspan;
SC_END

SC_BEGIN ECLASSF_SUBUPDIR
global $tp,$eclassf_from,$eclassf_catid,$eclassf_subid;
return "<a href='" . e_SELF . "?{$eclassf_from}.cat.{$eclassf_catid}.{$eclassf_subid}.0'><img src='./images/updir.png' alt='" . ECLASSF_121 . "' title='" . ECLASSF_121 . "' style='border:0;'/></a>";
SC_END

SC_BEGIN ECLASSF_CAT_COLSPAN
global $ECLASSF_PREF, $tp, $eclassf_colspan;
return $eclassf_colspan;
SC_END

SC_BEGIN ECLASSF_CATICON
global $tp,$eclassf_caticon,$eclassf_catname;

if (!empty($eclassf_caticon) && file_exists('./images/icons/' . $eclassf_caticon))
{
	$retval = "<img src='./images/icons/" . $eclassf_caticon . "' alt='" . $tp->toHTML($eclassf_catname) . " icon' title='" . $tp->toHTML($eclassf_catname) . "' style='border:0;'/>";
}
else
{
    $retval .= "<img src='./images/icons/blank.png' alt='category icon' title='' style='border:0;'/>";
}
return $retval;

SC_END

SC_BEGIN ECLASSF_CATNAME
global $eclassf_from,$eclassf_catid,$eclassf_catname,$tp;
$retval ="<a href='" . e_SELF . "?$eclassf_from.sub.$eclassf_catid.0.0'>" . $tp->toHTML($eclassf_catname) . "</a>";
return $retval;
SC_END

SC_BEGIN ECLASSF_CATDESC
global $tp,$eclassf_catdesc;
return $tp->toHTML($eclassf_catdesc);
SC_END

SC_BEGIN ECLASSF_CATSUB
global $ECLASSF_PREF,$eclassf_selector,$catsubs;
return $ECLASSF_PREF['eclassf_subdrop'] == 1?$eclassf_selector: $catsubs;
SC_END

SC_BEGIN ECLASSF_LISTCOLSPAN
global $ECLASSF_PREF, $tp, $eclassf_colspan;
return $eclassf_colspan;
SC_END

SC_BEGIN ECLASSF_LISTNEXTPREV
global $eclassf_nextprev;
return $eclassf_nextprev.'&nbsp;';
SC_END

SC_BEGIN ECLASSF_LISTNAME
global $tp, $eclassf_from, $eclassf_catid, $eclassf_subid, $eclassf_id, $eclassf_name;
$retval = "<a href='" . e_SELF . "?{$eclassf_from}.item.{$eclassf_catid}.{$eclassf_subid}.{$eclassf_id}'>" . $tp->toHTML($eclassf_name) . "</a>";
return $retval;
SC_END

SC_BEGIN ECLASSF_LISTPRICE
global $eclassf_price, $tp;
return $tp->toHTML($eclassf_price);
SC_END

SC_BEGIN ECLASSF_POSTED
global $tp, $eclassf_gen, $eclassf_expires;
if ($eclassf_expires > 0)
{
    $retval = strftime("%d %b %y", $eclassf_expires); // Not very international, but having time makes it look messy replace with parm
}
else
{
    $retval = ECLASSF_43;
}
return $retval;
SC_END

SC_BEGIN ECLASSF_LISTTHUMBS
global $tp, $ECLASSF_PREF, $eclassf_thumbnail, $eclassf_from , $eclassf_catid, $eclassf_subid, $eclassf_id;
$AW=0;
$AH=$ECLASSF_PREF['eclassf_thumbheight'];

if (!empty($eclassf_thumbnail) && file_exists(e_PLUGIN . "e_classifieds/images/classifieds/" . $eclassf_thumbnail))
{
    $img_name = e_PLUGIN . "e_classifieds/image.php?eclassf_picture=" . $eclassf_thumbnail."&amp;eclassf_height=$AH&amp;eclassf_watermark=".$ECLASSF_PREF['eclassf_watermark'];
}
else
{
    $img_name = e_PLUGIN . 'e_classifieds/images/icons/nothumb.png';
}
$retval .= "
	<a href='" . e_SELF . "?{$eclassf_from}.item.{$eclassf_catid}.{$eclassf_subid}.{$eclassf_id}'><img src='{$img_name}' style='border:0;width:".$ECLASSF_PREF['eclassf_thumbheight']."px;height:".$ECLASSF_PREF['eclassf_thumbheight']."px;' alt='" . ECLASSF_114 . "' title='" . ECLASSF_114 . "'/></a>";

return $retval;
SC_END

SC_BEGIN ECLASSF_LIST_CATNAME
global $ECLASSF_PREF, $tp, $force_one_cat, $force_one_sub_cat, $eclassf_subname, $eclassf_catname;
if ($force_one_cat && $force_one_sub_cat)
{
// List of all items for sale
$retval .= "<strong>" . ECLASSF_110 . "</strong>";
} elseif ($force_one_cat)
{
// Use the sub-cat name, but call it a category
$retval .= ECLASSF_46 . " - <strong>" . $tp->toHTML($eclassf_subname) . "</strong>";
}
else
{
// Display both category and sub-category
$retval .= ECLASSF_46 . " - <strong>" . $tp->toHTML($eclassf_catname) . "</strong>: " . ECLASSF_91 . " - <strong>" . $tp->toHTML($eclassf_subname) . "</strong>";
}
return $retval;
SC_END

SC_BEGIN ECLASSF_LISTPOSTER
global $tp,$eclassf_poster;
return $tp->toHTML($eclassf_poster);

SC_END

SC_BEGIN ECLASSF_LISTUPDIR
global $ECLASSF_PREF, $tp, $eclassf_from, $eclassf_tmp, $eclassf_catid, $eclassf_subid, $eclassf_itemid;
return "
	<a href='" . e_SELF . "?$eclassf_from.sub.$eclassf_catid.$eclassf_subid.0'>
		<img src='./images/updir.png' alt='" . ECLASSF_121 . "' title='" . ECLASSF_121 . "' style='border:0;'/>
	</a>";
SC_END


SC_BEGIN ECLASSF_MANAGE
global $ECLASSF_PREF,$eclassf_from,$eclassf_catid,$eclassf_subid,$eclassf_itemid,$eclassf_action;
if (check_class($ECLASSF_PREF['eclassf_create']) || check_class($ECLASSF_PREF['eclassf_admin']) )
{
	$retval = "<a href='" . e_PLUGIN . "e_classifieds/manage_adds.php'>" . ECLASSF_17 . "</a>";
}
else
{
	$retval="";
}
return $retval;
SC_END

SC_BEGIN ECLASSF_TERMSLINK
global $eclassf_from,$eclassf_catid,$eclassf_subid,$eclassf_itemid,$eclassf_action;
$retval = "<a href='" . e_SELF . "?$eclassf_from.tnc.$eclassf_catid.$eclassf_subid.$eclassf_itemid.$eclassf_action'>" . ECLASSF_41 . "</a>";
return $retval;
SC_END

SC_BEGIN ECLASSF_CURRENCY
global $ECLASSF_PREF, $tp;
return $tp->toHTML($ECLASSF_PREF['eclassf_currency']);
SC_END

SC_BEGIN ECLASSF_TANDC
global $ECLASSF_PREF, $tp;
return $tp->toHTML($ECLASSF_PREF['eclassf_terms'], true);
SC_END

SC_BEGIN ECLASSF_UPDIRTC
global $ECLASSF_PREF, $tp, $eclassf_from, $eclassf_tmp, $eclassf_catid, $eclassf_subid, $eclassf_itemid;
return "
	<a href='" . e_SELF . "?$eclassf_from.$eclassf_tmp.$eclassf_catid.$eclassf_subid.$eclassf_itemid'>
		<img src='./images/updir.png' alt='" . ECLASSF_121 . "' title='" . ECLASSF_121 . "' style='border:0;'/>
	</a>";
SC_END

SC_BEGIN ECLASSF_ADVERTCOST
global $gold_obj,$ECLASSF_PREF;
if(is_object($gold_obj) && $gold_obj->gold_plugins['e_classifieds']==1 )
{
	return $gold_obj->formation($ECLASSF_PREF['eclassf_goldcost']);
}
else
{
return '';
}
SC_END
*/