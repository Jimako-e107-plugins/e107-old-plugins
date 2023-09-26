if ($pref['wishlist_enable_forums'] == "1"){

global $post_info, $sql;

$postowner  = $post_info['user_id'];

$sql->db_Select("aacgc_wishlist", "*", "WHERE list_user_id='".$postowner."'", "");
$row = $sql->db_Fetch();

if ($row['list_itema'] == "")
{$wishlistforum = "";}
else
{$wishlistforum = "<a href='".e_PLUGIN."aacgc_wishlist/Wish_List_Details.php?det.".$postowner."'><img src='".e_PLUGIN."aacgc_wishlist/images/mywishlistbutton.png'></img></a><br>";}


return "<br>".$wishlistforum."<br>";
}