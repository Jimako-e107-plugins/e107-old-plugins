global $post_info, $gold_obj;
if(isset($gold_obj))
{
	return LAN_GS_SC003.': '.$gold_obj->formation($gold_obj->gold_spent($post_info['user_id']));
}
else
{
	return "";
}