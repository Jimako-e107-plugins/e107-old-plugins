<?php


if (!defined('e107_INIT')) { exit; }
if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:85%"); }

global $guestbook_shortcodes, $pref;

$GB_TEMPLATE_START = "
	<div style='text-align:center'>".GB_LAN_ALLCOMMENT." {ENTRIES_TOTAL}
	<br />
	<br />
	</div>
	<div style='text-align:center'>
			<span class='button' style='padding-left:10px;padding-right:10px;cursor:pointer' onclick=\"expandit('guestbook_sign')\">
				".GB_LAN_SIGN."
			</span>
			<br />
			<br />
		</div>
		
	<div style='display:".($action=="edit"? "block" : "none")."' id='guestbook_sign'><br />
	<form method='post' action='".$_SERVER['PHP_SELF'].($action=="edit" ? "?update.$guestbook_id"  :""). "' id='dataform'>
	<table style='width:98%' class='fborder'>
	<tr>
		<td class='forumheader3' colspan='2'>".GB_LAN_NOTICE."</td>
	</tr>";

if( (USER && !( getperms("P") || check_class($pref['guestbook_moderator_class']) )) || ( (getperms("P") || check_class($pref['guestbook_moderator_class']) ) && $action != "edit") )
{
    $GB_TEMPLATE_START .= "
	<tr>
		<td class='forumheader3' style='width:80px'>".GB_LAN_NAME."</td>
		<td class='forumheader3'>".USERNAME."</td>
	</tr>
	<tr>
		<td class='forumheader3'>".GB_LAN_EMAIL."</td>
		<td class='forumheader3'>".USEREMAIL."</td>
	</tr>
	<tr>
		<td class='forumheader3'>".GB_LAN_WEBSITE."</td>
		<td class='forumheader3'><input type='text' class='tbox' style='width:100%' maxlength='128' name='url'   value='".(USERURL?USERURL:"http://")."' /></td>
	</tr>";
}
else
{
	$GB_TEMPLATE_START.="
	<tr>
		<td class='forumheader3' style='width:80px'>".GB_LAN_NAME."</td>
		<td class='forumheader3'><input type='text' class='tbox' style='width:100%' maxlength='50' name='name'  value='".$g_name."' /></td>
	</tr>
	<tr>
		<td class='forumheader3'>".GB_LAN_EMAIL."</td>
		<td class='forumheader3'><input type='text' class='tbox' style='width:100%' maxlength='128' name='email' value='".$g_email."' /></td>
	</tr>
	<tr>
		<td class='forumheader3'>".GB_LAN_WEBSITE."</td>
		<td class='forumheader3'><input type='text' class='tbox' style='width:100%' maxlength='128' name='url'   value='".($g_url? $g_url:"http://")."' /></td>
	</tr>";
}


//-----------------------------------------------------------------------------------------------------------+

$GB_TEMPLATE_START.="
	<tr>
		<td class='forumheader3'>".GB_LAN_COMMENT."</td>
		<td class='forumheader3'>
		<textarea name='comment' class='tbox' style='width:100%;height:100px' rows='10' cols='60' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>$guestbook_comment</textarea>
		$text_bbcode
		</td>
	</tr>
		$text_emote";
if ($use_securecode) {
$GB_TEMPLATE_START.="
	<tr>
		<td class='forumheader' colspan='2' style='text-align:center'>".GB_LAN_SECURE."
		<input type='hidden' name='rand_num' value='".$securecodeimg = $sec_img->random_number."'>
		".$sec_img->r_image()." 
		<input class='tbox' type='text' name='code_verify' size='15' maxlength='20'>
		</td>
	</tr>";
}
$GB_TEMPLATE_START.="
	<tr>
		<td class='forumheader' colspan='2' style='text-align:center'>
		<input type='submit' name='".($action=="edit"?"guestbook_update":"guestbook_submit")."' class='button' value='".GB_LAN_SUBMIT."' />
		</td>
	</tr>
	</table>
	</form>
			
	<br />
	<br />
	</div>";
		
									
$GB_TEMPLATE_START.="	<br />
	<br />
	<center>
	<div style='text-align:center'>
";

$GB_TEMPLATE_END = "
</div>
</center>
";

$GB_TEMPLATE = "
<table class='forumheader' style='".USER_WIDTH."; text-align:center' cellpadding='0' cellspacing='0'>
	<tr>
		<td class='fcaption' style='border:none'>
    	<span style='float:left'>
		{GUEST_NAME}
		</span>
		<span style='float:right;text-align:right'>
		{EMAIL_IMG}
		{WEBSITE_IMG}
		{PROFILE_IMG}
		{EDIT_IMG} {DELETE_IMG}
		</span>
		</td>
	</tr>
	<tr>
		<td class='forumheader3' style='border-left:none;border-right:none'>
		{GB_COMMENT}<br />
		</td>
	</tr>
	<tr>
		<td class='forumheader' style='border-left:none;border-right:none'>
		<span class='smalltext' style='float:left'>
		<a title='{IP_PRIVATE}'>{HOST_PRIVATE}</a>
		</span>
		<span class='smalltext' style='float:right;text-align:right;width:250px'>
		{DATE}					
		</span>
		</td>
	</tr>
	</table>
	<br />
	<br />
";

?>