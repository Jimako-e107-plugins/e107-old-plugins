<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
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
global $reviewer_shortcodes;
$reviewer_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
// * start shortcodes
/*
SC_BEGIN REVIEWER_BACK
return '<a href="#" onclick="history.go(-1)"><img src="'.e_PLUGIN.'reviewer/images/back.png" style="border:0px" alt="'.REVIEWER_H030.'" title="'.REVIEWER_H030.'" /></a>';
SC_END

SC_BEGIN REVIEWER_EDIT_STARS
	global $REVIEWER_PREF;
	switch ($parm)
	{
		case '05':
			if($REVIEWER_PREF['reviewer_half']==1)
			{
				return REVIEWER_R05 . "&nbsp;<img src='" . e_PLUGIN . "reviewer/images/rate05.png' alt='" . REVIEWER_R05 . "' title='&frac12; " . REVIEWER_R05 . "'  />";
			}
			else
			{
				return '';
			}
			break;
		case '10':
			return REVIEWER_R10 . "&nbsp;<img src='" . e_PLUGIN . "reviewer/images/rate10.png' alt='" . REVIEWER_R10 . "' title='1 " . REVIEWER_R10 . "'  />";
			break;
		case '15':
			if($REVIEWER_PREF['reviewer_half']==1)
			{
				return REVIEWER_R15 . "&nbsp;<img src='" . e_PLUGIN . "reviewer/images/rate15.png' alt='" . REVIEWER_R15 . "' title='1 &frac12; " . REVIEWER_R15 . "'  />";
			}
			else
			{
				return '';
			}
			break;
		case '20':
			return REVIEWER_R20 . "&nbsp;<img src='" . e_PLUGIN . "reviewer/images/rate20.png' alt='" . REVIEWER_R20 . "' title='2 " . REVIEWER_R20 . "'  />";
			break;
		case '25':
			if($REVIEWER_PREF['reviewer_half']==1)
			{
				return REVIEWER_R25 . "&nbsp;<img src='" . e_PLUGIN . "reviewer/images/rate25.png' alt='" . REVIEWER_R25 . "' title='2 &frac12; " . REVIEWER_R25 . "'  />";
			}
			else
			{
				return '';
			}
			break;
		case '30':
			return REVIEWER_R30 . "&nbsp;<img src='" . e_PLUGIN . "reviewer/images/rate30.png' alt='" . REVIEWER_R30 . "' title='3 " . REVIEWER_R30 . "'  />";
			break;
		case '35':
			if($REVIEWER_PREF['reviewer_half']==1)
			{
				return REVIEWER_R35 . "&nbsp;<img src='" . e_PLUGIN . "reviewer/images/rate35.png' alt='" . REVIEWER_R35 . "' title='3 &frac12; " . REVIEWER_R35 . "'  />";
			}
			else
			{
				return '';
			}
			break;
		case '40':
			return REVIEWER_R40 . "&nbsp;<img src='" . e_PLUGIN . "reviewer/images/rate40.png' alt='" . REVIEWER_R40 . "' title='4 " . REVIEWER_R40 . "'  />";
			break;
		case '45':
			if($REVIEWER_PREF['reviewer_half']==1)
			{
				return REVIEWER_R45 . "&nbsp;<img src='" . e_PLUGIN . "reviewer/images/rate45.png' alt='" . REVIEWER_R45 . "' title='4 &frac12; " . REVIEWER_R45 . "'  />";
			}
			else
			{
				return '';
			}
			break;
		case '50':
			return REVIEWER_R50 . "&nbsp;<img src='" . e_PLUGIN . "reviewer/images/rate50.png' alt='" . REVIEWER_R50 . "' title='5 " . REVIEWER_R50 . "'  />";
			break;
		default:
			return REVIEWER_R00 . "&nbsp;<img src='" . e_PLUGIN . "reviewer/images/rate00.png' alt='" . REVIEWER_R00 . "' title='&frac12; " . REVIEWER_R00 . "'  />";
}
SC_END

SC_BEGIN REVIEWER_VIEW_CREATE
global $reviewer_obj;
if ($reviewer_obj->reviewer_create)
{
	return '<a href="'.e_PLUGIN.'reviewer/reviewer.php?0.create">'.REVIEWER_H021.'</a>';
}
else
{
	return '';
}
SC_END
SC_BEGIN REVIEWER_RATE1
global $REVIEWER_PREF,$tp,$reviewer_category_rate1;
if ($REVIEWER_PREF['reviewer_usecat'] != 1)
{
$retval=str_replace("{REVIEWER_RATE1}",REVIEWER_RATE1,$REVIEWER_PREF['reviewer_rate1']);
}
else
{
$retval=str_replace("{REVIEWER_RATE1}",REVIEWER_RATE1,$reviewer_category_rate1);
}
return $tp->toHTML($retval);

SC_END

SC_BEGIN REVIEWER_RATE2
global $REVIEWER_PREF,$tp,$reviewer_category_rate2;
if ($REVIEWER_PREF['reviewer_usecat'] != 1)
{
$retval=str_replace("{REVIEWER_RATE2}",REVIEWER_RATE2,$REVIEWER_PREF['reviewer_rate2']);
}
else
{
$retval=str_replace("{REVIEWER_RATE1}",REVIEWER_RATE1,$reviewer_category_rate2);
}
return $tp->toHTML($retval);
SC_END

SC_BEGIN REVIEWER_RATE3
global $REVIEWER_PREF,$tp,$reviewer_category_rate3;
if ($REVIEWER_PREF['reviewer_usecat'] != 1)
{
$retval=str_replace("{REVIEWER_RATE3}",REVIEWER_RATE3,$REVIEWER_PREF['reviewer_rate3']);
}
else
{
$retval=str_replace("{REVIEWER_RATE1}",REVIEWER_RATE1,$reviewer_category_rate3);
}
return $tp->toHTML($retval);
SC_END

SC_BEGIN REVIEWER_RATE4
global $REVIEWER_PREF,$tp,$reviewer_category_rate4;
if ($REVIEWER_PREF['reviewer_usecat'] != 1)
{
$retval=str_replace("{REVIEWER_RATE4}",REVIEWER_RATE4,$REVIEWER_PREF['reviewer_rate4']);
}
else
{
$retval=str_replace("{REVIEWER_RATE1}",REVIEWER_RATE1,$reviewer_category_rate4);
}
return $tp->toHTML($retval);
SC_END

SC_BEGIN REVIEWER_RATE5
global $REVIEWER_PREF,$tp,$reviewer_category_rate5;
if ($REVIEWER_PREF['reviewer_usecat'] != 1)
{
$retval=str_replace("{REVIEWER_RATE5}",REVIEWER_RATE5,$REVIEWER_PREF['reviewer_rate5']);
}
else
{
$retval=str_replace("{REVIEWER_RATE1}",REVIEWER_RATE1,$reviewer_category_rate5);
}
return $tp->toHTML($retval);
SC_END

SC_BEGIN REVIEWER_RATE6
global $REVIEWER_PREF,$tp,$reviewer_category_rate6;
if ($REVIEWER_PREF['reviewer_usecat'] != 1)
{
$retval=str_replace("{REVIEWER_RATE6}",REVIEWER_RATE6,$REVIEWER_PREF['reviewer_rate6']);
}
else
{
$retval=str_replace("{REVIEWER_RATE1}",REVIEWER_RATE1,$reviewer_category_rate6);
}
return $tp->toHTML($retval);
SC_END

SC_BEGIN REVIEWER_RATE7
global $REVIEWER_PREF,$tp,$reviewer_category_rate7;
if ($REVIEWER_PREF['reviewer_usecat'] != 1)
{
$retval=str_replace("{REVIEWER_RATE7}",REVIEWER_RATE7,$REVIEWER_PREF['reviewer_rate7']);
}
else
{
$retval=str_replace("{REVIEWER_RATE1}",REVIEWER_RATE1,$reviewer_category_rate7);
}
return $tp->toHTML($retval);
SC_END

SC_BEGIN REVIEWER_RATE8
global $REVIEWER_PREF,$tp,$reviewer_category_rate8;
if ($REVIEWER_PREF['reviewer_usecat'] != 1)
{
$retval=str_replace("{REVIEWER_RATE8}",REVIEWER_RATE8,$REVIEWER_PREF['reviewer_rate8']);
}
else
{
$retval=str_replace("{REVIEWER_RATE1}",REVIEWER_RATE1,$reviewer_category_rate8);
}
return $tp->toHTML($retval);
SC_END

SC_BEGIN REVIEWER_RATE9
global $REVIEWER_PREF,$tp,$reviewer_category_rate9;
if ($REVIEWER_PREF['reviewer_usecat'] != 1)
{
$retval=str_replace("{REVIEWER_RATE9}",REVIEWER_RATE9,$REVIEWER_PREF['reviewer_rate9']);
}
else
{
$retval=str_replace("{REVIEWER_RATE1}",REVIEWER_RATE1,$reviewer_category_rate9);
}
return $tp->toHTML($retval);
SC_END

SC_BEGIN REVIEWER_RATE10
global $REVIEWER_PREF,$tp,$reviewer_category_rate10;
if ($REVIEWER_PREF['reviewer_usecat'] != 1)
{
$retval=str_replace("{REVIEWER_RATE10}",REVIEWER_RATE10,$REVIEWER_PREF['reviewer_rate10']);
}
else
{
$retval=str_replace("{REVIEWER_RATE1}",REVIEWER_RATE1,$reviewer_category_rate10);
}
return $tp->toHTML($retval);
SC_END

SC_BEGIN REVIEWER_TANDC
global $tp,$REVIEWER_PREF;
if (empty($REVIEWER_PREF['reviewer_TC']))
{
	return $tp->toHTML(REVIEWER_TANDC);
}
else
{
	return $tp->toHTML($REVIEWER_PREF['reviewer_TC']);
}
SC_END

SC_BEGIN REVIEWER_ITEM_PICTURE
global $tp,$reviewer_items_picture;

$tmp=explode(',',$parm);
$height=$tmp[0];
$width=$tmp[1];
if (file_exists(e_PLUGIN."reviewer/images/itempics/".$reviewer_items_picture))
{
if($width>0 && $height>0)
{
	return "<img src='".e_PLUGIN."reviewer/images/itempics/".$tp->toFORM($reviewer_items_picture)."' alt='' style='height:{$height}px;width:{$width}px;border:0px;' />";
}
else
{
	return "<img src='".e_PLUGIN."reviewer/images/itempics/".$tp->toFORM($reviewer_items_picture)."' alt='' style='border:0px;' />";
}


}
else
{
	return "&nbsp;";
}
SC_END

SC_BEGIN REVIEWER_ITEM_UPDIR
global $reviewer_items_id,$reviewer_from;
return "<a href='".e_SELF."?$reviewer_from.item.$reviewer_items_id'><img src='images/updir.png' style='border:0px;'  alt='' title='' /></a>";
SC_END
SC_BEGIN REVIEWER_MESSAGE
global $reviewer_msg;
return $reviewer_msg;
SC_END

SC_BEGIN REVIEWER_LIST_UPDIR
global $reviewer_itemid,$reviewer_from;
return "<a href='".e_SELF."?$reviewer_from.list'><img src='images/updir.png' style='border:0px;'  alt='back' title='back' /></a>";
SC_END

SC_BEGIN REVIEWER_CATLOGO
global $reviewer_caticon;
return "<img src='".e_PLUGIN."reviewer/images/caticons/{$reviewer_caticon}' alt='$reviewer_caticon' title='' />";
SC_END

SC_BEGIN REVIEWER_ITEM_SITE
global $tp,$reviewer_items_url;
if (!empty($reviewer_items_url))
{
	return "<a href='".urldecode($tp->toFORM($reviewer_items_url))."' rel='external' >".REVIEWER_H006."</a>";
}
else
{
	return "";
}
SC_END

SC_BEGIN REVIEWER_ITEM_EDIT
global $reviewer_obj,$reviewer_items_posterid,$reviewer_items_id;
if($reviewer_obj->reviewer_admin || ($reviewer_obj->reviewer_editownitem && $reviewer_obj->reviewer_create && $reviewer_items_posterid=USERID))
{
	return "<a href='".e_SELF."?0.edit.$reviewer_items_id' ><img src='".e_IMAGE."admin_images/edit_16.png' style='border:0px' alt='' title='' /></a>";
}
else
{
	return '';
}

SC_END

SC_BEGIN REVIEWER_ACCEPT
global $tp;
$reviewer_accept = "<a href='" . e_SELF . "?0.agreed'>" . REVIEWER_TANDC02 . "</a>";
return $tp->toHTML($reviewer_accept);
SC_END

SC_BEGIN REVIEWER_REJECT
global $tp;
$reviewer_reject = "<a href='" . SITEURL . "index.php'>" . REVIEWER_TANDC03 . "</a>";
return $tp->toHTML($reviewer_reject);
SC_END

SC_BEGIN REVIEWER_VIEW_NEXTPREV
global $reviewer_nextprev;
return $reviewer_nextprev."&nbsp;";
SC_END

SC_BEGIN REVIEWER_CATLIST
global $reviewer_selcat;
return $reviewer_selcat;
SC_END

SC_BEGIN REVIEWER_CATFILTER
global $reviewer_list;
if ($reviewer_list > 1)
{
    return "<input type='submit' class='button' name='reviewer_filter' value='" . REVIEWER_H004 . "' />";
}
else
{
    return "";
}
SC_END

SC_BEGIN REVIEWER_ITEMS_NAME
global $reviewer_items_name;
return  $reviewer_items_name;
SC_END

SC_BEGIN REVIEWER_ITEMS_STARS
global $reviewer_items_stars;
return $reviewer_items_stars;
SC_END

SC_BEGIN REVIEWER_ITEMS_VOTES
global $reviewer_items_votes;
return $reviewer_items_votes;
SC_END

SC_BEGIN REVIEWER_ITEMS_LASTPOST
global $reviewer_lastpost;
if ($reviewer_lastpost >0)
{
return date($parm,$reviewer_lastpost);
}
else
{
return "&nbsp;";
}
SC_END

SC_BEGIN REVIEWER_ITEMS_EDIT
global $reviewer_obj,$reviewer_item_edit,$reviewer_reviewer_posterid;
if ($reviewer_obj->reviewer_admin || ($reviewer_obj->reviewer_editown && USERID==$reviewer_reviewer_posterid))
{
	return $reviewer_item_edit;
}
else
{
	return "";
}
SC_END

SC_BEGIN REVIEWER_ITEMS_VIEW
global $reviewer_item_view;

	return $reviewer_item_view;

SC_END


SC_BEGIN REVIEWER_ITEMS_DELETE
global $reviewer_obj,$reviewer_item_delete;
if ($reviewer_obj->reviewer_admin)
{
return $reviewer_item_delete;
}
else
{
	return "";
}
SC_END

SC_BEGIN REVIEWER_ITEM_POSTER
global $reviewer_reviewer_postername;
return $reviewer_reviewer_postername;
SC_END

SC_BEGIN REVIEWER_EDIT_POSTER
global $reviewer_reviewer_postername;
if (USER)
{
	return $reviewer_reviewer_postername;
}
else
{
	return "<input type=text' style='width:50%' name='reviewer_reviewer_postername' value='".$reviewer_reviewer_postername."' class='tbox' />";
}
SC_END
SC_BEGIN REVIEWER_ITEM_POSTDATE
global $reviewer_reviewer_posted;
if ($reviewer_reviewer_posted >0)
{
	return date($parm,$reviewer_reviewer_posted);
}
else
{
	return "&nbsp;";
}
SC_END
SC_BEGIN REVIEWER_ITEM_RATE1
global $reviewer_rate1;
return $reviewer_rate1;
SC_END

SC_BEGIN REVIEWER_ITEM_RATE2
global $reviewer_rate2;
return $reviewer_rate2;
SC_END

SC_BEGIN REVIEWER_ITEM_RATE3
global $reviewer_rate3;
return $reviewer_rate3;
SC_END

SC_BEGIN REVIEWER_ITEM_RATE4
global $reviewer_rate4;
return $reviewer_rate4;
SC_END

SC_BEGIN REVIEWER_ITEM_RATE5
global $reviewer_rate5;
return $reviewer_rate5;
SC_END

SC_BEGIN REVIEWER_ITEM_RATE6
global $reviewer_rate6;
return $reviewer_rate6;
SC_END
SC_BEGIN REVIEWER_ITEM_RATE7
global $reviewer_rate7;
return $reviewer_rate7;
SC_END
SC_BEGIN REVIEWER_ITEM_RATE8
global $reviewer_rate8;
return $reviewer_rate8;
SC_END
SC_BEGIN REVIEWER_ITEM_RATE9
global $reviewer_rate9;
return $reviewer_rate9;
SC_END
SC_BEGIN REVIEWER_ITEM_RATE10
global $reviewer_rate10;
return $reviewer_rate10;
SC_END

SC_BEGIN REVIEWER_ITEM_VOTES
global $reviewer_votes;
return $reviewer_votes;
SC_END
SC_BEGIN REVIEWER_VIEW_RATE1
global $reviewer_rate1;
return $reviewer_rate1;
SC_END

SC_BEGIN REVIEWER_VIEW_RATE2
global $reviewer_rate2;
return $reviewer_rate2;
SC_END

SC_BEGIN REVIEWER_VIEW_RATE3
global $reviewer_rate3;
return $reviewer_rate3;
SC_END

SC_BEGIN REVIEWER_VIEW_RATE4
global $reviewer_rate4;
return $reviewer_rate4;
SC_END

SC_BEGIN REVIEWER_VIEW_RATE5
global $reviewer_rate5;
return $reviewer_rate5;
SC_END

SC_BEGIN REVIEWER_VIEW_RATE6
global $reviewer_rate6;
return $reviewer_rate6;
SC_END
SC_BEGIN REVIEWER_VIEW_RATE7
global $reviewer_rate7;
return $reviewer_rate7;
SC_END
SC_BEGIN REVIEWER_VIEW_RATE8
global $reviewer_rate8;
return $reviewer_rate8;
SC_END
SC_BEGIN REVIEWER_VIEW_RATE9
global $reviewer_rate9;
return $reviewer_rate9;
SC_END
SC_BEGIN REVIEWER_VIEW_RATE10
global $reviewer_rate10;
return $reviewer_rate10;
SC_END

SC_BEGIN REVIEWER_VIEW_EMAIL
global $reviewer_reviewer_ep;

	$reviewer_email = "&nbsp;<a href='../../email.php?plugin:reviewer.$reviewer_reviewer_ep' title='" . REVIEWER_V021 . "'><img src='" . e_IMAGE . "generic/" . IMODE . "/email.png' style='border:0;' alt='" . REVIEWER_V021 . "' /></a>";
return $reviewer_email;
SC_END

SC_BEGIN REVIEWER_VIEW_PRINT
global $reviewer_reviewer_ep;
	$reviewer_print .= "&nbsp;<a href='../../print.php?plugin:reviewer.$reviewer_reviewer_ep' title='" . REVIEWER_V022 . "'><img src='" . e_IMAGE . "generic/" . IMODE . "/printer.png' style='border:0;' alt='" . REVIEWER_V022 . "' /></a>";
return $reviewer_print;
SC_END

SC_BEGIN REVIEWER_ITEMS_IMAGE
global $tp,$reviewer_item_image;
return $tp->toHTML($reviewer_item_image);
SC_END

SC_BEGIN REVIEWER_ITEMNAME
global $tp,$reviewer_items_name;
return $tp->toHTML($reviewer_items_name);
SC_END

SC_BEGIN REVIEWER_ITEMDESC
global $tp,$reviewer_items_description;
return $tp->toHTML($reviewer_items_description,true);
SC_END

SC_BEGIN REVIEWER_ITEM_OVERALL
global $tp,$reviewer_rateo;
return $reviewer_rateo;
SC_END

SC_BEGIN REVIEWER_ITEM_DETAIL
global $tp,$reviewer_item_detail;
return $tp->toHTML($reviewer_item_detail);
SC_END

SC_BEGIN REVIEWER_ITEM_COMMENTS
global $tp,$reviewer_reviewer_review;
return $tp->toHTML($reviewer_reviewer_review,true);
SC_END

SC_BEGIN REVIEWER_ADD_REVIEW
global $tp,$reviewer_itemid,$reviewer_obj,$reviewer_allow_new;
$reviewer_add="<a href='" . e_SELF . "?0.add.$reviewer_itemid'>".REVIEWER_V005."</a>";
if ($reviewer_allow_new && ($reviewer_obj->reviewer_creator || $reviewer_obj->reviewer_admin) )
{
	return $reviewer_add;
}
elseif (!$reviewer_allow_new)
{
	return REVIEWER_V012;
}
else
{
	return "";
	}
SC_END

SC_BEGIN REVIEWER_EDIT_COMMENTS
global $reviewer_reviewer_review;
return $reviewer_reviewer_review;
SC_END

SC_BEGIN REVIEWER_EDIT_RATE1
global $reviewer_rate1;
return $reviewer_rate1;
SC_END

SC_BEGIN REVIEWER_EDIT_RATE2
global $reviewer_rate2;
return $reviewer_rate2;
SC_END

SC_BEGIN REVIEWER_EDIT_RATE3
global $reviewer_rate3;
return $reviewer_rate3;
SC_END

SC_BEGIN REVIEWER_EDIT_RATE4
global $reviewer_rate4;
return $reviewer_rate4;
SC_END

SC_BEGIN REVIEWER_EDIT_RATE5
global $reviewer_rate5;
return $reviewer_rate5;
SC_END

SC_BEGIN REVIEWER_EDIT_RATE6
global $reviewer_rate6;
return $reviewer_rate6;
SC_END
SC_BEGIN REVIEWER_EDIT_RATE7
global $reviewer_rate7;
return $reviewer_rate7;
SC_END
SC_BEGIN REVIEWER_EDIT_RATE8
global $reviewer_rate8;
return $reviewer_rate8;
SC_END
SC_BEGIN REVIEWER_EDIT_RATE9
global $reviewer_rate9;
return $reviewer_rate9;
SC_END
SC_BEGIN REVIEWER_EDIT_RATE10
global $reviewer_rate10;
return $reviewer_rate10;
SC_END

SC_BEGIN REVIEWER_EDIT_SAVE
return "<input type='submit' class='button' name='submitrev' value='".REVIEWER_V006."' />";
SC_END

SC_BEGIN REVIEWER_EDIT_UPDIR
global $reviewer_edit_updir;
return $reviewer_edit_updir;
SC_END

SC_BEGIN REVIEWER_EDIT_SECURE
global $reviewer_secimg,$REVIEWER_PREF;
if (!USER && $REVIEWER_PREF['reviewer_captcha']>0)
{
	return $reviewer_secimg->r_image()." <input class='tbox' type='text' name='reviewer_code_verify' size='15' maxlength='20' />" ;
}
else
{
	return "&nbsp;";
}
SC_END
SC_BEGIN REVIEWER_EDIT_MESSAGE
global $reviewer_invalid;
return "<b>$reviewer_invalid</b>";
SC_END
SC_BEGIN REVIEWER_CONFIRMDELETE
global $reviewer_confirmdelete;
return $reviewer_confirmdelete;
SC_END
SC_BEGIN REVIEWER_CANCELDELETE
global $reviewer_canceldelete;
return $reviewer_canceldelete;
SC_END

SC_BEGIN REVIEWER_CONFIRM_UPDIR
global $reviewer_confirm_updir;
return $reviewer_confirm_updir;
SC_END

SC_BEGIN REVIEWER_CATICONS
global $reviewer_iconlist;
return $reviewer_iconlist;
SC_END

SC_BEGIN REVIEWER_SUBMIT_CAT

global $reviewer_catlist;
return $reviewer_catlist;
SC_END

SC_BEGIN REVIEWER_CATDESC
global $reviewer_catdesc;
return $reviewer_catdesc;
SC_END

SC_BEGIN REVIEWER_SUBMIT_NAME
global $tp,$reviewer_items_name;
return '<input type="text" class="tbox" name="reviewer_items_name" style="width:50%" value="'.$tp->toFORM($reviewer_items_name).'" />';
SC_END

SC_BEGIN REVIEWER_SUBMIT_DESC
global $reviewer_items_description,$tp;
return '<textarea name="reviewer_items_description"  class="tbox" rows="5" cols="50" style="width:75%" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">'.$tp->toFORM($reviewer_items_description).'</textarea>
		<br /><input type="text" style="width:85%;border:0;" class="help" id="helpb" /><br />' . display_help('helpb').'&nbsp;';
SC_END

SC_BEGIN REVIEWER_SUBMIT_URL
global $reviewer_items_url,$tp;
return "<input class='tbox' style='width:60%' type='text' name='reviewer_items_url' value='".$tp->toFORM($reviewer_items_url)."' />";
SC_END

SC_BEGIN REVIEWER_SUBMIT_PIC
		global		$reviewer_piclist;
		return		$reviewer_piclist;
SC_END

SC_BEGIN REVIEWER_SUBMIT_OK
return 	"<input type='submit' class='button' name='reviewer_save' value='" . REVIEWER_AI012 . "' />";
SC_END

SC_BEGIN REVIEWER_SUBMIT_APPROVAL
global $reviewer_obj,$reviewer_items_approved;
if ($reviewer_obj->reviewer_admin)
{
	return 	"<input type='checkbox' name='reviewer_items_approved' class='tbox' value='1' ".($reviewer_items_approved==1?"checked='checked'":"")." />";
}
elseif($reviewer_obj->reviewer_auto)
{
	return REVIEWER_H023;
}
else
{
	return REVIEWER_H024;
}
SC_END

SC_BEGIN REVIEWER_SUBMIT_UPLOAD
return "<input  name='file_userfile[]' type='file' class='tbox' />&nbsp;<input type='submit' class='button' name='reviewer_upfile' value='".REVIEWER_AI031."'/>";
SC_END

SC_BEGIN REVIEWER_ULIST_DATE
global $reviewer_reviewer_posted;
return date($parm,$reviewer_reviewer_posted);
SC_END

SC_BEGIN REVIEWER_ULIST_ITEM
global $tp,$reviewer_items_name,$reviewer_reviewer_itemid,$reviewer_reviewer_id;
return '<a href="'.e_PLUGIN.'reviewer/reviewer.php?0.view.'.$reviewer_reviewer_id.'">'.$tp->toHTML($reviewer_items_name,false).'</a>';
SC_END

SC_BEGIN REVIEWER_ULIST_REVIEW
global $tp,$reviewer_reviewer_review;
return $tp->html_truncate($tp->toHTML($reviewer_reviewer_review,false),90,'[...]');

SC_END

SC_BEGIN REVIEWER_ULIST_RATE
global $overall_rate,$reviewer_reviewer_id;
return '<a href="'.e_PLUGIN.'reviewer/reviewer.php?0.view.'.$reviewer_reviewer_id.'">'.$overall_rate.'</a>';
SC_END

SC_BEGIN REVIEWER_ULIST_VIEW
global $reviewer_reviewer_id;
return '<a href="'.e_PLUGIN.'reviewer/reviewer.php?0.view.'.$reviewer_reviewer_id.'"><img src="'.e_IMAGE.'admin_images/content_16.png" style="border:0px;" alt="'.REVIEWER_UL06.'" title="'.REVIEWER_UL06.'" /></a>';
SC_END

SC_BEGIN REVIEWER_UMEMBER
global $tp,$user_name;
return $tp->toHTML($user_name,false);
SC_END

SC_BEGIN REVIEWER_RLIST_MEMBER
   global $tp,$reviewer_postername,$reviewer_posterid;
   return "<a href='".e_SELF."?0.ulist.$reviewer_posterid' >".$tp->toHTML($reviewer_postername,false)."</a>";
SC_END

SC_BEGIN REVIEWER_RLIST_NUMBER
   global $reviewer_numcounts;
   return $reviewer_numcounts;

SC_END

SC_BEGIN REVIEWER_RLIST_DATE
   global $reviewer_lastpost;
   return date($parm,$reviewer_lastpost);
SC_END
*/

?>