<?php
	require_once("../../class2.php");
	if(!getperms("P")) { echo "You do not have permission"; exit; }
	require_once(e_ADMIN."auth.php");
	include(e_PLUGIN."advance_online_menu/language/".e_LANGUAGE.".php");
	
if ($_POST) {
	$pref['ao_menu_name'] = $_POST['ao_menu_name'];
	$pref['ao_menu_show_guests'] = $_POST['ao_menu_show_guests'];
	$pref['aom_nm_l_n'] = $_POST['aom_nm_l_n'];
	$pref['aom_lm_l_n'] = $_POST['aom_lm_l_n'];
	$pref['aom_nm_s'] = $_POST['aom_nm_s'];
	$pref['aom_lm_s'] = $_POST['aom_lm_s'];
	$pref['aom_om_s'] = $_POST['aom_om_s'];
	$pref['aom_mm_s'] = $_POST['aom_mm_s'];
	$pref['aom_seperator'] = $_POST['aom_seperator'];
	save_prefs();
	$message = 'Settings stored!';
}
if (isset($message)) {
	$ns->tablerender("", "<div style='text-align: center'><b>".$message."</b></div>");
}
	
	$config = "
	<form method='post' action='".e_SELF."'>
	<table class='fborder' width='100%'>
		<tr>
			<td class='forumheader3' width='50%'>
				Show guests IP for everyone<br /><i>If not checked, only visible for admins</i>
			</td>
			<td class='forumheader3' width='50%'>
				<input type='checkbox' class='tbox' name='ao_menu_show_guests' "; if($pref['ao_menu_show_guests']) { $config .= "checked "; } $config .= "/>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' width='50%'>
				The menu name:<br /><i>Title shwon in the header of your menu!</i>
			</td>
			<td class='forumheader3' width='50%'>
				<input type='text' class='tbox' name='ao_menu_name' value='".$pref['ao_menu_name']."' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' width='50%'>
				Number of names to show on Newest Members menu!
			</td>
			<td class='forumheader3' width='50%'>
				<input type='text' size='2' max-length='2' class='tbox' name='aom_nm_l_n' value='".$pref['aom_nm_l_n']."' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' width='50%'>
				Number of names to show on Latest Members menu!
			</td>
			<td class='forumheader3' width='50%'>
				<input type='text' size='2' max-length='2' class='tbox' name='aom_lm_l_n' value='".$pref['aom_lm_l_n']."' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' width='50%'>
				Links seperator.<br /><i>Something small like \"|\" to seperate links in the menu!</i>
			</td>
			<td class='forumheader3' width='50%'>
				<input type='text' size='6' max-length='6' class='tbox' name='aom_seperator' value='".$pref['aom_seperator']."' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' width='50%'>
				Show Newest Members?
			</td>
			<td class='forumheader3' width='50%'>
				<input type='checkbox' class='tbox' name='aom_nm_s' "; if($pref['aom_nm_s']) { $config .= "checked "; } $config .= "/>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' width='50%'>
				Show Latest Members?
			</td>
			<td class='forumheader3' width='50%'>
				<input type='checkbox' class='tbox' name='aom_lm_s' "; if($pref['aom_lm_s']) { $config .= "checked "; } $config .= "/>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' width='50%'>
				Show Online Members?
			</td>
			<td class='forumheader3' width='50%'>
				<input type='checkbox' class='tbox' name='aom_om_s' "; if($pref['aom_om_s']) { $config .= "checked "; } $config .= "/>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' width='50%'>
				Show More / Other information?
			</td>
			<td class='forumheader3' width='50%'>
				<input type='checkbox' class='tbox' name='aom_mm_s' "; if($pref['aom_mm_s']) { $config .= "checked "; } $config .= "/>
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align: center;'>
				<input type='submit' class='button' value='Save Settings' />
			</td>
		</tr>
	</table>
	</form>";
	
	$ns->tablerender(AO_NAME." ".AO_CONFIG, $config);
	require_once(e_ADMIN."footer.php");
?>