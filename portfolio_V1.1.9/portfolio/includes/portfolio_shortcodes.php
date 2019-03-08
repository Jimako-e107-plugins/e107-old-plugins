<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_once(e_HANDLER . 'shortcode_handler.php');
global $portfolio_shortcodes;
$portfolio_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
SC_BEGIN PORTFOLIO_CAPTION
global $tp, $portfolio_obj;
return $tp->toHTML($portfolio_obj->portfolio_caption, false);
SC_END

SC_BEGIN PORTFOLIO_MESSAGE
global $portfolio_msg;
return $portfolio_msg;
SC_END

SC_BEGIN PORTFOLIO_LIST
global $tp, $portfolio_obj;
return $tp->toHTML($portfolio_obj->portfolio_cat, false);
SC_END

SC_BEGIN PORTFOLIO_NEW
global $sql2,$portfolio_obj,$PORTFOLIO_PREF;
$portfolio_num=$sql2->db_Count('portfolio_person','(*)','where portfolio_person_poster="'.USERID.'.'.USERNAME.'"',false);
if ($portfolio_obj->portfolio_post)
{
	if($PORTFOLIO_PREF['portfolio_max']>0 && $portfolio_num>=$PORTFOLIO_PREF['portfolio_max'])
	{
		return PORTFOLIO_62.' '.$PORTFOLIO_PREF['portfolio_max'].' '.PORTFOLIO_63.' '.PORTFOLIO_64.' '.$portfolio_num;
	}
	else
	{
	if($PORTFOLIO_PREF['portfolio_max']>0)
	{
		return "<a href='" . e_SELF . "?0.new' >".PORTFOLIO_53."</a>" .' '.PORTFOLIO_62.' '.$PORTFOLIO_PREF['portfolio_max'].' '.PORTFOLIO_63;
	}
	else
	{
	return "<a href='" . e_SELF . "?0.new' >".PORTFOLIO_53."</a>";
	}
	}
}
else
{
	return "";
}
SC_END

SC_BEGIN PORTFOLIO_PROJECTACTIVITY_TITLE
global $tp, $portfolio_obj;
return $tp->toHTML($portfolio_obj->portfolio_pa, false);
SC_END

SC_BEGIN PORTFOLIO_DEPT_DESCRIPTION
global $tp,$portfoliocat_description;
return $tp->toHTML($portfoliocat_description,false);
SC_END

SC_BEGIN PORTFOLIO_LIST_SHORTDESC
global $portfolio_row, $tp;
return $tp->toHTML($portfolio_row['portfoliocat_shortdesc'], false);
SC_END

SC_BEGIN PORTFOLIO_LIST_PROJECT
global $tp, $portfolio_row, $portfolio_from, $portfolio_catfrom, $portfolio_listfrom;
return "<a href='?$portfolio_from.proj." . $portfolio_row['portfoliocat_id'] . "'>" . $tp->toHTML($portfolio_row['portfoliocat_name'], false) . "</a>";
SC_END

SC_BEGIN PORTFOLIO_SUB_LIST
global $tp, $portfolio_obj;
return $tp->toHTML($portfolio_obj->portfolio_subcat, false);
SC_END



SC_BEGIN PORTFOLIO_SUB_PROJECT
global $tp, $portfolio_row2, $portfolio_from;
return "<a href='?$portfolio_from.dept." . $portfolio_row2['portfoliocat_id'] . "'>" . $tp->toHTML($portfolio_row2['portfoliocat_name'], false) . "</a>";
SC_END

SC_BEGIN PORTFOLIO_SUB_SHORTDESC
global $portfolio_row2, $tp;
return $tp->toHTML($portfolio_row2['portfoliocat_shortdesc'], false);
SC_END

SC_BEGIN PORTFOLIO_SUB_STAFF
global $portfolio_count;
return $portfolio_count;
SC_END
SC_BEGIN PORTFOLIO_LIST_NEXTPREV
global $portfolio_nextprev;
return $portfolio_nextprev;
SC_END

SC_BEGIN PORTFOLIO_LIST_ERRORS
global $tp, $portfolio_obj;
if (!empty($portfolio_obj->portfolio_notify))
{
    $smailaddr = explode("@", $portfolio_obj->portfolio_notify);
    // Little script just to avoid having a mailto:xxx@yyy.com in the page source
    $portfolio_text .= PORTFOLIO_20 . "&nbsp;
	<script type='text/javascript'>
	<!--
		var contact='" . $smailaddr[0] . " at " . $smailaddr[1] . "'
		var email='" . $smailaddr[0] . "'
		var emailHost='" . $smailaddr[1] . $subject . "'
		document.write(\"<a href=\" + \"mail\" + \"to:\" + email + \"@\" + emailHost+ \">\" + contact + \"</a>\" + \"\")
		//-->
		</script>";
}
else
{
    $portfolio_text = "";
}
return $portfolio_text;
SC_END

SC_BEGIN PORTFOLIO_DEPT_UPDIR
global $portfolio_from;
return "asd<a href='?$portfolio_from.list'><img src='./images/updir.png' alt='" . PORTFOLIO_8 . "' style='border:0' /></a>";
SC_END

SC_BEGIN PORTFOLIO_PROJ_UPDIR
global $portfolio_from;
return "<a href='?$portfolio_from.list'><img src='./images/updir.png' alt='" . PORTFOLIO_8 . "' style='border:0' /></a>";
SC_END
SC_BEGIN PORTFOLIO_LIST_UPDIR
global $portfolio_from;
return "<a href='?$portfolio_from.list'><img src='./images/updir.png' alt='" . PORTFOLIO_8 . "' style='border:0' /></a>";
SC_END

SC_BEGIN PORTFOLIO_DEPT_STAFF_UPDIR
global $portfolio_id, $portfolio_from, $portfolio_row;

return "<a href='?$portfolio_from.list'><img src='./images/updir.png' alt='" . PORTFOLIO_8 . "' style='border:0' /></a>";
SC_END

SC_BEGIN PORTFOLIO_DEPT_NAME
global $tp, $portfoliocat_name;
return $tp->toHTML($portfoliocat_name, false);
SC_END

SC_BEGIN PORTFOLIO_DEPT_PICTURE
global $tp, $portfoliocat_imageurl, $portfoliocat_imagetext, $portfolio_obj;
return "
	<a href='" . e_PLUGIN . "portfolio/images/portfolio/" . $portfoliocat_imageurl . "' onclick=\"window.open(this.href, 'blank'); return false;\">

		<img src='" . e_PLUGIN . "portfolio/images/portfolio/" . $portfoliocat_imageurl . "' style='border:0;width:" . $portfolio_obj->portfolio_catpich . "px;height:" . $portfolio_obj->portfolio_cattpicv . "px;' title='" . $tp->toFORM($portfoliocat_imagetext) . "' alt='" . $tp->toFORM($portfoliocat_imagetext) . "'  />
	</a>";
SC_END

SC_BEGIN PORTFOLIO_DEPT_TOPTITLE
global $tp, $portfoliocat_desctoptitle;
return $tp->toHTML($portfoliocat_desctoptitle, false);
SC_END

SC_BEGIN PORTFOLIO_DEPT_TOPDESC
global $tp, $portfoliocat_desctop;
return $tp->toHTML($portfoliocat_desctop, true);
SC_END

SC_BEGIN PORTFOLIO_DEPT_LEFTTITLE
global $tp, $portfoliocat_desclefttitle;
return $tp->toHTML($portfoliocat_desclefttitle, false);
SC_END

SC_BEGIN PORTFOLIO_DEPT_LEFTDESC
global $tp, $portfoliocat_descleft;
return $tp->toHTML($portfoliocat_descleft, true);
SC_END

SC_BEGIN DEPT_DEPT_LASTUPDATED
global $tp, $portfolio_lu;
return $tp->toHTML($portfolio_lu, false);
SC_END

SC_BEGIN DEPT_DEPT_EMAIL
global $portfoliocat_email;
$emailaddr = explode("@", $portfoliocat_email);
return "<script type='text/javascript'>
		<!--
		var contact='" . $emailaddr[0] . " at " . $emailaddr[1] . "'
		var email='" . $emailaddr[0] . "'
		var emailHost='" . $emailaddr[1] . $subject . "'
		document.write(\"<a href=\" + \"mail\" + \"to:\" + email + \"@\" + emailHost+ \">\" + contact + \"</a>\" + \"\")
		//-->
		</script>";
SC_END

SC_BEGIN PORTFOLIO_DEPT_PHONE
global $tp, $portfoliocat_phone;
return $tp->toHTML($portfoliocat_phone, false);
SC_END

SC_BEGIN PORTFOLIO_DEPT_PRINT
global $portfolio_person_id;

return '<a href="../../print.php?plugin:portfolio.'.$portfolio_person_id.'"><img src="'.e_IMAGE.'generic/'.IMODE.'/printer.png" alt="'.PORTFOLIO_CON_48.'" title="'.PORTFOLIO_CON_48.'" style="border:0px;" /></a>';
SC_END

SC_BEGIN PORTFOLIO_DEPT_EMAIL
global $portfolio_person_id;

return '<a href="../../email.php?plugin:portfolio.'.$portfolio_person_id.'"><img src="'.e_IMAGE.'generic/'.IMODE.'/email.png" alt="'.PORTFOLIO_CON_49.'" title="'.PORTFOLIO_CON_49.'" style="border:0px;" /></a>';

SC_END

SC_BEGIN PORTFOLIO_DEPT_PDF
global $portfolio_id,$sql,$pref;
if ($pref['plug_installed'][pdf])
{
	return "<a href='".e_PLUGIN."pdf/pdf.php?plugin:portfolio.$portfolio_id'><img src='".e_PLUGIN."pdf/images/pdf_16.png' style='border:0;' alt='pdf' /></a>";
}
else
{
	return "";
}
SC_END

SC_BEGIN PORTFOLIO_DEPT_EDIT
global $portfolio_obj,$portfolio_person_id,$portfolio_person_poster;
$portfolio_tmp=explode(".",$portfolio_person_poster,2);
if ($portfolio_obj->portfolio_super || USERID==$portfolio_tmp[0])
{
	return '<a href="'.e_SELF.'?0.edit.'.$portfolio_person_id.'"><img src="'.e_IMAGE.'admin_images/edit_16.png" alt="'.PORTFOLIO_CON_50.'" title="'.PORTFOLIO_CON_50.'" style="border:0px;" /></a>';
}
else
{
	return "";
}
SC_END

SC_BEGIN PORTFOLIO_DEPT_DELETE
global $portfolio_obj,$portfolio_id;
if ($portfolio_obj->portfolio_super)
{
	return '<a href="'.e_SELF.'?0.delete.'.$portfolio_id.'"><img src="'.e_IMAGE.'admin_images/delete_16.png" alt="'.PORTFOLIO_CON_51.'" title="'.PORTFOLIO_CON_51.'" style="border:0px;" /></a>';
}
else
{
	return "";
}

SC_END

SC_BEGIN PORTFOLIO_STAFF_DELETE
return '<input type="submit" class="button" name="portfolio_delete" value="'.PORTFOLIO_47.'" />';
SC_END

SC_BEGIN PORTFOLIO_STAFF_CANCEL
return '<input type="submit" class="button" name="portfolio_cancel" value="'.PORTFOLIO_48.'" />';
SC_END


SC_BEGIN PORTFOLIO_STAFF_UPDIR
global $portfolio_from, $portfolio_person_cat;
return "<a href='?$portfolio_from.dept.$portfolio_person_cat'><img src='./images/updir.png' alt='" . PORTFOLIO_8 . "' style='border:0' /></a>";
SC_END

SC_BEGIN PORTFOLIO_STAFF_NAME
global $tp, $portfolio_person_name;
return $tp->toHTML($portfolio_person_name, false);
SC_END

SC_BEGIN PORTFOLIO_STAFF_DETAILS
global $tp, $portfolio_person_biography;
return $tp->toHTML($portfolio_person_biography, true);
SC_END

SC_BEGIN PORTFOLIO_STAFF_ADDITIONAL
global $tp, $portfolio_person_additional;
return $tp->toHTML($portfolio_person_additional, true);
SC_END

SC_BEGIN PORTFOLIO_STAFF_PHONE
global $tp, $portfolio_person_phone, $portfolio_person_showphone;
if ($portfolio_person_showphone == 1)
{
    return $tp->toHTML($portfolio_person_phone, false);
}
else
{
    return PORTFOLIO_30;
}
SC_END

SC_BEGIN PORTFOLIO_STAFF_EMAIL
global $portfolio_person_email, $portfolio_person_showemail;
if ($portfolio_person_showemail == 1)
{
    $emailaddr = explode("@", $portfolio_person_email);
    return "<script type='text/javascript'>
		<!--
		var contact='" . $emailaddr[0] . " at " . $emailaddr[1] . "'
		var email='" . $emailaddr[0] . "'
		var emailHost='" . $emailaddr[1] . $subject . "'
		document.write(\"<a href=\" + \"mail\" + \"to:\" + email + \"@\" + emailHost+ \">\" + contact + \"</a>\" + \".\")
		//-->
		</script>";
}
else
{
    return PORTFOLIO_31;
}
SC_END

SC_BEGIN PORTFOLIO_STAFF_CONTACT
global $tp,$portfolio_person_contact;
return $tp->toHTML($portfolio_person_contact,false);
SC_END

SC_BEGIN PORTFOLIO_STAFF_WEBSITE
global $tp, $portfolio_person_websiteurl, $portfolio_person_websitename;
if(!empty($portfolio_person_websiteurl) && !empty($portfolio_person_websitename))
{
return '<a href="' . $tp->toFORM($portfolio_person_websiteurl) . '" rel="external"  >' . $tp->toHTML($portfolio_person_websitename, false) . '</a>';
}elseif(!empty($portfolio_person_websitename))
{
return  $tp->toHTML($portfolio_person_websitename, false) ;
}
else
{
return PORTFOLIO_CON_47;
}
SC_END

SC_BEGIN PORTFOLIO_STAFF_ATTACHMENT

global $tp,$portfolio_person_poster,$portfolio_person_attachment;
	$tmp=explode(".",$portfolio_person_poster,2);
if (!empty($portfolio_person_attachment) && is_readable(e_PLUGIN.'portfolio/uploads/portfolio/'.$tmp[0].'/'.$tp->toFORM($portfolio_person_attachment)))
{

	return '<a href= "'.e_PLUGIN.'portfolio/uploads/portfolio/'.$tmp[0].'/'.$tp->toFORM($portfolio_person_attachment).'" title="'.$tp->toFORM($portfolio_person_attachment).'">'.PORTFOLIO_58.'</a>';
}
else
{
	return PORTFOLIO_59;
}
SC_END

SC_BEGIN PORTFOLIO_STAFF_VIDEO

global $tp,$portfolio_person_videolink,$portfolio_person_videolinktext;
if (!empty($portfolio_person_videolink) )
{
	return '<a href= "'.$tp->toFORM($portfolio_person_videolink).'" rel="external" title="'.$tp->toFORM($portfolio_person_videolinktext).'">'.PORTFOLIO_58.'</a>';
}
else
{
	return PORTFOLIO_61;
}
SC_END

SC_BEGIN PORTFOLIO_STAFF_PORTRAIT1
global $tp, $portfolio_obj, $portfolio_path, $portfolio_person_portrait1, $portfolio_person_portraittext1;
$portfolio_title = (!empty($portfolio_person_portraittext1)?$tp->toHTML($portfolio_person_portraittext1, false):PORTFOLIO_CON_39);
$portfolio_large = $portfolio_path . $tp->toFORM($portfolio_person_portrait1);
if (!empty($portfolio_person_portrait1) && is_readable($portfolio_large))
{
if ($parm=="nolink")
	{
		return '<img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" />';
	}
	else
	{
    if ($portfolio_obj->portfolio_lightbox)
    {
        return '<a href="' . $portfolio_large . '" rel="lightbox[portrait1]" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="lightbox[portrait1]" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    else
    {
        return '<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    }
}
else
{
    return "";
}

SC_END

SC_BEGIN PORTFOLIO_STAFF_PORTRAIT2
global $tp, $portfolio_obj, $portfolio_path, $portfolio_person_portrait2, $portfolio_person_portraittext2;
$portfolio_title = (!empty($portfolio_person_portraittext2)?$tp->toHTML($portfolio_person_portraittext2, false):PORTFOLIO_CON_39);
$portfolio_large = $portfolio_path . $tp->toFORM($portfolio_person_portrait2);
if (!empty($portfolio_person_portrait2) && is_readable($portfolio_large))
{
if ($parm=="nolink")
	{
		return '<img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" />';
	}
	else
	{
    if ($portfolio_obj->portfolio_lightbox)
    {
        return '<a href="' . $portfolio_large . '" rel="lightbox[portrait1]" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="lightbox[portrait1]" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    else
    {
        return '<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    }
}
else
{
    return "";
}
SC_END

SC_BEGIN PORTFOLIO_STAFF_PORTRAIT3
global $tp, $portfolio_obj, $portfolio_path, $portfolio_person_portrait3, $portfolio_person_portraittext3;
$portfolio_title = (!empty($portfolio_person_portraittext3)?$tp->toHTML($portfolio_person_portraittext2, false):PORTFOLIO_CON_39);
$portfolio_large = $portfolio_path . $tp->toFORM($portfolio_person_portrait3);
if (!empty($portfolio_person_portrait3) && is_readable($portfolio_large))
{
if ($parm=="nolink")
	{
		return '<img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" />';
	}
	else
	{
    if ($portfolio_obj->portfolio_lightbox)
    {
        return '<a href="' . $portfolio_large . '" rel="lightbox[portrait1]" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="lightbox[portrait1]" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    else
    {
        return '<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    }
}
else
{
    return "";
}
SC_END


SC_BEGIN PORTFOLIO_STAFF_GALLERY1
global $tp, $portfolio_obj, $portfolio_path, $portfolio_person_gallery1, $portfolio_person_gallerytext1;
$portfolio_title = (!empty($portfolio_person_gallerytext1)?$tp->toHTML($portfolio_person_gallerytext1, false):PORTFOLIO_CON_39);
$portfolio_large = $portfolio_path . $tp->toFORM($portfolio_person_gallery1);
if (!empty($portfolio_person_gallery1) && is_readable($portfolio_large))
{
if ($parm=="nolink")
	{
		return '<img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" />';
	}
	else
	{
    if ($portfolio_obj->portfolio_lightbox)
    {
        return '<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    else
    {
        return '<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    }
}
else
{
    return "";
}
SC_END

SC_END
SC_BEGIN PORTFOLIO_STAFF_GALLERY2
global $tp, $portfolio_obj, $portfolio_path, $portfolio_person_gallery2, $portfolio_person_gallerytext2;
$portfolio_title = (!empty($portfolio_person_gallerytext2)?$tp->toHTML($portfolio_person_gallerytext2, false):PORTFOLIO_CON_39);
$portfolio_large = $portfolio_path . $tp->toFORM($portfolio_person_gallery2);
if (!empty($portfolio_person_gallery2) && is_readable($portfolio_large))
{
if ($parm=="nolink")
	{
		return '<img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" />';
	}
	else
	{
    if ($portfolio_obj->portfolio_lightbox)
    {
        return '<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    else
    {
        return '<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    }
}
else
{
    return "";
}
SC_END
SC_BEGIN PORTFOLIO_STAFF_GALLERY3
global $tp, $portfolio_obj, $portfolio_path, $portfolio_person_gallery3, $portfolio_person_gallerytext3;
$portfolio_title = (!empty($portfolio_person_gallerytext3)?$tp->toHTML($portfolio_person_gallerytext3, false):PORTFOLIO_CON_39);
$portfolio_large = $portfolio_path . $tp->toFORM($portfolio_person_gallery3);
if (!empty($portfolio_person_gallery3) && is_readable($portfolio_large))
{
if ($parm=="nolink")
	{
		return '<img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" />';
	}
	else
	{
    if ($portfolio_obj->portfolio_lightbox)
    {
        return '<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    else
    {
        return '<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    }
}
else
{
    return "";
}
SC_END
SC_BEGIN PORTFOLIO_STAFF_GALLERY4
global $tp, $portfolio_obj, $portfolio_path, $portfolio_person_gallery4, $portfolio_person_gallerytext4;
$portfolio_title = (!empty($portfolio_person_gallerytext4)?$tp->toHTML($portfolio_person_gallerytext4, false):PORTFOLIO_CON_39);
$portfolio_large = $portfolio_path . $tp->toFORM($portfolio_person_gallery4);
if (!empty($portfolio_person_gallery4) && is_readable($portfolio_large))
{
if ($parm=="nolink")
	{
		return '<img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" />';
	}
	else
	{
    if ($portfolio_obj->portfolio_lightbox)
    {
        return '<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    else
    {
        return '<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    }
}
else
{
    return "";
}
SC_END
SC_BEGIN PORTFOLIO_STAFF_GALLERY5
global $tp, $portfolio_obj, $portfolio_path, $portfolio_person_gallery5, $portfolio_person_gallerytext5;
$portfolio_title = (!empty($portfolio_person_gallerytext5)?$tp->toHTML($portfolio_person_gallerytext5, false):PORTFOLIO_CON_39);
$portfolio_large = $portfolio_path . $tp->toFORM($portfolio_person_gallery5);
if (!empty($portfolio_person_gallery5) && is_readable($portfolio_large))
{
if ($parm=="nolink")
	{
		return '<img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" />';
	}
	else
	{
    if ($portfolio_obj->portfolio_lightbox)
    {
        return '<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    else
    {
        return '<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    }
}
else
{
    return "";
}
SC_END
SC_BEGIN PORTFOLIO_STAFF_GALLERY6
global $tp, $portfolio_obj, $portfolio_path, $portfolio_person_gallery6, $portfolio_person_gallerytext6;
$portfolio_title = (!empty($portfolio_person_gallerytext6)?$tp->toHTML($portfolio_person_gallerytext6, false):PORTFOLIO_CON_39);
$portfolio_large = $portfolio_path . $tp->toFORM($portfolio_person_gallery6);
if (!empty($portfolio_person_gallery6) && is_readable($portfolio_large))
{
if ($parm=="nolink")
	{
		return '<img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" />';
	}
	else
	{
    if ($portfolio_obj->portfolio_lightbox)
    {
        return '<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="lightbox[gallery]" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    else
    {
        return '<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="border:0px;'.$portfolio_obj->imageresize($portfolio_large,$portfolio_obj->portfolio_imagepich,$portfolio_obj->portfolio_imagepicw).'" src="' . $portfolio_large . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /></a><br />
		<a href="' . $portfolio_large . '" rel="external" title="' . $portfolio_title . '"><img style="width:16px;height:16px;border:0px;" src="' . e_PLUGIN.'portfolio/images/enlarge.png' . '" alt="' . $portfolio_title . '" title="' . $portfolio_title . '" /> <span class="smalltext">'.PORTFOLIO_CON_40.'</span></a>';
    }
    }
}
else
{
    return "";
}
SC_END

SC_BEGIN PORTFOLIO_STAFF_AFFILIATE1
global $tp,$portfolio_person_affiliate1,$portfolio_person_affiliateurl1;
if(!empty($portfolio_person_affiliate1) && !empty($portfolio_person_affiliateurl1))
{
return '<a href="' . $tp->toFORM($portfolio_person_affiliateurl1) . '" rel="external"  >' . $tp->toHTML($portfolio_person_affiliate1, false) . '</a>';
}
else
{
return $portfolio_person_affiliate1;
}
SC_END

SC_BEGIN PORTFOLIO_STAFF_AFFILIATE2
global $tp,$portfolio_person_affiliate2,$portfolio_person_affiliateurl2;
if(!empty($portfolio_person_affiliate2) && !empty($portfolio_person_affiliateurl2))
{
return '<a href="' . $tp->toFORM($portfolio_person_affiliateurl2) . '" rel="external"  >' . $tp->toHTML($portfolio_person_affiliate2, false) . '</a>';
}
else
{
return $portfolio_person_affiliate2;
}
SC_END

SC_BEGIN PORTFOLIO_STAFF_AFFILIATE3
global $tp,$portfolio_person_affiliate3,$portfolio_person_affiliateurl3;
if(!empty($portfolio_person_affiliate3) && !empty($portfolio_person_affiliateurl3))
{
return '<a href="' . $tp->toFORM($portfolio_person_affiliateurl3) . '" rel="external"  >' . $tp->toHTML($portfolio_person_affiliate3, false) . '</a>';
}
else
{
return $portfolio_person_affiliate3;
}
SC_END

SC_BEGIN PORTFOLIO_STAFF_VIEWS
global $portfolio_person_views;
return $portfolio_person_views;
SC_END

SC_BEGIN PORTFOLIO_STAFF_UNIQUE
global $portfolio_person_unique;
return $portfolio_person_unique;
SC_END

SC_BEGIN PORTFOLIO_STAFF_COMMENTS
global $portfolio_obj,$portfolio_cobj,$portfolio_person_id;
if($portfolio_obj->portfolio_comments)
{
	$portfolio_comm= $portfolio_cobj->compose_comment("portfolio", "comment", $portfolio_person_id, $width, "Re :", false,  true,  true);
	return $portfolio_comm['comment']."<br />".$portfolio_comm['comment_form'];
}
else
{
return "";
}
SC_END

SC_BEGIN PORTFOLIO_STAFF_RATING
global $portfolio_view_rating;
return $portfolio_view_rating;
SC_END



// Edit Person Shortcodes
SC_BEGIN PORTFOLIO_EDIT_UPDIR
global $portfolio_from,$portfolio_id;
return "<a href='?$portfolio_from.show.$portfolio_id'><img src='./images/updir.png' title='" . PORTFOLIO_ED_042 . "' alt='" . PORTFOLIO_ED_042 . "' style='border:0' /></a>";

SC_END

SC_BEGIN PORTFOLIO_EDIT_CAPTION
global $portfolio_cap1;
return $portfolio_cap1;
SC_END

SC_BEGIN PORTFOLIO_EDIT_NAME
global $tp, $portfolio_person_name;
return "<input type='text' class='tbox' size='40' id='portfolio_person_name' name='portfolio_person_name' value='" . $tp->toFORM($portfolio_person_name) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_CONTACT
global $tp, $portfolio_person_contact;
return '<textarea name="portfolio_person_contact" class="tbox" style="width:45%;" rows="4" cols="30" >'.$tp->toFORM($portfolio_person_contact).'</textarea>';
SC_END

SC_BEGIN PORTFOLIO_EDIT_SHOWPHONE
global $portfolio_person_showphone;
return "<input type='checkbox' class='tbox' name='portfolio_person_showphone'" . ($portfolio_person_showphone == 1?" checked='checked' ":"") . " value='1' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_CATEGORY
global $tp, $sql,$sql2, $portfolio_person_cat;
$portfolio_list = explode(",", $portfolio_person_cat);
#
#$retval = "<select class='tbox' id='portfolio_catlist' name='portfolio_catlist[]' size='5' multiple>";
#if ($sql->db_Select("portfolio_cat", "portfoliocat_id,portfoliocat_name,portfoliocat_parent", "order by portfoliocat_name", "nowhere", false))
#{
#    while ($portfolio_row = $sql->db_Fetch())
#    {
#        extract($portfolio_row);
#        $retval .= "<option value='$portfoliocat_id'" .
#        (in_array($portfoliocat_id, $portfolio_list)?" selected='selected' ":" ") .($portfoliocat_parent == 0?"disabled='disabled'":""). ">";
#        if ($portfoliocat_parent != 0)
#        {
#            $retval .= " &gt; ";
#        }
#        $retval .= $portfoliocat_name . "</option>";
#    }
#}
#$retval .= "</select>";
$retval = "<select class='tbox' id='portfolio_catlist' name='portfolio_catlist[]' size='5' multiple>";
    if ($sql->db_Select("portfolio_cat", "portfoliocat_id,portfoliocat_name,portfoliocat_parent", "where portfoliocat_parent ='0' order by portfoliocat_order","nowhere",false))
    {
        $portfolio_new = true;
        while ($portfolio_row = $sql->db_Fetch())
        {
            $retval .= "<option value='" . $portfolio_row['portfoliocat_id'] . "' disabled='disabled'>" . $tp->toFORM($portfolio_row['portfoliocat_name']) . "</option>";

            if ($sql2->db_Select("portfolio_cat", "portfoliocat_id,portfoliocat_name,portfoliocat_parent", "portfoliocat_parent =" . $portfolio_row['portfoliocat_id'] . " order by portfoliocat_order"))
            {
                while ($portfolio_row2 = $sql2->db_Fetch())
                {
                    // extract($portfolio_row);
                    #print $portfolio_row['portfoliocat_name']." <br>";
                    #print $portfolio_row['portfoliocat_parent']." <br>";
                    #print $portfolio_row2['portfoliocat_name']." 2<br>";
                   # print $portfolio_row2['portfoliocat_parent']." 2<br>";
                    $retval .= "<option value='" . $portfolio_row2['portfoliocat_id'] . "'" .
                    (in_array($portfolio_row2['portfoliocat_id'], $portfolio_list)?" selected='selected' ":" ") .($portfolio_row2['portfoliocat_parent'] == 0?"disabled='disabled'":"") . ">" . "&nbsp;&raquo;&nbsp;" . $tp->toFORM($portfolio_row2['portfoliocat_name']) . "</option>";
                }
            }
        }
    }
    else
    {
        $retval .= "<option value='0'>" . PORTFOLIO_CAT_02 . "</option>";
    }

$retval .= "</select>";

return $retval;
SC_END

SC_BEGIN PORTFOLIO_EDIT_PHONE
global $tp, $portfolio_person_phone;
return "<input type='text' class='tbox' size='20' name='portfolio_person_phone' value='" . $tp->toFORM($portfolio_person_phone) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_SHOWEMAIL
global $portfolio_person_showemail;
return "<input type='checkbox' class='tbox' name='portfolio_person_showemail'" . ($portfolio_person_showemail == 1?" checked='checked' ":"") . " value='1' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_EMAIL
global $tp, $portfolio_person_email;
return "<input type='text' class='tbox' size='50' name='portfolio_person_email' value='" . $tp->toFORM($portfolio_person_email) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_WEBSITE
global $tp, $portfolio_person_websitename;
return "<input type='text' class='tbox' size='50' name='portfolio_person_websitename' value='" . $tp->toFORM($portfolio_person_websitename) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_WEBURL
global $tp, $portfolio_person_websiteurl;
return "<input type='text' class='tbox' size='50' name='portfolio_person_websiteurl' value='" . $tp->toFORM($portfolio_person_websiteurl) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_AFFILIATE1
global $tp, $portfolio_person_affiliate1;
return "<input type='text' class='tbox' size='50' name='portfolio_person_affiliate1' value='" . $tp->toFORM($portfolio_person_affiliate1) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_AFFILIATE2
global $tp, $portfolio_person_affiliate2;
return "<input type='text' class='tbox' size='50' name='portfolio_person_affiliate2' value='" . $tp->toFORM($portfolio_person_affiliate2) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_AFFILIATE3
global $tp, $portfolio_person_affiliate3;
return "<input type='text' class='tbox' size='50' name='portfolio_person_affiliate3' value='" . $tp->toFORM($portfolio_person_affiliate3) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_AFFILIATEURL1
global $tp, $portfolio_person_affiliateurl1;
return "<input type='text' class='tbox' size='50' name='portfolio_person_affiliateurl1' value='" . $tp->toFORM($portfolio_person_affiliateurl1) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_AFFILIATEURL2
global $tp, $portfolio_person_affiliateurl2;
return "<input type='text' class='tbox' size='50' name='portfolio_person_affiliateurl2' value='" . $tp->toFORM($portfolio_person_affiliateurl2) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_AFFILIATEURL3
global $tp, $portfolio_person_affiliateurl3;
return "<input type='text' class='tbox' size='50' name='portfolio_person_affiliateurl3' value='" . $tp->toFORM($portfolio_person_affiliateurl3) . "' />";
SC_END



SC_BEGIN PORTFOLIO_EDIT_BIOGRAPHY
global $tp,$portfolio_person_biography;
return "<textarea rows='8' cols='60' style='width:95%;' class='tbox' name='portfolio_person_biography' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>" . $tp->toFORM($portfolio_person_biography) . "</textarea><br />
		<input id='helpb' class='helpbox' type='text' name='helpb' size='100' style='width:97%'/><br />" . display_help("helpb") ;
SC_END

SC_BEGIN PORTFOLIO_EDIT_ADDITIONAL
global $tp,$portfolio_person_additional;
return "<textarea rows='8' cols='60' style='width:95%;' class='tbox' name='portfolio_person_additional' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>$portfolio_person_additional</textarea><br />
			<input id='helpc' class='helpbox' type='text' name='helpc' size='100' style='width:97%'/><br />" . display_help("helpc") ;
SC_END

SC_BEGIN PORTFOLIO_EDIT_VIDEO
global $tp, $portfolio_person_videolink;
return "<input type='text' class='tbox' size='70' name='portfolio_person_videolink' value='" . $tp->toFORM($portfolio_person_videolink) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_ATTACHMENT
global $portfolio_path, $tp, $portfolio_person_attachment;

if (!empty($portfolio_person_attachment) && is_readable(e_PLUGIN . "portfolio/uploads/portfolio/$portfolio_path/" . $portfolio_person_attachment))
{
    $retval = PORTFOLIO_ED_027 . " " . $tp->toFORM($portfolio_person_attachment) . " (" . PORTFOLIO_ED_028 . " <input type='checkbox' name='portfolio_delattachment' value='1' class='tbox' /> )";
}
else
{
    $retval = "<input type='file' size='50'  class='tbox' name='portfolio_person_attachment[]'  />";
}
return $retval;
SC_END

SC_BEGIN PORTFOLIO_EDIT_MAIN
return "<input type='button' id='portfolio_detailbutton' disabled='disabled' class='button' value='" . PORTFOLIO_ED_015 . "' onClick=\"portfolio_images()\" />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_IMAGES
return "<input type='button' id='portfolio_imagebutton'  class='button' value='" . PORTFOLIO_ED_016 . "' onClick=\"portfolio_details()\" />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_PORTRAIT1
global $portfolio_path, $tp, $portfolio_person_portrait1;

if (!empty($portfolio_person_portrait1) && is_readable(e_PLUGIN . "portfolio/uploads/portfolio/$portfolio_path/" . $portfolio_person_portrait1))
{
    $retval = PORTFOLIO_ED_027 . " " . $tp->toFORM($portfolio_person_portrait1) . " (" . PORTFOLIO_ED_028 . " <input type='checkbox' name='portfolio_delete_portrait[1]' value='1' class='tbox' /> )";
}
else
{
    $retval = "<input type='file' size='50'  class='tbox' name='portfolio_person_portrait[1]'  />";
}
return $retval;
SC_END

SC_BEGIN PORTFOLIO_EDIT_PORTRAIT_TEXT1
global $tp, $portfolio_person_portraittext1;
return "<input type='text' style='width:75%;' class='tbox' name='portfolio_person_portraittext1' value='" . $tp->toFORM($portfolio_person_portraittext1) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_PORTRAIT2
global $portfolio_path, $tp, $portfolio_person_portrait2;

if (!empty($portfolio_person_portrait2) && is_readable(e_PLUGIN . "portfolio/uploads/portfolio/$portfolio_path/" . $portfolio_person_portrait2))
{
    $retval = PORTFOLIO_ED_027 . " " . $tp->toFORM($portfolio_person_portrait2) . " (" . PORTFOLIO_ED_028 . " <input type='checkbox' name='portfolio_delete_portrait[2]' value='1' class='tbox' /> )";
}
else
{
    $retval = "<input type='file' size='50'  class='tbox' name='portfolio_person_portrait[2]'  />";
}
return $retval;
SC_END

SC_BEGIN PORTFOLIO_EDIT_PORTRAIT_TEXT2
global $tp, $portfolio_person_portraittext2;
return "<input type='text' style='width:75%;' class='tbox' name='portfolio_person_portraittext2' value='" . $tp->toFORM($portfolio_person_portraittext2) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_PORTRAIT3
global $portfolio_path, $tp, $portfolio_person_portrait3;

if (!empty($portfolio_person_portrait3) && is_readable(e_PLUGIN . "portfolio/uploads/portfolio/$portfolio_path/" . $portfolio_person_portrait3))
{
    $retval = PORTFOLIO_ED_027 . " " . $tp->toFORM($portfolio_person_portrait3) . " (" . PORTFOLIO_ED_028 . " <input type='checkbox' name='portfolio_delete_portrait[3]' value='1' class='tbox' /> )";
}
else
{
    $retval = "<input type='file' size='50'  class='tbox' name='portfolio_person_portrait[3]'  />";
}
return $retval;
SC_END

SC_BEGIN PORTFOLIO_EDIT_PORTRAIT_TEXT3
global $tp, $portfolio_person_portraittext3;
return "<input type='text' style='width:75%;' class='tbox' name='portfolio_person_portraittext3' value='" . $tp->toFORM($portfolio_person_portraittext3) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY1
global $portfolio_path, $tp, $portfolio_person_gallery1;

if (!empty($portfolio_person_gallery1) && is_readable(e_PLUGIN . "portfolio/uploads/portfolio/$portfolio_path/" . $portfolio_person_gallery1))
{
    $retval = PORTFOLIO_ED_027 . " " . $tp->toFORM($portfolio_person_gallery1) . " (" . PORTFOLIO_ED_028 . " <input type='checkbox' name='portfolio_delete_gallery[1]' value='1' class='tbox' /> )";
}
else
{
    $retval = "<input type='file' size='50'  class='tbox' name='portfolio_person_gallery[1]'  />";
}
return $retval;
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY_TEXT1
global $portfolio_path, $tp, $portfolio_person_gallerytext1;
return "<input type='text' style='width:75%;' class='tbox' name='portfolio_person_gallerytext1' value='" . $tp->toFORM($portfolio_person_gallerytext1) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY2
global $portfolio_path, $tp, $portfolio_person_gallery2;

if (!empty($portfolio_person_gallery2) && is_readable(e_PLUGIN . "portfolio/uploads/portfolio/$portfolio_path/" . $portfolio_person_gallery2))
{
    $retval = PORTFOLIO_ED_027 . " " . $tp->toFORM($portfolio_person_gallery2) . " (" . PORTFOLIO_ED_028 . " <input type='checkbox' name='portfolio_delete_gallery[2]' value='1' class='tbox' /> )";
}
else
{
    $retval = "<input type='file' size='50'  class='tbox' name='portfolio_person_gallery[2]'  />";
}
return $retval;
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY_TEXT2
global $portfolio_path, $tp, $portfolio_person_gallerytext2;
return "<input type='text' style='width:75%;' class='tbox' name='portfolio_person_gallerytext2' value='" . $tp->toFORM($portfolio_person_gallerytext2) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY3
global $portfolio_path, $tp, $portfolio_person_gallery3;

if (!empty($portfolio_person_gallery3) && is_readable(e_PLUGIN . "portfolio/uploads/portfolio/$portfolio_path/" . $portfolio_person_gallery3))
{
    $retval = PORTFOLIO_ED_027 . " " . $tp->toFORM($portfolio_person_gallery3) . " (" . PORTFOLIO_ED_028 . " <input type='checkbox' name='portfolio_delete_gallery[3]' value='1' class='tbox' /> )";
}
else
{
    $retval = "<input type='file' size='50'  class='tbox' name='portfolio_person_gallery[3]'  />";
}
return $retval;
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY_TEXT3
global $portfolio_path, $tp, $portfolio_person_gallerytext3;
return "<input type='text' style='width:75%;' class='tbox' name='portfolio_person_gallerytext3' value='" . $tp->toFORM($portfolio_person_gallerytext3) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY4
global $portfolio_path, $tp, $portfolio_person_gallery4;

if (!empty($portfolio_person_gallery4) && is_readable(e_PLUGIN . "portfolio/uploads/portfolio/$portfolio_path/" . $portfolio_person_gallery4))
{
    $retval = PORTFOLIO_ED_027 . " " . $tp->toFORM($portfolio_person_gallery4) . " (" . PORTFOLIO_ED_028 . " <input type='checkbox' name='portfolio_delete_gallery[4]' value='1' class='tbox' /> )";
}
else
{
    $retval = "<input type='file' size='50'  class='tbox' name='portfolio_person_gallery[4]'  />";
}
return $retval;
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY_TEXT4
global $portfolio_path, $tp, $portfolio_person_gallerytext4;
return "<input type='text' style='width:75%;' class='tbox' name='portfolio_person_gallerytext4' value='" . $tp->toFORM($portfolio_person_gallerytext4) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY5
global $portfolio_path, $tp, $portfolio_person_gallery5;

if (!empty($portfolio_person_gallery5) && is_readable(e_PLUGIN . "portfolio/uploads/portfolio/$portfolio_path/" . $portfolio_person_gallery5))
{
    $retval = PORTFOLIO_ED_027 . " " . $tp->toFORM($portfolio_person_gallery5) . " (" . PORTFOLIO_ED_028 . " <input type='checkbox' name='portfolio_delete_gallery[5]' value='1' class='tbox' /> )";
}
else
{
    $retval = "<input type='file' size='50'  class='tbox' name='portfolio_person_gallery[5]'  />";
}
return $retval;
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY_TEXT5
global $portfolio_path, $tp, $portfolio_person_gallerytext5;
return "<input type='text' style='width:75%;' class='tbox' name='portfolio_person_gallerytext5' value='" . $tp->toFORM($portfolio_person_gallerytext5) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY6
global $portfolio_path, $tp, $portfolio_person_gallery6;

if (!empty($portfolio_person_gallery6) && is_readable(e_PLUGIN . "portfolio/uploads/portfolio/$portfolio_path/" . $portfolio_person_gallery6))
{
    $retval = PORTFOLIO_ED_027 . " " . $tp->toFORM($portfolio_person_gallery6) . " (" . PORTFOLIO_ED_028 . " <input type='checkbox' name='portfolio_delete_gallery[6]' value='1' class='tbox' /> )";
}
else
{
    $retval = "<input type='file' size='50'  class='tbox' name='portfolio_person_gallery[6]'  />";
}
return $retval;
SC_END

SC_BEGIN PORTFOLIO_EDIT_GALLERY_TEXT6
global $portfolio_path, $tp, $portfolio_person_gallerytext6;
return "<input type='text' style='width:75%;' class='tbox' name='portfolio_person_gallerytext6' value='" . $tp->toFORM($portfolio_person_gallerytext6) . "' />";
SC_END

SC_BEGIN PORTFOLIO_EDIT_SUBMIT

return "<input type='submit' name='portfolio_submit' value='" . PORTFOLIO_ED_036 . "' class='button' />";

SC_END

SC_BEGIN PORTFOLIO_GOLD_COST
global $gold_obj,$PORTFOLIO_PREF;
if(is_object($gold_obj) && $gold_obj->gold_plugins['portfolio']==1 && $PORTFOLIO_PREF['portfolio_goldpost']>0)
{
	return '<b>'. PORTFOLIO_GOLD_06. ' ' .$gold_obj->formation($PORTFOLIO_PREF['portfolio_goldpost']).'</b>';
}
else
{
	return '';
}
SC_END

SC_BEGIN PORTFOLIO_GOLD_VIEW
global $gold_obj,$PORTFOLIO_PREF;
if(is_object($gold_obj) && $gold_obj->gold_plugins['portfolio']==1 && $PORTFOLIO_PREF['portfolio_goldview']>0)
{
	return '<b>'. PORTFOLIO_GOLD_11. ' ' .$gold_obj->formation($PORTFOLIO_PREF['portfolio_goldview']).'</b>';
}
else
{
	return '';
}
SC_END

*/
?>