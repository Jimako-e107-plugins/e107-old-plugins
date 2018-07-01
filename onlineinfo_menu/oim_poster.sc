global $post_info, $tp;

if($post_info['user_name'])
{
	return "<a href='".e_BASE."user.php?id.".$post_info['user_id']."' ".getuserclassinfo($post_info['user_id']).") ><b>".$post_info['user_name']."</b></a>";
}
else
{
	$x = explode(chr(1), $post_info['thread_user']);
	$tmp = explode(".", $x[0], 2);
	if(!$tmp[1])
	{
		return FORLAN_103;
	}
	else
	{
		return "<b>".$tmp[1]."</b>";
	}
}
