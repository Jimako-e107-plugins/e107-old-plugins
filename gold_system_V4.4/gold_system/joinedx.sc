// for use in forum view topic
global $post_info;
if ($post_info['user_id'])
{
	if(!empty($parm))
	{
		return LAN_GS_SC002.': '.date($parm,$post_info['user_join']).'<br />';
	}
	else
	{
		require_once(e_HANDLER.'date_handler.php');
		$gold_conv=new convert;
		return LAN_GS_SC002.': '.$gold_conv->convert_date($post_info['user_join'],'short').'<br />';
	}
}