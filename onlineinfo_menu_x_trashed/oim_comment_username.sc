global $comrow;
if (isset($comrow['user_id']) && $comrow['user_id']) 
{
	return "<a href='".e_BASE."user.php?id.".$comrow['user_id']."'".getuserclassinfo($comrow['user_id'])." >".$comrow['user_name']."</a>";
}
else
{
	$comrow['user_id'] = 0;
	$tmp = preg_replace("/[0-9]+\./", '', $comrow['comment_author']);
	return str_replace("Anonymous", LAN_ANONYMOUS, $tmp);
}
