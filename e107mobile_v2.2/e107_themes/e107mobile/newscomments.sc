global $pref, $sql;
if($pref['comments_disabled'] == 1)
{
	return;
}
$news_item = getcachedvars('current_news_item');
$param = getcachedvars('current_news_param');

if (varsettrue($pref['multilanguage']))
{	// Can have multilanguage news table, monlingual comment table. If the comment table is multilingual, it'll only count entries in the current language
	$news_item['news_comment_total'] = $sql->db_Select("comments", "*", "comment_item_id='".$news_item['news_id']."' AND comment_type='0' ");
}

if ($pref['comments_icon'] && $news_item['news_comment_total'])
{
	$sql->db_Select('comments', 'comment_datestamp', "comment_item_id='".intval($news_item['news_id'])."' AND comment_type='0' ORDER BY comment_datestamp DESC LIMIT 0,1");
	list($comments['comment_datestamp']) = $sql->db_Fetch();
	$latest_comment = $comments['comment_datestamp'];
	if ($latest_comment > USERLV )
	{
		$NEWIMAGE = $param['image_new_small'];
	}
	else
	{
		$NEWIMAGE = $param['image_nonew_small'];
	}
}
else
{
	$NEWIMAGE = $param['image_nonew_small'];
}

switch($news_item['news_comment_total']) {

	case "1":
	$nctext="1 Comment";
	break;
	
	case "0":
	$nctext="Add Comment";
	break;
	
	default:
	$nctext=$news_item['news_comment_total']." Comments";
	}

return ($news_item['news_allow_comments'] ? $param['commentoffstring'] 
:
 ''.($pref['comments_icon'] ? $NEWIMAGE : '')." <a href='".e_HTTP."comment.php?comment.news.".$news_item['news_id']."'>".$nctext.'</a>');