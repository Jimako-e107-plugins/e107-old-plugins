parse_str($parm);
   global $post_info, $sql;

	$postowner  = $post_info['user_id'];

   if (USER){



	$sql->db_Select("user_extended", "*", "user_extended_id='".$postowner."'");
	$extp = $sql->db_Fetch();
             


if($extp['user_yahoo'] == "")
{$yahoo = "";}
else
{$yahoo = "<a href='http://edit.yahoo.com/config/send_webmesg?.target=".$extp['user_yahoo']."&.src=pg'><img src='http://opi.yahoo.com/online?u=".$extp['user_yahoo']."&m=g&t=2&l=us'></a>";}




 	
$yahoo_ims = "".$yahoo."";





return $yahoo_ims;}


