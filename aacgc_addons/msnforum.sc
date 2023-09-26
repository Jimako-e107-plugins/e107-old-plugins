parse_str($parm);
   global $post_info, $sql;

	$postowner  = $post_info['user_id'];

   if (USER){



	$sql->db_Select("user_extended", "*", "user_extended_id='".$postowner."'");
	$extp = $sql->db_Fetch();
             


if($extp['user_msn'] == "")
{$msn = "";}
else
{$msn = "<a href='http://osi.techno-st.net:8000/message/msn/".$extp['user_msn']."'><img src='http://osi.techno-st.net:8000/msn/".$extp['user_msn']."'></img></a>";}




 	
$msn_ims = "".$msn."";





return $msn_ims;}

