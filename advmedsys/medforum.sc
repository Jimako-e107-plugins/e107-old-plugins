parse_str($parm);
   global $post_info, $sql;

	$postowner  = $post_info['user_id'];

   if (USER){


	$sql->db_Select("advmedsys_awarded", "*", "awarded_user_id='".$postowner."'");
	$medcountf = 0;
	while($row = $sql->db_Fetch()){
	$medcountf = $medcountf + 1;
				}

	$medalsf = AMS_FORUM_S1.": ".$medcountf;
   }
return $medalsf;