global $user,$gold_obj;
if(isset($gold_obj))
{
	return $gold_obj->formation($gold_obj->gold_balance($user['user_id']));
}
else
{
	return "";
}