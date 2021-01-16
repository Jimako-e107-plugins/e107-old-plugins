<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) {
    exit;
}
include_once(e_HANDLER . 'shortcode_handler.php');

$cpage_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
// * start shortcodes
/*

SC_BEGIN CPAGE_LIST_BULLET
   global $cpage_obj;
return $cpage_obj->bullet;
SC_END


SC_BEGIN CPAGE_LIST_PAGE
   global $tp,$cpage_row,$CPAGE_PREF,$cpage_obj,$PLUGINS_DIRECTORY;
   $link_url=$cpage_obj->make_url($cpage_row['cpage_link'],$cpage_row['cpage_id'],0,$cpage_row['cpage_title']);
   return "<a href='".$link_url."'>".$tp->toHTML($cpage_row['cpage_title'])."</a>";

SC_END

SC_BEGIN CPAGE_LIST_CATEGORY
   global $tp,$cpage_row;
   return $tp->toHTML($cpage_row['cpage_cat_name']);
SC_END

SC_BEGIN CPAGE_LIST_INDENT
   global $tp,$cpage_row;
   $indent='';
   if(!empty($cpage_row['cpage_cat_name'])){
   	$indent=' ';
   }
   return $indent;
SC_END

SC_BEGIN CPAGE_TITLE
   global $tp,$cpage_row;
   return $tp->toHTML($cpage_row['cpage_title']);
SC_END

SC_BEGIN CPAGE_AUTHOR
   global $tp,$cpage_row;
   if($cpage_row['cpage_showauthor_flag']!=1)
   {
   		return '';
   }
   if(empty($cpage_row['user_name']))
   {
  	 	$tmp=explode('.',$cpage_row['cpage_author']);
   		return $tp->toHTML($tmp[1]);
   }
   else
   {
   if($parm=='linkoff')
   {
   		return $tp->toHTML($cpage_row['user_name']);
   }
   else
   {
   return "<a href='".e_BASE."user.php?id.{$cpage_row[user_id]}' >".$tp->toHTML($cpage_row['user_name'])."</a>";
   }
   }

SC_END

SC_BEGIN CPAGE_CREATED
  global $tp,$cpage_row,$cpage_conv;
   if($cpage_row['cpage_showdate_flag']!=1)
   {
   return '';
   }
  if($parm=='short')
  {
  	return $cpage_conv->convert_date($cpage_row['cpage_datestamp'],'short');
  }
  else
  {
  	return $cpage_conv->convert_date($cpage_row['cpage_datestamp'],'long');
  }
SC_END

SC_BEGIN CPAGE_LASTUPDATED
   global $tp,$cpage_row,$cpage_conv;
   if($cpage_row['cpage_lastdate_flag']!=1)
   {
   return '';
   }
   if($parm=='short')
   {
   return $cpage_conv->convert_date($cpage_row['cpage_lastupdate'],'short');
   }
   else
   {
   return $cpage_conv->convert_date($cpage_row['cpage_lastupdate'],'long');
   }
SC_END

SC_BEGIN CPAGE_VIEWS
   global $tp,$cpage_row,$cpage_conv;
   if($cpage_row['cpage_views_flag']!=1)
   {
   return '';
   }
   return $cpage_row['cpage_views'];

SC_END

SC_BEGIN CPAGE_UNIQUE
   global $tp,$cpage_row,$cpage_conv;
   if($cpage_row['cpage_unique_flag']!=1)
   {
   return '';
   }
   return $cpage_row['cpage_unique'];
SC_END

SC_BEGIN CPAGE_RATE
   global $tp,$cpage_row,$cpage_show_obj;
   if($cpage_row['cpage_rating_flag']!=1)
   {
   return '';
   }
   return $cpage_show_obj->view_rating;
SC_END
SC_BEGIN CPAGE_SHOWCOMMENTS
   global $tp,$cpage_row,$cpage_show_obj;

   if($cpage_row['cpage_comment_flag']!=1)
   {
   return '';
   }else{
   	return "<input type='button' class='button' name='cpage_showcomments' id='cpage_showcomments' style='visibility:hidden;' value='Show Comments' onclick=\"toggle_comments();\" />";
   }
SC_END
SC_BEGIN CPAGE_COMMENT
   global $tp,$cpage_row,$cpage_show_obj;
   if($cpage_row['cpage_comment_flag']!=1)
   {
   	return '';
   }
   return $cpage_show_obj->comment_form[comment];
SC_END
SC_BEGIN CPAGE_COMMENT_FORM
   global $tp,$cpage_row,$cpage_show_obj;
   if($cpage_row['cpage_comment_flag']!=1)
   {
  	 return '';
   }
   return $cpage_show_obj->comment_form[comment_form];
SC_END

SC_BEGIN CPAGE_BODY
      global $tp,$cpage_show_obj;
   return $tp->toHTML($cpage_show_obj->cpage_page,true,'constants');
SC_END

SC_BEGIN CPAGE_PAGES
   global $tp,$cpage_show_obj;
   return $cpage_show_obj->page_selector;
SC_END

SC_BEGIN CPAGE_PASSWORD
   return "<input type='password' class='tbox' name='cpage_password' value='' />";
SC_END

SC_BEGIN CPAGE_SUBMIT
   return "<input type='submit' class='button' name='cpage_submit' value='".CPAGE_06."' />";
SC_END

SC_BEGIN CPAGE_PDF
   global $tp,$cpage_row,$cpage_show_obj,$PLUGINS_DIRECTORY;
   if(file_exists(THEME."images/pdf_16.png")){
	$image="<img src='".THEME."images/pdf_16.png' style='border:0;'  alt='" . CPAGE_CP66 . "' title='" . CPAGE_CP66 . "' />";
   }else{
   	$image="<img src='".SITEURL.$PLUGINS_DIRECTORY."pdf/images/pdf_16.png' style='border:0;'  alt='" . CPAGE_CP66 . "' title='" . CPAGE_CP66 . "' />";
   }
   if($cpage_row['cpage_pdf_flag']!=1)
   {
   return '';
   }
return "<a href='".SITEURL.$PLUGINS_DIRECTORY."pdf/pdf.php?plugin:cpage.$cpage_row[cpage_id]'>{$image}</a>";
SC_END

SC_BEGIN CPAGE_EMAIL
   global $tp,$cpage_row,$cpage_show_obj,$IMAGES_DIRECTORY;
   if(file_exists(THEME.'images/email.png')){
   	$image="<img src='" .THEME."images/email.png' style='border:0' alt='" . CPAGE_CP64 . "' title='" . CPAGE_CP64 . "' />";;
   }
   else{
   	$image="<img src='" .SITEURL.$IMAGES_DIRECTORY."generic/" . IMODE . "/email.png' style='border:0' alt='" . CPAGE_CP64 . "' title='" . CPAGE_CP64 . "' />";
   }
   if($cpage_row['cpage_email_flag']!=1)
   {
   return '';
   }
   return "<a href='".SITEURL."email.php?plugin:cpage." . $cpage_row[cpage_id] . "'>{$image}</a>";

SC_END


SC_BEGIN CPAGE_PRINT
   global $tp,$cpage_row,$cpage_show_obj,$IMAGES_DIRECTORY;
   if(file_exists(THEME."images/printer.png")){
   	$image="<img src='" .THEME."images/printer.png' style='border:0;' title='" . CPAGE_CP65 . "' alt='" . CPAGE_CP65 . "' />";
   }else{
   	$image="<img src='" . SITEURL.$IMAGES_DIRECTORY.  "generic/" . IMODE . "/printer.png' style='border:0;' title='" . CPAGE_CP65 . "' alt='" . CPAGE_CP65 . "' />";
   }
   if($cpage_row['cpage_print_flag']!=1)
   {
   return '';
   }
   return "<a href='".SITEURL."print.php?plugin:cpage.$cpage_row[cpage_id]' >{$image}</a>";

SC_END






*/