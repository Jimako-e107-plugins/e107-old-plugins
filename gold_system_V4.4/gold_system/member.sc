global $post_info;
if ($post_info['user_id']) {
return LAN_GS_SC001.': '.$post_info['user_id'].'<br />';
}