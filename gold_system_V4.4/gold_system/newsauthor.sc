
global $gold_obj,$gorb_obj;
$news_item = getcachedvars('current_news_item');
$param = getcachedvars('current_news_param');

if (isset($gold_obj) && $gold_obj->plugin_active('gold_orb'))
{
	if ($news_item['user_id'])
	{
	    $gold_data = $gold_obj->gold_member[$news_item['user_id']];
	    if ($parm == 'nolink')
	    {
    	    if (empty($gold_data['gold_orb']))
	        {
	            return $news_item['user_id'];
	        }
	        else
	        {
		        // replaced with show orb
	    	    return $gorb_obj->show_orb($news_item['user_id'], $news_item['user_name']);
        	}
    	}
    	else
    	{

	        if (empty($gold_data['gold_orb']))
	        {
	            return '<a href="' . e_BASE . 'user.php?id.' . $news_item['user_id'] . '">' . $news_item['user_name'] . '</a>';
	        }
	        else
	        {
                // replaced with show orb
	            return "<a href='" . e_BASE . "user.php?id." . $news_item['user_id'] . "'>" . $gorb_obj->show_orb($news_item['user_id'], $news_item['user_name']) . '</a>';
    	    }
    	}
	}
}
else
{
	 return '<a href="' . e_BASE . 'user.php?id.' . $news_item['user_id'] . '">' . $news_item['user_name'] . '</a>';
}