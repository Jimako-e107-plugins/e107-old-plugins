global $gold_sc_userid,$gold_obj,$user;
// Uses a parameter containing the user id
// or a variable called $gold_sc_userid containing the user ID
// or a variable called $user with an element ['user_id'] containing the user ID
if (isset($gold_obj) && $gold_obj->plugin_active('gold_orb'))
{
	if ($parm > 0)
	{
		$gold_sc_userid=intval($parm);
	}
	elseif ($gold_sc_userid>0)
	{
		$gold_sc_userid=$gold_sc_userid;
	}
	elseif($user['user_id']>0)
	{
		$gold_sc_userid=$user['user_id'];
	}
	else
	{
		$gold_sc_userid=0;
	}
	if($gold_sc_userid > 0)
	{
		$gold_obj->load_gold($gold_sc_userid);
		return "<a href='".e_BASE."user.php?id.".$gold_obj->gold_member[$gold_sc_userid]['gold_id']."'>".$gold_obj->show_orb($gold_obj->gold_member[$gold_sc_userid]['gold_id'], $gold_obj->gold_member[$gold_sc_userid]['user_name']). "</a>";
	}
	else
	{
		return '';
	}
}
else
{
	return "";
}
