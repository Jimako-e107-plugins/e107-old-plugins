parse_str($parm);
   global $post_info, $sql;

	$postowner  = $post_info['user_id'];

   if (USER){



	$sql->db_Select("user_extended", "*", "user_extended_id='".$postowner."'");
	$extp = $sql->db_Fetch();
             


if($extp['user_facebook'] == "")
{$facebook = "";}
else
{$facebook = "
<a href='http://en-gb.facebook.com/".$extp['user_facebook']."' title='' target='_blank'></a>
<img width='".$pref['userfacebook_size']."px' src='http://badge.facebook.com/badge/".$extp['user_facebook_badge'].".png' alt='' style='border:0px' />
</a><br>
";}




 	
$facebook_ims = "".$facebook."";





return $facebook_ims;}
