parse_str($parm);

	global $post_info, $sql;
	
	$post_id    = $post_info['thread_id'];
	
	$thankcount = 0;
   $thankcount = $sql->db_count("forum_thanks","(*)","WHERE Thanks_PostID= {$post_id} ");
   
return $text;
