<?php

if (!defined('e107_INIT'))
{
    exit;
}
include_once(e_HANDLER . 'shortcode_handler.php');
$guestbook_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);

/*
SC_BEGIN ENTRIES_TOTAL
global $entries_total;
return $entries_total;
SC_END

SC_BEGIN GUEST_NAME
global $row,$name;
$name = $row['name'];
return $name;
SC_END

SC_BEGIN GB_COMMENT
global $row,$tp,$pref;
$comment = $tp->toEmail($row['comment']);
	if(!$pref['guestbook_bbcode'])
	{
		$comment = strip_tags($comment, "<br>");
	}
return $comment;
SC_END

SC_BEGIN DATE
global $row;
	$con = new convert;
	$gb_date = $con -> convert_date($row['date'], long);
return $gb_date;
SC_END

SC_BEGIN WEBSITE_IMG
global $row,$pref,$gb_url;
	$gb_url = ($row['url'] ? "http://".eregi_replace("http://", "", $row['url']) : "");
	$gb_url = ((!$pref['guestbook_hideurl'] || USER)? $row['url'] : "");
    
	$gb_url_img = ($row['url'] ? "<a href='".$row['url']."' rel='external'><img style='border:0' src='".FTHEME."website.png' alt='' title='".GB_LAN_WEBSITE."' /></a>" : "");

return $gb_url_img;
SC_END

SC_BEGIN WEBSITE_TEXT
global $row;
$gb_url_text   = ($row['url']?"<a href='".$row['url']."' rel='external'>".GB_LAN_WEBSITE."</a>":"");
return $gb_url_text;
SC_END

SC_BEGIN EMAIL_IMG
global $row;
	$email_img  = (($row['email'] && ADMIN)?"<a href='mailto:".$row['email']."'><img style='border:0' src='".FTHEME."email.png' alt='' title='".GB_LAN_EMAIL."' /></a>" : "");
return $email_img;
SC_END

SC_BEGIN EMAIL_TEXT
global $row;
$email_text = (($row['email'] && ADMIN)?"<a href='mailto:".$row['email']."'>".GB_LAN_EMAIL."</a>" : "");
return $email_text;
SC_END

SC_BEGIN PROFILE_IMG
global $row,$pref;
if($row['user'] != 0 && (!$pref['memberlist_access']))
{
   	$profile_img        = "<a href='".e_BASE."user.php?id.".$row['user']."'><img style='border:0' src='".FTHEME."profile.png' alt='' title='".GB_LAN_PROFILE."' /></a>";
}
return $profile_img;
SC_END

SC_BEGIN PROFILE_TEXT
global $row,$pref;
	if($row['user'] != 0 && (!$pref['memberlist_access']))
	{
		$profile_text       = "<a href='".e_BASE."user.php?id.".$row['user']."'>".GB_LAN_PROFILE."</a>";
	}
return $profile_text;
SC_END

SC_BEGIN EDIT_IMG
global $row,$pref;
	if( getperms("P") || check_class($pref['guestbook_moderator_class']) || ( $row['date'] > ($time - (60*$pref['guestbook_edittime'])) && $row['host'] == substr($host, 0, strlen($guestbook_host)) ) )
	{
		$edit_img  = "<a href='$_SERVER[PHP_SELF]?edit.".$row['id']."'><img style='border:0' src='".FTHEME."admin_edit.png' alt='' title='".GB_LAN_EDIT."' /></a>";
	}
return $edit_img;
SC_END

SC_BEGIN EDIT_TEXT
global $row,$pref;
	if( getperms("P") || check_class($pref['guestbook_moderator_class']) || ( $guestbook_date > ($time - (60*$pref['guestbook_edittime'])) && $guestbook_host == substr($host, 0, strlen($guestbook_host)) ) )
	{
		$edit_text = "<a href='$_SERVER[PHP_SELF]?edit.".$row['id']."'>".GB_LAN_EDIT."</a>";
	}
return $edit_text;
SC_END

SC_BEGIN DELETE_IMG
global $row,$pref;
	if( getperms("P") || check_class($pref['guestbook_moderator_class']) )
	{
		$delete_img  = "<a href='$_SERVER[PHP_SELF]?delete.".$row['id']."'><img style='border:0' src='".FTHEME."admin_delete.png' alt='' title='".GB_LAN_DELETE."' /></a>";
	}
return $delete_img;
SC_END

SC_BEGIN DELETE_TEXT
global $row,$pref;
	if( getperms("P") || check_class($pref['guestbook_moderator_class']) )
	{
		$delete_text = "<a href='$_SERVER[PHP_SELF]?delete.".$row['id']."'>".GB_LAN_DELETE."</a>";
	}
return $delete_text;
SC_END

SC_BEGIN IP_PRIVATE
global $row,$pref;
	$ip_private = ( (getperms("P") || check_class($pref['guestbook_moderator_class'])) ? $row['ip']:"");
return $ip_private;
SC_END

SC_BEGIN IP_PUBLIC
global $row,$pref;
	$ip_public  =$row['ip'];
return $ip_public;
SC_END

SC_BEGIN HOST_PRIVATE
global $row,$pref;
	$host_private = ( (getperms("P") || check_class($pref['guestbook_moderator_class'])) ? $row['host']:"");
return $host_private;
SC_END

SC_BEGIN HOST_PUBLIC
global $row,$pref;
	$host_public  = $row['host'];
return $host_public;
SC_END

SC_BEGIN GBOOK_ID
global $row;
$gbook_id = $row['id'];
return $gbook_id;
SC_END

*/
?>