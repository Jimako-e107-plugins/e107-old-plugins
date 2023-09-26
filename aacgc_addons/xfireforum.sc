parse_str($parm);
   global $post_info, $sql;

	$postowner  = $post_info['user_id'];

   if (USER){



	$sql->db_Select("user_extended", "*", "user_extended_id='".$postowner."'");
	$extp = $sql->db_Fetch();
             


if($extp['user_xfire'] == "")
{$xfire = "";}
else
{$xfire = "<a href='http://profile.xfire.com/".$extp['user_xfire']."'><img src='http://miniprofile.xfire.com/bg/bg/type/3/".$extp['user_xfire'].".png' width='149' height='29'></img></a>";}




 	
$xfire_ims = "".$xfire."";





return $xfire_ims;}

