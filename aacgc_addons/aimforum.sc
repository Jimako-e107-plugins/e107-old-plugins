parse_str($parm);
   global $post_info, $sql;

	$postowner  = $post_info['user_id'];

   if (USER){



	$sql->db_Select("user_extended", "*", "user_extended_id='".$postowner."'");
	$extp = $sql->db_Fetch();
             


if($extp['user_aim'] == "")
{$aim = "";}
else
{$aim = "<a href='aim:goim?screenname=".$extp['user_aim']."'><img src='http://technoserv.no-ip.org:8080/aim/".$extp['user_aim']."'></img></a>";}




 	
$aim_ims = "".$aim."";





return $aim_ims;}

