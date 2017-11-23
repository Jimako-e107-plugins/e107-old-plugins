global $mbl_obj, $user, $MBL_PREF;

if (!isset($mbl_obj)) {
	require_once(e_PLUGIN.'memberlist/includes/memberlist_class.php');
	if (file_exists(e_PLUGIN . 'memberlist/languages/' . e_LANGUAGE . '.php')) {
		include_lan(e_PLUGIN . 'memberlist/languages/' . e_LANGUAGE . '.php');
	} else {
		include_lan(e_PLUGIN . 'memberlist/languages/English.php');
	}

	$mbl_obj = new memberlist();
}

if (isset($mbl_obj)) {
	$list = $mbl_obj->getGroupList($user['user_id']);
	
	if (check_class($MBL_PREF['editclass'])) {
		$edit = " <a href='".e_PLUGIN."memberlist/editgroup.php?".$user['user_id']."'><img src='".e_PLUGIN."memberlist/images/edit.png' border='0' alt='".LAN_MBL_GS02."' title='".LAN_MBL_GS02."'/></a>";
	} else {
		$edit = "";
	}
	
	$sc_text = "
		<tr>
			<td colspan='2' class='forumheader'>".LAN_MBL_GS01." $edit</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader3' style='text-align:center'>
	";
	
	$primGrp = $mbl_obj->getPrimaryClass($user['user_id']);	
	
	if ($list) {
		$first = true;
		while (list($cls, $name)=each($list)) {
			if (!$first) $sc_text .= "<br/>";
			$sc_text .= "<a href='".$mbl_obj->getGroupLink($cls)."' ".$mbl_obj->getGroupStyle($cls).">".($cls == $primGrp ? "[ " : "")."$name".($cls == $primGrp ? " ]" : "")."</a>";
			$first = false;
		}
	} else {
		$sc_text .= "-";
	}
	
	$sc_text .= "</td></tr>";
} else {
	$sc_text = "";
}

return $sc_text;