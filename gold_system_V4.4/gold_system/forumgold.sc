global $post_info, $GOLD_PREF, $gold_obj;
if(isset($gold_obj))
{
	if ($post_info['user_id']==USERID)
	{
	    return $GOLD_PREF['gold_currency_name'].' '.$gold_obj->formation($gold_obj->gold_balance($post_info['user_id']));
	}
	elseif ($post_info['user_id'])
	{
	    return '<a href="' . e_PLUGIN . 'gold_system/donate.php?'.$post_info['user_name'].'" title="'.LAN_GS_FORRUMSC_01.'">'.$GOLD_PREF['gold_currency_name'].'</a>: ' . $gold_obj->formation($gold_obj->gold_balance($post_info['user_id']));
	}
}
else
{
	return '';
}
