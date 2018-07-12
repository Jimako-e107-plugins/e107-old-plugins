global $gold_sc_userid,$gold_obj,$user,$post_info;
// Uses a parameter containing the user id
// or a variable called $gold_sc_userid containing the user ID
// or a variable called $user with an element ['user_id'] containing the user ID
if(isset($gold_obj))
{
	if ($parm > 0)
	{
		return LAN_GS_GM013.' '.$gold_obj->formation($gold_obj->gold_spent($parm));
	}
	elseif ($gold_sc_userid>0)
	{
		return LAN_GS_GM013.' '.$gold_obj->formation($gold_obj->gold_spent($gold_sc_userid));
	}
	elseif($user['user_id']>0)
	{
		return LAN_GS_GM013.' '.$gold_obj->formation($gold_obj->gold_spent($user['user_id']));
	}
		elseif($post_info['user_id']>0)
	{
	// from forum
		return LAN_GS_GM013.' '.$gold_obj->formation($gold_obj->gold_balance($post_info['user_id']));
	}
	else
	{
		return '';
	}
}
else
{
	return '';
}