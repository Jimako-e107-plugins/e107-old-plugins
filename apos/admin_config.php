<?php
/*
+------------------------------------------------------------------------------+
| Auto Post on Signup v1.0
| Plugin by Martinj - www.martinj.co.uk
| July 2009
|   e107 Website System - e107.org
|  Plugin skeleton by nlstart
+------------------------------------------------------------------------------+
*/

$eplug_admin = true;
require_once('../../class2.php');
	if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }

require_once(e_ADMIN.'auth.php');

include_lan(e_PLUGIN.'apos/languages/'.e_LANGUAGE.'.php');

// Set the active menu option for admin_menu.php
$pageid = APOS_ADMIN_01;

if (isset($_POST['update_prefs'])) 
	{
		if(is_numeric($_POST['apos_userid'])) {
		$userDetails=get_user_data($_POST['apos_userid']);
		$pref['apos_sender']=$userDetails['username'];
		$pref['apos_forum'] = $tp->toDB($_POST['apos_forum']);
		$pref['apos_userid'] = $tp->toDB($_POST['apos_userid']);
		$pref['apos_title'] = $tp->toDB($_POST['apos_title']);
		$pref['apos_text'] = $tp->toDB($_POST['apos_text']);
		save_prefs();
		$message = APOS_ADMIN_02;
		}
		
			else {
			$message = APOS_ADMIN_03;
			}
	}
	
// Displays the update message to confirm data is stored in database
	if (isset($message)) 
	{
		$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
	}

		require_once(e_PLUGIN.'forum/forum_class.php');
		$forum = new e107forum;
		$forumParents= $forum->forum_getparents();

	$forumList = $forum->forum_get_allowed();
	$subList = $forum->forum_getsubs();
	$forumdd = "<select name='apos_forum' class='tbox'>";

	foreach($forumList as $key=>$val)
			{
				// tidy this up
				if($pref['apos_forum']==$key) {
				$selected="selected='selected'";
				}
				else {
				$selected="";
				}
					$forumdd .= "\n<option value='".$key."' ".$selected.">".$val."</option>";
			}
	
	$forumdd .= "</select>";
	
	

$text = '
<div style="text-align:center">
<form id="settings_form" action="'.e_SELF.'" method="post">
	<fieldset>
		<legend>
			'.APOS_ADMIN_01.'
		</legend>
		<table border="0" class="tborder" cellspacing="10">
			<tr>
				<td class="tborder" style="width: 200px">
					<span class="smalltext" style="font-weight: bold">
						'.APOS_ADMIN_04.'
					</span>
				</td>
				<td class="tborder" style="width: 200px">
					'.$forumdd.'
				</td>
			</tr>
		</table>
		
				<table border="0" class="tborder" cellspacing="10">
			<tr>
				<td class="tborder" style="width: 200px">
					<span class="smalltext" style="font-weight: bold">
						'.APOS_ADMIN_05.'
					</span>
				</td>
				<td class="tborder" style="width: 200px">
					<input type="text" name="apos_userid" value="'.$pref['apos_userid'].'" size="5" />
				</td>
			</tr>
		</table>
		
						<table border="0" class="tborder" cellspacing="10">
			<tr>
				<td class="tborder" style="width: 400px">
					<span class="smalltext" style="font-weight: bold">
						'.APOS_ADMIN_06.'
					</span><br />
					<input type="text" name="apos_title" value="'.$pref['apos_title'].'" size="40" />
				</td>
			</tr>
		</table>
		

				<table border="0" class="tborder" cellspacing="10">
			<tr>
				<td class="tborder" style="width: 400px">
					<span class="smalltext" style="font-weight: bold">
						'.APOS_ADMIN_07.'
					</span><br />

					<textarea rows="10" cols="30" name="apos_text">'.$pref['apos_text'].'</textarea>
				</td>
			</tr>
			<tr>
			<td class="tborder" style="width: 400px">
			<span class="smalltext" style="font-weight: bold">'.APOS_HELP_00.'</span><br />
			'.APOS_HELP_01.'<br /><br />
			<li>'.APOS_HELP_02.'</li>
			<li>'.APOS_HELP_03.'</li>
			<li>'.APOS_HELP_04.'</li>
			</td>
			</tr>
		</table>
		
		
	<br />
	<input class="button" type="submit" name="update_prefs" value="'.APOS_ADMIN_08.'" />
	<br />
	</fieldset>
</form>
<div><a href="http://www.martinj.co.uk">APoS by Martinj</a></div>
</div>
';

	$caption = APOS_ADMIN_09;
	$ns->tablerender($caption, $text);

	require_once(e_ADMIN.'footer.php');
?>